<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Poli;

class PoliController extends Controller
{
    public function index()
    {
        $poli = Poli::all();
        return view('admin.poli.index', compact('poli'));
    }

    public function update(Request $request, $id)
    {
        $poli = Poli::findOrFail($id);
        $poli->update($request->all()); // Bisa update nama atau estimasi waktu
        return back()->with('success', 'Data Poli diupdate');
    }
}