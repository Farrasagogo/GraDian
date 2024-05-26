@extends("firebase.app")

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Profile</h1>
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Username:</th>
            <td>{{ $user['name'] }}</td>
        </tr>
        <tr>
            <th>Nama Ibu:</th>
            <td>{{ $user['forgot_password_key'] }}</td>
        </tr>
        <tr>
            <th>Password(Terenkripsi):</th>
            <td>
                @if(strlen($user['password']) > 10) <!-- Change 10 to whatever length you want to truncate -->
                    <span class="hashed-password truncated">{{ substr($user['password'], 0, 10) }}...</span>
                @else
                    {{ $user['password'] }}
                @endif
            </td>
        </tr>
    </table>

    <a href="{{ route('profile.edit') }}" class="btn btn-primary mt-3">Edit</a>
</div>

<!-- Script to handle expanding hashed password -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const expandLink = document.querySelector('.expand-password');
        const hashedPassword = document.querySelector('.hashed-password');

        expandLink.addEventListener('click', function(e) {
            e.preventDefault();
            hashedPassword.textContent = '{{ $user['password'] }}';
            expandLink.style.display = 'none';
        });
    });
</script>
@endsection
