@extends('layouts.app')

@section('title', 'Create Category — ISP Inventory')
@section('page_title', 'Create Category')

@section('content')
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-lg max-w-lg">
        <form action="{{ route('categories.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition" required>
                @error('name') <p class="text-rose-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Description</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition">{{ old('description') }}</textarea>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-cyan-500/20 text-cyan-400 border border-cyan-500/30 font-medium transition-all duration-300 hover:bg-cyan-500/30">Save</button>
                <a href="{{ route('categories.index') }}" class="px-6 py-2.5 rounded-xl bg-white/5 text-slate-300 border border-white/10 transition-all duration-300 hover:bg-white/10">Cancel</a>
            </div>
        </form>
    </div>
@endsection
