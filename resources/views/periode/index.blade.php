@extends('layouts.master-dashboard')

@section('title', 'Manajemen Periode')

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

      {{-- Alert --}}
      @if (\Session::has('message'))
          {!! \Session::get('message') !!}
      @endif

<div class="row my-3">
  <div class="col-lg col-md-12">
    <div class="card small-9">
      <div class="card-header">
       <h5 class="card-title">Manajemen Periode Komunitas</h5>
     </div>
      <div class="card-body">

      @can('periode-create')
      <div class="row my-3">
        <div class="col-md-12">
          <a href="{{ route('manajemen.periode.create') }}" class="btn btn-sm btn-primary text-white"><i class="fas fa-plus"></i> Tambah</a>
        </div>
      </div>
      @endcan
              <div class="row my-3">
                <div class="col-lg col-md-12">
                  <div class="card small-9">
                    <div class="card-header">
                      <h5 class="card-title">Periode</h5>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg col-md-12">
                          <table id="example1" class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>Action</th>
                                <th>Periode</th>
                                <th>Status</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($periode as $periodes)
                                <tr class="align-middle">
                                <td class="text-center col-2">
                                  @can('periode-delete')
                                  <a href="{{ route('manajemen.periode.delete', $periodes->id) }}" data-method='delete' data-confirm='Apakah anda yakin ingin menghapus periode {{$periodes->nama_periode }}?' class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                  @endcan
                                  
                                  @can('periode-edit')
                                  <a href="{{ route('manajemen.periode.edit', $periodes->id) }}" class="btn btn-sm btn-default"><i class="fas fa-edit"></i></a>
                                </td>
                                @endcan
                                
                                  <td class="align-middle">{{ $periodes->periode }}</td>
                                  <td class="align-middle">
                                  <input data-id="{{$periodes->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $periodes->status ? 'checked' : '' }}>
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
            </div>
          </div>
        </div>
      </div>

    </div><!-- /.container-fluid -->
</div>
@endsection

@section('scripts')
  <script>
      $(function(){
          $('.toggle-class').change(function() {
              var status = $(this).prop('checked') == true ? 1 : 0;
              var id = $(this).data('id');

              $.ajax({
                  type: "GET",
                  dataType : "json",
                  url: "{{ route('manajemen.periode.changeStatus') }}",
                  data: {'status': status, 'id': id},
                  success: function(data){
                      console.log(data.success);
                  }
              });
          });
      })
  </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  /> --}}
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

  <script src="{{ asset('js/ujs.min.js') }}"></script>
  <script src="{{ asset('admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script>
@endsection