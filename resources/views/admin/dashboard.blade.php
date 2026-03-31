@extends('layouts.admin')

@section('title', $namaPoliAktif . ' - Operasional')
  <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/png">
@section('content')

    @if($filterPoli)
    <div class="mb-8 bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-6 rounded-2xl shadow-lg shadow-blue-500/20 flex items-center justify-between relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-16 -mt-16 blur-2xl"></div>
        
        <div class="flex items-center gap-5 relative z-10">
            <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center text-3xl backdrop-blur-sm border border-white/30 shadow-inner">
                🩺
            </div>
            <div>
                <h3 class="font-bold text-xl tracking-tight">Mode Loket: {{ $namaPoliAktif }}</h3>
                <p class="text-blue-100 text-sm mt-0.5 opacity-90">Anda sedang fokus menangani antrian poli ini.</p>
            </div>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="relative z-10 px-5 py-2.5 bg-white text-blue-700 rounded-xl text-sm font-bold hover:bg-blue-50 transition shadow-md flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            Tampilkan Semua
        </a>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-between hover:shadow-md transition group">
            <div>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Total Antrian</p>
                <h3 class="text-3xl font-black text-slate-800">{{ $total }}</h3>
            </div>
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl group-hover:scale-110 transition">📊</div>
        </div>
        
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-between hover:shadow-md transition group">
            <div>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Sisa Menunggu</p>
                <h3 class="text-3xl font-black text-orange-500">{{ $sisa }}</h3>
            </div>
            <div class="w-12 h-12 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center text-xl group-hover:scale-110 transition">⏳</div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-between hover:shadow-md transition group">
            <div>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Selesai Dilayani</p>
                <h3 class="text-3xl font-black text-emerald-500">{{ $selesai }}</h3>
            </div>
            <div class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center text-xl group-hover:scale-110 transition">✅</div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        
        <div class="xl:col-span-2 space-y-6">
            
            <div class="bg-white rounded-3xl shadow-lg border border-slate-100 overflow-hidden relative">
                <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-blue-500 via-indigo-500 to-emerald-500"></div>
                
                <div class="p-8 text-center relative z-10">
                    <h2 class="text-slate-400 font-bold uppercase tracking-[0.2em] text-xs mb-8">Sedang Dilayani Sekarang</h2>
                    
                    @if($current)
                        <div class="flex flex-col items-center justify-center mb-6">
                            <span class="text-9xl font-black text-slate-800 font-mono tracking-tighter leading-none drop-shadow-sm">{{ $current->nomor_antrian }}</span>
                            <span class="mt-4 px-4 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-bold border border-blue-200">
                                {{ $current->poli->nama_poli }}
                            </span>
                        </div>
                        
                        <div class="bg-slate-50 rounded-2xl p-6 mb-8 mx-auto max-w-lg border border-slate-200 relative group overflow-hidden text-left">
                            <div class="absolute top-0 right-0 w-16 h-16 bg-blue-100 rounded-bl-full -mr-8 -mt-8 opacity-50 group-hover:scale-110 transition"></div>
                            
                            <div class="relative z-10">
                                <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mb-1">Nama Pasien</p>
                                <h3 class="text-2xl font-bold text-slate-800 mb-3">{{ $current->pasien->nama }}</h3>
                                
                                <div class="flex items-center gap-4 pt-3 border-t border-slate-200">
                                    <div>
                                        <p class="text-[10px] text-slate-400 font-bold uppercase">NIK / Identitas</p>
                                        <p class="text-sm font-mono font-semibold text-slate-600">{{ $current->pasien->nik }}</p>
                                    </div>
                                    <div class="h-8 w-px bg-slate-200"></div>
                                    <div>
                                        <p class="text-[10px] text-slate-400 font-bold uppercase">Jenis Kelamin</p>
                                        <p class="text-sm font-semibold text-slate-600">
                                            {{ $current->pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-5">
                            <form action="{{ route('admin.panggil', $current->id_antrian) }}" method="POST">
                                @csrf
                                <button class="w-full py-4 bg-amber-50 text-amber-600 border border-amber-200 rounded-xl font-bold hover:bg-amber-100 hover:shadow-md transition flex items-center justify-center gap-2 group">
                                    <svg class="w-6 h-6 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                                    Panggil Ulang
                                </button>
                            </form>
                            <form action="{{ route('admin.selesai', $current->id_antrian) }}" method="POST">
                                @csrf
                                <button class="w-full py-4 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700 hover:shadow-lg hover:shadow-emerald-200 transition flex items-center justify-center gap-2 transform hover:-translate-y-0.5">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Selesaikan
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="py-20 flex flex-col items-center justify-center text-slate-300">
                            <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-400">Counter Kosong</h3>
                            <p class="text-sm text-slate-400 mt-1">Silakan panggil antrian berikutnya.</p>
                        </div>
                    @endif
                </div>
            </div>

            @if($current)
            <div class="bg-white border border-red-100 p-5 rounded-2xl flex items-center justify-between shadow-sm hover:shadow-md transition">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-red-50 text-red-500 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-700">Pasien Tidak Muncul?</h4>
                        <p class="text-xs text-slate-500">Klik tombol ini jika sudah dipanggil 3x.</p>
                    </div>
                </div>
                <form action="{{ route('admin.lewati', $current->id_antrian) }}" method="POST">
                    @csrf
                    <button class="px-5 py-2.5 bg-white border border-red-200 text-red-600 rounded-xl text-sm font-bold hover:bg-red-600 hover:text-white transition shadow-sm">
                        Lewati Pasien
                    </button>
                </form>
            </div>
            @endif
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 flex flex-col h-[700px]">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50 rounded-t-3xl flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-slate-800">Daftar Tunggu</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Urutan berikutnya</p>
                </div>
                <span class="px-3 py-1 bg-blue-600 text-white text-xs rounded-full font-bold shadow-sm">{{ $waiting->count() }}</span>
            </div>

            <div class="flex-1 overflow-y-auto p-4 space-y-3">
                @forelse($waiting as $item)
                    <div class="group bg-white border border-slate-100 p-4 rounded-2xl flex justify-between items-center hover:border-blue-300 hover:shadow-md transition-all relative overflow-hidden">
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 opacity-0 group-hover:opacity-100 transition"></div>
                        
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center font-bold text-lg text-slate-700 font-mono group-hover:bg-blue-600 group-hover:text-white transition">
                                {{ $item->nomor_antrian }}
                            </div>
                            <div>
                                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">{{ $item->poli->nama_poli }}</div>
                                <div class="text-sm font-bold text-slate-800 truncate w-32">{{ $item->pasien->nama }}</div>
                            </div>
                        </div>
                        <form action="{{ route('admin.panggil', $item->id_antrian) }}" method="POST">
                            @csrf
                            <button class="w-10 h-10 rounded-full bg-slate-50 text-slate-400 flex items-center justify-center hover:bg-blue-600 hover:text-white hover:scale-110 transition shadow-sm" title="Panggil">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"></path></svg>
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="h-full flex flex-col items-center justify-center text-slate-400 pb-10">
                        <div class="text-4xl mb-3 grayscale opacity-30">🎉</div>
                        <p class="text-sm">Tidak ada antrian menunggu.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection