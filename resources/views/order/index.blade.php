@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')
    <div class="row">
        <div class="col-12">
            @if (count($viewData['orders']) > 0)
                @foreach ($viewData['orders'] as $order)
                    <div class="card mb-3">
                        <div class="card-header">
                            Order #{{ $order->getId() }} - Total: ${{ $order->getTotal() }}
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td>{{ $item->product->getName() }}</td>
                                            <td>${{ $item->getPrice() }}</td>
                                            <td>{{ $item->getQuantity() }}</td>
                                            <td>${{ $item->getPrice() * $item->getQuantity() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            @else
                <p>You have no orders.</p>
            @endif
        </div>
    </div>
@endsection
