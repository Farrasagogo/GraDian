<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            position: relative;
        }
        .login-logo {
            font-family: 'Montserrat', sans-serif;
            font-weight: 900;
            font-size: 50px;
            position: absolute;
            top: -160px;
            left: 50%;
            transform: translateX(-50%);
            color: #7d52a0;
        }
        .login-btn {
            background-color: #7d52a0;
            color: white;
            border: none;
            transition: all 0.3s ease;
        }
        .login-btn:hover {
            background-color: #6c3f8f;
        }
    </style>
</head>
<body>
<div class="container login-container">
    <h1 class="login-logo">GraDian</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center" style="font-weight: 600; font-family: 'Montserrat', sans-serif; font-size: 30px">Login</h1>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ url('/login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Username:</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn login-btn btn-block">Login</button>
                    </form>
                    <br>
                    <p class="text-center"><a href="{{ url('password/forgot') }}">Forgot Password?</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
