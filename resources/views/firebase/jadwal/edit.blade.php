<div class="card-body">

    <form id="editForm">
        @csrf
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
                <option value="Monday" @if($data['tipe_jadwal'] == 'Monday') selected @endif>Senin</option>
                <option value="Tuesday" @if($data['tipe_jadwal'] == 'Tuesday') selected @endif>Selasa</option>
                <option value="Wednesday" @if($data['tipe_jadwal'] == 'Wednesday') selected @endif>Rabu</option>
                <option value="Thursday" @if($data['tipe_jadwal'] == 'Thursday') selected @endif>Kamis</option>
                <option value="Friday" @if($data['tipe_jadwal'] == "Friday") selected @endif>Jum'at</option>
                <option value="Saturday" @if($data['tipe_jadwal'] == 'Saturday') selected @endif>Sabtu</option>
                <option value="Sunday" @if($data['tipe_jadwal'] == 'Sunday') selected @endif>Minggu</option>
            </select>
        </div>
        <div class="form-group">
            <label for="detail">Deskripsi</label>
            <textarea class="form-control" id="detail" name="detail" required maxlength="150">{{ $data['detail'] }}</textarea>
        </div>
        <div class="form-group">
            <label for="jam_obat">Jam Obat</label>
            <input type="time" class="form-control" id="jam_obat" name="jam_obat" value="{{ $data['jam_obat'] }}" required>
        </div>
        <button type="button" class="btn btn-primary" id="submitForms">Perbarui Jadwal</button>
    </form>
    <div id="form-response"></div>
</div>

<script>
    $(document).ready(function() {
        $('#submitForms').click(function(e) {
            e.preventDefault();

            var formData = $('#editForm').serialize();
            var url = "{{ route('jadwal.update', $data['id']) }}";

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {

                        window.location.reload(); 
                        $('.alert-success').text(response.successMessage);
                        
                    } else {
                        alert('Error updating data');
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        });
    });
</script>