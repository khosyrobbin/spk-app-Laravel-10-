@extends('template.template')
@section('content')
    <div class="main-content">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-icon">
                    <i class="fas fa-check"></i>
                </div>
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    {{ session('success') }}
                </div>
            </div>
        @endif
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
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-icon">
                    <i class="fas fa-check"></i>
                </div>
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <section class="section">
            <div class="section-header">
                <h1 class="section-title">Halaman Kriteria</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <p>Kriteria adalah standar atau patokan yang digunakan untuk mengevaluasi alternatif keputusan yang
                            ada.</p>
                    </div>
                    <div class="card-body">
                        <div style="height: 50px">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Tambah Kriteria
                            </button>
                        </div>
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
                                        <td>
                                            @if ($item->status == 1)
                                                Benefit
                                            @else
                                                Cost
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('kriteria.destroy', $item->kriteria_id) }}"
                                                method="post">
                                                <a href="{{ route('kriteria.edit', $item->kriteria_id) }}"
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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="exampleModalLabel">Form Tambah Kriteria</h4>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kriteria.store') }}" method="post" role="form">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="nama_k">Nama Kriteria:</label>
                            <input type="text" class="form-control @error('nama_k') is-invalid @enderror" id="nama_k"
                                placeholder="Tambahkan kriteria baru" name="nama_k">
                            @error('nama_k')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="bobot" class="form-label text-bold">Bobot:</label>
                            <select name="bobot" id="bobot" class="form-control @error('bobot') is-invalid @enderror">
                                <option value="">Pilih bobot kriteria</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            @error('bobot')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="status" class="form-label text-bold">Status:</label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="">Pilih status kriteria</option>
                                <option value="1">Benefit</option>
                                <option value="2">Cost</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
    </td>
@endsection
