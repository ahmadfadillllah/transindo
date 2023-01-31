<div class="modal fade" id="editTiket{{ $t->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <form action="{{ route('laporan.update', $t->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 col-md-12">
                        <label for="">Nama Lengkap</label>
                        <div class="mb-3">
                            <input type="text" class="form-control input-rounded" name="nama_lengkap"
                                value="{{ $t->nama_lengkap }}" required>
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="">Email</label>
                        <div class="mb-3">
                            <input type="email" class="form-control input-rounded" name="email"
                                value="{{ $t->email }}" required>
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="">No. Handphone</label>
                        <div class="mb-3">
                            <input type="text" class="form-control input-rounded" name="no_hp"
                                value="{{ $t->no_hp }}" required>
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="">Status</label>
                        <div class="mb-3">
                            <select id="inputState" class="default-select form-control wide" name="status">
                                <option {{ $t->status == 'Tersedia' ? "Tersedia" : ""}} value="{{ $t->status }}">{{ $t->status }}
                                <option value="Belum Terpakai">Belum Terpakai</option>
                                <option value="Sudah Terpakai">Sudah Terpakai</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
