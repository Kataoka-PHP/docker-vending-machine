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
            {{session('product_purchase_success_message')}}
        </div>
        <div class="alert alert-success">
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

    <div class="mb-5"></div>

    {{-- 金額投入エリア --}}
    <div class="ml-5">
        <form action="/" method="post">
            @csrf
                <input class="btn btn-secondary" type="submit" name="returned_amount" value="返却">
                <input class="btn btn-primary" type="submit" name="10yen" value="￥10">
                <input class="btn btn-primary" type="submit" name="50yen" value="￥50">
                <input class="btn btn-primary" type="submit" name="100yen" value="￥100">
                <input class="btn btn-primary" type="submit" name="500yen" value="￥500">
                <input class="btn btn-primary" type="submit" name="1000yen" value="￥1000">
                <input class="btn btn-primary" type="submit" name="2000yen" value="￥2000">
        </form>
    </div>
    {{-- /金額投入エリア --}}

    <div class="mt-5"></div>
    <div class="ml-5"></div>
    <div class="ml-5">投入金額:{{ $input_amount }}円</div>
    <div class="mt-5"></div>

    {{-- 製品購入エリア --}}
    <div class="ml-5">
        <div class="row">
            <div class="card-deck">
                @foreach($product_masters as $product_master)
                    <div class="card">
                        <div class="card-header">{{$product_master->product_name}}</div>
                        <img src="data:image/jpeg;base64,{{$product_master->image}}" class="card-img-top h-50" alt="">
                            <div class="card-body">
                                <p>在庫数:{{$product_master->stocks->stock}}</p>
                                @if ($product_master->stocks->stock === 0)
                                    <input class="btn btn-dark" type="submit" value=売切 disabled="disabled">
                                @else
                                    <form action="/processProductPurchase"  method="post">
                                        @csrf
                                            <input type="hidden" name="id" value="{{$product_master->id}}">
                                            <input type="hidden" name="product_name" value="{{$product_master->product_name}}">
                                            <input class="btn btn-primary" type="submit" name="product_price" value="{{$product_master->price}}">
                                            <input class="btn btn-secondary" type="submit" name="stock+3" value=在庫+3>
                                            <input type="hidden" name="purchase_time" value="{{ \Carbon\Carbon::now() }}">
                                    </form>
                                @endif
                            </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- /製品購入エリア --}}

</body>
</html>







