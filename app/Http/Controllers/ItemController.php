<?php
namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Supplier;
use App\Imports\ItemsImport;
use App\Exports\ItemsTemplateExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $items = Item::with('category')
            ->filter($request->only(['category_id', 'search']))
            ->paginate(10)
            ->appends($request->only(['category_id', 'search']));
        $categories = Category::all();
        return view('items.index', compact('items', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('items.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'name'           => 'required|string|max:255',
            'mac_address'    => 'nullable|string|max:17',
            'serial_number'  => 'required|string|unique:items',
            'stock_quantity' => 'required|integer|min:0',
            'unit'           => 'required|string|max:20',
            'location'       => 'nullable|string|max:255',
            'supplier_id'    => 'nullable|exists:suppliers,id',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('items', 'public');
        }

        Item::create($data);
        $this->checkLowStockAndNotify();
        return redirect()->route('items.index')->with('success', 'Item created.');
    }

    public function show(Item $item)
    {
        $item->load('category', 'transactions', 'supplier');
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('items.edit', compact('item', 'categories', 'suppliers'));
    }

    public function update(Request $request, Item $item)
    {
        $data = $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'name'           => 'required|string|max:255',
            'mac_address'    => 'nullable|string|max:17',
            'serial_number'  => 'required|string|unique:items,serial_number,' . $item->id,
            'stock_quantity' => 'required|integer|min:0',
            'unit'           => 'required|string|max:20',
            'location'       => 'nullable|string|max:255',
            'supplier_id'    => 'nullable|exists:suppliers,id',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $data['image'] = $request->file('image')->store('items', 'public');
        }

        $item->update($data);
        $this->checkLowStockAndNotify();
        return redirect()->route('items.index')->with('success', 'Item updated.');
    }

    public function destroy(Item $item)
    {
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item deleted.');
    }

    public function importForm()
    {
        return view('items.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        $path = $request->file('file')->store('imports');
        $fullPath = storage_path('app/' . $path);

        $importer = new ItemsImport();
        $result = $importer->import($fullPath);

        unlink($fullPath);

        if ($result['success']) {
            return redirect()->route('items.index')->with('success', $result['message'])
                ->with('import_errors', $result['errors'] ?? []);
        }

        return back()->withErrors(['file' => $result['message']]);
    }

    public function template()
    {
        $export = new ItemsTemplateExport();
        $export->download();
    }

    public function printLabel(Item $item)
    {
        $item->load('category');
        return view('items.partials.print-label', compact('item'));
    }

    private function checkLowStockAndNotify(int $threshold = 5): void
    {
        $excludeCategories = ['Router & Core Network', 'GPON OLT', 'EPON OLT', 'Switch'];
        $lowStockItems = Item::where('stock_quantity', '<=', $threshold)
            ->where('stock_quantity', '>', 0)
            ->whereHas('category', fn($q) => $q->whereNotIn('name', $excludeCategories))
            ->get();

        if ($lowStockItems->isEmpty()) return;

        $message = "\u{26A0}\u{FE0F} *Low Stock Alert*\n";
        foreach ($lowStockItems as $item) {
            $message .= "- {$item->name}: {$item->stock_quantity} {$item->unit} tersisa\n";
        }

        \Illuminate\Support\Facades\Log::warning('Low Stock Alert', ['items' => $lowStockItems->toArray()]);
    }
}
