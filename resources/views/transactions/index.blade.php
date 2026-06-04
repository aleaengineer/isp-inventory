@extends('layouts.app')

@section('title', 'Transactions — ISP Inventory')
@section('page_title', 'Transactions')

@section('content')
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-lg">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-lg font-semibold">All Transactions</h3>
            <a href="{{ route('transactions.create') }}" class="px-4 py-2 rounded-xl bg-cyan-500/20 text-cyan-400 border border-cyan-500/30 text-sm font-medium transition-all duration-300 hover:bg-cyan-500/30">+ New Transaction</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b border-white/10 text-slate-400 uppercase tracking-wider text-xs">
                        <th class="pb-3 pr-4">Item</th>
                        <th class="pb-3 pr-4">Type</th>
                        <th class="pb-3 pr-4">Qty</th>
                        <th class="pb-3 pr-4">Technician</th>
                        <th class="pb-3 pr-4">Purpose</th>
                        <th class="pb-3">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $tx)
                        <tr class="border-b border-white/5 transition-all duration-200 hover:bg-white/5">
                            <td class="py-3 pr-4 font-medium">{{ $tx->item->name ?? '—' }}</td>
                            <td class="py-3 pr-4">
                                @if ($tx->transaction_type === 'in')
                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/20 text-emerald-400">In</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-rose-500/20 text-rose-400">Out</span>
                                @endif
                            </td>
                            <td class="py-3 pr-4">{{ $tx->quantity }}</td>
                            <td class="py-3 pr-4 text-slate-400">{{ $tx->technician_name }}</td>
                            <td class="py-3 pr-4 text-slate-400">{{ $tx->purpose ?? '—' }}</td>
                            <td class="py-3 text-slate-500 whitespace-nowrap">{{ $tx->transaction_date->format('Y-m-d') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="py-6 text-center text-slate-500">Belum ada transaksi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">{{ $transactions->links() }}</div>
    </div>
@endsection
