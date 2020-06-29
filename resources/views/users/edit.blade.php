@extends('layouts.global')

@section('title')
Edit User
@endsection

@section('content')
<div class="col-md-8">
    @if (session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif

    <form action="{{route('users.update',[$user->id])}}" method="POST" enctype="multipart/form-data"
        class="bg-white shadow-sm p-3">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control" placeholder="Full Name">
        <br>

        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="{{$user->username}}" class="form-control"
            placeholder="Username" disabled>
        <br>

        <label for="">Status</label>
        <br>
        <input {{$user->status == "ACTIVE" ? "checked" : ""}} type="radio" name="status" id="active" value="ACTIVE"
            class="form-control">
        <label for="active">Active</label>

        <input {{$user->status == "INACTIVE" ? "checked" : ""}} type="radio" name="status" id="inactive"
            value="INACTIVE" class="form-control">
        <label for="inactive">Inactive</label>
        <br><br>

        <label for="roles">Roles</label>
        <br>
        <input type="checkbox" {{in_array("ADMIN",json_decode($user->roles)) ? "checked" : ""}} name="roles[]"
            id="ADMIN" value="ADMIN">
        <label for="ADMIN">Administrator</label>

        <input value="STAFF" type="checkbox" {{in_array("STAFF", json_decode($user->roles)) ? "checked" : ""}}
            name="roles[]" id="STAFF">
        <label for="STAFF">Staff</label>

        <input value="CUSTOMER" type="checkbox" {{in_array("CUSTOMER", json_decode($user->roles)) ? "checked" : ""}}
            name="roles[]" id="CUSTOMER">
        <label for="CUSTOMER">Customer</label>
        <br><br>

        <label for="phone">Phone Number</label>
        <br>
        <input type="text" name="phone" class="form-control" value="{{$user->phone}}">

        <br>

        <label for="address">Address</label>
        <br>
        <textarea name="address" id="address" class="form-cotrol" cols="50" rows="4">
        {{$user->address}}
            </textarea>

        <br>

        <label for="avatar">Avatar Image</label>
        <br>
        Current Avatar : <br>
        @if ($user->avatar)
        <img src="{{asset('storage/'.$user->avatar)}}" width="120px">
        <br>
        @else
        No Pict
        @endif

        <br>

        <input type="file" name="avatar" id="avatar" class="form-control">
        <small class="text-muted">Kosongkan JIka tidak ingin mengubah avatar</small>

        <hr class="my-3">

        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="{{$user->email}}" placeholder="user@gmail.com"
            class="form-control" disabled>
        <br>

        <input type="submit" class="btn btn-primary" value="Save">
    </form>

</div>
@endsection