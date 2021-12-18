@extends('layouts.master-dashboard')

@section('title', 'Sistem GenBI Cirebon')


@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit Periode</h1>
        </div><!-- /.col -->
        <div class="col-sm-6 small-9">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Manajemen Periode</a></li>
            <li class="breadcrumb-item active">Edit Periode</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
      
      {{-- Alert --}}
      @if (\Session::has('message'))
          {!! \Session::get('message') !!}
      @endif

      <div class="row my-3">
        <div class="col-lg col-md-12">
          <div class="card card-primary small-9">
            <div class="card-header">
              <h5 class="card-title">Form Edit Periode</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('manajemen.periode.update', $periode->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Periode</label>
                        <input type="text" name="periode" id="" class="form-control" placeholder="Tahun Periode" {{ !empty(old('periode')) ? old('periode') : $periode->periode }}">
                        @error('periode')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <input type="text" name="status" id="" class="form-control" placeholder="0 as unActive / 1 as active" value="{{ old('status') }}">
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">Simpan</button>
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