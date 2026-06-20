@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="card mb-3">
  <div class="row g-0">
    <div class="col-md-4">
       <img src="{{ asset('/storage/'.$viewData["product"]->getImage()) }}" class="img-fluid rounded-start">
    </div>
    <div class="col-md-8">
       <div class="card-body">
         <h5 class="card-title">
             {{ $viewData["product"]->getName() }} (${{ $viewData["product"]->getPrice() }})
         </h5>
         <p class="card-text">{{ $viewData["product"]->getDescription() }}</p>
         @auth
         <form action="{{ route('cart.add') }}" method="POST">
           @csrf
           <input type="hidden" name="product_id" value="{{ $viewData['product']->getId() }}">
           <button type="submit" class="btn bg-primary text-white">Add to Cart</button>
         </form>
         @else
         <p class="card-text"><a href="{{ route('login') }}">Login to buy</a></p>
         @endauth
       </div>
    </div>
  </div>
</div>
@endsection