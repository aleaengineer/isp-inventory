<?php
namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Item;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('item')->latest()->paginate(15);
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $items = Item::all();
        return view('transactions.create', compact('items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'item_id'          => 'required|exists:items,id',
            'transaction_type' => 'required|in:in,out',
            'quantity'         => 'required|integer|min:1',
            'technician_name'  => 'required|string|max:255',
            'purpose'          => 'nullable|string',
            'transaction_date' => 'required|date',
        ]);

        $item = Item::findOrFail($data['item_id']);

        if ($data['transaction_type'] === 'out' && $item->stock_quantity < $data['quantity']) {
            return back()->withErrors(['quantity' => 'Stok tidak mencukupi. Stok saat ini: ' . $item->stock_quantity])->withInput();
        }

        $item->decrement('stock_quantity', $data['transaction_type'] === 'out' ? $data['quantity'] : 0);
        $item->increment('stock_quantity', $data['transaction_type'] === 'in' ? $data['quantity'] : 0);

        Transaction::create($data);

        return redirect()->route('transactions.index')->with('success', 'Transaction recorded.');
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('item');
        return view('transactions.show', compact('transaction'));
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted.');
    }
}
