@extends('layouts.admin')

@section('title', 'Kelola Poli')
  <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/png">

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @foreach($poli as $p)
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <form action="{{ route('admin.poli.update', $p->id_poli) }}" method="POST">
            @csrf @method('PUT')
            <div class="flex justify-between items-center mb-4">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold text-lg">
                    {{ substr($p->nama_poli, 0, 1) }}
                </div>
                <button class="bg-slate-100 text-slate-600 px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-600 hover:text-white transition">Simpan Perubahan</button>
            </div>
            
            <div class="space-y-4">
                <div>
                    <label class="text-xs font-bold text-slate-400 uppercase">Nama Poli</label>
                    <input type="text" name="nama_poli" value="{{ $p->nama_poli }}" class="w-full font-bold text-slate-800 border-b border-slate-200 focus:border-blue-500 outline-none py-1">
                </div>
                <div>
                    <label class="text-xs font-bold text-slate-400 uppercase">Estimasi Waktu (Menit)</label>
                    <input type="number" name="estimasi_menit" value="{{ $p->estimasi_menit }}" class="w-full font-bold text-slate-800 border-b border-slate-200 focus:border-blue-500 outline-none py-1">
                </div>
            </div>
        </form>
    </div>
    @endforeach
</div>
@endsection