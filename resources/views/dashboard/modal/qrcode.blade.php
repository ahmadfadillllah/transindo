<div class="modal fade" id="qrCode">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Scan Menggunakan QR Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div id="reader" width="600px"></div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript">
<script src="{{ asset('dashboard/xhtml') }}/js/html5-qrcode.min.js"></script>
<script>
        function onScanSuccess(decodedText, decodedResult) {
            console.log(`Code matched = ${decodedText}`, decodedResult);
            var dataType = "json";
            var headers = {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                };
                $.ajax({
                    type: "POST",
                    cache: true,
                    url: "{{ route('dashboard.update_qrcode') }}",
                    headers: headers,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id_tiket": decodedText,
                    },
                    success: function (data, status) {
                        console.log(data);
                        if (data.message == 'Error') {
                            Swal.fire(
                            'Upps!',
                            'Maaf tiket sudah pernah digunakan sebelumnya',
                            'warning'
                            ).then(function() {
                            window.location = "{{ route('dashboard.index') }}";
                        })
                        }else{
                            Swal.fire(
                            'Tiket valid!',
                            'Hai '+data.dataUpdate['nama_lengkap'] + ', silahkan masuk ke room',
                            'success'
                            ).then(function() {
                            window.location = "{{ route('dashboard.index') }}";
                        });
                        }

                    },dataType: dataType
                });
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            console.warn(`Code scan error = ${error}`);
        }

        setTimeout( () => {
        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
        }, 1000)

    </script>
