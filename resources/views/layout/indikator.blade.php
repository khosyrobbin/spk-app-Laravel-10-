@extends('template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1 class="section-title">Halaman Indikator</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Example Card</h4>
                    </div>
                    <div class="card-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <div style="height: 50px">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#exampleModalIndikator">Tambah Indikator
                            </button>
                        </div>
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
        </section>
    </div>
    <!-- Modal tambah kriteria -->
    <div class="modal fade" id="exampleModalIndikator" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="exampleModalLabel">Form Tambah Indikator</h4>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('indikator.store') }}" method="post" role="form">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="id_kriteria" class="form-label text-bold">Nama Kriteria:</label>
                            <select name="id_kriteria" id="id_kriteria" class="form-control">
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
                            <select name="nilai_i" id="nilai_i" class="form-control">
                                <option value="">Pilih nilai indikator</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
