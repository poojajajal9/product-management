@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Products</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if(\Illuminate\Support\Facades\Session::has('notification'))
                            <div
                                class="alert alert-{{\Illuminate\Support\Facades\Session::get('notification.type')}}">
                                <span><?php echo \Illuminate\Support\Facades\Session::get('notification.message'); ?></span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="row" style="text-align: center">
                        <?php $products = \App\Models\Product::where('is_active', 1)->take(6)->get(); ?>

                        @if(count($products) > 0)
                        @foreach($products as $product)
                        <div class="col-md-4" style="float: left; margin-bottom: 30px;">
                            <a href="{{ route('product.show', [$product->id]) }}" style="text-decoration: none; color: inherit">
                                <div class="card" style="border: 1px solid black">
                                    <img src="{{ asset('images/' . $product->picture) }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h3 class="card-title">
                                            {{ !empty($product) && !empty($product->name) ? $product->name : 'Sample' }}
                                        </h3>
                                        <p class="card-text">
                                            {!! !empty($product) && !empty($product->description) ? $product->description : '...' !!}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                        @else
                        <h1>No record found.</h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
