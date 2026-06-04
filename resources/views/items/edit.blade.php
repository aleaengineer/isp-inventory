@extends('layouts.app')
@section('title', 'Edit Item — ISP Inventory')
@section('page_title', 'Edit Item')
@section('content')
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-lg max-w-2xl">
        <form action="{{ route('items.update', $item) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Category</label>
                <select name="category_id" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition">
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $item->category_id == $cat->id ? 'selected' : '' }} class="bg-slate-800">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name', $item->name) }}" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition" required>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Serial Number</label>
                    <input type="text" name="serial_number" value="{{ old('serial_number', $item->serial_number) }}" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">MAC Address</label>
                    <input type="text" name="mac_address" value="{{ old('mac_address', $item->mac_address) }}" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Stock Quantity</label>
                    <input type="number" name="stock_quantity" value="{{ old('stock_quantity', $item->stock_quantity) }}" min="0" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Unit</label>
                    <select name="unit" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition">
                        <option value="pcs" {{ $item->unit == 'pcs' ? 'selected' : '' }} class="bg-slate-800">Pcs</option>
                        <option value="roll" {{ $item->unit == 'roll' ? 'selected' : '' }} class="bg-slate-800">Roll</option>
                        <option value="meter" {{ $item->unit == 'meter' ? 'selected' : '' }} class="bg-slate-800">Meter</option>
                        <option value="set" {{ $item->unit == 'set' ? 'selected' : '' }} class="bg-slate-800">Set</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Location</label>
                    <input type="text" name="location" value="{{ old('location', $item->location) }}" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Supplier</label>
                <select name="supplier_id" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition">
                    <option value="" class="bg-slate-800">— Select Supplier —</option>
                    @foreach ($suppliers as $s)
                        <option value="{{ $s->id }}" {{ $item->supplier_id == $s->id ? 'selected' : '' }} class="bg-slate-800">{{ $s->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Image</label>
                @if($item->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $item->image) }}" class="w-24 h-24 object-cover rounded-lg border border-white/10">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-cyan-500/20 file:text-cyan-400 file:text-xs">
                @error('image') <p class="text-rose-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-cyan-500/20 text-cyan-400 border border-cyan-500/30 font-medium transition-all duration-300 hover:bg-cyan-500/30">Update</button>
                <a href="{{ route('items.index') }}" class="px-6 py-2.5 rounded-xl bg-white/5 text-slate-300 border border-white/10 transition-all duration-300 hover:bg-white/10">Cancel</a>
            </div>
        </form>
    </div>
@endsection
