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

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group float-right">
                                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary mr-2">Back</a>
                                    <a href="{{ route('products.edit', $product->id) }}"
                                       class="btn btn-outline-secondary">Edit</a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <p>
                                    <strong>Name: </strong><br>
                                    {{ !empty($product) ? $product->name : '-' }}
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p>
                                    <strong>Status: </strong><br>
                                    {{ (isset($product->is_active) && $product->is_active == 1) ? 'Active' : 'Inactive' }}
                                </p>
                            </div>
                            <div class="col-md-12">
                                <p>
                                    <strong>Description: </strong><br>
                                    {{ !empty($product) ? $product->description : '-' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page_js')
    <script type="text/javascript">
        $(document).ready(function () {
            //
        })
    </script>
@stop
