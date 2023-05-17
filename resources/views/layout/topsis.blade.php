@extends('template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <?php
                $b = App\Models\Beasiswa::find($beasiswa->beasiswa_id);
                $jml_k = $b->kriteria->count();
                ?>
                <h1 class="section-title">Halaman Hasil Perangkingan Beasiswa {{ $b->nama_b }}</h1>
            </div>

            {{-- 1 --}}
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
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>A{{ $no }}</td>
                                    <td>{{ $data->nama_siswa }}</td>
                                    @foreach ($data->indikator as $i)
                                        <td>{{ $i->nilai_i }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- 2 --}}
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
                                {{-- <th scope="col" rowspan="3">Jumlah</th> --}}
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
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>A{{ $no }}</td>
                                    <td>{{ $data->nama_siswa }}</td>
                                    {{-- <td>{{ round(0.6543,2) }}</td> round((($i->nilai_i)/ pow($i->nilai_i, 2)), 2) --}}
                                    @foreach ($data->indikator as $i)
                                        <td>{{ pow($i->nilai_i, 2) }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                            <td></td>
                            <td></td>
                            <td>Jumlah =</td>
                            @foreach ($seleksi as $data)
                            @foreach ( $data->indikator as $i )
                            <td>{{ $i->pluck('nilai_i') }}</td>
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- 3 --}}
            {{-- 4 --}}
            {{-- 5 --}}
            {{-- 6 --}}
            {{-- 7 --}}
            {{-- 8 --}}
            {{-- 9 --}}
        </section>
    </div>
@endsection
