<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <title>Vending-Machine</title>
</head>
<body>

{{-- フラッシュメッセージ表示エリア --}}
@if (session('input_amount_message'))
    <div class="alert alert-success">
        {{session('input_amount_message')}}
    </div>
@elseif (session('returned_amount_message'))
    <div class="alert alert-success">
        {{session('product_purchase_success_message')}}<br>
        {{session('returned_amount_message')}}
    </div>
@elseif (session('return_of_change'))
    <div class="alert alert-success">
    {{session('return_of_change')}}
    </div>
@elseif (session('input_amount_error_message'))
    <div class="alert alert-danger">    
    {{session('input_amount_error_message')}}
    </div>
@elseif (session('product_purchase_success_message'))
    <div class="alert alert-success">
    {{session('product_purchase_success_message')}}
    </div>
@elseif (session('product_purchase_error_message'))
    <div class="alert alert-danger">
    {{session('product_purchase_error_message')}}
    </div>
@endif
{{-- /フラッシュメッセージ表示エリア --}}

{{-- 自販機エリア --}}
<div class="container mb-5">
    <div class="container bg-primary mt-3 pb-3">
        {{-- 製品購入エリア --}}
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card-group">
                        @foreach($product_masters as $product_master)
                            <div class="col-lg-2">
                                <div class="card mt-3 mb-3 border-dark">
                                    <div class="card-header text-center border-dark">{{$product_master->product_name}}
                                    </div>
                                    <img src="data:image/jpeg;base64,{{$product_master->image}}" class="card-img-top">
                                    <div class="card-body border-dark">
                                    <p>在庫数:{{$product_master->stocks->stock}}</p>
                                        @if ($product_master->stocks->stock === 0)
                                            <div class="text-center">
                                                <input class="btn btn-dark border-dark" type="submit" value=売切 disabled="disabled">
                                            </div>
                                        @else
                                            <form action="/processProductPurchase"  method="post">
                                                @csrf
                                                    <input type="hidden" name="id" value="{{$product_master->id}}">
                                                    <input type="hidden" name="product_name" value="{{$product_master->product_name}}">
                                                    <div class="text-center">
                                                        @if ($input_amount >=  $product_master->price)
                                                            <input class="btn btn-primary border-dark" type="submit" name="product_price" value="￥{{$product_master->price}}">
                                                        @else
                                                            <input class="btn btn-primary border-dark" type="submit" name="product_price" value="￥{{$product_master->price}}" disabled="disabled">
                                                        @endif
                                                    </div>
                                                    <input type="hidden" name="purchase_time" value="{{ \Carbon\Carbon::now() }}">
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                </div>
            </div>
        </div>
        {{-- /製品購入エリア --}}

        {{-- 金額投入エリア --}}
        @if ($input_amount === 9999)
            <div class="text-right mr-3">
                <form action="/" method="post">
                    @csrf
                        <input class="btn btn-secondary border-dark" type="submit" name="returned_amount" value="返却">
                        <input class="btn btn-warning border-dark" type="submit" name="10yen" value="￥10" disabled="disabled">
                        <input class="btn btn-warning border-dark" type="submit" name="50yen" value="￥50" disabled="disabled">
                        <input class="btn btn-warning border-dark" type="submit" name="100yen" value="￥100" disabled="disabled">
                        <input class="btn btn-warning border-dark" type="submit" name="500yen" value="￥500" disabled="disabled">
                        <input class="btn btn-warning border-dark" type="submit" name="1000yen" value="￥1000" disabled="disabled">
                        <input class="btn btn-warning border-dark" type="submit" name="2000yen" value="￥2000" disabled="disabled">
                </form>
            </div>
        @else
            <div class="text-right mr-3">
                <form action="/" method="post">
                    @csrf
                        <input class="btn btn-secondary border-dark" type="submit" name="returned_amount" value="返却">
                        <input class="btn btn-warning border-dark" type="submit" name="10yen" value="￥10">
                        <input class="btn btn-warning border-dark" type="submit" name="50yen" value="￥50">
                        <input class="btn btn-warning border-dark" type="submit" name="100yen" value="￥100">
                        <input class="btn btn-warning border-dark" type="submit" name="500yen" value="￥500">
                        <input class="btn btn-warning border-dark" type="submit" name="1000yen" value="￥1000">
                        <input class="btn btn-warning border-dark" type="submit" name="2000yen" value="￥2000">
                </form>
            </div>
        @endif
        {{-- /金額投入エリア --}}

        {{-- 投入金額表示エリア --}}
        <div class="clearfix mr-3">
            <div class="float-right">
                <div class="input-group-prepend mt-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text border-dark">投入金額
                        </div>
                    </div>
                    <input class="rounded border-dark" type="text" value="￥{{ $input_amount }}" readonly>
                </div>
            </div>
        </div>
        {{-- /投入金額表示エリア --}}
        
    </div>  
</div>
{{-- /自販機エリア --}}

</body>
</html>







