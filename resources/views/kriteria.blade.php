@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn bg-success" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Tambah Kriteria
                        </button>
                        {{ __('Kriteria') }}
                    </div>

                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Kriteria</th>
                                    <th scope="col">Bobot</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class=" table-hover">
                                @foreach ($kriteria as $item)
                                    <tr>
                                        <td>{{ $item->nama_k }}</td>
                                        <td>{{ $item->bobot }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            <form action="{{ route('kriteria.destroy', $item->id_kriteria) }}"
                                                method="post">
                                                <a href="{{ route('kriteria.edit', $item->id_kriteria) }}"
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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Form Tambah Kriteria</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kriteria.store') }}" method="post" role="form">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="nama_k" class="form-label text-bold">Nama Kriteria:</label>
                            <input type="text" class="form-control" id="nama_k" placeholder="Tambahkan kriteria baru"
                                name="nama_k">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="bobot" class="form-label text-bold">Bobot:</label>
                            <select name="bobot" id="bobot">
                                <option value="">Pilih bobot kriteria</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="status" class="form-label text-bold">Status:</label>
                            <select name="status" id="status">
                                <option value="">Pilih status kriteria</option>
                                <option value="Benefit">Benefit</option>
                                <option value="Cost">Cost</option>
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
