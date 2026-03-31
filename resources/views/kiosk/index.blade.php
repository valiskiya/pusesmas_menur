<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Mandiri - Puskesmas Menur</title>
    {{-- Pastikan file gambar ada, atau ganti dengan link gambar online --}}
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Plus Jakarta Sans', sans-serif; } 
        ::-webkit-scrollbar { width: 0px; background: transparent; }
        
        /* Print Styles */
        @media print {
            body * { visibility: hidden; }
            .ticket-area, .ticket-area * { visibility: visible; }
            .ticket-area { position: absolute; left: 0; top: 0; width: 100%; margin: 0; padding: 0; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen py-8 px-4 flex items-center justify-center">

    <div class="max-w-5xl w-full bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-slate-100 flex flex-col md:flex-row h-[85vh] md:h-auto min-h-[650px]">
        
        {{-- BAGIAN KIRI (BIRU) --}}
        <div class="w-full md:w-1/3 bg-blue-600 p-10 text-white flex flex-col justify-between relative overflow-hidden shrink-0">
            <div class="absolute top-0 left-0 w-full h-full pointer-events-none">
                <div class="absolute top-[-50px] right-[-50px] w-40 h-40 bg-blue-500 rounded-full opacity-50"></div>
                <div class="absolute bottom-[-20px] left-[-20px] w-32 h-32 bg-blue-400 rounded-full opacity-30"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-blue-500 rounded-full blur-3xl opacity-20"></div>
            </div>

            <div class="relative z-10 text-center md:text-left">
                <div class="bg-white/20 p-3 rounded-2xl w-16 h-16 flex items-center justify-center mb-6 mx-auto md:mx-0 backdrop-blur-sm border border-white/30 shadow-lg">
                    {{-- Ganti src jika logo tidak muncul --}}
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-10 h-10" onerror="this.style.display='none'">
                    <span class="text-2xl font-bold" onerror="this.style.display='block'">🏥</span>
                </div>
                <h1 class="text-3xl font-extrabold leading-tight mb-2 tracking-tight">Puskesmas<br>Menur Surabaya</h1>
                <p class="text-blue-100 text-sm font-medium opacity-90 tracking-wide">Anjungan Pendaftaran Mandiri (APM)</p>
            </div>

            <div class="relative z-10 mt-auto hidden md:block">
                <div class="space-y-6">
                    <div class="flex items-center gap-4 {{ session('success') ? 'opacity-50' : 'opacity-100' }}">
                        <div class="w-10 h-10 rounded-full {{ session('success') ? 'bg-blue-500' : 'bg-white text-blue-600' }} flex items-center justify-center text-sm font-bold shadow-md transition-all">1</div>
                        <p class="text-sm font-bold {{ session('success') ? 'text-blue-300' : 'text-white' }}">Isi Biodata</p>
                    </div>
                    <div class="h-8 w-0.5 bg-blue-400/30 ml-5"></div>
                    <div class="flex items-center gap-4 {{ session('success') ? 'opacity-50' : 'opacity-100' }}">
                        <div class="w-10 h-10 rounded-full {{ session('success') ? 'bg-blue-500' : 'bg-white text-blue-600' }} flex items-center justify-center text-sm font-bold shadow-md transition-all">2</div>
                        <p class="text-sm font-bold {{ session('success') ? 'text-blue-300' : 'text-white' }}">Pilih Poli</p>
                    </div>
                    <div class="h-8 w-0.5 bg-blue-400/30 ml-5"></div>
                    <div class="flex items-center gap-4 {{ session('success') ? 'opacity-100 scale-105' : 'opacity-50' }}">
                        <div class="w-10 h-10 rounded-full {{ session('success') ? 'bg-green-400 text-white' : 'bg-blue-500' }} flex items-center justify-center text-sm font-bold shadow-md transition-all">
                            @if(session('success')) ✓ @else 3 @endif
                        </div>
                        <p class="text-sm font-bold {{ session('success') ? 'text-white' : 'text-blue-300' }}">Ambil Tiket</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- BAGIAN KANAN (FORM & HASIL) --}}
        <div class="w-full md:w-2/3 bg-white p-8 md:p-12 overflow-y-auto">
            
            @if(session('success'))
                {{-- TAMPILAN SUKSES --}}
                <div class="text-center w-full max-w-lg mx-auto animate-fade-in-up pt-4">
                    <div class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6 text-4xl shadow-sm animate-bounce">
                        🎉
                    </div>
                    
                    <h2 class="text-3xl font-black text-slate-800 mb-2">Pendaftaran Berhasil!</h2>
                    <p class="text-slate-500 mb-8">Silakan ambil struk antrian Anda di bawah ini.</p>
                    
                    <div class="ticket-area bg-white border-2 border-slate-100 rounded-3xl p-0 shadow-2xl relative overflow-hidden group hover:border-blue-200 transition-all mx-auto max-w-sm">
                        <div class="bg-slate-50 p-6 border-b border-dashed border-slate-200">
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] mb-1">Nomor Antrian Anda</p>
                            <div class="text-8xl font-black text-slate-800 font-mono tracking-tighter group-hover:scale-110 transition duration-300">{{ session('nomor') }}</div>
                        </div>

                        <div class="p-6 bg-white relative">
                            <div class="absolute -left-3 top-[-12px] w-6 h-6 bg-white rounded-full border border-slate-100"></div>
                            <div class="absolute -right-3 top-[-12px] w-6 h-6 bg-white rounded-full border border-slate-100"></div>

                            <div class="inline-block px-4 py-1.5 bg-blue-100 text-blue-700 rounded-lg text-sm font-bold uppercase mb-6 tracking-wide">
                                {{ session('poli') }}
                            </div>

                            <div class="text-left bg-slate-50 rounded-xl p-4 border border-slate-100">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-xs text-slate-400 font-bold uppercase">Nama Pasien</span>
                                    <span class="text-xs text-slate-400 font-bold uppercase">NIK</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-slate-800 text-lg truncate pr-4 max-w-[150px]">{{ session('nama_pasien') }}</span>
                                    <span class="font-mono text-xs font-semibold text-slate-500 bg-white px-2 py-1 rounded border border-slate-200">{{ session('nik') }}</span>
                                </div>
                            </div>
                            
                            <div class="mt-4 pt-4 border-t border-slate-100 text-center">
                                <p class="text-[10px] text-slate-400 uppercase font-bold tracking-widest">{{ now()->format('d M Y - H:i') }} WIB</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 grid grid-cols-2 gap-4 no-print">
                        <button onclick="window.print()" class="py-4 px-6 bg-slate-100 text-slate-700 rounded-xl font-bold hover:bg-slate-200 transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                            Cetak Struk
                        </button>
                        
                        <a href="{{ url('/') }}" class="py-4 px-6 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            Menu Utama
                        </a>
                    </div>
                </div>

            @else
                {{-- TAMPILAN FORM --}}
                
                {{-- ALERT ERROR (SANGAT PENTING!) --}}
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r" role="alert">
                        <p class="font-bold">Oops! Ada kesalahan input:</p>
                        <ul class="mt-1 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{-- END ALERT ERROR --}}

                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-3">
                        <span class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-xl">📝</span>
                        Lengkapi Data Pasien
                    </h2>
                    <p class="text-slate-500 mt-1 ml-14">Pastikan data sesuai dengan Kartu Identitas (KTP/KK).</p>
                </div>
                
                <form action="{{ route('antrian.daftar') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Nomor Induk Kependudukan (NIK)</label>
                            <div class="relative">
                                {{-- value="{{ old('nik') }}" Agar kalau error, tulisan tidak hilang --}}
                                <input type="number" name="nik" value="{{ old('nik') }}" placeholder="Masukkan 16 digit NIK" autofocus
                                    class="w-full bg-slate-50 text-slate-800 text-lg px-5 py-4 pl-12 rounded-2xl border border-slate-200 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 outline-none transition font-mono placeholder:text-slate-400 placeholder:text-sm shadow-sm" required>
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xl">🪪</span>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Nama Lengkap</label>
                            <div class="relative">
                                <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama sesuai KTP" 
                                    class="w-full bg-slate-50 text-slate-800 font-bold px-5 py-4 pl-12 rounded-2xl border border-slate-200 focus:border-blue-500 focus:bg-white outline-none transition shadow-sm" required>
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xl">👤</span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                class="w-full bg-slate-50 text-slate-800 px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-500 focus:bg-white outline-none transition shadow-sm cursor-pointer" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Jenis Kelamin</label>
                            <div class="grid grid-cols-2 gap-3 h-[58px]">
                                <label class="cursor-pointer h-full">
                                    <input type="radio" name="jenis_kelamin" value="L" class="peer sr-only" {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }} required>
                                    <div class="h-full flex items-center justify-center rounded-2xl border border-slate-200 bg-slate-50 text-slate-500 peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-600 transition font-bold text-sm shadow-sm hover:bg-slate-100">
                                        Laki-laki
                                    </div>
                                </label>
                                <label class="cursor-pointer h-full">
                                    <input type="radio" name="jenis_kelamin" value="P" class="peer sr-only" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }} required>
                                    <div class="h-full flex items-center justify-center rounded-2xl border border-slate-200 bg-slate-50 text-slate-500 peer-checked:bg-pink-500 peer-checked:text-white peer-checked:border-pink-500 transition font-bold text-sm shadow-sm hover:bg-slate-100">
                                        Perempuan
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">No. WhatsApp / HP (Opsional)</label>
                            <div class="relative">
                                <input type="number" name="no_hp" value="{{ old('no_hp') }}" placeholder="Contoh: 0812345..." 
                                    class="w-full bg-slate-50 text-slate-800 px-5 py-4 pl-12 rounded-2xl border border-slate-200 focus:border-blue-500 focus:bg-white outline-none transition shadow-sm">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xl">📱</span>
                            </div>
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Alamat Domisili</label>
                            <textarea name="alamat" rows="2" placeholder="Jalan, RT/RW, Kelurahan..." 
                                class="w-full bg-slate-50 text-slate-800 px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-500 focus:bg-white outline-none transition shadow-sm resize-none">{{ old('alamat') }}</textarea>
                        </div>
                    </div>

                    <div class="relative py-4">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-slate-200 border-dashed"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span class="bg-white px-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Pilih Tujuan</span>
                        </div>
                    </div>

                    <div class="mb-8">
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            @foreach($poli as $p)
                            <label class="cursor-pointer group relative">
                                <input type="radio" name="id_poli" value="{{ $p->id_poli }}" class="peer sr-only" {{ old('id_poli') == $p->id_poli ? 'checked' : '' }} required>
                                <div class="p-4 rounded-2xl border-2 border-slate-100 bg-white peer-checked:border-blue-600 peer-checked:bg-blue-50 hover:border-blue-200 transition text-center h-full flex flex-col items-center justify-center gap-2 shadow-sm group-hover:shadow-md peer-checked:shadow-inner">
                                    <div class="absolute top-3 right-3 w-4 h-4 rounded-full border border-slate-300 peer-checked:bg-blue-600 peer-checked:border-blue-600"></div>
                                    <span class="text-3xl filter grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100 peer-checked:grayscale-0 peer-checked:opacity-100 transition duration-300">
                                        @if(Str::contains(strtolower($p->nama_poli), 'gigi')) 🦷 
                                        @elseif(Str::contains(strtolower($p->nama_poli), 'anak')) 👶 
                                        @elseif(Str::contains(strtolower($p->nama_poli), 'lansia')) 👴 
                                        @elseif(Str::contains(strtolower($p->nama_poli), 'kia')) 🤰 
                                        @else 🩺 @endif
                                    </span>
                                    <span class="text-xs font-bold text-slate-600 peer-checked:text-blue-700 leading-tight">{{ $p->nama_poli }}</span>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="w-full py-4 bg-blue-600 text-white rounded-2xl font-bold text-lg hover:bg-blue-700 hover:shadow-xl hover:shadow-blue-200 transition transform hover:-translate-y-1 active:translate-y-0 flex items-center justify-center gap-3">
                        <span>🖨️</span> Cetak Nomor Antrian
                    </button>
                </form>
            @endif
        </div>
    </div>
</body>
</html>