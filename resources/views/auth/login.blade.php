<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register - Puskesmas Menur</title>
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        /* Animasi Modal */
        .modal { transition: opacity 0.25s ease; }
        body.modal-active { overflow-x: hidden; overflow-y: hidden !important; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-blue-300/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-emerald-300/20 rounded-full blur-3xl"></div>

    <div class="bg-white/80 backdrop-blur-lg p-8 md:p-10 rounded-3xl shadow-[0_20px_50px_rgba(8,_112,_184,_0.07)] w-full max-w-md border border-white/50 relative z-10">
        
        <div class="text-center mb-8">
            <div class="flex justify-center items-center gap-5 mb-6">
                <img src="{{ asset('img/surabaya.png') }}" alt="Surabaya" class="h-14 w-auto drop-shadow-sm hover:scale-105 transition duration-300">
                <div class="h-10 w-[1px] bg-slate-200"></div>
                <img src="{{ asset('img/logo.png') }}" alt="Puskesmas" class="h-12 w-12 drop-shadow-sm hover:scale-105 transition duration-300">
            </div>
            <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Login Petugas</h2>
            <p class="text-slate-500 text-sm mt-2">Masuk menggunakan Email & Password</p>
        </div>

        @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <form action="{{ route('login.proses') }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2 ml-1">Email Address</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <input type="email" name="email" 
                        class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block transition-all outline-none placeholder:text-slate-400" 
                        placeholder="nama@email.com" required value="{{ old('email') }}">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2 ml-1">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input type="password" name="password" 
                        class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block transition-all outline-none placeholder:text-slate-400" 
                        placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-500/30 transform transition hover:-translate-y-0.5 duration-200">
                MASUK DASHBOARD
            </button>
        </form>

        <div class="mt-8 text-center pt-6 border-t border-slate-100">
            <p class="text-sm text-slate-500 mb-2">Belum punya akun petugas?</p>
            <button onclick="toggleModal()" class="text-sm font-bold text-blue-600 hover:text-blue-700 hover:underline transition-colors">
                Daftar Akun Baru
            </button>
        </div>
    </div>

    <div id="registerModal" class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50">
        <div class="modal-overlay absolute w-full h-full bg-slate-900 opacity-50"></div>
        
        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded-3xl shadow-2xl z-50 overflow-y-auto max-h-[90vh]">
            
            <div class="absolute top-4 right-4 cursor-pointer z-50" onclick="toggleModal()">
                <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>
            </div>

            <div class="py-8 px-8">
                <div class="flex justify-between items-center pb-4 mb-4 border-b border-slate-100">
                    <h3 class="text-2xl font-bold text-slate-800">Daftar Petugas Baru</h3>
                    <div class="cursor-pointer z-50" onclick="toggleModal()">
                        <svg class="fill-current text-slate-400 hover:text-slate-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                        </svg>
                    </div>
                </div>

                <form action="{{ route('register.proses') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Nama Lengkap</label>
                        <input type="text" name="nama" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm" placeholder="Nama Petugas" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Email</label>
                        <input type="email" name="email" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm" placeholder="email@puskesmas.com" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Password</label>
                        <input type="password" name="password" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm" placeholder="Minimal 5 karakter" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Ulangi Password</label>
                        <input type="password" name="password_confirmation" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm" placeholder="Ketik ulang password" required>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 rounded-xl shadow-lg shadow-emerald-500/30 transition-all">
                            DAFTAR SEKARANG
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleModal() {
            const body = document.querySelector('body')
            const modal = document.querySelector('.modal')
            modal.classList.toggle('opacity-0')
            modal.classList.toggle('pointer-events-none')
            body.classList.toggle('modal-active')
        }

        // Menutup modal jika klik di luar area modal (overlay)
        const overlay = document.querySelector('.modal-overlay')
        overlay.addEventListener('click', toggleModal)
        
        // Membuka modal otomatis jika ada error pada register (Opsional)
        @if($errors->has('nama') || $errors->has('password_confirmation'))
            toggleModal();
        @endif
    </script>

    <div class="absolute bottom-4 text-center w-full text-xs text-slate-400/60 font-medium z-0">
        &copy; 2025 Puskesmas Menur Surabaya. All rights reserved.
    </div>

</body>
</html>