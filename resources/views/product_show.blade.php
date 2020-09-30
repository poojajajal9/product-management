@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Product Detail</div>

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

                    <p>
                        <strong>Product Name: </strong><br>
                        <span>{{ $product->name }}</span>
                    </p>

                    <p>
                        <strong>Description: </strong><br>
                        <span>{!! $product->description !!}</span>
                    </p>

                    <br><br>

                    <form action="{{ route('order.place') }}" method="post"
                          enctype="multipart/form-data" class="checkout_form" id="checkout_form">
                        {{ csrf_field() }}

                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="user_id" value="{{ auth()->check() ? auth()->id() : 0 }}">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="name">
                                        Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="email">
                                        Email
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="email" name="email"
                                           value="{{ old('email') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="unit_number">Unit Number</label>
                                    <input type="text" class="form-control" id="unit_number" name="unit_number"
                                           value="{{ old('unit_number') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="buzzer_number">Buzzer Number</label>
                                    <input type="text" class="form-control" id="buzzer_number" name="buzzer_number"
                                           value="{{ old('buzzer_number') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="address">
                                        Address
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="address" name="address"
                                           value="{{ old('address') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label" for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                           value="{{ old('city') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label" for="state">State</label>
                                    <input type="text" class="form-control" id="state" name="state"
                                           value="{{ old('state') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label" for="zip_code">Zip Code</label>
                                    <input type="text" class="form-control" id="zip_code" name="zip_code"
                                           value="{{ old('zip_code') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label" for="country">Country</label>
                                    <input type="text" class="form-control" id="country" name="country"
                                           value="{{ old('country') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary pull-right">Place Order</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
