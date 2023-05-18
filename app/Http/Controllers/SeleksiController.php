<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use App\Models\Indikator;
use App\Models\Kriteria;
use App\Models\seleksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        if ($seleksi = seleksi::create($request->all())) { {
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

    public function topsis($beasiswa_id)
    {
        $beasiswa = Beasiswa::with('kriteria')->first();
        $seleksi = seleksi::with('indikator')->get();

        $indikator = $seleksi->pluck('indikator');

        $sum_indikator = [];

        foreach ($indikator as $index => $subArray) {
            foreach ($subArray as $innerIndex => $value) {
                if (!isset($sum_indikator[$innerIndex])) {
                    $sum_indikator[$innerIndex] = 0;
                }
                $sum_indikator[$innerIndex] += pow($value["nilai_i"], 2);
            }
        }

        // $indikator = Indikator::get()->pluck('nilai_i', 'indikator_id');
        // $kriteria = Kriteria::all();


        // $indikator = array();
        // $kriteria_s = array();

        // dd($seleksi);
        return view('layout.topsis', compact('beasiswa', 'seleksi', 'sum_indikator'));
    }
}
