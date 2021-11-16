@extends('layouts.admin')

@section('judul', 'Data Perjalanan Dinas')

@section('isi')

<div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Pegawai</h6>
    </div>
    @if (session('status'))
    <div class="alert alert-success">
        {{ session ('status') }}
    </div>
    @endif
        <div class="card-body">
            <a href="{{  route('letters.create') }}" class="btn btn-primary mb-3 float-right">
                + Tambah Perjalanan Dinas
            </a>
            <div class="table-responsive">
            <table class="table table-bordered table-hover scroll-horizontal-vertical" id="crudTable" width="100%" cellspacing="0" id="crudtable">
            <thead class="thead-dark text-center">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">No SPT</th>
                    <th scope="col">Tujuan</th>
                    <th scope="col">Agenda</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
        <tbody class="text-center"></tbody>
        </table>
    </div>
    </div>
</div>
    
@endsection

@push('addon-script')
    <script>
        // AJAX DataTable
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [
                    {data: 'id', name : 'id'},
                    {data: 'no_spt', name : 'no_spt'},
                    {data: 'tujuan', name : 'tujuan'},
                    {data: 'agenda', name : 'agenda'},
                    {data: 'tanggal', name : 'tanggal'},
                    {
                        data: 'aksi',
                        name : 'aksi',
                        orderable : false,
                        searchable : false,
                        width : '15%'
                    },
            ]
        });
    </script>
@endpush