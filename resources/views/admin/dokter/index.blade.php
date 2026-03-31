@extends('layouts.admin')

@section('title', 'Manajemen Dokter')
<link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/png">

@section('content')
<div class="flex gap-6">
    <div class="w-1/3">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <h3 class="font-bold text-slate-800 mb-4">Tambah Dokter Baru</h3>
            <form action="{{ route('admin.dokter.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-600 mb-2">Nama Dokter</label>
                    <input type="text" name="nama_dokter" class="w-full border p-2 rounded-lg" placeholder="Contoh: dr. Budi Santoso" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-600 mb-2">No. Izin Praktek (SIP)</label>
                    <input type="text" name="no_izin_praktek" class="w-full border p-2 rounded-lg" placeholder="Contoh: 446/001/SIP-DU/2025" required>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-600 mb-2">Poli</label>
                    <select name="id_poli" class="w-full border p-2 rounded-lg bg-white" required>
                        <option value="" disabled selected>-- Pilih Poli --</option>
                        @foreach($poli as $p)
                        <option value="{{ $p->id_poli }}">{{ $p->nama_poli }}</option>
                        @endforeach
                    </select>
                </div>

                <button class="w-full bg-blue-600 text-white py-2 rounded-lg font-bold hover:bg-blue-700 transition">Simpan Dokter</button>
            </form>
        </div>
    </div>

    <div class="w-2/3">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 text-slate-500 font-bold border-b">
                    <tr>
                        <th class="p-4">Nama Dokter</th>
                        <th class="p-4">No. SIP</th> <th class="p-4">Poli</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dokter as $d)
                    <tr class="border-b last:border-0 hover:bg-slate-50">
                        <td class="p-4 font-semibold text-slate-700">
                            {{ $d->nama_dokter }}
                        </td>
                        <td class="p-4 text-slate-500">
                            {{ $d->no_izin_praktek }} </td>
                        <td class="p-4">
                            <span class="bg-blue-50 text-blue-600 px-2 py-1 rounded text-xs font-bold">
                                {{ $d->poli->nama_poli ?? 'Tanpa Poli' }}
                            </span>
                        </td>
                        <td class="p-4 text-center">
                            <form action="{{ route('admin.dokter.destroy', $d->id_dokter) }}" method="POST" onsubmit="return confirm('Hapus dokter ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 hover:text-red-700 font-bold text-xs bg-red-50 hover:bg-red-100 px-3 py-1 rounded transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-6 text-center text-slate-400">Belum ada data dokter.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection