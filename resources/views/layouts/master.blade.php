<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Online Lottery Platform</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- animate css -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
    <!-- load all Font Awesome styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <!-- owl carousel css -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <style>
        .cart-overlay {
            /*position: fixed;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                background-color: rgba(0, 0, 0, 0.5);
                display: none;
                justify-content: center;
                align-items: center;
                z-index: 9999;
                transition: background-color 0.5s ease;*/
            max-width: 300px;
            width: 300px;
            position: fixed;
            top: 0;
            right: 0;
            height: 100vh;
            background: #fff;
            z-index: 99;
            transform: translateX(400px);
            transition: transform 300ms ease-in;
        }

        .cart-overlay.active {
            transform: translateX(0px);
        }

        .cart {
            /* background-color: #fff; */
            /* max-width: 500px; */
            /* Adjust width as needed */
            /* width: 100%;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                transition: opacity 0.5s ease; */
            background-color: #fff;
            max-width: 500px;
            width: 100%;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: opacity 0.5s ease;
            height: 100vh;
            position: relative;
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-body {
            padding: 10px 0;
        }

        .cart.active {
            opacity: 1;
            /* Change opacity when active */
        }

        .cart-footer {
            /* margin-top: 20px;
                display: flex;
                justify-content: space-between;
                position: absolute;
                bottom: 20px; */
            margin-top: 20px;
            display: flex;
            justify-content: center;
            position: absolute;
            bottom: 20px;
            width: calc(300px - 40px);
        }

        .help-block {
            color: red;
        }
    </style>

    @yield('css')

</head>

<body>

    <div class="preloader">
        <div class="loader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    @include('layouts.partials.header')
    @yield('content')
    @if(Auth::check())
    <div class="cart-overlay">
        <div class="cart">
            <div class="cart-header">
                <h3>Your Cart</h3>
                <button class="btn-close" id="close-cart-btn"></button>
            </div>
            <div class="cart-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Lottery</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(App\Http\Helpers\CartHelper::getAllProductFromCart() as $data)
                        @php
                        $lottery = App\Models\Lottery::where('id',$data['lottery_id'])->first();
                        @endphp
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$lottery->lotteryMaster->lottery_name}}</td>
                            <td>{{$data['checked_winning_quantity']}}</td>
                            <td>{{$lottery->lotteryMaster->lottery_price}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right">Total</td>
                            <td class="text-right">{{App\Http\Helpers\CartHelper::totalCartPrice()}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="cart-footer">
                <a href="{{route('user.lottery.checkout')}}" class="btn-pok w-100">Proceed to Checkout <i class="fa-solid fa-angle-right"></i></a>
            </div>
        </div>
    </div>
    @endif

    @include('layouts.partials.footer')

    @stack('scripts')

</body>

</html>