@extends('layouts.app')

@section('title', 'Categories — ISP Inventory')
@section('page_title', 'Categories')

@section('content')
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-lg">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-lg font-semibold">All Categories</h3>
            <a href="{{ route('categories.create') }}" class="px-4 py-2 rounded-xl bg-cyan-500/20 text-cyan-400 border border-cyan-500/30 text-sm font-medium transition-all duration-300 hover:bg-cyan-500/30">+ Add Category</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b border-white/10 text-slate-400 uppercase tracking-wider text-xs">
                        <th class="pb-3 pr-4">Name</th>
                        <th class="pb-3 pr-4">Items Count</th>
                        <th class="pb-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $cat)
                        <tr class="border-b border-white/5 transition-all duration-200 hover:bg-white/5">
                            <td class="py-3 pr-4 font-medium">{{ $cat->name }}</td>
                            <td class="py-3 pr-4 text-slate-400">{{ $cat->items_count }}</td>
                            <td class="py-3 flex gap-2">
                                <a href="{{ route('categories.edit', $cat) }}" class="px-3 py-1 rounded-lg bg-cyan-500/10 text-cyan-400 text-xs transition-all duration-200 hover:bg-cyan-500/20">Edit</a>
                                <form action="{{ route('categories.destroy', $cat) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf @method('DELETE')
                                    <button class="px-3 py-1 rounded-lg bg-rose-500/10 text-rose-400 text-xs transition-all duration-200 hover:bg-rose-500/20">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="py-6 text-center text-slate-500">Belum ada kategori.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">{{ $categories->links() }}</div>
    </div>
@endsection
