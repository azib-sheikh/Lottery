@extends('layouts.user.user-dashboard')

@section('css')
    <style>
        .transaction-card {
            padding: 20px;
            border-bottom: 1px solid #ccc5;
        }

        .trans-info {
            width: 70%;
            display: flex;
        }

        .trans-amount {
            width: 30%;
            display: flex;
            justify-content: flex-end;
        }

        .trans-icon i {
            padding: 10px;
            margin-right: 10px;
            color: #fff;
            background: linear-gradient(223.14deg, #F44A33 -17.3%, #E8AE3D 101.56%);
            border-radius: 5px;
        }

        .content-wrapper {
            background: #fff;
        }

        .transaction-foot {
            display: flex;
            justify-content: space-between;
            padding-left: 39px;

        }

        .trans-view .link-btn {
            color: #ff7033;
            position: relative;
            padding-right: 25px;
            cursor: pointer;
            transition: all 300ms ease-in;

        }

        .trans-view .link-btn:hover {
            padding-right: 30px;
        }

        .trans-view .link-btn::after {
            content: '\f061';
            /* Unicode for the Font Awesome user icon */
            font-family: 'Font Awesome 6 Free';
            width: 20px;
            height: 20px;
            position: absolute;
            right: 0px;
            font-weight: 900;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">

                {{-- Breadcrumb --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <a href="{{ route('user.dashboard') }}">
                            <button class="btn btn-primary">Go back to Dashboard</button>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Lottery</li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    @foreach ($data as $lottery)
                        <div class="col-md-6">
                            <div class="transaction-card">
                                <div class="d-flex">
                                    <div class="trans-info">
                                        <div class="trans-icon">
                                            <i class="fa-solid fa-indian-rupee-sign"></i>
                                        </div>
                                        <div class="trans-data">
                                            <strong class="d-block">{{ $lottery->lotteryMaster->lottery_name }}</strong>
                                            <i class="text-dark">{{ \Carbon\Carbon::parse($lottery->created_at)->format('d-m-Y') }}</i>
                                        </div>

                                    </div>
                                    <div class="trans-amount">
                                        <div>
                                            <strong class="d-block">+$1,000</strong>
                                            <i class="text-success">Winning Price</i>
                                        </div>
                                    </div>
                                </div>
                                <div class="transaction-foot">
                                    <div class="trans-id">
                                        <strong>Price per Entry:</strong>
                                        <i>$50</i>
                                    </div>
                                    <div class="trans-view">
                                        <a class="link-btn" href="{{ route('user.lottery.chooseNumbers',['lotteryId' => $lottery->id ]) }}">Choose Number</a>
                                        <a class="link-btn" href="{{ route('user.lottery.showChosenNumbers',['lotteryId' => $lottery->id]) }}">Show</a>

                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


            </div>
        </div>
    </div>
@endsection
