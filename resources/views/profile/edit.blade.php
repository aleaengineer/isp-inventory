@extends('layouts.app')
@section('title', 'My Profile — ISP Inventory')
@section('page_title', 'My Profile')
@section('content')
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-lg max-w-2xl">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')

            <div class="flex items-center gap-4">
                @if($user->photo)
                    <img src="{{ asset('storage/' . $user->photo) }}" class="w-16 h-16 rounded-full object-cover border-2 border-cyan-500/30">
                @else
                    <div class="w-16 h-16 rounded-full bg-cyan-500/20 flex items-center justify-center text-2xl text-cyan-400 font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                @endif
                <div>
                    <p class="font-semibold text-lg">{{ $user->name }}</p>
                    <p class="text-sm text-slate-400">{{ $user->email }}</p>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Photo</label>
                <input type="file" name="photo" accept="image/*" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-cyan-500/20 file:text-cyan-400 file:text-xs">
                @error('photo') <p class="text-rose-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition" required>
                @error('name') <p class="text-rose-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition" required>
                @error('email') <p class="text-rose-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition">
            </div>

            <hr class="border-white/10">

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Current Password <span class="text-slate-500">(isi jika ingin ganti password)</span></label>
                <input type="password" name="current_password" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">New Password</label>
                    <input type="password" name="password" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition">
                    @error('password') <p class="text-rose-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition">
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-cyan-500/20 text-cyan-400 border border-cyan-500/30 font-medium hover:bg-cyan-500/30">Update Profile</button>
                <a href="{{ route('dashboard') }}" class="px-6 py-2.5 rounded-xl bg-white/5 text-slate-300 border border-white/10 hover:bg-white/10">Cancel</a>
            </div>
        </form>
    </div>
@endsection
