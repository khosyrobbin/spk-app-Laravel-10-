@extends('template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1 class="section-title">Halaman Beasiswa</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <p>Halaman ini merupakan halaman untuk mengelola beasiswa</p>
                    </div>
                    <div class="card-body">
                        <div style="height: 50px">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#exampleModalBeasiswa">Tambah Beasiswa
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @foreach ($beasiswa as $item)
        <div class="row">
            <div class="col-12">
                <article class="article article-style-b">
                    <div class="article-details">
                        <div class="article-title">
                            <h4><strong>Beasiswa {{ $item->nama_b }}</strong></h4>
                        </div>
                        <p>Kriteria: {{ implode(', ', $item->kriteria->pluck('nama_k')->toArray()) }}</p>
                        {{-- <p>{{$item->kriteria->pluck('nama_k')}}</p> --}}
                        <div class="article-cta">
                            <form action="{{ route('beasiswa.destroy', $item->beasiswa_id) }}"
                                method="post">
                                <a href="{{ route('topsis', $item->beasiswa_id) }}" class="btn btn-success">Lihat Hasil</a>
                                <a href="{{ route('beasiswa.show', $item->beasiswa_id) }}"
                                    class="btn btn-info">Kelola Beasiswa</a>
                                <a href="{{ route('beasiswa.edit', $item->beasiswa_id) }}"
                                    class="btn btn-warning">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Delete</button>
                            </form>
                            {{-- <a href="#">Read More <i class="fas fa-chevron-right"></i></a> --}}
                        </div>
                    </div>
                </article>
            </div>
        </div>
    @endforeach

    <!-- Modal tambah kriteria -->
    <div class="modal fade" id="exampleModalBeasiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="exampleModalLabel">Form Tambah Beasiswa</h4>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('beasiswa.store') }}" method="post" role="form">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="nama_k">Nama Beasiswa:</label>
                            <input type="text" class="form-control" id="nama_b" placeholder="Tambahkan beasiswa baru"
                                name="nama_b">
                        </div>
                        <div class="mb-3 mt-3">
                            <label class="form-label text-bold">Indikator:</label>
                            @foreach ($kriteria as $data => $kriteria_id)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="kriteria_id[]"
                                        value="{{ $data }}">
                                    <label class="form-check-label">
                                        {{ $kriteria_id }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        {{-- test kriteria --}}
                        {{-- <div class="mb-3 mt-3">
                            <label class="form-label text-bold">Kriteria:</label>
                            @foreach ($kriteria as $data => $nama_k)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="indikator_id[]" value="{{ $data }}">
                                <label class="form-check-label">
                                    {{ $nama_k }}
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
