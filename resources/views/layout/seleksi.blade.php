@extends('template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1 class="section-title">Halaman Seleksi</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Example Cardd</h4>
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
                                data-bs-target="#exampleModalSeleksi">Tambah Data Seleksi
                            </button>
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">Nama Beasiswa</th>
                                    <th scope="col">Kriteria</th>
                                    <th scope="col">Indikator</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class=" table-hover">
                                @foreach ($seleksi as $item)
                                    <tr>
                                        <td>{{ $item->nama_b }}</td>
                                        <td>{{ $item->beasiswa_id }}</td>
                                        {{-- <td>{{ implode(', ', $item->kriteria->pluck('nama_k')->toArray()) }}</td> --}}
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            {{-- <form action="{{ route('beasiswa.destroy', $item->beasiswa_id) }}"
                                                method="post">
                                                <a href="{{ route('beasiswa.edit', $item->beasiswa_id) }}"
                                                    class="btn btn-warning">edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">delete</button>
                                            </form> --}}
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
    <div class="modal fade" id="exampleModalSeleksi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="exampleModalLabel">Form Tambah Seleksi</h4>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('seleksi.store') }}" method="post" role="form">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="nama_k">Nama Siswa:</label>
                            <input type="text" class="form-control" id="nama_siswa" placeholder="Tambahkan siswa baru"
                                name="nama_siswa">
                        </div>
                        @foreach ($kriteria_s as $data)
                            <div class="mb-3 mt-3">
                                <label for="">{{ $data->nama_k }}</label>
                                @foreach ($indikator_s as $item)
                                    @if ($item->kriteria_id == $data->kriteria_id)
                                        <p>{{ $item->nama_i }}</p>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach

                        {{-- <div class="mb-3 mt-3">
                            <label class="form-label text-bold">Indikator:</label>
                            @foreach ($kriteria as $data => $kriteria_id)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="kriteria_id[]" value="{{ $data }}">
                                <label class="form-check-label">
                                    {{ $kriteria_id }}
                                </label>
                            </div>
                            @endforeach
                        </div> --}}
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
