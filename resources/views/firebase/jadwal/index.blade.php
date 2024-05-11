@extends("firebase.app")

@section('content')
<div class="col-10" style="font-family: 'Open sans', sans-serif; font-size: 1.2rem; font-weight:900; color:#4d5155; margin: 20px;">Jadwal Obat</div>
<div class="table-responsive"style="margin: 20px;">
    <table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col" class="col-12 col-md-1">No</th>
            <th scope="col" class="col-12 col-md-2">Tipe Obat</th>
            <th scope="col" class="col-12 col-md-2">Hari</th>
            <th scope="col" class="col-12 col-md-3">Deskripsi</th>
            <th scope="col" class="col-12 col-md-2">Jam Obat</th>
            <th scope="col" class="col-12 col-md-2">
                <button type="button" class="btn btn-success btn-sm px-2 mb-1 mb-md-0 mr-md-1" data-toggle="modal" data-target="#addModal">
                    <span class="d-none d-md-inline">Tambah Jadwal</span>
                    <span class="d-inline d-md-none"><i class="bi-plus-lg text-white"></i></span>
                </button>
            </div>
        </th>
    </tr>
</thead>
<tbody>
    @php $no = 1; @endphp
    @foreach ($data as $item)
        <tr>
            <td class="col-12 col-md-1">{{ $no++ }}</td>
            <td class="col-12 col-md-2">{{ $item['tipe_obat'] }}</td>
            <td class="col-12 col-md-2">{{ $item['tipe_jadwal'] }}</td>
            <td class="col-12 col-md-3">{{ $item['detail'] }}</td>
            <td class="col-12 col-md-2">{{ $item['jam_obat'] }}</td>
            <td class="col-12 col-md-2">
                <div class="d-flex flex-column flex-md-row">
                    <button type="button" class="btn btn-primary btn-sm px-2 mb-1 mb-md-0 mr-md-1" data-toggle="modal" data-target="#editModal-{{ $item['id'] }}">
                        <span class="d-none d-md-inline">Mengubah Jadwal</span>
                        <span class="d-inline d-md-none text-white"><i class="bi-pencil"></i></span>
                    </button>
                    <form action="{{ route('delete', $item['id']) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm px-2">
                            <span class="d-none d-md-inline">Menghapus Jadwal</span>
                            <span class="d-inline d-md-none text-white"><i class="bi-trash"></i></span>
                        </button>
                    </form>
                </td>
            </tr>
            <div class="modal fade" id="editModal-{{ $item['id'] }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
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
            <div class="modal-dialog modal-dialog-centered" role="document">
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
                                    <option value="Monday" selected>Senin</option>
                                    <option value="Tuesday" selected>Selasa</option>
                                    <option value="Wednesday" selected>Rabu</option>
                                    <option value="Thursday" selected>Kamis</option>
                                    <option value="Friday" selected>Jumat</option>
                                    <option value="Saturday" selected>Sabtu</option>
                                    <option value="Sunday" selected>Minggu</option>
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
                            <button type="submit" class="btn btn-primary btn-block">Tambah Jadwal</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </tbody>
</table>
</div>
@endsection