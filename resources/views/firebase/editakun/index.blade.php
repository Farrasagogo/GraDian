@extends("firebase.app")

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Edit Profile</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Username:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $user['name'] }}" required>
        </div>
        <div class="form-group">
            <label for="forgot_password_key">Nama Ibu:</label>
            <input type="text" id="forgot_password_key" name="forgot_password_key" class="form-control" value="{{ $user['forgot_password_key'] }}" required>
        </div>
        <div class="form-group">
            <label for="password">Password Baru (kosongkan bila tidak diubah):</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password Baru:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
@endsection
