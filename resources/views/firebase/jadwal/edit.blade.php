<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">Edit Data</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('update', $data['id']) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="tipe_obat">Tipe Obat</label>
                            <select class="form-control" id="tipe_obat" name="tipe_obat" required>
                                <option value="" disabled selected>Pilih Obat</option>
                                <option value="Pestisida" @if($data['tipe_obat'] == 'Pestisida') selected @endif>Pestisida</option>
                                <option value="Fungisida" @if($data['tipe_obat'] == 'Fungisida') selected @endif>Fungisida</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tipe_jadwal">Tipe Jadwal</label>
                            <select class="form-control" id="tipe_jadwal" name="tipe_jadwal" required>
                                <option value="" disabled selected>Pilih Hari</option>
                                <option value="Senin" @if($data['tipe_jadwal'] == 'Senin') selected @endif>Senin</option>
                                <option value="Selasa" @if($data['tipe_jadwal'] == 'Selasa') selected @endif>Selasa</option>
                                <option value="Rabu" @if($data['tipe_jadwal'] == 'Rabu') selected @endif>Rabu</option>
                                <option value="Kamis" @if($data['tipe_jadwal'] == 'Kamis') selected @endif>Kamis</option>
                                <option value="Jumat" @if($data['tipe_jadwal'] == 'Jumat') selected @endif>Jumat</option>
                                <option value="Sabtu" @if($data['tipe_jadwal'] == 'Sabtu') selected @endif>Sabtu</option>
                                <option value="Minggu" @if($data['tipe_jadwal'] == 'Minggu') selected @endif>Minggu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="detail">Detail</label>
                            <input type="number" class="form-control" id="detail" name="detail" value="{{ $data['detail'] }}" required>
                        </div>
                        <div class="form-group">
                            <label for="jam_obat">Jam Obat</label>
                            <input type="time" class="form-control" id="jam_obat" name="jam_obat" value="{{ $data['jam_obat'] }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>