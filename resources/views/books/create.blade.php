@extends('layouts.global')

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
</script>
@endsection

@section('title')
Create Book
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        @if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
        @endif
        <form action="{{route('books.store')}}" method="POST" enctype="multipart/form-data"
            class="shadow-sm p-3 bg-white">
            @csrf
            <label for="title">Title</label><br>
            <input type="text" name="title" class="form-control" placeholder="Book Title"><br>

            <label for="cover">Cover</label>
            <input type="file" name="cover" class="form-control"><br>

            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"
                placeholder="Give a description about this book"></textarea><br>

            <label for="categories">Categories</label><br>
            <select name="categories[]" id="categories" class="form-control" multiple></select>

            <label for="stock">Stock</label><br>
            <input type="number" name="stock" id="stock" class="form-control"><br>

            <label for="author">Author</label><br>
            <input type="text" name="author" id="author" class="form-control" placeholder="Book Author"><br>

            <label for="publisher">Publisher</label><br>
            <input type="text" name="publisher" id="publisher" class="form-control" placeholder="Book Publisher"><br>

            <label for="price">Price</label><br>
            <input type="number" name="price" id="price" class="form-control" placeholder="Book Price"><br>


            <br><br>

            <button class="btn btn-primary" name="save_action" value="PUBLISH">Publish</button>
            <button class="btn btn-secondary" name="save_action" value="DRAFT">Save as Draft</button>

        </form>
    </div>
</div>
@endsection