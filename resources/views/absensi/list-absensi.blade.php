@extends('layouts.master-dashboard')

@section('title', 'Sistem Absensi Kegiatan')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6 small-9">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Absensi</a></li>
            <li class="breadcrumb-item active">index</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->

      <div class="row my-3">
        <div class="col-lg col-md-12">
          <div class="card small-9">
            <div class="card-header">
              <h5 class="card-title">Data Absensi</h5>
            </div>
            <div class="card-body">
              <div class="row my-3">
                <div class="col-md-12">
                  <a href="{{ route('manajemen.absensi.eksport') }}" class="btn btn-success text-white">Export PDF</a>
                </div>
              </div>
              <div class="row">
                <div class="col-lg col-md-12">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Konfirmasi</th>
                        <th>Nama</th>
                        <th>Kegiatan</th>
                        <th>Tanggal Absen</th>
                        <th>Foto</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($absensi as $val)
                        <tr>
                          <td class="align-middle" width="100px">
                            @if($val->is_confirmed)
                              <button class="btn btn-sm btn-secondary">Terkonfirmasi</button>
                            @else
                              <a href="{{ route('manajemen.absensi.approve',$val->id) }}" data-method='patch' class="btn btn-sm btn-success">Konfirmasi</a>
                            @endif
                          </td>
                          <td class="align-middle">{{ $val->user->nama }}</td>
                          <td class="align-middle">{{ $val->kegiatan->nama_kegiatan }}</td>
                          <td class="align-middle">{{ date('d F Y | H:i', strtotime($val->created_at)) }}</td>
                          <td class="align-middle">
                            {{-- get images from cloudinary --}}
                            {{-- get url images from cloudinary --}}
                            <a href="{{ $val->foto }}">
                            <img src="{{ $val->foto }}" alt="{{ $val->user->nama }}" width="100px">
                            </a>

                            {{-- get images from Min.IO --}}
                            {{-- <a href="{{ Storage::cloud('minio')->url($val->foto) }}">
                              <img src="{{ Storage::cloud('minio')->url($val->foto) }}" alt='foto-absensi' height="100px" width="100px">
                            </a> --}}
                            {{-- <a href="{{ Storage::url($val->foto) }}">
                              <img src="{{ Storage::url($val->foto) }}" alt='foto-absensi' height="50px">
                            </a> --}}
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

    </div><!-- /.container-fluid -->
</div>
@endsection

@section('styles')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('scripts')
  <script src="{{ asset('js/ujs.min.js') }}"></script>
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