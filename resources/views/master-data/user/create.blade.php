@extends('layouts.master')

@section('title')
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Input Data</h3>
                        </div>
                        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama <span class="text-danger">*</span></label>
                                    <input type="input" class="form-control" id="nama" name="name"
                                        placeholder="Masukan Nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Masukan Email" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Masukan Password" required>
                                    <small>Minimal 8 karakter</small>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Password <span
                                            class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" placeholder="Masukan Password" required>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-click-animate">Simpan</button>
                                <a href="{{ route('user.index') }}" class="btn btn-warning">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
@endpush
