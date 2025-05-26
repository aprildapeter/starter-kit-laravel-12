@extends('layouts.master')

@section('title')
    <h1>Data User</h1>
@endsection

@push('css')
    <style>
        table.dataTable {
            width: 100% !important;
        }

        table.dataTable th {
            white-space: nowrap;
            /* Prevent header text from wrapping */
            text-align: center;
            /* Align header text to the center */
            vertical-align: middle;
            /* Vertically center header text */
        }
    </style>
@endpush

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">User</li>
    </ol>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('user.create') }}" class="btn btn-primary">Buat User</a>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="table" class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        table = $('#table').DataTable({
            processing: true,
            paging: true,
            autoWidth: false,
            serverSide: true,
            responsive: true,
            ajax: {
                url: '{{ route('user.data') }}',
            },
            columnDefs: [{
                targets: '_all', // Terapkan untuk semua kolom
                createdCell: function(td, cellData, rowData, row, col) {
                    $(td).css({
                        'white-space': 'nowrap', // Menghindari teks membungkus
                        'text-align': 'center', // Menyejajarkan teks ke tengah
                        'vertical-align': 'middle', // Menyejajarkan teks secara vertikal
                    });
                }
            }],
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'name',
                },
                {
                    data: 'email',
                },
                {
                    data: 'status',
                },
                {
                    data: 'aksi',
                    searchable: false,
                    sortable: false
                },
            ],
        })

        function nonAktifUser(url) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data User Akan Dinonaktifkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Non Aktif!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memproses...',
                        text: 'Silakan tunggu',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: url,
                        type: 'PATCH', // Menggunakan PATCH untuk update status
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            'status': 0,
                        },
                        success: (response) => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil dinonaktifkan.',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            });
                            table.ajax.reload();
                        },
                        error: (errors) => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Tidak dapat menonaktifkan data.',
                                confirmButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }
            });
        }

        function aktifUser(url) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data User Akan Diaktifkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Aktifkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memproses...',
                        text: 'Silakan tunggu',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: url,
                        type: 'PATCH', // Menggunakan PATCH untuk update status
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            'status': 1,
                        },
                        success: (response) => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil diaktifkan.',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            });
                            table.ajax.reload();
                        },
                        error: (errors) => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Tidak dapat mengaktifkan data.',
                                confirmButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }
            });
        }

        function resetPassword(url) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data User Akan Reset Password!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Reset Password!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memproses...',
                        text: 'Silakan tunggu',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: url,
                        type: 'PATCH', // Menggunakan PATCH untuk update status
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: (response) => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil reset password.',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            });
                            table.ajax.reload();
                        },
                        error: (errors) => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Tidak dapat reset password.',
                                confirmButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }
            });
        }

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        @endif
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
@endpush
