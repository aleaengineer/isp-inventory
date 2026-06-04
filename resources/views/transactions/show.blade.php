@extends('layouts.app')

@section('title', 'Transaction Detail — ISP Inventory')
@section('page_title', 'Transaction #' . $transaction->id)

@section('content')
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-lg max-w-2xl">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <p class="text-xs uppercase tracking-widest text-slate-500">Item</p>
                <p class="text-lg font-semibold mt-1">{{ $transaction->item->name ?? '—' }}</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-widest text-slate-500">Type</p>
                <p class="mt-1">
                    @if ($transaction->transaction_type === 'in')
                        <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/20 text-emerald-400">Stock In</span>
                    @else
                        <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-rose-500/20 text-rose-400">Stock Out</span>
                    @endif
                </p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-widest text-slate-500">Quantity</p>
                <p class="text-lg font-semibold mt-1">{{ $transaction->quantity }}</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-widest text-slate-500">Technician</p>
                <p class="text-lg font-semibold mt-1">{{ $transaction->technician_name }}</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-widest text-slate-500">Purpose</p>
                <p class="text-lg font-semibold mt-1">{{ $transaction->purpose ?? '—' }}</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-widest text-slate-500">Date</p>
                <p class="text-lg font-semibold mt-1">{{ $transaction->transaction_date->format('Y-m-d H:i') }}</p>
            </div>
        </div>
        <div class="flex gap-3 mt-6 pt-4 border-t border-white/10">
            <a href="{{ route('transactions.index') }}" class="px-4 py-2 rounded-xl bg-white/5 text-slate-300 border border-white/10 text-sm transition-all duration-300 hover:bg-white/10">Back</a>
        </div>
    </div>
@endsection
