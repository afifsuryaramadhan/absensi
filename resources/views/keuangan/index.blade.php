@extends('layouts.master-dashboard')

@section('title', 'Keuangan')

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
            <li class="breadcrumb-item active">Dashboard Keuangan</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Keuangan</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover datatables-responsive">
                            <thead>
                                <th>
                                    
                                </th>
                                <th>
                                    Tanggal
                                </th>
                                <th>
                                    Keterangan
                                </th>
                                <th>
                                    Jumlah
                                </th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="{{ route('manajemen.keuangan.create') }}" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>

                                    </td>
                                    <td>
                                        01/01/2020
                                    </td>
                                    <td>
                                        kas masuk
                                    </td>
                                    <td>
                                        20.000
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
