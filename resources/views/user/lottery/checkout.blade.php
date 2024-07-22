@extends('layouts.master')


@section('content')
<div class="container p-4">
  <div class="row">
    <div class="col-md-6">
      <h2 class="mb-5">Checkout</h2>
      <div class="checkout-wrapper">
        @foreach(App\Http\Helpers\CartHelper::getAllProductFromCart() as $data)
        @php
        $lottery = App\Models\Lottery::where('id',$data['lottery_id'])->first();
        @endphp
        <div class="checkout-item">
          <div class="lottery-info">
            <span class="lottery-icon">
              <img src="{{ asset($lottery->lotteryMaster->lottery_image) }}" alt="">
            </span>
            <span class="lottery-name">{{$lottery->lotteryMaster->lottery_name}}</span>
          </div>
          <div class="lottery-prices">
            Selected
            @foreach(explode(',',$data['checked_lottery_numbers']) as $checked_lottery_numbers)
            <button class="single-number selected" id="34">{{$checked_lottery_numbers}}</button>
            @endforeach
            <i class="fa fa-xmark"></i>
            <span class="qty-num">{{$data['checked_winning_quantity']}}</span>
          </div>

          <span class="item-close"><i class="fa fa-xmark"></i></span>
        </div>
        <!-- <div class="checkout-item">
          <div class="lottery-info">
            <span class="lottery-icon">
              <img src="{{asset('assets/img/lottery/euro-jackpot.png')}}" alt="">
            </span>
            <span class="lottery-name">Lottery name</span>
          </div>
          <div class="lottery-prices">
            Selected
            <button class="single-number selected" id="34">
              34
            </button> <i class="fa fa-xmark"></i>
            <span class="qty-num">1</span>
          </div>

          <span class="item-close"><i class="fa fa-xmark"></i></span>
        </div> -->
      </div>
      @endforeach
      <div class="mt-5">
        <a href="{{url('/')}}" class="back-link"><i class="fa fa-chevron-left me-2"></i>Back</a>

      </div>
    </div>
    <div class="col-md-6">
      <h2 class="ms-3">Billing Details</h2>
      <div class="checkout-bill mt-5">
        <table class="checkout-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Qty</th>
              <th>Price</th>
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
              <th>Total</th>
              <th></th>
              <th>{{App\Http\Helpers\CartHelper::totalCartPrice()}}</th>
            </tr>
          </tfoot>
        </table>
        <button class="btn-pok w-100 mt-4">Complete Checkout</button>
      </div>
    </div>
  </div>

</div>
@endsection