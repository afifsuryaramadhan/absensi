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
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Dashboard Absensi</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->

      <div class="row my-3">
		
        <div class="col-md-12">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">

                <h3 class="text-center">{{ $user->nama }}</h3>
                <p class="text-muted text-center">( {{ $role }} )</p>
                <p class="text-muted text-center"><span class="badge badge-{{ $user->status == 'Aktif' ? 'success' : 'dark' }} text-white px-3 py-1" style="font-size:14px">{{ $user->status }}</span></p>
                <table class="table table-hover">
                	<tr>
                		<td class="font-weight-bold" width="20%">Email</td>
                		<td width="1%">:</td>
                		<td>{{ $user->email }}</td>
                	</tr>
                	<tr>
                		<td class="font-weight-bold">Universitas</td>
                		<td>:</td>
                		<td>{{ $user->univ->nama_univ ?? ''}}</td>
                	</tr>
                	<tr>
                		<td class="font-weight-bold">Divisi</td>
                		<td>:</td>
                		<td>{{ $user->divisi->nama_divisi ?? ''}}</td>
                	</tr>
                	<tr>
                		<td class="font-weight-bold">Periode</td>
                		<td>:</td>
                		<td>{{ $user->periode->periode ?? ''}}</td>
                	</tr>
                </table>
                <a href="{{ route('manajemen.user.index') }}" class="btn btn-primary float-right"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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
