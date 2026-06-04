@extends('layouts.app')

@section('title', 'New Transaction — ISP Inventory')
@section('page_title', 'New Transaction')

@section('content')
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-lg max-w-2xl">
        <form action="{{ route('transactions.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Item</label>
                <select name="item_id" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition" required>
                    <option value="" class="bg-slate-800">— Select Item —</option>
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}" class="bg-slate-800">{{ $item->name }} (Stock: {{ $item->stock_quantity }})</option>
                    @endforeach
                </select>
                @error('item_id') <p class="text-rose-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Type</label>
                    <select name="transaction_type" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition" required>
                        <option value="in" class="bg-slate-800">Stock In</option>
                        <option value="out" class="bg-slate-800">Stock Out</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Quantity</label>
                    <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="1" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition" required>
                    @error('quantity') <p class="text-rose-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Technician Name</label>
                <input type="text" name="technician_name" value="{{ old('technician_name') }}" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition" required>
                @error('technician_name') <p class="text-rose-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Purpose</label>
                <textarea name="purpose" rows="2" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition">{{ old('purpose') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Transaction Date</label>
                <input type="datetime-local" name="transaction_date" value="{{ old('transaction_date', now()->format('Y-m-d\TH:i')) }}" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 focus:border-cyan-500/50 focus:outline-none transition" required>
                @error('transaction_date') <p class="text-rose-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-cyan-500/20 text-cyan-400 border border-cyan-500/30 font-medium transition-all duration-300 hover:bg-cyan-500/30">Save</button>
                <a href="{{ route('transactions.index') }}" class="px-6 py-2.5 rounded-xl bg-white/5 text-slate-300 border border-white/10 transition-all duration-300 hover:bg-white/10">Cancel</a>
            </div>
        </form>
    </div>
@endsection
