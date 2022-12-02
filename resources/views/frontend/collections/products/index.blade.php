@extends('layouts.app');

@section('title','All Categories')

@section('content')


<div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mb-4">Our Products</h4>
                </div>
                
                @forelse($products as $productItem)
                <div class="col-md-3">
                    <div class="product-card">
                        <div class="product-card-img">
                            @if($productItem->quantity >0)
                            <label class="stock bg-success">In Stock</label>
                            @else
                            <label class="stock bg-danger">Out of Stock</label>
                            @endif
                            @if($productItem->productImages->count()>0)
                            <img src="{{asset($productItem->productImages[0]->image)}}" alt="{{$productItem->name}}">
                            @endif
                        </div>
                        <div class="product-card-body">
                            <p class="product-brand">{{$productItem->brand}}</p>
                            <h5 class="product-name">
                               <a href="">
                                    {{$productItem->name}} 
                               </a>
                            </h5>
                            <div>
                                <span class="selling-price">{{$productItem->selling_price}}$</span>
                                <span class="original-price">{{$productItem->original_price}}$</span>
                            </div>
                            <div class="mt-2">
                                <a href="" class="btn btn1">Add To Cart</a>
                                <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                                <a href="" class="btn btn1"> View </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>No Products Available for {{$category->name}}</h4>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

@endsection