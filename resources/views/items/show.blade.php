@extends('layouts.app')
@section('title', $item->name . ' — ISP Inventory')
@section('page_title', $item->name)
@section('content')
    <div class="space-y-6">

        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-lg">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @if($item->image)
                    <div class="lg:col-span-3">
                        <img src="{{ asset('storage/' . $item->image) }}" class="w-48 h-48 object-cover rounded-xl border border-white/10">
                    </div>
                @endif
                <div>
                    <p class="text-xs uppercase tracking-widest text-slate-500">Category</p>
                    <p class="text-lg font-semibold mt-1">{{ $item->category->name ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-widest text-slate-500">Serial Number</p>
                    <p class="text-lg font-semibold mt-1">{{ $item->serial_number }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-widest text-slate-500">MAC Address</p>
                    <p class="text-lg font-semibold mt-1">{{ $item->mac_address ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-widest text-slate-500">Stock</p>
                    <p class="text-lg font-semibold mt-1 {{ $item->stock_quantity <= 5 ? 'text-amber-400' : '' }}">{{ $item->stock_quantity }} {{ $item->unit }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-widest text-slate-500">Location</p>
                    <p class="text-lg font-semibold mt-1">{{ $item->location ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-widest text-slate-500">Supplier</p>
                    <p class="text-lg font-semibold mt-1">{{ $item->supplier->name ?? '—' }}</p>
                </div>
            </div>
            <div class="flex gap-3 mt-6 pt-4 border-t border-white/10">
                <a href="{{ route('items.edit', $item) }}" class="px-4 py-2 rounded-xl bg-cyan-500/20 text-cyan-400 border border-cyan-500/30 text-sm transition-all duration-300 hover:bg-cyan-500/30">Edit Item</a>
                <a href="{{ route('items.index') }}" class="px-4 py-2 rounded-xl bg-white/5 text-slate-300 border border-white/10 text-sm transition-all duration-300 hover:bg-white/10">Back</a>
            </div>
        </div>

        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-lg">
            <h3 class="text-lg font-semibold mb-5">Transaction History</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="border-b border-white/10 text-slate-400 uppercase tracking-wider text-xs">
                            <th class="pb-3 pr-4">Type</th>
                            <th class="pb-3 pr-4">Qty</th>
                            <th class="pb-3 pr-4">Technician</th>
                            <th class="pb-3 pr-4">Purpose</th>
                            <th class="pb-3">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($item->transactions as $tx)
                            <tr class="border-b border-white/5 transition-all duration-200 hover:bg-white/5">
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
                                <td class="py-3 text-slate-500 whitespace-nowrap">{{ $tx->transaction_date->format('Y-m-d H:i') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="py-6 text-center text-slate-500">Belum ada transaksi untuk item ini.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
