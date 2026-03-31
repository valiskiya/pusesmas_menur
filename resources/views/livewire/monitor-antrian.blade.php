<div wire:poll.2s class="flex flex-col h-screen bg-slate-50 text-slate-800 font-sans overflow-hidden">

    <div class="h-16 shrink-0 bg-white border-b border-slate-200 flex justify-between items-center px-6 shadow-sm z-30 relative">
        <div class="flex items-center gap-3">
            <div class="bg-blue-50 p-1.5 rounded-lg">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-8 w-8">
            </div>
            <div>
                <h1 class="text-xl font-bold tracking-tight text-slate-800 leading-none">Puskesmas Menur</h1>
                <p class="text-[10px] text-blue-600 uppercase tracking-widest font-bold mt-0.5">
                    @if($poli_id)
                        Loket {{ $polis->find($poli_id)->nama_poli ?? '' }}
                    @else
                        Sistem Antrian Terpadu
                    @endif
                </p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="relative">
                <select wire:model.live="poli_id" class="appearance-none bg-slate-100 border border-slate-300 text-slate-700 py-1.5 pl-3 pr-8 rounded-lg text-xs font-bold uppercase cursor-pointer hover:bg-slate-200 transition focus:ring-2 focus:ring-blue-500 outline-none">
                    <option value="">📺 Tampilkan Semua</option>
                    @foreach($polis as $p)
                        <option value="{{ $p->id_poli }}">🏥 {{ $p->nama_poli }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-600">
                    <svg class="fill-current h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>

            <div class="text-right border-l border-slate-200 pl-4">
                <div id="clock" class="text-2xl font-mono font-bold text-slate-800 tracking-widest leading-none">00:00:00</div>
                <div id="date" class="text-[10px] text-slate-500 font-bold uppercase">Senin, 01 Jan 2025</div>
            </div>
        </div>
    </div>

    <div class="flex-1 flex overflow-hidden relative z-10">
        
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
            <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-blue-100/40 rounded-full blur-[80px]"></div>
            <div class="absolute bottom-[-10%] right-[20%] w-[400px] h-[400px] bg-emerald-100/40 rounded-full blur-[80px]"></div>
        </div>

        <div class="w-8/12 flex flex-col justify-center items-center relative z-10 border-r border-slate-200 p-2">
            
            <div class="mb-4 bg-slate-800 text-white px-6 py-1.5 rounded-full font-bold tracking-[0.2em] uppercase shadow-md text-xs">
                Sedang Melayani
            </div>

            @if($current)
                @php
                    // Logika Warna Berdasarkan Nama Poli
                    $poliName = strtolower($current->poli->nama_poli ?? '');
                    $colorTheme = 'blue'; // Default
                    if(str_contains($poliName, 'gigi')) $colorTheme = 'pink';
                    if(str_contains($poliName, 'anak') || str_contains($poliName, 'kia')) $colorTheme = 'orange';
                    if(str_contains($poliName, 'umum')) $colorTheme = 'blue';
                @endphp

                <div class="relative group transform transition-all duration-500 hover:scale-105">
                    <div class="absolute -inset-2 bg-gradient-to-r from-{{ $colorTheme }}-400 to-{{ $colorTheme }}-300 rounded-[2rem] opacity-30 blur-xl animate-pulse"></div>
                    
                    <div class="relative bg-white border-2 border-slate-100 text-slate-900 rounded-[1.5rem] px-16 py-6 shadow-2xl flex flex-col items-center min-w-[350px]">
                        
                        <div id="nomor-besar" class="text-[8rem] xl:text-[10rem] font-black leading-none tracking-tighter text-slate-800 font-mono">
                            {{ $current->nomor_antrian }}
                        </div>

                        <div class="h-1 w-20 bg-slate-100 rounded-full my-2"></div>

                        <div class="text-3xl xl:text-4xl font-bold text-{{ $colorTheme }}-600 text-center uppercase drop-shadow-sm">
                            {{ $current->poli->nama_poli ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="mt-5 text-center">
                    <p class="text-slate-400 text-[10px] uppercase font-bold tracking-widest mb-0.5">Nama Pasien</p>
                    <p class="text-3xl font-bold text-slate-800 truncate max-w-2xl leading-tight">
                        {{ $current->pasien->nama ?? '-' }}
                    </p>
                </div>

                <div class="mt-5 px-8 py-2.5 bg-{{ $colorTheme }}-600 text-white rounded-xl text-lg font-bold animate-bounce shadow-lg">
                    SILAKAN MASUK RUANGAN
                </div>
            @else
                <div class="flex flex-col items-center justify-center opacity-40">
                    <div class="w-24 h-24 bg-slate-200 rounded-full flex items-center justify-center mb-4 animate-pulse">
                        <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="text-2xl font-bold text-slate-400">Menunggu Antrian...</div>
                </div>
            @endif
        </div>

        <div class="w-4/12 bg-white flex flex-col z-10 shadow-[-5px_0_20px_rgba(0,0,0,0.02)] border-l border-slate-100">
            <div class="p-4 bg-slate-50 border-b border-slate-200 shrink-0">
                <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                    <span class="flex h-2.5 w-2.5 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-blue-600"></span>
                    </span>
                    ANTRIAN BERIKUTNYA
                </h3>
            </div>

            <div class="flex-1 p-4 space-y-2 overflow-y-auto bg-slate-50/50">
                @forelse($next as $index => $item)
                    @php
                        $pName = strtolower($item->poli->nama_poli ?? '');
                        $badgeColor = 'bg-blue-100 text-blue-700';
                        if(str_contains($pName, 'gigi')) $badgeColor = 'bg-pink-100 text-pink-700';
                        if(str_contains($pName, 'anak')) $badgeColor = 'bg-orange-100 text-orange-700';
                    @endphp

                    <div class="group bg-white p-3 rounded-lg flex items-center justify-between border border-slate-200 hover:border-blue-400 hover:shadow-sm transition-all">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-md bg-slate-100 text-slate-600 flex items-center justify-center text-xs font-bold border border-slate-200">
                                {{ $index + 1 }}
                            </div>
                            <div>
                                <div class="text-xl font-black text-slate-800 font-mono leading-none">{{ $item->nomor_antrian }}</div>
                                <span class="inline-block mt-0.5 px-1.5 py-[2px] rounded-[4px] text-[9px] font-bold uppercase {{ $badgeColor }}">
                                    {{ $item->poli->nama_poli ?? '-' }}
                                </span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-xs font-bold text-slate-700 truncate w-20 text-right">{{ $item->pasien->nama ?? '-' }}</div>
                            <div class="text-[9px] text-slate-400 font-medium">Menunggu</div>
                        </div>
                    </div>
                @empty
                    <div class="h-full flex flex-col items-center justify-center text-slate-400 space-y-2">
                        <p class="text-xs font-medium opacity-50">Tidak ada antrian</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="h-10 shrink-0 bg-slate-800 flex items-center relative overflow-hidden z-30">
        <div class="bg-blue-600 px-4 h-full flex items-center font-bold text-white z-20 shadow-xl border-r border-blue-500 text-xs tracking-wider">
            INFO
        </div>
        <div class="flex-1 text-slate-200 text-sm font-medium tracking-wide flex items-center py-1">
            <marquee scrollamount="6">
                Selamat Datang di Puskesmas Menur. Mohon menunggu panggilan sesuai nomor antrian dan Poli tujuan Anda. Terima kasih atas kesabaran Anda.
            </marquee>
        </div>
    </div>

    <script>
        setInterval(() => {
            const now = new Date();
            document.getElementById('clock').innerText = now.toLocaleTimeString('id-ID', { hour12: false });
            document.getElementById('date').innerText = now.toLocaleDateString('id-ID', { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' });
        }, 1000);

        document.addEventListener('livewire:initialized', () => {
            let lastNomor = '{{ $current->nomor_antrian ?? "" }}';
            Livewire.hook('morph.updated', () => {
                let elementNomor = document.getElementById('nomor-besar');
                if(!elementNomor) return;
                let currentNomor = elementNomor.innerText.trim();
                
                if (currentNomor !== lastNomor && currentNomor !== '') {
                    lastNomor = currentNomor;
                    setTimeout(() => { playAudio(currentNomor); }, 500);
                }
            });
        });

        function playAudio(nomor) {
            if ('speechSynthesis' in window) {
                window.speechSynthesis.cancel();
                let msg = new SpeechSynthesisUtterance();
                msg.lang = 'id-ID';
                let poli = "{{ $current->poli->nama_poli ?? 'Ruangan' }}"; 
                msg.text = "Nomor Antrian... " + nomor + "... Silakan Masuk ke " + poli;
                msg.rate = 0.85;
                window.speechSynthesis.speak(msg);
            }
        }
    </script>
</div>