@extends('layouts.app')
@section('title', 'Create Supplier — ISP Inventory')
@section('page_title', 'Create Supplier')
@section('content')
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-lg max-w-2xl">
        <form action="{{ route('suppliers.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Supplier Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition" required>
                @error('name') <p class="text-rose-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Contact Person</label>
                    <input type="text" name="contact_person" value="{{ old('contact_person') }}" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition">
                @error('email') <p class="text-rose-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Address</label>
                <textarea name="address" rows="3" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition">{{ old('address') }}</textarea>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-cyan-500/20 text-cyan-400 border border-cyan-500/30 font-medium hover:bg-cyan-500/30">Save</button>
                <a href="{{ route('suppliers.index') }}" class="px-6 py-2.5 rounded-xl bg-white/5 text-slate-300 border border-white/10 hover:bg-white/10">Cancel</a>
            </div>
        </form>
    </div>
@endsection
