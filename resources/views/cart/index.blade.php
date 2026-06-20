@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="row">
  <div class="col-12">
    @if(count($viewData["cart"]) > 0)
    <table class="table table-striped">
       <thead>
         <tr>
           <th scope="col">Image</th>
           <th scope="col">Name</th>
           <th scope="col">Price</th>
           <th scope="col">Quantity</th>
           <th scope="col">Subtotal</th>
           <th scope="col">Actions</th>
         </tr>
       </thead>
       <tbody>
         @foreach ($viewData["cart"] as $id => $item)
         <tr>
           <td><img src="{{ asset('/img/'.$item["image"]) }}" width="50px"></td>
           <td>{{ $item["name"] }}</td>
           <td>${{ $item["price"] }}</td>
           <td>{{ $item["quantity"] }}</td>
           <td>${{ $item["price"] * $item["quantity"] }}</td>
           <td>
             <form action="{{ route('cart.remove', ['id'=> $id]) }}" method="POST">
               @csrf
               @method('DELETE')
               <button type="submit" class="btn btn-danger btn-sm">Remove</button>
             </form>
           </td>
         </tr>
         @endforeach
       </tbody>
    </table>
    <div class="text-end">
       <b>Total: ${{ $viewData["total"] }}</b>
    </div>
    <div class="text-end mt-3">
       <form action="{{ route('cart.purchase') }}" method="POST">
         @csrf
         <button type="submit" class="btn bg-primary text-white">Purchase</button>
       </form>
    </div>
    @else
    <p>Your cart is empty.</p>
    @endif
  </div>
</div>
@endsection