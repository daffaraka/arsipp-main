@extends('layouts.admin')

@section('title')
    Produk Masuk
@endsection

@section('container')
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-xl px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="mail"></i></div>
                                Arsip
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main page content-->
        <div class="container-xl px-4 mt-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-header-actions mb-4">
                        <div class="card-header">
                            List Arsip
                            <a class="btn btn-sm btn-primary" href="{{ route('letter.create') }}">
                                Tambah Arsip
                            </a>
                        </div>
                        <div class="card-body">
                            {{-- Alert --}}
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button class="btn-close" type="button" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button class="btn-close" type="button" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            {{-- List Data --}}
                            <div class="table-responsive">
                            <table class="table table-striped table-hover table-sm table-responsive" id="crudTable">
                                <thead>
                                    <tr class = "align-middle">
                                        <th width="10">No.</th>
                                        <th>No. Bets</th>
                                        <th>Tanggal</th>
                                        <th>Produk</th>
                                        <th>Kode Dokumen</th>
                                        <th>Kode Bahan</th>
                                        <th>Kode Jadi</th>
                                        <th>Pengirim</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->bets_no }}</td>
                                        <td>{{ $item->bets_date }}</td>
                                        <td>{{ $item->department->name }}</td>
                                        <td>{{ $item->department->kode_dokumen }}</td>
                                        <td>{{ $item->department->kode_bahan }}</td>
                                        <td>{{ $item->department->kode_jadi }}</td>
                                        <td>{{ $item->sender->name }}</td>
                                        <td>
                                            <a class="btn btn-success btn-xs"
                                                href="{{route('detail-surat', $item->id)}}">
                                                <i class="fas fa-search-plus"></i> &nbsp; Detail
                                            </a>
                                            <a class="btn btn-primary btn-xs"
                                                href="{{route('letter.edit', $item->id) }}">
                                                <i class="fas fa-edit"></i> &nbsp; Ubah
                                            </a>
                                            <a href="{{route('letter.delete', $item->id) }}" id="delete"
                                                class="btn btn-danger btn-xs"> <i class="far fa-trash-alt"></i> &nbsp;
                                                Hapus</a>

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
        </div>
    </main>
@endsection

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            function setTableHeight() {
                var windowHeight = window.innerHeight;
                var headerHeight = document.querySelector('.page-header').offsetHeight;
                var tableHeight = windowHeight - headerHeight - 20; // Adjust the height accordingly

                var tableWrapper = document.querySelector('.table-responsive');
                tableWrapper.style.maxHeight = tableHeight + 'px';
            }

            setTableHeight();

            window.addEventListener('resize', function() {
                setTableHeight();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#crudTable').DataTable({});

            $('#delete').click(function(e) {
                e.preventDefault();
                var urlToRedirect = e.currentTarget.getAttribute('href')
                Swal.fire({
                    title: 'Delete?',
                    text: "Apakah anda yakin akan menghapus data ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = urlToRedirect;
                        Swal.fire(
                            'Sukses menghapus data!',
                            'Data telah dihapus',
                            'success'
                        )

                    }
                })

            });

        });
    </script>
@endpush
