@extends('layouts.global')

@section('title')
Edit Book
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        @if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
        @endif
        <form action="{{route('books.update',[$book->id])}}" method="POST" enctype="multipart/form-data"
            class="shadow-sm p-3 bg-white">
            @csrf

            <input type="hidden" name="_method" value="PUT">

            <label for="title">Title</label><br>
            <input type="text" name="title" class="form-control" placeholder="Book Title" value="{{$book->title}}"><br>

            <label for="cover">Cover</label>
            <small class="text-muted">Current Cover</small><br>
            @if ($book->cover)
            <img src="{{asset('storage/'.$book->cover)}}" width="96px">
            @endif
            <br><br>

            <input type="file" name="cover" class="form-control">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah cover</small><br><br>

            <label for="slug">Slug</label>
            <input type="text" name="slug" class="form-control" value="{{$book->slug}}" placeholder="enter-a-slug">

            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{$book->description}}</textarea><br>

            <label for="categories">Categories</label><br>
            <select multiple name="categories[]" id="categories" class="form-control"></select>

            <label for="stock">Stock</label><br>
            <input type="number" name="stock" id="stock" class="form-control" value="{{$book->stock}}"><br>

            <label for="author">Author</label><br>
            <input type="text" name="author" id="author" class="form-control" placeholder="Book Author"
                value="{{$book->author}}"><br>

            <label for="publisher">Publisher</label><br>
            <input type="text" name="publisher" id="publisher" class="form-control" placeholder="Book Publisher"
                value="{{$book->publisher}}"><br>

            <label for="price">Price</label><br>
            <input type="number" name="price" id="price" class="form-control" placeholder="Book Price"
                value="{{$book->price}}"><br>

            <label for="status">Status</label><br>
            <select name="status" id="status" class="form-control">
                <option value="PUBLISH" {{$book->status == 'PUBLISH' ? 'selected' : ''}}>PUBLISH</option>
                <option value="DRAFT" {{$book->status == 'DRAFT' ? 'selected' : ''}}>DRAFT</option>
            </select>

            <br>

            <button class="btn btn-primary" value="PUBLISH">Update</button>
        </form>
    </div>
</div>
</div>
</div>
@endsection

@section('footer-scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $('#categories').select2({
        ajax:{
            url:'http://127.0.0.1:8000/ajax/categories/search',
            processResults: function(data){
                return results: data.map(function(item){
                    return {id: item.id, text:item.name}
                })
            }
        }
    })

    var categories = {!! $book->category !!}

    categories.forEach(function(category){
        var option = new Option(category.name, category.id, true, true);
        $('#categories').append(option).trigger('change');
    });
</script>

@endsection