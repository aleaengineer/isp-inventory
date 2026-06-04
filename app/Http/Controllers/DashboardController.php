<?php
namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalItems       = Item::count();
        $totalCategories  = Category::count();
        $totalSuppliers   = Supplier::count();
        $excludeCategories = ['Router & Core Network', 'GPON OLT', 'EPON OLT', 'Switch'];
        $lowStockCount    = Item::where('stock_quantity', '<=', 5)->where('stock_quantity', '>', 0)
            ->whereHas('category', fn($q) => $q->whereNotIn('name', $excludeCategories))
            ->count();
        $totalTransactions = Transaction::count();
        $recentTransactions = Transaction::with('item')->latest()->take(5)->get();
        $lowStockItemList  = Item::with('category')
            ->where('stock_quantity', '<=', 5)->where('stock_quantity', '>', 0)
            ->whereHas('category', fn($q) => $q->whereNotIn('name', $excludeCategories))
            ->take(10)->get();

        // Chart data: transactions per day (last 14 days)
        $chartLabels = [];
        $chartIn = [];
        $chartOut = [];
        for ($i = 13; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $chartLabels[] = now()->subDays($i)->format('d M');
            $chartIn[] = Transaction::whereDate('transaction_date', $date)->where('transaction_type', 'in')->count();
            $chartOut[] = Transaction::whereDate('transaction_date', $date)->where('transaction_type', 'out')->count();
        }

        $searchResults = collect();
        $searchQuery = $request->input('q');

        if ($searchQuery) {
            $searchResults = Item::with('category')
                ->where('name', 'like', "%{$searchQuery}%")
                ->orWhere('serial_number', 'like', "%{$searchQuery}%")
                ->orWhere('mac_address', 'like', "%{$searchQuery}%")
                ->orWhere('location', 'like', "%{$searchQuery}%")
                ->paginate(10)
                ->appends(['q' => $searchQuery]);
        }

        return view('dashboard', compact(
            'totalItems', 'totalCategories', 'totalSuppliers', 'lowStockCount',
            'totalTransactions', 'recentTransactions', 'lowStockItemList',
            'chartLabels', 'chartIn', 'chartOut',
            'searchResults', 'searchQuery'
        ));
    }
}
