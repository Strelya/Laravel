<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Signin</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
</head>
<body class="text-center">
<form  method="post" action="{{ route('handle-sign-up') }}" class="form-signin">
    @csrf
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    @if($errors->has('email'))
        <ul class="alert alert-danger">
            @foreach($errors->get('email') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" value="{{ old('email') }}" required autofocus>
    @if ($errors->has('password'))
        <ul class="alert alert-danger">
            @foreach($errors->get('password') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="password"  name="password" class="form-control" placeholder="Password" required>
    @if ($errors->has('password_confirmation'))
        <ul class="alert alert-danger">
            @foreach($errors->get('password_confirmation') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <label for="inputPassword" class="sr-only">Password confirmation</label>
    <input type="password" id="password_confirmation"  name="password_confirmation" class="form-control" placeholder="Password" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
</form>
</body>
</html>

{{--                <div class="form-group">--}}
{{--                    @if ($errors->has('password_confirmation'))--}}
{{--                        <ul class="alert alert-danger">--}}
{{--                            @foreach($errors->get('password_confirmation') as $error)--}}
{{--                                <li>{{ $error }}</li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    @endif--}}
{{--                    <label for="password_confirmation">Password confirmation</label>--}}
{{--                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">--}}
{{--                </div>--}}


