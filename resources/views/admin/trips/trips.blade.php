@extends('layouts.admin')

@section('judul', 'Perjalanan Dinas')

@section('isi')

<div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Perjalanan Dinas</h6>
    </div>
    @if (session('status'))
    <div class="alert alert-success">
        {{ session ('status') }}
    </div>
    @endif

        <div class="card-body">
            <a href="{{  route('trips.create') }}" class="btn btn-primary mb-3 float-right">
                + Perjalanan Dinas
            </a>
            <div class="table-responsive">
            <table class="table table-bordered table-hover scroll-horizontal-vertical" id="crudTable" width="100%" cellspacing="0" id="crudtable">
            <thead class="thead-dark text-center">
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Agenda</th>
                    <th scope="col">Tanggal Mulai</th>
                    <th scope="col">Tanggal Selesai</th>
                    <th scope="col">Tujuan</th>
                    <th scope="col">Durasi</th>
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
                    {data: 'employe.nama', name : 'employe.nama'},
                    {data: 'letter.agenda', name : 'letter.agenda'},
                    {data: 'letter.tanggal', name : 'letter.tanggal'},
                    {data: 'letter.tanggal_sls', name : 'letter.tanggal_sls'},
                    {data: 'letter.tujuan', name : 'letter.tujuan'},
                    {data: 'letter.durasi', name : 'letter.durasi'},
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