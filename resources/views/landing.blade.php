<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Antrian Puskesmas Menur</title>
      <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex flex-col">

  <nav class="bg-white shadow-sm py-4 sticky top-0 z-50">
        <div class="container mx-auto px-6 flex justify-between items-center">
            
            <div class="flex items-center gap-4">
                <img src="{{ asset('img/surabaya.png') }}" alt="Logo Surabaya" class="h-12 w-auto object-contain">
                
                <div class="h-10 w-[1px] bg-gray-300"></div>
                
                <div class="flex items-center gap-3">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo Puskesmas" class="h-10 w-10 object-contain">
                    <div class="hidden md:block">
                        <h1 class="text-lg font-bold text-slate-800 leading-tight">Puskesmas Menur</h1>
                        <p class="text-[10px] uppercase tracking-wide text-slate-500">Pemerintah Kota Surabaya</p>
                    </div>
                </div>
            </div>

            <div class="text-sm text-slate-500 font-medium bg-slate-100 px-3 py-1 rounded-full">
                {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}
            </div>
        </div>
    </nav>

    <main class="flex-1 container mx-auto px-6 flex items-center justify-center py-10">
        <div class="grid md:grid-cols-2 gap-8 w-full max-w-4xl">
            
            <a href="{{ route('antrian.index') }}" class="group relative bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 border border-slate-100 hover:-translate-y-2 cursor-pointer flex flex-col items-center text-center overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-blue-500"></div>
                
                <div class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mb-6 group-hover:bg-blue-100 transition">
                    <span class="text-5xl">🏥</span>
                </div>
                
                <h2 class="text-2xl font-bold text-slate-800 mb-2">Pasien / Pengunjung</h2>
                <p class="text-slate-500 mb-6">Ambil nomor antrian poli secara mandiri di sini.</p>
                
                <span class="px-6 py-2 bg-blue-600 text-white rounded-full font-semibold group-hover:bg-blue-700 transition">
                    Ambil Antrian
                </span>
            </a>

            <div class="flex flex-col gap-6">
                <a href="{{ route('login') }}" class="group bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all border border-slate-100 hover:-translate-y-1 flex items-center gap-6">
                    <div class="w-16 h-16 bg-emerald-50 rounded-2xl flex items-center justify-center text-3xl">
                        👨‍⚕️
                    </div>
                    <div class="text-left">
                        <h3 class="text-xl font-bold text-slate-800">Login Petugas</h3>
                        <p class="text-sm text-slate-500">Masuk ke Dashboard Admin</p>
                    </div>
                    <div class="ml-auto text-emerald-500">➜</div>
                </a>

                <a href="{{ route('monitor') }}" target="_blank" class="group bg-slate-800 rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all border border-slate-700 hover:-translate-y-1 flex items-center gap-6">
                    <div class="w-16 h-16 bg-slate-700 rounded-2xl flex items-center justify-center text-3xl animate-pulse">
                        🖥️
                    </div>
                    <div class="text-left">
                        <h3 class="text-xl font-bold text-white">Layar Monitor</h3>
                        <p class="text-sm text-slate-400">Tampilan TV Ruang Tunggu</p>
                    </div>
                    <div class="ml-auto text-white">➜</div>
                </a>
            </div>

        </div>
    </main>

    <footer class="text-center py-6 text-slate-400 text-sm">
        &copy; 2025 Puskesmas Menur Surabaya
    </footer>

</body>
</html>