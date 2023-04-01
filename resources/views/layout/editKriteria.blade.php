@extends('template.template')
@section('content')
    <div class="main-content">
        <section class="section">

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit kriteria {{$kriterium->nama_k}}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kriteria.update', $kriterium->id_kriteria) }}" method="POST" role="form">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="">Nama Kriteria :</label>
                                <input type="text" class="form-control card card-body border" name="nama_k"
                                    id="nama_k" value="{{ $kriterium->nama_k }}">
                            </div>
                            <div class="mb-3">
                                <label for="bobot" class="form-label text-bold">Bobot:</label>
                                <select name="bobot" id="bobot" class=" form-control">
                                    <option value="{{ $kriterium->bobot }}">{{ $kriterium->bobot }}</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label text-bold">Status:</label>
                                <select name="status" id="status" class=" form-control">
                                    <option value="{{ $kriterium->status }}">{{ $kriterium->status }}</option>
                                    <option value="Benefit">Benefit</option>
                                    <option value="Cost">Cost</option>
                                </select>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('kriteria.index') }}" class=" btn btn-github btn-sm mt-4">Kembali</a>
                                <button type="submit" class="btn btn-danger btn-sm mt-4">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
