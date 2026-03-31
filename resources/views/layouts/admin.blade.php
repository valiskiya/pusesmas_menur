<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Puskesmas Menur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.3); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(255, 255, 255, 0.5); }
    </style>
</head>
<body class="bg-slate-50 h-screen flex overflow-hidden">

    <aside class="w-64 bg-gradient-to-b from-blue-600 to-blue-800 flex-shrink-0 hidden md:flex flex-col text-white transition-all duration-300 shadow-xl z-30">
        
        <div class="h-20 flex items-center px-6 border-b border-blue-500/30 gap-3">
            <div class="bg-white p-1.5 rounded-lg shadow-sm">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-7 w-7">
            </div>
            <div>
                <h1 class="font-bold text-white text-lg leading-none tracking-tight">Puskesmas</h1>
                <p class="text-[10px] text-blue-100 uppercase tracking-widest mt-1 opacity-80">Menur Surabaya</p>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1.5">
            
            <a href="{{ route('monitor') }}" target="_blank" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 hover:bg-white/20 hover:text-white group border border-dashed border-blue-400/50 hover:border-white/50 mb-6 bg-blue-700/30">
                <svg class="w-5 h-5 text-green-300 group-hover:text-green-200 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                <span class="font-medium text-sm text-blue-50 group-hover:text-white">Buka Monitor TV</span>
                <span class="ml-auto bg-green-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-sm">LIVE</span>
            </a>

            <div class="pb-2">
                <div class="h-px bg-blue-500/30 mx-2"></div>
            </div>

            <div x-data="{ open: {{ request('poli') || request()->routeIs('admin.dashboard') ? 'true' : 'false' }} }" class="space-y-1">
                
                <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 rounded-xl text-blue-50 hover:bg-white/10 hover:text-white transition-all group">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        <span class="font-bold text-xs uppercase tracking-wider">Loket Pelayanan</span>
                    </div>
                    <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform duration-200 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>

                <div x-show="open" x-transition.origin.top.duration.300ms class="space-y-1 pl-2">
                    
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 border-l-2 {{ request()->fullUrl() == route('admin.dashboard') ? 'border-white bg-white/10 text-white font-bold' : 'border-transparent text-blue-200 hover:text-white hover:bg-white/5' }}">
                        <span class="text-sm">Semua Antrian</span>
                    </a>

                    @php $sidebarPolis = \App\Models\Poli::all(); @endphp

                    @foreach($sidebarPolis as $poli)
                    <a href="{{ route('admin.dashboard', ['poli' => $poli->id_poli]) }}" 
                       class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 border-l-2 {{ request('poli') == $poli->id_poli ? 'border-white bg-white/10 text-white font-bold' : 'border-transparent text-blue-200 hover:text-white hover:bg-white/5' }}">
                        <span class="text-sm">{{ $poli->nama_poli }}</span>
                        @php
                            $count = \App\Models\Antrian::where('id_poli', $poli->id_poli)->whereDate('tanggal', \Carbon\Carbon::today())->where('status', 'menunggu')->count();
                        @endphp
                        @if($count > 0)
                            <span class="ml-auto bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow-sm">{{ $count }}</span>
                        @endif
                    </a>
                    @endforeach
                </div>
            </div>

            <div class="pt-4 pb-2">
                <div class="h-px bg-blue-500/30 mx-2"></div>
            </div>

            <p class="px-2 text-[10px] font-bold text-blue-200 uppercase tracking-wider mb-2">Manajemen Data</p>

            <a href="{{ route('admin.laporan') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.laporan') ? 'bg-white text-blue-700 shadow-md font-bold' : 'text-blue-50 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.laporan') ? 'text-blue-600' : 'text-blue-200 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                <span class="text-sm">Data Rekap</span>
            </a>

            <a href="{{ route('admin.dokter.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.dokter.*') ? 'bg-white text-blue-700 shadow-md font-bold' : 'text-blue-50 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.dokter.*') ? 'text-blue-600' : 'text-blue-200 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                <span class="text-sm">Data Dokter</span>
            </a>

            <a href="{{ route('admin.poli.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.poli.*') ? 'bg-white text-blue-700 shadow-md font-bold' : 'text-blue-50 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.poli.*') ? 'text-blue-600' : 'text-blue-200 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                <span class="text-sm">Kelola Poli</span>
            </a>
        </nav>
        
        <div class="p-4 border-t border-blue-500/30">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-blue-900/30 text-blue-100 rounded-xl text-sm font-bold hover:bg-white hover:text-red-600 transition duration-200 border border-blue-500/20 hover:border-red-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar Sistem
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-screen overflow-hidden bg-slate-50">
        <header class="h-20 flex items-center justify-between px-8 z-20">
            <div>
                <h2 class="text-2xl font-bold text-slate-800 tracking-tight">@yield('title')</h2>
                <p class="text-xs text-slate-500 mt-1">Sistem Antrian Terintegrasi</p>
            </div>

            <div class="flex items-center gap-6">
                <div class="hidden md:flex items-center gap-2 px-4 py-2 bg-white rounded-full shadow-sm border border-slate-200">
                    <span class="relative flex h-2.5 w-2.5">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                    </span>
                    <span class="text-xs font-semibold text-slate-600">Server Online</span>
                </div>

                <div class="flex items-center gap-3 pl-6 border-l border-slate-300">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-slate-800">{{ Auth::user()->nama ?? 'Administrator' }}</p>
                        <p class="text-[10px] text-slate-500 uppercase tracking-wide font-bold">Petugas Loket</p>
                    </div>
                    <div class="w-11 h-11 bg-gradient-to-br from-blue-500 to-blue-700 rounded-full flex items-center justify-center text-white font-bold shadow-lg shadow-blue-500/30 border-2 border-white">
                        {{ substr(Auth::user()->nama ?? 'A', 0, 1) }}
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto px-8 pb-8">
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" class="mb-6 bg-white text-emerald-700 px-6 py-4 rounded-xl border-l-4 border-emerald-500 shadow-sm flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-emerald-400 hover:text-emerald-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            @endif
            
            @yield('content')
        </main>
    </div>
</body>
</html>