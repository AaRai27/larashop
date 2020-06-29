@extends('layouts.global')

@section('title')
User List
@endsection

@section('content')
@if (session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif

<form action="{{route('users.index')}}">
    <div class="row">
        <div class="col-md-6">
            <input type="text" value="{{Request::get('keyword')}}" name="keyword" class="form-control"
                placeholder="Masukkan Email Untuk Filter">
        </div>
        <div class="col-md-6">
            <input type="radio" name="status" id="active" value="ACTIVE" class="form-control">
            <label for="active">Active</label>

            <input type="radio" name="status" id="inactive" value="INACTIVE" class="form-control">
            <label for="inactive">Inactive</label>

            <input type="submit" value="Filter" class="btn btn-primary">

        </div>
    </div>
</form>

{{-- <div class="row">
    <div class="col-md-6">
        <form action="{{route('users.index')}}">
<div class="input-group mb-3">
    <input type="text" name="keyword" value="{{Request::get('keyword')}}" class="form-control col-md-10"
        placeholder="Filter Berdasarkan email">
    <div class="input-group-append">
        <input type="submit" value="Filter" class="btn btn-primary">
    </div>
</div>
</form>
</div>
</div> --}}

<div class="row">
    <div class="col-md-12 text-right">
        <a href="{{route('users.create')}}" class="btn btn-primary">Create User</a>
    </div>
</div>
<br>
<table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col"><b>No</b></th>
            <th scope="col"><b>Full Name</b></th>
            <th scope="col"><b>Username</b></th>
            <th scope="col"><b>Email</b></th>
            <th scope="col"><b>Avatar</b></th>
            <th scope="col"><b>Status</b></th>
            <th scope="col"><b>Action</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->username}}</td>
            <td>{{$user->email}}</td>
            <td>
                @if ($user->avatar)
                <img src="{{asset('storage/'.$user->avatar)}}" width="70px">
                @else
                No Pict
                @endif
            </td>
            <td>
                @if ($user->status == "ACTIVE")
                <span class="badge badge-success">
                    {{$user->status}}
                </span>
                @else
                <span class="badge badge-danger">
                    {{$user->status}}
                </span>
                @endif
            </td>
            <td>
                <a href="{{route('users.edit',$user->id)}}" class="btn btn-info text-white btn-sm">Edit</a>
                <form action="{{route('users.destroy',[$user->id])}}"
                    onsubmit="return confirm('Delete this user permanentrly?')" class="d-inline" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                </form>
                <a href="{{route('users.show',[$user->id])}}" class="btn btn-primary btn-sm">Detail</a>
            </td>
        </tr>
        @endforeach
    <tfoot>
        <tr>
            <td colspan="10">
                {{$users->appends(Request::all())->links()}}
            </td>
        </tr>
    </tfoot>
    </tbody>
</table>
@endsection