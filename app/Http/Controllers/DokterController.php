<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Poli;

class DokterController extends Controller
{
    public function index()
    {
        $dokter = Dokter::with('poli')->get();
        $poli = Poli::all();
        return view('admin.dokter.index', compact('dokter', 'poli'));
    }

    public function store(Request $request)
    {
        $request->validate(['nama_dokter' => 'required', 'id_poli' => 'required']);
        Dokter::create($request->all());
        return back()->with('success', 'Dokter berhasil ditambahkan');
    }

    public function destroy($id)
    {
        Dokter::destroy($id);
        return back()->with('success', 'Dokter dihapus');
    }
}