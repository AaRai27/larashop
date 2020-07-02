@extends('layouts.global')

@section('title')
Edit Category
@endsection

@section('content')

@if (session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif

<div class="col-md-8">
    <form action="{{route('categories.update',[$category->id])}}" enctype="multipart/form-data" method="POST"
        class="bg-white shadow-sm p-3">
        @csrf
        <input type="hidden" name="_method" value="PUT">

        <label>Category Name</label><br>
        <input type="text" name="name" class="form-control" value="{{$category->name}}"><br><br>

        <label>Category Slug</label>
        <input type="text" name="slug" class="form-control" value="{{$category->slug}}"><br><br>

        <label>Category Image</label><br>
        @if ($category->image)
        <span>Current Image</span><br>
        <img src="{{asset('storage/'.$category->image)}}" width="120px"><br><br>
        @endif

        <input type="file" name="image" class="form-control">
        <small class="text-muted">Kosongkan Jika Tidak ingin mengubah gambar</small><br><br>

        <input type="submit" class="btn btn-primary" value="Update">

    </form>
</div>
@endsection