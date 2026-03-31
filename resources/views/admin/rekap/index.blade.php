@extends('layouts.admin')

@section('title', 'Data Rekap Kunjungan')
<link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/png">
@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex justify-between items-center">
        <div>
            <h3 class="font-bold text-slate-800 text-lg">Rekap Data Pasien</h3>
            <p class="text-sm text-slate-500">Riwayat kunjungan poli dan waktu periksa</p>
        </div>
        <button onclick="window.print()" class="px-4 py-2 bg-slate-100 text-slate-600 rounded-lg text-sm font-bold hover:bg-slate-200 transition flex items-center gap-2">
            🖨️ Cetak / PDF
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-slate-50 text-slate-500 font-bold border-b border-slate-100 uppercase text-xs">
                <tr>
                    <th class="px-6 py-4">No</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Nama Pasien</th>
                    <th class="px-6 py-4">Poli Tujuan</th>
                    <th class="px-6 py-4">Waktu Daftar</th>
                    <th class="px-6 py-4">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($rekap as $index => $item)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4 font-bold text-slate-600">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-slate-600">
                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-800">{{ $item->pasien->nama ?? '-' }}</div>
                        <div class="text-xs text-slate-400">NIK: {{ $item->pasien->nik ?? '-' }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-600 border border-blue-100">
                            {{ $item->poli->nama_poli ?? '-' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-slate-600 font-mono">
                        {{ \Carbon\Carbon::parse($item->waktu_daftar)->format('H:i') }} WIB
                    </td>
                    <td class="px-6 py-4">
                        @if($item->status == 'selesai')
                            <span class="text-emerald-600 font-bold flex items-center gap-1">✅ Selesai</span>
                        @elseif($item->status == 'dipanggil')
                            <span class="text-blue-600 font-bold flex items-center gap-1">🔊 Dipanggil</span>
                        @elseif($item->status == 'batal')
                            <span class="text-red-500 font-bold flex items-center gap-1">🚫 Batal</span>
                        @else
                            <span class="text-slate-400 font-bold flex items-center gap-1">⏳ Menunggu</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection