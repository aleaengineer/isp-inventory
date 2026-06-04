@extends('layouts.app')
@section('title', 'Import Items — ISP Inventory')
@section('page_title', 'Import Items')
@section('content')
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-lg max-w-2xl">
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-2">Upload File Excel</h3>
            <p class="text-sm text-slate-400">Format file: <code>.xlsx</code> atau <code>.xls</code>. Download template terlebih dahulu untuk panduan pengisian.</p>
        </div>

        <form action="{{ route('items.import') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Pilih File</label>
                <input type="file" name="file" accept=".xlsx,.xls" required
                    class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-100 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-cyan-500/20 file:text-cyan-400 file:text-xs">
                @error('file') <p class="text-rose-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-cyan-500/20 text-cyan-400 border border-cyan-500/30 font-medium hover:bg-cyan-500/30">Import</button>
                <a href="{{ route('items.import.template') }}" class="px-6 py-2.5 rounded-xl bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 font-medium hover:bg-emerald-500/30">Download Template</a>
                <a href="{{ route('items.index') }}" class="px-6 py-2.5 rounded-xl bg-white/5 text-slate-300 border border-white/10 hover:bg-white/10">Cancel</a>
            </div>
        </form>

        <div class="mt-6 pt-6 border-t border-white/10">
            <h4 class="text-sm font-semibold text-slate-300 mb-2">Petunjuk:</h4>
            <ul class="text-xs text-slate-400 space-y-1 list-disc list-inside">
                <li>Download template, isi data sesuai kolom yang tersedia.</li>
                <li>Kolom <strong>name</strong>, <strong>category</strong>, <strong>serial_number</strong>, <strong>stock_quantity</strong>, <strong>unit</strong> wajib diisi.</li>
                <li>Kolom <strong>category</strong> diisi dengan nama kategori yang sudah ada (contoh: GPON ONT, Switch, dll).</li>
                <li>Serial number harus unik — jika sudah ada akan dilewati.</li>
                <li>Hapus baris contoh sebelum import data anda.</li>
            </ul>
        </div>
    </div>

    @if(session('import_errors'))
        <div class="mt-6 bg-rose-500/5 backdrop-blur-xl border border-rose-500/30 rounded-2xl p-6 shadow-lg max-w-2xl">
            <h4 class="text-sm font-semibold text-rose-400 mb-3">Baris yang gagal diimport ({{ count(session('import_errors')) }}):</h4>
            <ul class="text-xs text-rose-300 space-y-1 list-disc list-inside">
                @foreach(session('import_errors') as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
