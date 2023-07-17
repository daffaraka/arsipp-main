@extends('layouts.admin')

@section('title')
    Detail Batch
@endsection

@section('container')
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-fluid px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="file-text"></i></div>
                                Detail Batch
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            <button class="btn btn-sm btn-light text-primary" onclick="javascript:window.history.back();">
                                <i class="me-1" data-feather="arrow-left"></i>
                                Kembali Ke Semua Batch
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-fluid px-4">
            <div class="row gx-4">
                <div class="col-lg-7">
                    <div class="card mb-4">
                        <div class="card-header">Detail Batch</div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Nomor Bets</th>
                                            <td>{{ $item->bets_no }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Arsip</th>
                                            <td>{{ $item->bets_date }}</td>
                                        </tr>
                                        <tr>
                                            <th>Pengirim Arsip</th>
                                            <td>{{ $item->sender->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Produk</th>
                                            <td>{{ $item->department->name }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card mb-5">
                    <div class="card">

                            <div class="card-header">Perbarui Status Tracking</div>
                            <form action="{{ route('tracking.store') }}" method="POST"enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                <div class="mb-3">
                                    <label for="">Pilih status</label>
                                    <input type="hidden" name="batch_id" value="{{ $item->id }}">
                                    <select name="status" id="" class="form-control ">
                                        <option value="">Perbarui status</option>


                                        @can('Penimbangan')
                                            <option value="penimbangan">Penimbangan</option>
                                        @endcan
                                        @can('Pengolahan')
                                            <option value="pengolahan">Pengolahan</option>
                                        @endcan
                                        @can('Rekonsiliasi')
                                            <option value="rekonsiliasi">Penerimaan dan
                                                rekonsiliasi bahan pengemas</option>
                                        @endcan
                                        @can('Container')
                                            <option value="container">Pembukaan container</option>
                                        @endcan
                                        @can('Pengisian')
                                            <option value="pengisian    ">Pengisian</option>
                                        @endcan
                                        @can('Pengemasan')
                                            <option value="pengemasan">Pengemasan</option>
                                        @endcan
                                        @can('Admin')
                                            <option value="selesai">Selesai</option>
                                        @endcan
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="">Keterangan</label>
                                    <input type="text" name="keterangan" id="" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="">Upload Foto Bukti</label>
                                    <input type="file" name="foto" id="" class="form-control" capture="camera"  >
                                </div>
                                <button class="btn btn-success btn-md pb-2 mt-3">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                </div>


                <div class="col-md-12">
                    <div class="card">

                            <div class="card-header">Detail Tracking </div>

                            <div class="card-body">
                            <div class="row">
                                <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                      <tr class ="align-middle">
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                        <th>Nama Pengguna</th>
                                        <th>Tanggal</th>
                                        <th>Foto</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($item->tracking as $array => $tracking)
                                      <tr>
                                        <td>
                                          <span class="badge bg-{{ $array == 0 ? 'success' : 'white text-dark' }}">{{ $tracking->status }}</span>
                                        </td>
                                        <td>{{ $tracking->keterangan }}</td>
                                        <td>{{ $tracking->user->name }}</td>
                                        <td>{{ Carbon\Carbon::parse($tracking->created_at)->isoFormat('ll LT') }}</td>
                                        <td>
                                            @if ($tracking->foto)
                                            <img src="{{ Storage::url($tracking->foto) }}" alt="Foto Bukti" width="100">
                                        @else
                                            Tidak ada foto
                                        @endif
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
        </div>
    </main>
@endsection
