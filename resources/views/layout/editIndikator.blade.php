@extends('template.template')
@section('content')
    <div class="main-content">
        <section class="section">

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <?php $nama = App\Models\KriteriaModel::find($indikator->id_kriteria); ?>
                        <h4>Edit indikator kriteria {{ $nama->nama_k }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('indikator.update', $indikator->id_indikator) }}" method="POST" role="form">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nama_i" class="form-label text-bold">Nama Indikator:</label>
                                <input type="text" class="form-control card card-body border" name="nama_i"
                                    id="nama_i" value="{{ $indikator->nama_i }}">
                            </div>
                            <div class="mb-3">
                                <label for="nilai_i" class="form-label text-bold">Nilai Indikator:</label>
                                <select name="nilai_i" id="nilai_i" class=" form-control">
                                    <option value="{{ $indikator->nilai_i }}">{{ $indikator->nilai_i }}</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('indikator.index') }}" class=" btn btn-github btn-sm mt-4">Kembali</a>
                                <button type="submit" class="btn btn-danger btn-sm mt-4">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
