@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <?php $nama = App\Models\Kriteria::find($indikator->kriteria_id); ?>
                    <div class="card-header">{{ __('Edit Indikator ') }}{{$nama->nama_k}}</div>

                    <div class="card-body">
                        <form action="{{ route('indikator.update', $indikator->indikator_id) }}" method="POST" role="form">
                            @csrf
                            @method('PUT')
                            {{-- <div class="mb-3">
                                <label for="kriteria_id" class="form-label text-bold">Nama Kriteria:</label>
                                <input type="text" class="form-control card card-body border" name="kriteria_id"
                                id="kriteria_id" value="{{ $nama->nama_k }}" readonly>
                            </div> --}}
                            <div class="mb-3">
                                <label for="nama_i" class="form-label text-bold">Nama Indikator:</label>
                                <input type="text" class="form-control card card-body border" name="nama_i"
                                id="nama_i" value="{{ $indikator->nama_i }}">
                            </div>
                            <div class="mb-3">
                                <label for="nilai_i" class="form-label text-bold">Nilai Indikator:</label>
                                <select name="nilai_i" id="nilai_i" >
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
        </div>
    </div>
@endsection
