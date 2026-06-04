@extends('layouts.app')
@section('title', $supplier->name . ' — ISP Inventory')
@section('page_title', $supplier->name)
@section('content')
    <div class="space-y-6">
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-lg">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <p class="text-xs uppercase tracking-widest text-slate-500">Contact Person</p>
                    <p class="text-lg font-semibold mt-1">{{ $supplier->contact_person ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-widest text-slate-500">Phone</p>
                    <p class="text-lg font-semibold mt-1">{{ $supplier->phone ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-widest text-slate-500">Email</p>
                    <p class="text-lg font-semibold mt-1">{{ $supplier->email ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-widest text-slate-500">Address</p>
                    <p class="text-lg font-semibold mt-1">{{ $supplier->address ?? '—' }}</p>
                </div>
            </div>
            <div class="flex gap-3 mt-6 pt-4 border-t border-white/10">
                <a href="{{ route('suppliers.edit', $supplier) }}" class="px-4 py-2 rounded-xl bg-cyan-500/20 text-cyan-400 border border-cyan-500/30 text-sm hover:bg-cyan-500/30">Edit</a>
                <a href="{{ route('suppliers.index') }}" class="px-4 py-2 rounded-xl bg-white/5 text-slate-300 border border-white/10 text-sm hover:bg-white/10">Back</a>
            </div>
        </div>

        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-lg">
            <h3 class="text-lg font-semibold mb-5">Items from {{ $supplier->name }}</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="border-b border-white/10 text-slate-400 uppercase tracking-wider text-xs">
                            <th class="pb-3 pr-4">Name</th>
                            <th class="pb-3 pr-4">Category</th>
                            <th class="pb-3 pr-4">Serial</th>
                            <th class="pb-3 pr-4">Stock</th>
                            <th class="pb-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($supplier->items as $item)
                            <tr class="border-b border-white/5 hover:bg-white/5">
                                <td class="py-3 pr-4 font-medium">{{ $item->name }}</td>
                                <td class="py-3 pr-4 text-slate-400">{{ $item->category->name ?? '—' }}</td>
                                <td class="py-3 pr-4 text-slate-400">{{ $item->serial_number }}</td>
                                <td class="py-3 pr-4">{{ $item->stock_quantity }} {{ $item->unit }}</td>
                                <td class="py-3"><a href="{{ route('items.show', $item) }}" class="px-3 py-1 rounded-lg bg-cyan-500/10 text-cyan-400 text-xs hover:bg-cyan-500/20">View</a></td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="py-6 text-center text-slate-500">Belum ada item dari supplier ini.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
