@extends('layouts.admin')
@section('title', 'Laporan Kunjungan Hari Ini')
<link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/png">

@section('content')

<div class="space-y-6">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
        <h3 class="font-bold text-slate-800 mb-6">Statistik Kunjungan per Poli</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($stats as $s)
            <div>
                <div class="flex justify-between mb-1">
                    <span class="text-sm font-medium text-slate-700">{{ $s->nama_poli }}</span>
                    <span class="text-sm font-bold text-slate-900">{{ $s->antrian_count }} Pasien</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2.5">
                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $s->antrian_count > 0 ? min($s->antrian_count * 5, 100) : 0 }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100">
            <h3 class="font-bold text-slate-800">Detail Laporan Kunjungan</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600">
                <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 font-bold">No</th>
                        <th class="px-6 py-4 font-bold">Tanggal</th>
                        <th class="px-6 py-4 font-bold">Nama Pasien</th>
                        <th class="px-6 py-4 font-bold">Poli Tujuan</th>
                        <th class="px-6 py-4 font-bold">Waktu Daftar</th>
                        <th class="px-6 py-4 font-bold text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($laporan as $row)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-slate-900">
                            {{ $loop->iteration }}
                        </td>
                        
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($row->tanggal)->format('d-m-Y') }}
                        </td>

                        <td class="px-6 py-4">
                            <div class="font-medium text-slate-900">{{ $row->pasien->nama ?? 'Pasien Terhapus' }}</div>
                            <small class="text-slate-500">{{ $row->pasien->nik ?? '-' }}</small>
                        </td>

                        <td class="px-6 py-4">
                            {{ $row->poli->nama_poli ?? '-' }}
                        </td>

                        <td class="px-6 py-4">
                            {{ date('H:i', strtotime($row->waktu_daftar)) }} WIB
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if($row->status == 'menunggu')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">
                                    Menunggu
                                </span>
                            @elseif($row->status == 'dipanggil')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-600 animate-pulse">
                                    Sedang Dilayani
                                </span>
                            @elseif($row->status == 'selesai')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-600">
                                    Selesai
                                </span>
                            @elseif($row->status == 'batal')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-600">
                                    Batal
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-slate-400">
                            Tidak ada data antrian hari ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection