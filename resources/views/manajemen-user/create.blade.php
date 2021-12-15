@extends('layouts.master-dashboard')

@section('title', 'Sistem Absensi Kegiatan')


@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Tambah User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6 small-9">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Manajemen user</a></li>
            <li class="breadcrumb-item active">Tambah user</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->

      <div class="row my-3">
        <div class="col-lg col-md-12">
          <div class="card card-primary small-9">
            <div class="card-header">
              <h5 class="card-title">Form Tambah User</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('manajemen.user.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="nama" id="" class="form-control" placeholder="Nama lengkap" value="{{ old('nama') }}">
                        @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" id="" class="form-control" placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="text" name="password" id="" class="form-control" placeholder="Password"  value="{{ old('password') }}">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Role</label>
                        <select name="role" id="" class="form-control">
                            <option value="">-- Pilih Role --</option>
                            @foreach ($roles as $val)
                              <option value="{{$val->name}}" {{ old('role')==$val->id ? 'selected' : null }} >{{ $val->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Universitas</label>
                        <select name="id_univ" id="" class="form-control">
                            <option value="">-- Pilih Universitas --</option>
                            @foreach ($univ as $val)
                              <option value="{{$val->id}}" {{ old('id_univ')==$val->id ? 'selected' : null }} >{{ $val->nama_univ }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Divisi</label>
                        <select name="id_divisi" id="" class="form-control">
                            <option value="">-- Pilih Divisi --</option>
                            @foreach ($divisi as $val)
                              <option value="{{$val->id}}" {{ old('id_divisi') == $val->id ? 'selected':null}} >{{ $val->nama_divisi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="">Status</label>
                      <div class="form-check">
                        <div class="row">
                          <div class="col-sm-1">
                            <input class="form-check-input" type="radio" name="status" id="aktif" value="Aktif" {{ old('status')=='Aktif' ? 'checked' : '' }}>
                            <label class="form-check-label" for="aktif">Aktif</label>
                          </div>
                          <div class="col-sm-1">
                            <input class="form-check-input" type="radio" name="status" id="non-aktif" value="Tidak aktif" {{ old('status')=='Tidak aktif' ? 'checked' : '' }}>
                            <label class="form-check-label" for="non-aktif">Tidak Aktif</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-block btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>

    </div><!-- /.container-fluid -->
</div>
@endsection

@section('styles')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('scripts')
  <!-- DataTables -->
  <script src="{{ asset('admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
    });
  </script>
@endsection