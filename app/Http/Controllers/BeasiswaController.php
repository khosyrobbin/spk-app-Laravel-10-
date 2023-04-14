<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use App\Models\Indikator;
use App\Models\Kriteria;
use App\Models\seleksi;
use Illuminate\Http\Request;

class BeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beasiswa = Beasiswa::all();
        $kriteria = Kriteria::orderBy('nama_k', 'asc')->get()->pluck('nama_k', 'kriteria_id');
        // $kriteria = Kriteria::orderBy('nama_k', 'asc')->get()->pluck('nama_k', 'kriteria_id');

        return view('layout.beasiswa', compact('beasiswa','kriteria'));
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
            'nama_b' => 'required',
            'kriteria_id' => 'required|array|min:2'
        ]);

        // Beasiswa::create($request->all());
        // return redirect()->route('beasiswa.index');

        // $params = $request->validated();
        if ($beasiswa = Beasiswa::create($request->all())) {
            $beasiswa->kriteria()->sync($request['kriteria_id']);

            return redirect(route('beasiswa.index'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($beasiswa_id)
    {
        $beasiswa = Beasiswa::findOrFail($beasiswa_id);

        $seleksi = seleksi::all();
        $indikator_s = Indikator::all();
        $kriteria_s = Kriteria::all();

        return view('layout.showBeasiswa', compact('beasiswa','seleksi','indikator_s','kriteria_s'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($beasiswa_id)
    {
        $beasiswa = Beasiswa::findOrFail($beasiswa_id);
        $kriteria = Kriteria::orderBy('nama_k', 'asc')->get()->pluck('nama_k', 'kriteria_id');

        return view('layout.editBeasiswa', compact('beasiswa','kriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Beasiswa $beasiswa)
    {
        $request->validate([
            'nama_b' => 'required',
            'kriteria_id' => 'required|array|min:2'
        ]);

        if ($beasiswa->update($request->all())) {
            $beasiswa->kriteria()->sync($request['kriteria_id']);

            return redirect(route('beasiswa.index'));
        }
        // $beasiswa->update($request->all());
        // return redirect(route('beasiswa.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Beasiswa $beasiswa)
    {
        $beasiswa->kriteria()->detach();
        $beasiswa->delete();
        return redirect()->route('beasiswa.index');
    }
}
