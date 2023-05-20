@extends('template.template')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <?php $b = App\Models\Beasiswa::find($beasiswa->beasiswa_id); ?>
                <h1 class="section-title">Halaman Beasiswa {{ $b->nama_b }}</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Silahkan inputkan data siswa yang mengikuti beasiswa {{ $b->nama_b }}</h4>
                    </div>
                    <div class="card-body">
                        <p></p>
                        <div style="height: 50px">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#exampleModalSiswa">Tambah Siswa
                            </button>
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">NISN</th>
                                    <th scope="col">Nama Siswa</th>
                                    {{-- <th scope="col">Kriteria</th> --}}
                                    <th></th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class=" table-hover">
                                @foreach ($seleksi as $item)
                                    @if ($item->beasiswa_id == $b->beasiswa_id)
                                        <tr>
                                            <td>{{ $item->NISN }}</td>
                                            <td>{{ $item->nama_siswa }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>
                                                {{-- <button class="btn btn-warning btn-detail open_modal"
                                                    value="{{ $item->seleksi_id }}">detail</button> --}}

                                                <form action="{{ route('seleksi.destroy', $item->seleksi_id) }}"
                                                    method="post">
                                                    {{-- <a href="{{ route('beasiswa.edit', $item->seleksi_id) }}"
                                                        class="btn btn-warning">edit</a> --}}
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger">delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Modal tambah kriteria -->
    <div class="modal fade" id="exampleModalSiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="exampleModalLabel">Form Tambah Seleksi</h4>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('seleksi.store') }}" method="post" role="form">
                        @csrf
                        <input type="hidden" name="beasiswa_id" value="{{ $b->beasiswa_id }}">
                        <div class="mb-3 mt-3">
                            <label for="NISN" class="form-label text-bold">NISN:</label>
                            <input type="text" class="form-control" id="NISN" placeholder="Tambahkan NISN"
                                name="NISN">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="nama_siswa" class="form-label text-bold">Nama Siswa:</label>
                            <input type="text" class="form-control" id="nama_siswa" placeholder="Tambahkan siswa baru"
                                name="nama_siswa">
                        </div>
                        @foreach ($beasiswa->kriteria as $data)
                            <div class="mb-3 mt-3">
                                <label for="" class="form-label text-bold">{{ $data->nama_k }}</label>
                                <select name="indikator_id[]" class="form-control">
                                    <option value="">Pilih indikator yang sesuai</option>
                                    @foreach ($indikator_s as $item)
                                        @if ($item->kriteria_id == $data->kriteria_id)
                                            <option value="{{ $item->indikator_id }}">{{ $item->nama_i }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <input type="text" name="bobot[]" value="{{$data->bobot}}">
                                {{-- <input type="text" name="status" value="{{$data->status}}"> --}}
                            </div>
                        @endforeach
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- ajax --}}
@endsection
