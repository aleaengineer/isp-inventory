@extends('layouts.app')
@section('title', 'Users — ISP Inventory')
@section('page_title', 'User Management')
@section('content')
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-lg">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-lg font-semibold">All Users</h3>
            <a href="{{ route('users.create') }}" class="px-4 py-2 rounded-xl bg-cyan-500/20 text-cyan-400 border border-cyan-500/30 text-sm font-medium transition-all duration-300 hover:bg-cyan-500/30">+ Add User</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b border-white/10 text-slate-400 uppercase tracking-wider text-xs">
                        <th class="pb-3 pr-4">Name</th>
                        <th class="pb-3 pr-4">Email</th>
                        <th class="pb-3 pr-4">Role</th>
                        <th class="pb-3 pr-4">Phone</th>
                        <th class="pb-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $u)
                        <tr class="border-b border-white/5 hover:bg-white/5 transition-all duration-200">
                            <td class="py-3 pr-4 font-medium flex items-center gap-2">
                                @if($u->photo)
                                    <img src="{{ asset('storage/' . $u->photo) }}" class="w-7 h-7 rounded-full object-cover">
                                @endif
                                {{ $u->name }}
                            </td>
                            <td class="py-3 pr-4 text-slate-400">{{ $u->email }}</td>
                            <td class="py-3 pr-4">
                                @if($u->role === 'admin')
                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-purple-500/20 text-purple-400">Admin</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-cyan-500/20 text-cyan-400">Operator</span>
                                @endif
                            </td>
                            <td class="py-3 pr-4 text-slate-400">{{ $u->phone ?? '—' }}</td>
                            <td class="py-3 flex gap-2">
                                <a href="{{ route('users.edit', $u) }}" class="px-3 py-1 rounded-lg bg-cyan-500/10 text-cyan-400 text-xs hover:bg-cyan-500/20">Edit</a>
                                @if($u->id !== auth()->id())
                                    <form action="{{ route('users.destroy', $u) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
                                        @csrf @method('DELETE')
                                        <button class="px-3 py-1 rounded-lg bg-rose-500/10 text-rose-400 text-xs hover:bg-rose-500/20">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="py-6 text-center text-slate-500">Belum ada user.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-5">{{ $users->links() }}</div>
    </div>
@endsection
