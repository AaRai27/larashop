@extends('layouts.global')

@section('title')
Edit Order
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        @if (session('status'))
        <div class="aler alert-success">
            {{session('status')}}
        </div>
        @endif
    </div>
</div>
<div>
    <form action="{{route('orders.update',[$order->id])}}" method="POST" class="shadow-sm bg-white p-3">
        @csrf
        <input type="hidden" name="_method" value="PUT">

        <label for="invoice_number">Invoice Number</label>
        <input type="text" class="form-control" value="{{$order->invoice_number}}" disabled>

        <label for="buyer">Buyer</label>
        <input type="text" class="form-control" value="{{$order->user->name}}" disabled>

        <br>

        <label for="created_at">Order Date</label><br>
        <input type="text" class="form-control" value="{{$order->created_at}}" disabled><br>

        <label>Books {{$order->totalQuantity}}</label><br>

        <ul>
            @foreach ($order->books as $books)
            <li>{{$book->title}} <b> ({{$book->pivot->quantity}}) </b></li>
            @endforeach
        </ul>

        <label>Total Price</label><br>
        <input type="text" class="form-control" value="{{$order->total_price}}" disabled>
        <br>

        <label for="status">Status</label><br>
        <select name="status" id="status" class="form-control">
            <option {{$order->status == "SUBMIT" ? "selected" : ""}} value="SUBMIT">SUBMIT</option>
            <option {{$order->status == "PROCESS" ? "selected" : ""}} value="PROCESS">PROCESS</option>
            <option {{$order->status == "FINISH" ? "selected" : ""}} value="FINISH">FINISH</option>
            <option {{$order->status == "CANCEL" ? "selected" : ""}} value="CANCEL">CANCEL</option>
        </select>
        <br>

        <input type="submit" class="btn btn-primary" value="Update">

    </form>
</div>
@endsection