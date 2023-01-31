@include('auth.layout.head')
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <h4 class="text-center mb-4">Portal Pemesanan Tiket Konser</h4>
                                @include('notif.index')
                                <form action="" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Nama Lengkap</strong></label>
                                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Email</strong></label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>No. Handphone</strong></label>
                                        <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" id="pay-button" class="btn btn-primary btn-block">Bayar</button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <a class="text-primary"
                                            href="{{ route('login') }}">Login Sebagai Staf</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">

    var payButton = document.getElementById('pay-button');
payButton.addEventListener('click', function () {
    var namalengkapmu = document.querySelector("#nama_lengkap");
    var emailmu = document.querySelector("#email");
    var no_hpmu = document.querySelector("#no_hp");
    if (namalengkapmu.value == "") {
        Swal.fire(
            'Upps!',
            'Nama Lengkap tidak boleh kosong',
            'info'
        )
    } else if (emailmu.value == "") {
        Swal.fire(
            'Upps!',
            'Email tidak boleh kosong',
            'info'
        )
    } else if (no_hpmu.value == "") {
        Swal.fire(
            'Upps!',
            'No. Handphone tidak boleh kosong',
            'info'
        )
    } else {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function (result) {
                /* You may add your own implementation here */
                //   alert("payment success!"); console.log(result);

                // console.log(dataId);
                var nama_lengkap = $("#nama_lengkap").val();
                var email = $("#email").val();
                var no_hp = $("#no_hp").val();

                var data = {
                    nama_lengkap: nama_lengkap,
                    email: email,
                    no_hp: no_hp,
                };
                // console.log(data);
                var dataType = "json";
                var headers = {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                };
                $.ajax({
                    type: "POST",
                    url: '{{ route('register.post') }}',
                    data: data,
                    headers: headers,
                    success: function (data, status) {
                        var data = data;
                        console.log(data);
                        console.log(data.dataPemesanan);
                        Swal.fire({
                        title: 'ID Tiket: ' + data.dataPemesanan['id_tiket'],
                        text: 'Harap menyimpan ID tiket & qrcode tersebut sebelum halaman ini ditutup',
                        imageUrl: '{{ asset('admin/dompet.dexignlab.com/xhtml/images/qrcode') }}/' + data.dataPemesanan['qrcode'],
                        imageWidth: 200,
                        imageHeight: 200,
                        imageAlt: 'QR Code',
                        confirmButtonText: 'Ya, saya sudah catat',
                        }).then(function() {
                            window.location = "{{ route('home.index') }}";
                        });
                    },
                    dataType: dataType
                });

            },
            onPending: function (result) {
                Swal.fire(
                    'Upps!',
                    'Pembayaran dipending',
                    'info'
                )
            },
            onError: function (result) {
                /* You may add your own implementation here */
                //   alert("payment failed!"); console.log(result);
                Swal.fire(
                    'Gagal',
                    'Pembayaran gagal',
                    'warning'
                )
            },
            onClose: function () {
                Swal.fire(
                    'Upps!',
                    'Pembayaran ditutup',
                    'info'
                )
            }
        })
    }

});
</script>
@include('auth.layout.footer')
