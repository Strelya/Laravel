@extends('admin.layout')

@section('content')
    <a class="btn btn-primary" href="{{route('users.create')}}" role="button">Create User</a>
    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Created at</th>
        <th scope="col">Updated at</th>
        <th scope="col">X</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->created_at}}</td>
            <td>{{$user->updated_at}}</td>
            <td>
                <form method="post" action="{{route('users.destroy', $user->id)}}">
                    @csrf
                    @method('delete')
                    <input type="submit" value="X">
                </form></td>
        </tr>
    @endforeach
    </tbody>
</table>
   {{$users->links()}}
@endsection
