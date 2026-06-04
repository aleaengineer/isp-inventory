@extends('layouts.app')
@section('title', 'Suppliers — ISP Inventory')
@section('page_title', 'Suppliers')
@section('content')
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-lg">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-lg font-semibold">All Suppliers</h3>
            <a href="{{ route('suppliers.create') }}" class="px-4 py-2 rounded-xl bg-cyan-500/20 text-cyan-400 border border-cyan-500/30 text-sm font-medium transition-all duration-300 hover:bg-cyan-500/30">+ Add Supplier</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b border-white/10 text-slate-400 uppercase tracking-wider text-xs">
                        <th class="pb-3 pr-4">Name</th>
                        <th class="pb-3 pr-4">Contact</th>
                        <th class="pb-3 pr-4">Phone</th>
                        <th class="pb-3 pr-4">Email</th>
                        <th class="pb-3 pr-4">Items</th>
                        <th class="pb-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suppliers as $s)
                        <tr class="border-b border-white/5 hover:bg-white/5 transition-all duration-200">
                            <td class="py-3 pr-4 font-medium">{{ $s->name }}</td>
                            <td class="py-3 pr-4 text-slate-400">{{ $s->contact_person ?? '—' }}</td>
                            <td class="py-3 pr-4 text-slate-400">{{ $s->phone ?? '—' }}</td>
                            <td class="py-3 pr-4 text-slate-400">{{ $s->email ?? '—' }}</td>
                            <td class="py-3 pr-4">{{ $s->items_count }}</td>
                            <td class="py-3 flex gap-2">
                                <a href="{{ route('suppliers.edit', $s) }}" class="px-3 py-1 rounded-lg bg-cyan-500/10 text-cyan-400 text-xs hover:bg-cyan-500/20">Edit</a>
                                <form action="{{ route('suppliers.destroy', $s) }}" method="POST" onsubmit="return confirm('Hapus supplier ini?')">
                                    @csrf @method('DELETE')
                                    <button class="px-3 py-1 rounded-lg bg-rose-500/10 text-rose-400 text-xs hover:bg-rose-500/20">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="py-6 text-center text-slate-500">Belum ada supplier.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-5">{{ $suppliers->links() }}</div>
    </div>
@endsection
