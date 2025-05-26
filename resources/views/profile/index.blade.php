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
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('plugin/AdminLte/dist/img/user4-128x128.jpg') }}"
                                    alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $user->name ?? '' }}</h3>

                            <p class="text-muted text-center">{{ $user->email ?? '' }}</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Profile</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Change
                                        Password</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                @include('profile.partials.update-profile')
                                @include('profile.partials.update-password')
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
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
