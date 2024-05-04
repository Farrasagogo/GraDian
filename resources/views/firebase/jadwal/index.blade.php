@extends("firebase.app")

@section('content')
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Tipe Obat</th>
            <th scope="col">Hari</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Jam Obat</th>
            <th scope="col"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addModal">
                Tambah Jadwal
            </button></th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach ($data as $item)
            <tr>
                <th scope="row">{{ $no++ }}</th>
                <td>{{ $item['tipe_obat'] }}</td>
                <td>{{ $item['tipe_jadwal'] }}</td>
                <td>{{ $item['detail'] }}</td>
                <td>{{ $item['jam_obat'] }}</td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal-{{ $item['id'] }}">
                        Mengubah Jadwal
                    </button>
                    <form action="{{ route('delete', $item['id']) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Menghapus Jadwal</button>
                    </form>
                </td>
            </tr>
            <div class="modal fade" id="editModal-{{ $item['id'] }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="editModalLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Include the edit form here -->
                            @include('firebase.jadwal.edit', ['data' => $item])
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Tambah Jadwal Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addForm" method="POST" action="{{ route('store') }}">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="tipe_obat">Tipe Obat</label>
                                <select class="form-control" id="tipe_obat" name="tipe_obat" required>
                                    <option value="" disabled selected>Pilih Obat</option>
                                    <option value="Pestisida" selected>Pestisida</option>
                                    <option value="Fungisida" selected>Fungisida</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tipe_jadwal">Hari</label>
                                <select class="form-control" id="tipe_jadwal" name="tipe_jadwal" required>
                                    <option value="" disabled selected>Pilih Hari</option>
                                    <option value="Senin" selected>Senin</option>
                                    <option value="Selasa" selected>Selasa</option>
                                    <option value="Rabu" selected>Rabu</option>
                                    <option value="Kamis" selected>Kamis</option>
                                    <option value="Jum'at" selected>Jumat</option>
                                    <option value="Sabtu" selected>Sabtu</option>
                                    <option value="Minggu" selected>Minggu</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="detail">Deskripsi</label>
                                <textarea class="form-control" id="detail" name="detail" required maxlength="150"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="jam_obat">Jam Obat</label>
                                <input type="time" class="form-control" id="jam_obat" name="jam_obat" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Jadwal</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </tbody>
</table>
</div>
@endsection