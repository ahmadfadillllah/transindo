@include('dashboard.layout.head')
@include('dashboard.layout.header')
@include('dashboard.layout.sidebar')
<div class="content-body">
    <div class="container-fluid">
        @include('notif.index')
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">ID Tiket</h4>
                        <button type="button" class="btn btn-rounded btn-success" data-bs-toggle="modal" data-bs-target="#qrCode"><span
                            class="btn-icon-start text-success"><i class="fa fa-upload color-success"></i>
                        </span>Masuk Menggunakan QR Code</button>
                        @include('dashboard.modal.qrcode')
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('dashboard.update_idtiket') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input class="form-control form-control-lg" type="text" name="id_tiket" placeholder="Masukkan ID Tiket" required>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn  btn-square btn-primary">Submit</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@include('dashboard.layout.footer')
