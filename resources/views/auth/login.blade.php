<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — ISP Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen font-sans antialiased flex items-center justify-center p-4">

    <div class="w-full max-w-md">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold tracking-wider text-cyan-400">MY<span class="text-slate-300">INVENTORY</span></h1>
            <p class="text-sm text-slate-500 mt-1">Inventory & Asset Management</p>
        </div>

        {{-- Login Card --}}
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 shadow-2xl shadow-cyan-500/5">
            <h2 class="text-xl font-semibold mb-6 text-center">SIGN IN</h2>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-slate-100 placeholder-slate-500 focus:border-cyan-500/50 focus:outline-none focus:ring-1 focus:ring-cyan-500/20 transition-all"
                        placeholder="Email">
                    @error('email')
                        <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1.5">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-slate-100 placeholder-slate-500 focus:border-cyan-500/50 focus:outline-none focus:ring-1 focus:ring-cyan-500/20 transition-all"
                        placeholder="••••••••">
                    @error('password')
                        <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 text-sm text-slate-400">
                        <input type="checkbox" name="remember" class="rounded bg-white/5 border-white/10 text-cyan-500 focus:ring-cyan-500/20">
                        Remember me
                    </label>
                </div>

                <button type="submit"
                    class="w-full py-3 rounded-xl bg-cyan-500/20 text-cyan-400 border border-cyan-500/30 font-semibold transition-all duration-300 hover:bg-cyan-500/30 hover:shadow-lg hover:shadow-cyan-500/10">
                    Sign In
                </button>
            </form>

            @if (session('status'))
                <div class="mt-4 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm">
                    {{ session('status') }}
                </div>
            @endif
        </div>

        {{-- Footer --}}
        <p class="text-center text-xs text-slate-600 mt-6">&copy; {{ date('Y') }} MYINVENTORY SYSTEMS</p>

    </div>

</body>
</html>
