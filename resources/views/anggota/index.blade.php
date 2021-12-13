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
            <li class="breadcrumb-item"><a href="#">Anggota</a></li>
            <li class="breadcrumb-item active">index</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->

      {{-- Alert --}}
      @if (\Session::has('message'))
          {!! \Session::get('message') !!}
      @endif

      <div class="row my-3">
        <div class="col-lg col-md-12">
          <div class="card small-9">
            <div class="card-header">
              <h5 class="card-title">Data Anggota Komunitas</h5>
            </div>
            <div class="card-body">

              @can('anggota-create')
              <div class="row my-3">
                <div class="col-md-12">
                  <a href="{{ route('manajemen.anggota.create') }}" class="btn btn-sm btn-primary text-white"><i class="fas fa-plus"></i> Tambah</a>
                </div>
              </div>
              @endcan
              
              <div class="row">
                <div class="col-lg col-md-12">
                  <table id="example1" class="table table-bordered table-hover datatables-responsive">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Nama</th>
                        <th>Universitas</th>
                        <th>Tahun Ajar</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="align-middle">
                                @can('anggota-edit')
                                <td class="text-center col-2">
                                  <a href="{{ route('manajemen.anggota.delete', $user->id) }}" data-method='delete' data-confirm='Apakah anda yakin ingin menghapus {{$user->nama}}?' class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                  <a href="{{ route('manajemen.anggota.edit', $user->id) }}" class="btn btn-sm btn-default"><i class="fas fa-edit"></i></a>
                                  <a href="{{ route('manajemen.anggota.show', $user->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                </td>
                                @endcan
                                @can('ganti-ketua')
                                  <td>
                                    <a href="{{ route('manajemen.ketua.angkat-ketua', $user->id) }}" data-method='patch' class="btn btn-sm btn-success">Jadikan ketua</a>
                                  </td>
                                @endcan
                                <td class="align-middle">{{ $user->nama }}</td>
                                <td class="align-middle">{{ isset($user->univ) ? $user->univ->nama_univ : '-' }}</td>
                                <td class="align-middle">{{ $user->tahun_ajar}}</td>
                                <td class="align-middle "><span class="badge badge-{{ $user->status == 'Aktif' ? 'success' : 'dark' }} text-white px-3 py-1">{{ $user->status }}</span></td>
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