@extends('layouts.app')
@section('title', 'Items — ISP Inventory')
@section('page_title', 'Items')
@section('content')
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-lg">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-5">
            <h3 class="text-lg font-semibold">All Items</h3>
            <div class="flex gap-2">
                <a href="{{ route('items.import.form') }}" class="px-4 py-2 rounded-xl bg-purple-500/20 text-purple-400 border border-purple-500/30 text-sm font-medium transition-all duration-300 hover:bg-purple-500/30">Import</a>
                <a href="{{ route('items.export.xlsx') }}" class="px-4 py-2 rounded-xl bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 text-sm font-medium transition-all duration-300 hover:bg-emerald-500/30">Export XLSX</a>
                <a href="{{ route('items.create') }}" class="px-4 py-2 rounded-xl bg-cyan-500/20 text-cyan-400 border border-cyan-500/30 text-sm font-medium transition-all duration-300 hover:bg-cyan-500/30">+ Add Item</a>
            </div>
        </div>

        <form method="GET" action="{{ route('items.index') }}" class="flex flex-col sm:flex-row gap-3 mb-5">
            <select name="category_id" class="px-4 py-2 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition text-sm">
                <option value="" class="bg-slate-800">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }} class="bg-slate-800">{{ $cat->name }}</option>
                @endforeach
            </select>
            <div class="flex-1 relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari item..." class="w-full px-4 py-2 rounded-xl bg-white/5 border border-white/10 text-slate-100 placeholder-slate-500 focus:border-cyan-500/50 focus:outline-none transition text-sm">
            </div>
            <button type="submit" class="px-4 py-2 rounded-xl bg-cyan-500/20 text-cyan-400 border border-cyan-500/30 text-sm font-medium hover:bg-cyan-500/30">Filter</button>
            @if(request('category_id') || request('search'))
                <a href="{{ route('items.index') }}" class="px-4 py-2 rounded-xl bg-rose-500/20 text-rose-400 border border-rose-500/30 text-sm font-medium hover:bg-rose-500/30">Clear</a>
            @endif
        </form>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b border-white/10 text-slate-400 uppercase tracking-wider text-xs">
                        <th class="pb-3 pr-4">Name</th>
                        <th class="pb-3 pr-4">Category</th>
                        <th class="pb-3 pr-4">Serial</th>
                        <th class="pb-3 pr-4">Stock</th>
                        <th class="pb-3 pr-4">Location</th>
                        <th class="pb-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr class="border-b border-white/5 transition-all duration-200 hover:bg-white/5">
                            <td class="py-3 pr-4 font-medium">{{ $item->name }}</td>
                            <td class="py-3 pr-4 text-slate-400">{{ $item->category->name ?? '—' }}</td>
                            <td class="py-3 pr-4 text-slate-400">{{ $item->serial_number }}</td>
                            <td class="py-3 pr-4">
                                <span class="{{ $item->stock_quantity <= 5 ? 'text-amber-400 font-semibold' : 'text-slate-100' }}">
                                    {{ $item->stock_quantity }} {{ $item->unit }}
                                </span>
                            </td>
                            <td class="py-3 pr-4 text-slate-400">{{ $item->location ?? '—' }}</td>
                            <td class="py-3 flex gap-2">
                                <a href="{{ route('items.show', $item) }}" class="px-3 py-1 rounded-lg bg-white/5 text-slate-300 text-xs transition-all duration-200 hover:bg-white/10">View</a>
                                <a href="{{ route('items.edit', $item) }}" class="px-3 py-1 rounded-lg bg-cyan-500/10 text-cyan-400 text-xs transition-all duration-200 hover:bg-cyan-500/20">Edit</a>
                                <form action="{{ route('items.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus item ini?')">
                                    @csrf @method('DELETE')
                                    <button class="px-3 py-1 rounded-lg bg-rose-500/10 text-rose-400 text-xs transition-all duration-200 hover:bg-rose-500/20">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-6 text-center text-slate-500">Belum ada item.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            {{ $items->links() }}
        </div>
    </div>
@endsection
