@extends('layouts.admin')

@section('title')
    Batch
@endsection

@section('container')
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-xl px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="box"></i></div>
                                Batch Record

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
                            List Batch Record
                            <a class="btn btn-sm btn-primary" href="{{ route('batch.create') }}">
                                Tambah Batch
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
                            <table class="table table-striped table-hover table-sm" id="dataTable">
                                <thead>
                                    <tr class="align-middle">
                                        <th width="10">No.</th>
                                        <th>No. Batch</th>
                                        <th>Tanggal</th>
                                        <th>Produk</th>
                                        <th>Pengirim</th>
                                        <th>Pengedit terakhir</th>
                                        <th>Status terakhir</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($batch as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->bets_no }}</td>
                                            <td>{{ $item->bets_date }}</td>
                                            <td>{{ $item->department->name }}</td>
                                            <td>{{ $item->sender->name }}</td>
                                            <td>{{ $item->tracking->first()->user->name }}</td>
                                            <td>{{ $item->tracking->first()->status }}</td>
                                            <td>
                                                <a href="{{ route('batch.show', $item->id) }}"
                                                    class="btn btn-success btn-xs">
                                                    <i class="fas fa-search-plus"></i> &nbsp; Detail
                                                </a>
                                                <a href="{{ route('batch.edit', $item->id) }}"
                                                    class="btn btn-primary btn-xs">
                                                    <i class="fas fa-edit"></i> &nbsp; Ubah
                                                </a>
                                                <a href="{{ route('batch.destroy', $item->id) }}" id="delete"
                                                    class="btn btn-danger btn-xs">
                                                    <i class="far fa-trash-alt"></i> &nbsp;
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

        {{-- Edit Modal --}}
        <div class="modal fade" id="updateModal" role="dialog" aria-labelledby="createModal" aria-hidden="true"
            style="overflow:hidden;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModal">Tambah Data Produk</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" id="updateForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="idEdit">
                        <div class="modal-body">
                            <div class="mb-3 row">
                                <label for="department_id" class="col-sm-3 col-form-label">Produk</label>
                                <div class="col-sm-9">
                                    <select name="department_id" class="form-control selectx" id="department_id" required>
                                        <option value="">Pilih..</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}"
                                                {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                                {{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('department_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3 row">
                                <label for="letter_no" class="col-sm-3 col-form-label">Kode</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('kode') is-invalid @enderror"
                                        value="{{ old('kode') }}" id="editKode" name="kode"
                                        placeholder="Kode Dokumen.." required>
                                </div>
                                @error('kode')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="letter_no" class="col-sm-3 col-form-label">No. Bets</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('bets_no') is-invalid @enderror"
                                        value="{{ old('bets_no') }}" id="editBetsNo" name="bets_no"
                                        placeholder="No. Bets.." required>
                                </div>
                                @error('bets_no')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="letter_date" class="col-sm-3 col-form-label">Tanggal PO</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control @error('bets_date') is-invalid @enderror"
                                        value="{{ old('bets_date') }}" id="editBatesDate" name="bets_date" required>
                                </div>
                                @error('bets_Date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="bets_received" class="col-sm-3 col-form-label">Tanggal Upload</label>
                                <div class="col-sm-9">
                                    <input type="date"
                                        class="form-control @error('bets_received') is-invalid @enderror"
                                        value="{{ old('bets_received') }}" id="editBetsR" name="bets_received" required>
                                </div>
                                @error('bets_received')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3 row">
                                <label for="letter_file" class="col-sm-3 col-form-label">File</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control @error('bets_file') is-invalid @enderror"
                                        value="{{ old('bets_file') }}" name="bets_file"
                                        accept="application/pdf,application/vnd.ms-excel" required>
                                    <div id="letter_file" class="form-text">Ekstensi .pdf</div>
                                </div>
                                @error('bets_file')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-primary" type="submit" id="updateBtn">Simpan</button>
                        </div>
                    </form>
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
        var datatable = $('#dataTable').DataTable({});


        $(document).ready(function() {


           $('#delete').click(function(e) {
                e.preventDefault();
                var urlToRedirect = e.currentTarget.getAttribute('href');
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



            $('#edit-batch').click(function(e) {
                var id = $(this).attr("data-id");

                console.log(id);
                $.ajax({
                    url: "batch-record/edit/" + id,
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        $('#idEdit').val(data.item.id);
                        $('#editBetsNo').val(data.item.bets_no);
                        $('#editBatesDate').val(data.item.bets_date);
                        $('#editBetsR').val(data.item.bets_received);
                        $('#department_id').on('change', function() {
                            var department_id = this.value;
                            $.ajax({
                                url: "{{ url('admin/get-produk-kode') }}/" +
                                    department_id,
                                type: "post",
                                data: {
                                    id: department_id,
                                    _token: '{{ csrf_token() }}'
                                },
                                dataType: 'json',
                                success: function(result) {
                                    $('#editKode').val(result.departmen[0]
                                        .kode)
                                }
                            });
                        });

                    }
                });
            });

            $('#updateForm').submit(function(e) {
                e.preventDefault();

                // Mengambil data dari form
                var formData = new FormData(this);

                var id = $('#idEdit').val()

                // Mengirim data melalui AJAX request
                $.ajax({
                    url: "{{ url('admin/batch-record/update/') }}/" + id,
                    type: "POST",
                    data: formData,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Meng-handle respons sukses
                        console.log(response);
                        // Menutup modal
                        $('#updateModal').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        // Meng-handle respons error
                        console.log(xhr.responseText);
                    }
                });
            });

        });
    </script>
@endpush
