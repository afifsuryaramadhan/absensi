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
            <li class="breadcrumb-item active">Dashboard User</li>
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
              <h5 class="card-title">Data User</h5>
            </div>
            <div class="card-body">
              <div class="">
                <div class="col-md-12">
                  <a href="{{ route('manajemen.user.create') }}" class="btn btn-sm btn-primary text-white"><i class="fas fa-plus"></i> Tambah</a>
                  <!-- Import Excel --> 
                  <button type="button" class="btn btn-sm btn-success text-white" data-toggle="modal" data-target="#modal-default"><i class="fa fa fa-file-upload"></i> Import
                  </button>
                    <!-- Modal dialog -->
                  <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Import Data</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="{{ route('manajemen.user.import') }}" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="modal-body">
                            <div class="form-group">
                              <div>
                                <h6 class="font-weight-bold">Upload Data Anggota</h4>
                              </div>
                              <div>
                                <input type="file" name="import_file" required />
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-block btn-success">Import</button>
                            {{-- download excel button --}}
                            <a href="#" class="btn btn-block btn-info"><i class="fa fa-file-download"></i> Download Template</a>
                          </div>
                        </form>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
                </div>
              <div class="row mt-md-3">
                <div class="col-lg col-md-12">
                  <table id="example1" class="table table-bordered table-hover datatables-responsive">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Nama</th>
                        <th>Universitas</th>
                        <th>Role</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="align-middle">
                                <td class="text-center col-2">
                                  <a href="{{ route('manajemen.user.delete', $user->id) }}" data-method='delete' data-confirm='Apakah anda yakin ingin menghapus {{$user->nama}}?' class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                  <a href="{{ route('manajemen.user.edit', $user->id) }}" class="btn btn-sm btn-default"><i class="fas fa-edit"></i></a>
                                  <a href="{{ route('manajemen.user.show', $user->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                </td>
                                <td class="align-middle">{{ $user->nama }}</td>
                                <td class="align-middle">{{ isset($user->univ) ? $user->univ->nama_univ : 'Admin' }}</td>
                                <td class="align-middle">{{ ucwords($user->getRoleNames()->first()) }}</td>
                                <td class="align-middle "><span class="badge badge-{{ $user->periode->status == '1' ? 'success' : 'dark' }} text-white px-3 py-1">{{ $user->periode->status == '1' ? 'Aktif' : 'Tidak Aktif' }}</span></td>
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