@extends('admin.layout')

@section('content')
    <form method="post" action="{{ route('users.store') }}">
        @csrf
        <div class="form-group">
            @if($errors->has('name'))
                <ul class="alert alert-danger" role="alert">
                @foreach($errors->get('name') as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            @endif
            <label for="exampleInputName1">Name</label>
            <input name="name" type="text" class="form-control" id="exampleInputName1" aria-describedby="NameHelp" value="{{ old('name') }}">
            <small id="emailHelp" class="form-text text-muted">Name</small>
        </div>
        <div class="form-group">
            @if($errors->has('email'))
                <ul class="alert alert-danger" role="alert">
                    @foreach($errors->get('email') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <label for="exampleInputEmail1">Email address</label>
            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('email') }}">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            @if($errors->has('password'))
                <ul class="alert alert-danger" role="alert">
                    @foreach($errors->get('password') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <label for="exampleInputPassword1">Password</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="form-group">
            @if($errors->has('password_confirmation'))
                <ul class="alert alert-danger" role="alert">
                    @foreach($errors->get('password_confirmation') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <label for="exampleInputPassword2">Confirm Password</label>
            <input name="password_confirmation" type="password" class="form-control" id="exampleInputPassword2">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
