<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Set background color */
        }
        .forgot-password-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh; /* Full viewport height */
        }
        .card {
            width: 400px; /* Adjust card width as needed */
        }
    </style>
</head>
<body>
<div class="container forgot-password-container">
    <div class="card">
        <div class="card-body">
            <h1 class="text-center " style=" font-weight: 600;font-family: 'Montserrat', sans-serif; font-size: 30px">Lupa Password</h1>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('password.forgot.send') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Username:</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label for="forgot_password_key">Nama Ibu:</label>
                    <input type="text" id="forgot_password_key" name="forgot_password_key" class="form-control" value="{{ old('forgot_password_key') }}" required>
                </div>
                <button type="submit" style="background-color: #6c3f8f;"class="btn btn-primary btn-block">Kirim</button>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
