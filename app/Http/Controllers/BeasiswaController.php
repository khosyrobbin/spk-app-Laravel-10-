<?php

namespace App\Http\Controllers;

use App\Models\BeasiswaModel;
use App\Models\IndikatorModel;
use Illuminate\Http\Request;

class BeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beasiswa = BeasiswaModel::all();
        $indikator = IndikatorModel::orderBy('nama_i', 'asc')->get()->pluck('nama_i', 'id_indikator');

        return view('layout.beasiswa', compact('beasiswa','indikator'));
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
        ]);

        // BeasiswaModel::create($request->all());
        // return redirect()->route('beasiswa.index');

        // $params = $request->validated();
        if ($beasiswa = BeasiswaModel::create($request->all())) {
            $beasiswa->indikator()->sync($request['id_indikator']);

            return redirect(route('beasiswa.index'));
        }
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
    public function destroy(string $id)
    {
        //
    }
}
