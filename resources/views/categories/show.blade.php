@extends('layouts.app')

@section('title', $category->name . ' — ISP Inventory')
@section('page_title', $category->name)

@section('content')
    <div class="space-y-6">

        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-lg">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <p class="text-xs uppercase tracking-widest text-slate-500">Slug</p>
                    <p class="text-lg font-semibold mt-1">{{ $category->slug }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-widest text-slate-500">Total Items</p>
                    <p class="text-lg font-semibold mt-1">{{ $category->items->count() }}</p>
                </div>
            </div>
            @if ($category->description)
                <div class="mt-4">
                    <p class="text-xs uppercase tracking-widest text-slate-500">Description</p>
                    <p class="mt-1 text-slate-300">{{ $category->description }}</p>
                </div>
            @endif
            <div class="flex gap-3 mt-6 pt-4 border-t border-white/10">
                <a href="{{ route('categories.edit', $category) }}" class="px-4 py-2 rounded-xl bg-cyan-500/20 text-cyan-400 border border-cyan-500/30 text-sm transition-all duration-300 hover:bg-cyan-500/30">Edit</a>
                <a href="{{ route('categories.index') }}" class="px-4 py-2 rounded-xl bg-white/5 text-slate-300 border border-white/10 text-sm transition-all duration-300 hover:bg-white/10">Back</a>
            </div>
        </div>

        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-lg">
            <h3 class="text-lg font-semibold mb-5">Items in {{ $category->name }}</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="border-b border-white/10 text-slate-400 uppercase tracking-wider text-xs">
                            <th class="pb-3 pr-4">Name</th>
                            <th class="pb-3 pr-4">Serial</th>
                            <th class="pb-3 pr-4">Stock</th>
                            <th class="pb-3">Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($category->items as $item)
                            <tr class="border-b border-white/5 transition-all duration-200 hover:bg-white/5">
                                <td class="py-3 pr-4 font-medium">{{ $item->name }}</td>
                                <td class="py-3 pr-4 text-slate-400">{{ $item->serial_number }}</td>
                                <td class="py-3 pr-4">{{ $item->stock_quantity }} {{ $item->unit }}</td>
                                <td class="py-3 text-slate-400">{{ $item->location ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="py-6 text-center text-slate-500">Tidak ada item dalam kategori ini.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
