<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ISP Inventory')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
    @stack('styles')
</head>
<body x-data="{ sidebarOpen: false, darkMode: localStorage.getItem('darkMode') !== 'false' }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))" :class="darkMode ? 'bg-slate-900 text-slate-100' : 'bg-slate-50 text-slate-800'" class="min-h-screen font-sans antialiased transition-colors duration-300">

    <div class="flex h-screen">
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="w-64 {{ session('darkMode', true) ? 'bg-white/5 backdrop-blur-lg border-r border-white/10' : 'bg-white border-r border-slate-200' }} p-6 fixed md:relative md:translate-x-0 flex flex-col shrink-0 z-50 transition-transform duration-300">
            <div class="flex items-center justify-between mb-10">
                <h1 class="text-xl font-bold tracking-wider" :class="darkMode ? 'text-cyan-400' : 'text-cyan-600'">MY<span :class="darkMode ? 'text-slate-300' : 'text-slate-600'">INVENTORY</span></h1>
                <button @click="sidebarOpen = false" class="md:hidden text-slate-400"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
            </div>
            <nav class="space-y-2 flex-1">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/20' : 'text-slate-400 border border-transparent hover:bg-white/5 hover:text-slate-200' }}" :class="{ 'hover:bg-white/10': !darkMode }">
                    <span>📊</span> {{ __('Dashboard') }}
                </a>
                <a href="{{ route('items.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('items.*') ? 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/20' : 'text-slate-400 border border-transparent hover:bg-white/5 hover:text-slate-200' }}" :class="{ 'hover:bg-white/10': !darkMode }">
                    <span>📦</span> {{ __('Items') }}
                </a>
                <a href="{{ route('categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('categories.*') ? 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/20' : 'text-slate-400 border border-transparent hover:bg-white/5 hover:text-slate-200' }}" :class="{ 'hover:bg-white/10': !darkMode }">
                    <span>📁</span> {{ __('Categories') }}
                </a>
                <a href="{{ route('suppliers.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('suppliers.*') ? 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/20' : 'text-slate-400 border border-transparent hover:bg-white/5 hover:text-slate-200' }}" :class="{ 'hover:bg-white/10': !darkMode }">
                    <span>🏭</span> {{ __('Suppliers') }}
                </a>
                <a href="{{ route('transactions.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('transactions.*') ? 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/20' : 'text-slate-400 border border-transparent hover:bg-white/5 hover:text-slate-200' }}" :class="{ 'hover:bg-white/10': !darkMode }">
                    <span>🔄</span> {{ __('Transactions') }}
                </a>
                @if(auth()->user()->isAdmin())
                    <hr :class="darkMode ? 'border-white/10' : 'border-slate-200'" class="my-3">
                    <a href="{{ route('users.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('users.*') ? 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/20' : 'text-slate-400 border border-transparent hover:bg-white/5 hover:text-slate-200' }}" :class="{ 'hover:bg-white/10': !darkMode }">
                        <span>👥</span> {{ __('Users') }}
                    </a>
                @endif
            </nav>
            <div class="pt-4 border-t border-white/10" :class="darkMode ? 'border-white/10' : 'border-slate-200'">
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 text-slate-400 border border-transparent hover:bg-white/5 hover:text-slate-200" :class="{ 'hover:bg-white/10': !darkMode }">
                    <span>👤</span> {{ __('Profile') }}
                </a>
            </div>
        </aside>

        <main class="flex-1 flex flex-col overflow-hidden">
            <header class="px-6 py-4 flex items-center justify-between" :class="darkMode ? 'bg-white/5 backdrop-blur-lg border-b border-white/10' : 'bg-white border-b border-slate-200'">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-slate-400"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg></button>
                    <h2 class="text-lg font-semibold">@yield('page_title', 'Dashboard')</h2>
                </div>
                <div class="flex items-center gap-2 md:gap-4">
                    <button @click="darkMode = !darkMode" class="px-1.5 py-1 md:px-3 md:py-1.5 rounded-xl text-[10px] md:text-xs font-medium transition-all duration-300" :class="darkMode ? 'bg-amber-500/20 text-amber-400 border border-amber-500/30' : 'bg-slate-700 text-slate-200 border border-slate-600'">
                        <span x-text="darkMode ? '☀️' : '🌙'"></span>
                        <span class="hidden md:inline" x-text="darkMode ? ' Light' : ' Dark'"></span>
                    </button>
                    <a href="{{ route('profile.edit') }}" class="text-xs md:text-sm hidden sm:inline" :class="darkMode ? 'text-slate-400' : 'text-slate-600'">{{ Auth::user()->name }}</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-2 py-1.5 md:px-4 md:py-2 rounded-xl bg-rose-500/10 text-rose-400 border border-rose-500/20 text-[10px] md:text-xs font-medium transition-all duration-300 hover:bg-rose-500/20">Logout</button>
                    </form>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-6">
                @if (session('success'))
                    <div class="mb-6 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="mb-6 px-4 py-3 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-400 text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
            </div>
        </main>
    </div>

    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 md:hidden z-40"></div>

    @stack('scripts')
</body>
</html>
