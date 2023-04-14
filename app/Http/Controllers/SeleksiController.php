<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use App\Models\Indikator;
use App\Models\Kriteria;
use App\Models\seleksi;
use Illuminate\Http\Request;

class SeleksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $seleksi = seleksi::all();
        // $kriteria = Kriteria::orderBy('nama_k', 'asc')->get()->pluck('nama_k', 'kriteria_id');
        // $indikator = Indikator::orderBy('nama_i', 'asc')->get()->pluck('nama_i', 'indikator_id');
        // $indikator_s = Indikator::all();
        // $kriteria_s = Kriteria::all();
        // return view('layout.seleksi', compact('seleksi','kriteria','indikator','indikator_s','kriteria_s'));
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
            'NISN' => 'required|numeric',
            'nama_siswa' => 'required',
            'beasiswa_id' => 'required',
            'indikator_id' => 'required|array|max:5'
        ]);
        if ($seleksi = seleksi::create($request->all())) {
            {
                $seleksi->indikator()->sync($request['indikator_id']);
                // $seleksi->indikator()->sync($request['indikator_id']);
            }

            return redirect()->back();
        }
        // seleksi::create($request->all());
        // return redirect()->back();
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(seleksi $seleksi)
    {
        $seleksi->indikator()->detach();
        $seleksi->delete();
        return redirect()->back();
    }
}
