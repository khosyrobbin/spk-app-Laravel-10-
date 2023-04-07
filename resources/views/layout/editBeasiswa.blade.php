@extends('template.template')
@section('content')
    <div class="main-content">
        <section class="section">

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Beasiswa {{ $beasiswa->nama_b }} </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('beasiswa.update', $beasiswa->beasiswa_id) }}" method="POST" role="form">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nama_i" class="form-label text-bold">Nama Beasiswa:</label>
                                <input type="text" class="form-control card card-body border" name="nama_b"
                                    id="nama_b" value="{{ $beasiswa->nama_b }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-bold">Kriteria :</label>
                                @php
                                    $selectBeasiswa = $beasiswa->kriteria->pluck('kriteria_id')->toArray();
                                @endphp
                                @foreach ($kriteria as $data => $kriteria_id)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="kriteria_id[]"
                                            value="{{ $data }}" @checked(in_array($data, $selectBeasiswa))>
                                        <label class="form-check-label">
                                            {{ $kriteria_id }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="text-center">
                                <a href="{{ route('beasiswa.index') }}" class=" btn btn-github btn-sm mt-4">Kembali</a>
                                <button type="submit" class="btn btn-danger btn-sm mt-4">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
