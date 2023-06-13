@extends('template.template')
@section('content')
    <div class="main-content">
        @if (session('delete'))
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-icon">
                    <i class="fas fa-check"></i>
                </div>
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    {{ session('delete') }}
                </div>
            </div>
        @endif
        <section class="section">
            <div class="section-header">
                <?php
                $b = App\Models\Beasiswa::find($beasiswa->beasiswa_id);
                $jml_k = $b->kriteria->count();
                ?>
                <h1 class="section-title">Halaman Hasil Perangkingan Beasiswa {{ $b->nama_b }}{{ $b->beasiswa_id }}</h1>
            </div>

            @if ($seleksi->where('beasiswa_id', $b->beasiswa_id)->isNotEmpty())
                {{-- 1. Matriks penilaian --}}
                <div class="section-body">
                    <div class="card">
                        <h6>Evaluation Matrix (x<sub>ij</sub>)</h6>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" rowspan="3">No</th>
                                    <th scope="col" rowspan="3">Alternatif</th>
                                    <th scope="col" rowspan="3">Nama</th>
                                    <th scope="col" colspan="{{ $b->kriteria->count() }}">Kriteria</th>
                                </tr>
                                <tr>
                                    @foreach ($beasiswa->kriteria as $data)
                                        <th>{{ $data->nama_k }}</th>
                                    @endforeach
                                </tr>
                                <tr>
                                    @for ($i = 1; $i <= $jml_k; $i++)
                                        <th>K{{ $i }}</th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody class=" table-hover">
                                <?php $no = 0;
                                ?>
                                @foreach ($seleksi as $data)
                                    @if ($data->beasiswa_id == $b->beasiswa_id)
                                        <tr>
                                            <td>{{ ++$no }}</td>
                                            <td>A{{ $no }}</td>
                                            <td>{{ $data->nama_siswa }}</td>
                                            @foreach ($data->indikator as $i)
                                                <td>{{ $i->nilai_i }}</td>
                                            @endforeach
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- 2. Normalisasi --}}
                <div class="section-body">
                    <div class="card">
                        <h6>Normalisasi (r<sub>ij</sub>)</h6>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" rowspan="3">No</th>
                                    <th scope="col" rowspan="3">Alternatif</th>
                                    <th scope="col" rowspan="3">Nama</th>
                                    <th scope="col" colspan="{{ $b->kriteria->count() }}">Kriteria</th>
                                </tr>
                                <tr>
                                    @foreach ($beasiswa->kriteria as $data)
                                        <th>{{ $data->nama_k }}</th>
                                    @endforeach
                                </tr>
                                <tr>
                                    @for ($n = 1; $n <= $jml_k; $n++)
                                        <th>K{{ $n }}</th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody class=" table-hover">
                                <?php $no = 0;
                                ?>
                                @foreach ($seleksi as $data)
                                    @if ($data->beasiswa_id == $b->beasiswa_id)
                                        <tr>
                                            <td>{{ ++$no }}</td>
                                            <td>A{{ $no }}</td>
                                            <td>{{ $data->nama_siswa }}</td>
                                            @foreach ($data->indikator as $key => $i)
                                                <td>{{ round($i->nilai_i / sqrt($sum_indikator[$key]), 4) }}</td>
                                            @endforeach
                                        </tr>
                                    @endif
                                @endforeach
                                <td></td>
                                <td></td>
                                <td>Jumlah =</td>
                                @foreach ($sum_indikator as $indikator)
                                    <td> {{ $indikator }} </td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- 3. Normalisasi terbobot --}}
                <div class="section-body">
                    <div class="card">
                        <h6>Normalisasi Terbobot(r<sub>ij</sub>)</h6>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" rowspan="3">No</th>
                                    <th scope="col" rowspan="3">Alternatif</th>
                                    <th scope="col" rowspan="3">Nama</th>
                                    <th scope="col" colspan="{{ $b->kriteria->count() }}">Kriteria</th>
                                </tr>
                                <tr>
                                    @foreach ($beasiswa->kriteria as $data)
                                        <th>{{ $data->nama_k }}</th>
                                    @endforeach
                                </tr>
                                <tr>
                                    @for ($i = 1; $i <= $jml_k; $i++)
                                        <th>K{{ $i }}</th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody class=" table-hover">
                                <?php $no = 0;
                                ?>
                                @foreach ($seleksi as $data)
                                    @if ($data->beasiswa_id == $b->beasiswa_id)
                                        <tr>
                                            <td>{{ ++$no }}</td>
                                            <td>A{{ $no }}</td>
                                            <td>{{ $data->nama_siswa }}</td>
                                            @foreach ($data->indikator as $key => $i)
                                                @php
                                                    $normalisasi_terbobot = round($i->nilai_i / sqrt($sum_indikator[$key]), 4) * $i->pivot->bobot;
                                                @endphp
                                                <td>{{ $normalisasi_terbobot }}
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- 4. Solusi ideal positif --}}
                <div class="section-body">
                    <div class="card">
                        <h6>Solusi Ideal positif (A<sup>+</sup>)</h6>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" colspan="{{ $b->kriteria->count() }}">Kriteria</th>
                                </tr>
                                <tr>
                                    @foreach ($beasiswa->kriteria as $data)
                                        <th>{{ $data->nama_k }}
                                            (@if ($data->status == 1)
                                                Benefit
                                            @else
                                                Cost
                                            @endif)
                                            {{ $data->status }}
                                        </th>
                                    @endforeach
                                </tr>
                                <tr>
                                    @for ($i = 1; $i <= $jml_k; $i++)
                                        <th>y<sub>{{ $i }}</sub><sup>+</sup></th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody class="table-hover">
                                @foreach ($max_values as $ideal_positif)
                                    <td> {{ $ideal_positif }} </td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- 5. Solusi ideal negatif --}}
                <div class="section-body">
                    <div class="card">
                        <h6>Solusi Ideal negatif (A<sup>-</sup>)</h6>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" colspan="{{ $b->kriteria->count() }}">Kriteria</th>
                                </tr>
                                <tr>
                                    @foreach ($beasiswa->kriteria as $data)
                                        <th>{{ $data->nama_k }}
                                            (@if ($data->status == 1)
                                                Benefit
                                            @else
                                                Cost
                                            @endif)
                                            {{ $data->status }}
                                        </th>
                                    @endforeach
                                </tr>
                                <tr>
                                    @for ($i = 1; $i <= $jml_k; $i++)
                                        <th>y<sub>{{ $i }}</sub><sup>-</sup></th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody class="table-hover">
                                @foreach ($min_values as $ideal_negatif)
                                    <td> {{ $ideal_negatif }} </td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- 6. Jarak ideal positif dan negatif --}}
                <div class="section-body">
                    <div class="card">
                        <h6>Jarak Ideal positif (D<sub>i</sub><sup>+</sup>) & Jarak Ideal negatif
                            (D<sub>i</sub><sup>-</sup>)
                        </h6>
                        <table class="table table-hover">
                            <thead>
                                <th>No</th>
                                <th>Alternatif</th>
                                <th>Nama</th>
                                <th>D<suo>+</sup></th>
                                <th>D<suo>-</sup></th>
                            </thead>
                            <tbody class="table-hover">
                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($seleksi as $data)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>A{{ $no }}</td>
                                        <td>{{ $data->nama_siswa }}</td>
                                        @php
                                            $hasil_idealPositif = 0; // Initialize as float
                                            $hasil_idealNegatif = 0;
                                        @endphp
                                        @foreach ($data->indikator as $key => $i)
                                            @php
                                                $normalisasi_terbobot = round($i->nilai_i / sqrt($sum_indikator[$key]), 4) * $i->pivot->bobot;
                                                $hasil_idealPositif += pow($normalisasi_terbobot - $max_values[$key], 2);
                                                $total_idealPositif = round(sqrt($hasil_idealPositif), 4);

                                                $hasil_idealNegatif += pow($normalisasi_terbobot - $min_values[$key], 2);
                                                $total_idealNegatif = round(sqrt($hasil_idealNegatif), 4);
                                            @endphp
                                            {{-- <td>{{ $hasil_idealNegatif }}</td> --}}
                                        @endforeach
                                        <td>{{ $total_idealPositif }}</td>
                                        <td>{{ $total_idealNegatif }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- 7. Nilai Preferensi --}}
                <div class="section-body">
                    <div class="card">
                        <h6>Nilai Preferensi(V<sub>i</sub>)</h6>
                        <table class="table table-hover">
                            <thead>
                                <th>No</th>
                                <th>Alternatif</th>
                                <th>Nama</th>
                                <th>V<sub>i</sub></th>
                            </thead>
                            <tbody class="table-hover">
                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($seleksi as $data)
                                    @if ($data->beasiswa_id == $b->beasiswa_id)
                                        <tr>
                                            <td>{{ ++$no }}</td>
                                            <td>A{{ $no }}</td>
                                            <td>{{ $data->nama_siswa }}</td>
                                            @php
                                                $hasil_idealPositif = 0; // Initialize as float
                                                $hasil_idealNegatif = 0;

                                                $nilai_preferensi = 0;
                                            @endphp
                                            @foreach ($data->indikator as $key => $i)
                                                @php
                                                    $normalisasi_terbobot = round($i->nilai_i / sqrt($sum_indikator[$key]), 4) * $i->pivot->bobot;
                                                    $hasil_idealPositif += pow($normalisasi_terbobot - $max_values[$key], 2);
                                                    $total_idealPositif = round(sqrt($hasil_idealPositif), 4);

                                                    $hasil_idealNegatif += pow($normalisasi_terbobot - $min_values[$key], 2);
                                                    $total_idealNegatif = round(sqrt($hasil_idealNegatif), 4);

                                                    if ($total_idealPositif + $total_idealNegatif != 0) {
                                                        $nilai_preferensi = $total_idealNegatif / ($total_idealPositif + $total_idealNegatif);
                                                    } else {
                                                        $nilai_preferensi = 0; // Nilai default jika pembagi nol
                                                    }
                                                @endphp
                                            @endforeach
                                            <td>{{ $nilai_preferensi }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- 8. Rangking --}}
                <div class="section-body">
                    <div class="card">
                        <h6>Ranking</h6>
                        <table class="table table-hover">
                            <thead>
                                <th>Nama</th>
                                <th>V<sub>i</sub></th>
                                <th>Rank</th>
                            </thead>
                            <tbody class="table-hover">
                                @php
                                    $no = 0;
                                    $data_sorted = []; // Array untuk menyimpan data dengan nilai preferensi terurut
                                @endphp
                                @foreach ($seleksi as $data)
                                    @if ($data->beasiswa_id == $b->beasiswa_id)
                                        @php
                                            $no++;
                                            $alternatif = 'A' . $no;
                                            $nama_siswa = $data->nama_siswa;
                                            $hasil_idealPositif = 0;
                                            $hasil_idealNegatif = 0;
                                            $nilai_preferensi = 0;

                                            // Hitung nilai preferensi untuk data yang sesuai
                                            foreach ($data->indikator as $key => $i) {
                                                $normalisasi_terbobot = round($i->nilai_i / sqrt($sum_indikator[$key]), 4) * $i->pivot->bobot;
                                                $hasil_idealPositif += pow($normalisasi_terbobot - $max_values[$key], 2);
                                                $hasil_idealNegatif += pow($normalisasi_terbobot - $min_values[$key], 2);

                                                if ($key == count($data->indikator) - 1) {
                                                    $total_idealPositif = round(sqrt($hasil_idealPositif), 4);
                                                    $total_idealNegatif = round(sqrt($hasil_idealNegatif), 4);

                                                    if ($total_idealPositif + $total_idealNegatif != 0) {
                                                        $nilai_preferensi = $total_idealNegatif / ($total_idealPositif + $total_idealNegatif);
                                                    } else {
                                                        $nilai_preferensi = 0;
                                                    }
                                                }
                                            }

                                            $data_sorted[] = [
                                                'nama_siswa' => $nama_siswa,
                                                'nilai_preferensi' => $nilai_preferensi,
                                            ];
                                        @endphp
                                    @endif
                                @endforeach

                                @php
                                    // Urutkan data berdasarkan nilai preferensi secara descending
                                    usort($data_sorted, function ($a, $b) {
                                        return $b['nilai_preferensi'] <=> $a['nilai_preferensi'];
                                    });

                                    $rank = 1;
                                @endphp

                                @foreach ($data_sorted as $data)
                                    <tr>
                                        <td>{{ $data['nama_siswa'] }}</td>
                                        <td>{{ $data['nilai_preferensi'] }}</td>
                                        <td>{{ $rank }}</td>
                                    </tr>
                                    @php $rank++; @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </section>
    </div>
@endsection
