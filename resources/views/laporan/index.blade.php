@include('dashboard.layout.head')
@include('dashboard.layout.header')
@include('dashboard.layout.sidebar')
<div class="content-body">
    <div class="container-fluid">
        @include('notif.index')
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Daftar Pemesan Tiket</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Email</th>
                                        <th>No. Handphone</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tiket as $t)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $t->nama_lengkap }}</td>
                                        <td>{{ $t->email }}</td>
                                        <td>{{ $t->no_hp }}</td>
                                        <td>@if ($t->status == 'Belum Terpakai')
                                            <span class="badge badge-xs light badge-primary">{{ $t->status }}</span>
                                        @else
                                            <span class="badge badge-xs light badge-info">{{ $t->status }}</span>
                                        @endif</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target="#editTiket{{ $t->id }}"><i class="fas fa-pencil-alt"></i></a>
                                                @include('laporan.modal.edit')
                                                <a href="#" class="btn btn-danger shadow btn-xs sharp"  data-bs-toggle="modal" data-bs-target="#destroyTiket{{ $t->id }}"><i class="fa fa-trash"></i></a>
                                                @include('laporan.modal.destroy')
                                            </div>
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
@include('dashboard.layout.footer')
