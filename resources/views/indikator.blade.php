@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn bg-success" data-bs-toggle="modal"
                            data-bs-target="#exampleModalIndikator">Tambah Indikator
                        </button>
                        {{ __('Indikator') }}
                    </div>

                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Kriteria</th>
                                    <th scope="col">Nama Indikator</th>
                                    <th scope="col">Nilai Indikator</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class=" table-hover">
                                @foreach ($indikator as $item)
                                    <tr>
                                        <?php $nama = App\Models\KriteriaModel::find($item->id_kriteria); ?>
                                        <td>{{ $nama->nama_k }}</td>
                                        <td>{{ $item->nama_i }}</td>
                                        <td>{{ $item->nilai_i }}</td>
                                        <td>
                                            <form action="{{ route('indikator.destroy', $item->id_indikator) }}"
                                                method="post">
                                                <a href="{{ route('indikator.edit', $item->id_indikator) }}"
                                                    class="btn btn-warning">edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal tambah kriteria -->
    <div class="modal fade" id="exampleModalIndikator" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Form Tambah Indikator</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('indikator.store') }}" method="post" role="form">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="id_kriteria" class="form-label text-bold">Nama Kriteria:</label>
                            <select name="id_kriteria" id="id_kriteria">
                                <option value="">Pilih nama kriteria</option>
                                @foreach ($kriteria as $data => $nama_k)
                                    <option value="{{ $data }}" @selected(old('id_kriteria') == $data)>
                                        {{ $nama_k }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="nama_i" class="form-label text-bold">Nama Indikator:</label>
                            <input type="text" class="form-control" id="nama_i" placeholder="Tambahkan kriteria baru"
                                name="nama_i">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="nilai_i" class="form-label text-bold">Nilai Indikator:</label>
                            <select name="nilai_i" id="nilai_i">
                                <option value="">Pilih nilai indikator</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn bg-gradient-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
