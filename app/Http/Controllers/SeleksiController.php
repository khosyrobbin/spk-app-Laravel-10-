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
            'indikator_id' => 'required|array|max:5',
            'bobot' => 'required|array',
            'bobot.*' => 'numeric',
            'status' => 'required|array',
            'status.*' => 'numeric',
        ]);

        $seleksi = Seleksi::create([
            'NISN' => $request->NISN,
            'nama_siswa' => $request->nama_siswa,
            'beasiswa_id' => $request->beasiswa_id,
        ]);

        $indikatorIds = $request->indikator_id;
        $bobotArray = $request->bobot;
        $statusArray = $request->status;

        foreach ($indikatorIds as $index => $indikatorId) {
            $bobot = $bobotArray[$index];
            $status = $statusArray[$index];

            $seleksi->indikator()->attach($indikatorId, ['bobot' => $bobot, 'status' => $status]);
        }

        return redirect()->back();
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


        // $maxValues = [];
        // foreach ($indikator as $index => $subArray) {
        //     foreach ($subArray as $innerIndex => $value) {
        //         if (!isset($maxValues[$innerIndex])) {
        //             $maxValues[$innerIndex] = $value["nilai_i"];
        //         } else {
        //             $maxValues[$innerIndex] = max($maxValues[$innerIndex], $value["nilai_i"]);
        //         }
        //     }
        // }

        // Hampir benar
        $nilai_tertinggi = [];

        foreach ($seleksi as $data) {
            $nilai_normalisasi_terbobot = [];
            foreach ($data['indikator'] as $key => $i) {
                $normalisasi_terbobot = round($i['nilai_i'] / sqrt($sum_indikator[$key]), 4) * $i['pivot']['bobot'];
                $nilai_normalisasi_terbobot[] = $normalisasi_terbobot;
            }
            $nilai_tertinggi[] = max($nilai_normalisasi_terbobot);
        }
        // solusi ideal positif
        $max_values = [];
        foreach ($seleksi as $subArray) {
            $nilai_normalisasi_terbobot = [];
            foreach ($subArray['indikator'] as $innerIndex => $value) {
                $normalisasi_terbobot = round($value['nilai_i'] / sqrt($sum_indikator[$innerIndex]), 4) * $value['pivot']['bobot'];
                if ($value->pivot->status == 1) {
                    if (!isset($max_values[$innerIndex]) || $normalisasi_terbobot > $max_values[$innerIndex]) {
                        $max_values[$innerIndex] = $normalisasi_terbobot;
                    }
                } else {
                    if (!isset($max_values[$innerIndex]) || $normalisasi_terbobot < $max_values[$innerIndex]) {
                        $max_values[$innerIndex] = $normalisasi_terbobot;
                    }
                }
            }
        }
        $min_values = [];
        foreach ($seleksi as $subArray) {
            $nilai_normalisasi_terbobot = [];
            foreach ($subArray['indikator'] as $innerIndex => $value) {
                $normalisasi_terbobot = round($value['nilai_i'] / sqrt($sum_indikator[$innerIndex]), 4) * $value['pivot']['bobot'];
                if ($value->pivot->status == 1) {
                    if (!isset($min_values[$innerIndex]) || $normalisasi_terbobot < $min_values[$innerIndex]) {
                        $min_values[$innerIndex] = $normalisasi_terbobot;
                    }
                } else {
                    if (!isset($min_values[$innerIndex]) || $normalisasi_terbobot > $min_values[$innerIndex]) {
                        $min_values[$innerIndex] = $normalisasi_terbobot;
                    }
                }
            }
        }

        // dd($nilai_tertinggi);

        return view('layout.topsis', compact('beasiswa', 'seleksi', 'sum_indikator', 'nilai_tertinggi', 'max_values', 'min_values'));
    }
}
