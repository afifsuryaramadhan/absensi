@extends('layouts.master-dashboard')

@section('title', 'Sistem Absensi Kegiatan')


@section('content')
  <div class="card m-lg-4">
    <div class="card-header">
      <h3 class="card-title">Selamat Datang</h3>
      <div class="card-tools">
        <!-- Buttons, labels, and many other things can be placed here! -->
        <!-- Here is a label for example -->
        <span class="badge badge-primary">Dashboard Page</span>
      </div><!-- /.card-tools -->
    </div><!-- /.card-header -->
   
    <div class="card-body">
      Anda login sebagai <p class="badge badge-info">{{ Auth::user()->nama }}</p>
    </div><!-- /.card-body -->

    <div class="card-footer">
      Periode kamu saat ini adalah <p class="badge badge-info">{{ Auth::user()->periode->periode }}</p>
      dan statusnya adalah <span class="badge badge-{{ Auth::user()->periode->status == '1' ? 'success' : 'dark' }} text-white px-3 py-1">{{ Auth::user()->periode->status == '1' ? 'Aktif' : 'Tidak Aktif' }}</span>
    </div><!-- /.card-footer -->
  
</div><!-- /.card -->
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