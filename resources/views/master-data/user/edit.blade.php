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
                            <h3 class="card-title">Edit Data</h3>
                        </div>
                        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama <span class="text-danger">*</span></label>
                                    <input type="input" class="form-control" id="nama" name="name"
                                        value="{{ $user->name ?? '' }}" placeholder="Masukan Nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $user->email ?? '' }}" placeholder="Masukan Email" required>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-click-animate">Simpan</button>
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
