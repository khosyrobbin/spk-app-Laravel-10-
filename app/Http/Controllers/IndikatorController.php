<?php

namespace App\Http\Controllers;

use App\Models\IndikatorModel;
use App\Models\KriteriaModel;
use Illuminate\Http\Request;

class IndikatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $indikator = IndikatorModel::all();
        $kriteria = KriteriaModel::orderBy('nama_k', 'asc')->get()->pluck('nama_k', 'id_kriteria');
        return view('indikator', compact('indikator','kriteria'));
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
            'id_kriteria' => 'required',
        ]);

        IndikatorModel::create($request->all());
        return redirect()->route('indikator.index');
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
    public function edit(IndikatorModel $indikator)
    {
        // $indikator = IndikatorModel::findOrFail($id_indikator);
        // $kriteria = KriteriaModel::orderBy('nama_k', 'asc')->get()->pluck('nama_k', 'id_kriteria');
        return view('editIndikator', compact('indikator'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IndikatorModel $indikator)
    {
        $request->validate([
            'nama_i' => 'required',
            'nilai_i' => 'required',
            // 'id_kriteria' => 'required',
        ]);

        $indikator->update($request->all());
        return redirect()->route('indikator.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IndikatorModel $indikator)
    {
        $indikator->delete();
        return redirect()->route('indikator.index');
    }
    // test commit
}
