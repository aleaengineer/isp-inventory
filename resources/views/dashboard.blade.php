@extends('layouts.app')
@section('title', 'Dashboard — ISP Inventory')
@section('page_title', 'Dashboard')
@section('content')
    <div class="space-y-8">

        {{-- Summary Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-5 shadow-lg transition-all duration-300 hover:bg-white/10 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-slate-500">Total Items</p>
                        <p class="text-3xl font-bold mt-1 text-white">{{ $totalItems }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-cyan-500/20 flex items-center justify-center text-2xl">📦</div>
                </div>
            </div>

            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-5 shadow-lg transition-all duration-300 hover:bg-white/10 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-slate-500">Categories</p>
                        <p class="text-3xl font-bold mt-1 text-white">{{ $totalCategories }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-purple-500/20 flex items-center justify-center text-2xl">📁</div>
                </div>
            </div>

            <div class="bg-white/5 backdrop-blur-xl border border-amber-500/30 rounded-2xl p-5 shadow-lg transition-all duration-300 hover:bg-white/10 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-amber-400">Low Stock</p>
                        <p class="text-3xl font-bold mt-1 text-amber-300">{{ $lowStockCount }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-amber-500/20 flex items-center justify-center text-2xl">⚠️</div>
                </div>
            </div>

            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-5 shadow-lg transition-all duration-300 hover:bg-white/10 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-slate-500">Transactions</p>
                        <p class="text-3xl font-bold mt-1 text-white">{{ $totalTransactions }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/20 flex items-center justify-center text-2xl">🔄</div>
                </div>
            </div>

            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-5 shadow-lg transition-all duration-300 hover:bg-white/10 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-slate-500">Suppliers</p>
                        <p class="text-3xl font-bold mt-1 text-white">{{ $totalSuppliers }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-indigo-500/20 flex items-center justify-center text-2xl">🏭</div>
                </div>
            </div>

        </div>

        {{-- Low Stock Alert --}}
        @if($lowStockItemList->isNotEmpty())
            <div class="bg-amber-500/5 backdrop-blur-xl border border-amber-500/30 rounded-2xl p-6 shadow-lg">
                <h3 class="text-lg font-semibold text-amber-400 mb-4 flex items-center gap-2">⚠️ Low Stock Items</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="border-b border-amber-500/20 text-amber-400 uppercase tracking-wider text-xs">
                                <th class="pb-3 pr-4">Name</th>
                                <th class="pb-3 pr-4">Category</th>
                                <th class="pb-3 pr-4">Stock</th>
                                <th class="pb-3 pr-4">Location</th>
                                <th class="pb-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lowStockItemList as $item)
                                <tr class="border-b border-amber-500/10 hover:bg-amber-500/5 transition-all duration-200">
                                    <td class="py-3 pr-4 font-medium text-amber-300">{{ $item->name }}</td>
                                    <td class="py-3 pr-4 text-amber-400/70">{{ $item->category->name ?? '—' }}</td>
                                    <td class="py-3 pr-4 font-semibold text-amber-400">{{ $item->stock_quantity }} {{ $item->unit }}</td>
                                    <td class="py-3 pr-4 text-amber-400/70">{{ $item->location ?? '—' }}</td>
                                    <td class="py-3"><a href="{{ route('items.show', $item) }}" class="px-3 py-1 rounded-lg bg-amber-500/20 text-amber-400 text-xs hover:bg-amber-500/30">Detail</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        {{-- Chart --}}
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-lg">
            <h3 class="text-lg font-semibold mb-5 flex items-center gap-2">📈 Transactions (14 Days)</h3>
            <canvas id="transactionChart" height="100"></canvas>
        </div>

        {{-- Search Bar --}}
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-lg">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4" x-data="{ q: '{{ $searchQuery ?? '' }}' }">
                <div class="flex-1 relative w-full">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <form action="{{ route('dashboard') }}" method="GET" class="w-full">
                        <input type="text" name="q" x-model="q" placeholder="Cari barang..." class="w-full pl-12 pr-4 py-3 rounded-xl bg-white/5 border border-white/10 text-slate-100 placeholder-slate-500 focus:border-cyan-500/50 focus:outline-none focus:ring-1 focus:ring-cyan-500/20 transition-all text-sm">
                    </form>
                </div>
                <a href="{{ $searchQuery ? route('dashboard') : '#' }}" class="px-5 py-3 rounded-xl text-sm font-medium transition-all duration-200 whitespace-nowrap {{ $searchQuery ? 'bg-rose-500/20 text-rose-400 border border-rose-500/30 hover:bg-rose-500/30' : 'bg-white/5 text-slate-500 border border-white/10 cursor-not-allowed' }}">{{ $searchQuery ? 'Clear' : 'Search' }}</a>
            </div>
        </div>

        {{-- Search Results --}}
        @if ($searchQuery)
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-lg">
                <h3 class="text-lg font-semibold mb-5 flex items-center gap-2">🔍 Hasil: "{{ $searchQuery }}" <span class="text-sm font-normal text-slate-500">({{ $searchResults->total() }})</span></h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="border-b border-white/10 text-slate-400 uppercase tracking-wider text-xs">
                                <th class="pb-3 pr-4">Name</th>
                                <th class="pb-3 pr-4">Category</th>
                                <th class="pb-3 pr-4">Serial</th>
                                <th class="pb-3 pr-4">Stock</th>
                                <th class="pb-3 pr-4">Location</th>
                                <th class="pb-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($searchResults as $item)
                                <tr class="border-b border-white/5 transition-all duration-200 hover:bg-white/5">
                                    <td class="py-3 pr-4 font-medium">{{ $item->name }}</td>
                                    <td class="py-3 pr-4 text-slate-400">{{ $item->category->name ?? '—' }}</td>
                                    <td class="py-3 pr-4 text-slate-400 font-mono text-xs">{{ $item->serial_number }}</td>
                                    <td class="py-3 pr-4"><span class="{{ $item->stock_quantity <= 5 ? 'text-amber-400 font-semibold' : 'text-slate-100' }}">{{ $item->stock_quantity }} {{ $item->unit }}</span></td>
                                    <td class="py-3 pr-4 text-slate-400">{{ $item->location ?? '—' }}</td>
                                    <td class="py-3"><a href="{{ route('items.show', $item) }}" class="px-3 py-1 rounded-lg bg-cyan-500/10 text-cyan-400 text-xs hover:bg-cyan-500/20">Detail</a></td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="py-6 text-center text-slate-500">Tidak ditemukan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="block md:hidden space-y-3 mt-4">
                    @forelse($searchResults as $item)
                        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-semibold">{{ $item->name }}</p>
                                    <p class="text-xs text-slate-400 mt-1">{{ $item->category->name ?? '—' }} · {{ $item->serial_number }}</p>
                                </div>
                                <span class="px-2 py-0.5 rounded-full text-xs font-semibold {{ $item->stock_quantity <= 5 ? 'bg-amber-500/20 text-amber-400' : 'bg-emerald-500/20 text-emerald-400' }}">{{ $item->stock_quantity }} {{ $item->unit }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-slate-500 py-4">Tidak ditemukan.</p>
                    @endforelse
                </div>
                <div class="mt-5">{{ $searchResults->links() }}</div>
            </div>
        @endif

        {{-- Recent Transactions --}}
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-lg">
            <h3 class="text-lg font-semibold mb-5 flex items-center gap-2">📋 Recent Transactions</h3>
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
                        @forelse($recentTransactions as $tx)
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
            <div class="block md:hidden space-y-3 mt-4">
                @forelse($recentTransactions as $tx)
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-semibold">{{ $tx->item->name ?? '—' }}</p>
                                <p class="text-xs text-slate-400 mt-1">Technician: {{ $tx->technician_name }}</p>
                                <p class="text-xs text-slate-400">Purpose: {{ $tx->purpose ?? '—' }}</p>
                            </div>
                            <span class="px-2 py-0.5 rounded-full text-xs font-semibold {{ $tx->transaction_type === 'in' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-rose-500/20 text-rose-400' }}">{{ ucfirst($tx->transaction_type) }} · {{ $tx->quantity }}</span>
                        </div>
                        <p class="text-xs text-slate-500 mt-2">{{ $tx->transaction_date->format('Y-m-d') }}</p>
                    </div>
                @empty
                    <p class="text-center text-slate-500 py-4">Belum ada transaksi.</p>
                @endforelse
            </div>
        </div>

    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('transactionChart')?.getContext('2d');
    if (!ctx) return;

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [
                {
                    label: 'Stock In',
                    data: {!! json_encode($chartIn) !!},
                    borderColor: '#34d399',
                    backgroundColor: 'rgba(52, 211, 153, 0.1)',
                    fill: true,
                    tension: 0.3,
                },
                {
                    label: 'Stock Out',
                    data: {!! json_encode($chartOut) !!},
                    borderColor: '#fb7185',
                    backgroundColor: 'rgba(251, 113, 133, 0.1)',
                    fill: true,
                    tension: 0.3,
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: { color: '#94a3b8' }
                }
            },
            scales: {
                x: { ticks: { color: '#64748b' }, grid: { color: 'rgba(255,255,255,0.05)' } },
                y: { ticks: { color: '#64748b' }, grid: { color: 'rgba(255,255,255,0.05)' }, beginAtZero: true }
            }
        }
    });
});
</script>
@endpush
