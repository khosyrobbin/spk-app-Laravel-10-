<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class IndikatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $indikator = Indikator::all();
        $kriteria = Kriteria::orderBy('nama_k', 'asc')->get()->pluck('nama_k', 'kriteria_id');
        return view('layout.indikator', compact('indikator', 'kriteria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_i' => 'required',
            'nilai_i' => 'required',
            'kriteria_id' => 'required',
        ]);

        Indikator::create($request->all());
        return redirect()->route('indikator.index')->with('success', 'Indikator berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Indikator $indikator)
    {
        // $indikator = Indikator::findOrFail($indikator_id);
        // $kriteria = Kriteria::orderBy('nama_k', 'asc')->get()->pluck('nama_k', 'kriteria_id');
        return view('layout.editIndikator', compact('indikator'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Indikator $indikator)
    {
        $request->validate([
            'nama_i' => 'required',
            'nilai_i' => 'required',
            // 'kriteria_id' => 'required',
        ]);

        $indikator->update($request->all());
        return redirect()->route('indikator.index')->with('success', 'Indikator berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Indikator $indikator)
    {

        try {
            $indikator->delete();
            return redirect()->route('indikator.index')->with('delete', 'Indikator berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorMessage = $e->errorInfo[2]; // Mendapatkan pesan error dari query exception

            return redirect()->route('indikator.index')->with('error', $errorMessage);
        }
    }
}
