@extends('layouts.app')
@section('title', $viewData["title"])
@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card">
       <div class="card-header">
         Create product
       </div>
       <div class="card-body">
         @if($errors->any())
         <ul class="alert alert-danger list-unstyled">
           @foreach($errors->all() as $error)
           <li>- {{ $error }}</li>
           @endforeach
         </ul>
         @endif
         <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
           @csrf
           <div class="mb-3 row">
             <label class="col-md-4 col-form-label text-md-end">Name:</label>
             <div class="col-md-6">
               <input name="name" type="text" class="form-control">
             </div>
           </div>
           <div class="mb-3 row">
             <label class="col-md-4 col-form-label text-md-end">Price:</label>
             <div class="col-md-6">
               <input name="price" type="text" class="form-control">
             </div>
           </div>
           <div class="mb-3 row">
             <label class="col-md-4 col-form-label text-md-end">Description:</label>
             <div class="col-md-6">
               <textarea name="description" class="form-control"></textarea>
             </div>
           </div>
           <div class="mb-3 row">
             <label class="col-md-4 col-form-label text-md-end">Image:</label>
             <div class="col-md-6">
               <input name="image" type="file" class="form-control">
             </div>
           </div>
           <div class="mb-3 row">
             <div class="col-md-6 offset-md-4">
               <button type="submit" class="btn bg-primary text-white">
                 Create
               </button>
             </div>
           </div>
         </form>
       </div>
    </div>
  </div>
</div>
@endsection