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
                    <button type="button" class="btn btn-danger btn-sm px-2 delete-item" data-item-id="{{ $item['id'] }}">
                        <span class="d-none d-md-inline">Menghapus Jadwal</span>
                        <span class="d-inline d-md-none text-white"><i class="bi-trash"></i></span>
                    </button>
                    
                    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="messageModalLabel"></h5>
                                </div>
                                <div class="modal-body">
                                    <p id="messageText"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Penghapusan</h5>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin menghapus jadwal ini?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelButton">Batal</button>
                                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var deleteButtons = document.querySelectorAll('.delete-item');
                            var confirmationModal = document.getElementById('confirmationModal');
                            var confirmDeleteButton = document.getElementById('confirmDeleteButton');
                            var cancelButton = document.getElementById('cancelButton');
                        
                            deleteButtons.forEach(function(button) {
                                button.addEventListener('click', function() {
                                    var itemId = this.getAttribute('data-item-id');
                                    confirmDeleteButton.setAttribute('data-item-id', itemId);
                                    $('#confirmationModal').modal('show');
                                });
                            });
                        
                            confirmDeleteButton.addEventListener('click', function() {
                                var itemId = this.getAttribute('data-item-id');
                                var xhr = new XMLHttpRequest();
                                xhr.open('POST', "{{ route('delete', ['id' => '__PLACEHOLDER__']) }}".replace('__PLACEHOLDER__', itemId), true);
                                xhr.setRequestHeader('Content-Type', 'application/json');
                                xhr.setRequestHeader('X-CSRF-TOKEN', "{{ csrf_token() }}");
                                xhr.onreadystatechange = function() {
                                    if (xhr.readyState === XMLHttpRequest.DONE) {
                                        if (xhr.status === 200) {
                                            $('#confirmationModal').modal('hide');
                                            showMessageModal('Success', 'Jadwal berhasil dihapus');
                                            window.location.reload();
                                        } else {
                                            $('#confirmationModal').modal('hide');
                                            showMessageModal('Error', 'Terjadi kesalahan saat menghapus jadwal.');
                                        }
                                    }
                                };
                                xhr.send(JSON.stringify({ _method: 'DELETE' }));
                            });
                        
                            cancelButton.addEventListener('click', function() {
                                $('#confirmationModal').modal('hide'); // Close the modal when cancel button is clicked
                                console.log('Cancel button clicked');
                            });
                        });
                        
                        function showMessageModal(title, message) {
                            var messageModal = document.getElementById('messageModal');
                            var messageModalLabel = document.getElementById('messageModalLabel');
                            var messageText = document.getElementById('messageText');
                        
                            messageModalLabel.textContent = title;
                            messageText.textContent = message;
                            $('#messageModal').modal('show');
                        }
                        </script>
                        
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
                        <div id="form-responses"></div>
                        <form id="addForm">
                            @csrf
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
                            <button type="button" class="btn btn-primary btn-block" id="submitsForm">Tambah Jadwal</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var addForm = document.getElementById('addForm');
            var submitButton = document.getElementById('submitsForm');
            var formResponse = document.getElementById('form-responses');
        
            submitButton.addEventListener('click', function() {
                var formData = new FormData(addForm);
                var xhr = new XMLHttpRequest();
                xhr.open('POST', "{{ route('store') }}", true);
                xhr.setRequestHeader('X-CSRF-TOKEN', "{{ csrf_token() }}");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                window.location.reload(); 
                                                alert('Sukses, jadwal berhasil dibuat');
                            } else {
                                window.location.reload(); 
                                                alert('Gagal, jadwal gagal dibuat');
                            }
                        } else {
                            formResponse.innerHTML = '<div class="alert alert-danger">Request failed: ' + xhr.status + '</div>';
                        }
                    }
                };
                xhr.send(formData);
            });
        });
        </script>
    </tbody>
</table>
</div>
@endsection