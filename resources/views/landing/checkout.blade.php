@extends('layouts.master')


@section('content')
<div class="container p-4">
    <div class="row">
        <div class="col-md-6">
            <h2 class="mb-5">Checkout</h2>
            <div class="checkout-wrapper">
                <div class="checkout-item">
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
                </div>
<div class="checkout-item">
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
                </div>
            </div>
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
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Stake</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>1</td>
                            <td>45</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Total</th>
                            <th></th>
                            <th>45</th>
                        </tr>
                    </tfoot>
                </table>
                <button class="btn-pok w-100 mt-4">Complete Checkout</button>
            </div>
        </div>
    </div>

</div>
@endsection


