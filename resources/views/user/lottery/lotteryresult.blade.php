@extends('layouts.user.user-dashboard')
@section('css')
<style>
    .winning-number {

        position: relative;
        background-color: #fff;
        border-radius: 20px;

        box-shadow: 0px 0px 5px #ccc;
        overflow: hidden;
        height: 400px;
        display: grid;
        place-items: center;

    }

    .winning-number .popper {
        position: absolute;
        width: 100%;
        height: 400px;
        object-fit: cover;
    }

    .open-number {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(223.14deg, #e8ae3d -17.3%, #f44a33 101.56%);
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: 600;
        color: #fff;
        animation: customAni 5s;
        animation-fill-mode: forwards;
        position: relative;


    }

    @keyframes customAni {
        0% {
            animation-timing-function: ease-in;
            opacity: 1;
            transform: translateY(450px) scale(0.1);
            color: transparent;
        }

        24% {
            opacity: 1;
        }

        40% {
            animation-timing-function: ease-in;
            transform: translateY(24px) scale(1);
        }

        65% {
            animation-timing-function: ease-in;
            transform: translateY(12px);
        }

        82% {
            animation-timing-function: ease-in;
            transform: translateY(6px);
            color: transparent;
        }

        93% {
            animation-timing-function: ease-in;
            transform: translateY(4px);
        }

        25%,
        55%,
        75%,
        87% {
            animation-timing-function: ease-out;
            transform: translateY(0px);
        }

        100% {
            animation-timing-function: ease-out;
            opacity: 1;
            transform: translateY(0px) scale(2);
            color: #fff;
            box-shadow: 0px 0px 10px #ccc;
        }
    }

    .winning-status {
        margin: 20px 0px;
        background: #fff;
        padding: 20px;
        border-radius: 20px;
        box-shadow: 0px 0px 5px #ccc;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .choosen-number {
        display: flex;
        justify-content: space-around;
    }

    .choosen-number span {
        box-shadow: 0px 7px 9px rgba(29, 122, 143, 0.25);
        font-weight: 500;
        font-size: 18px;
        letter-spacing: 0.03em;
        color: #fff;
        border-color: transparent;
        background: linear-gradient(223.14deg, #f44a33 -17.3%, #e8ae3d 101.56%);
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        margin-right: 10px;
    }

    .emoji-icon {
        width: 35px;
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
                @if($equalNumbers)
                <div class="col-md-6">
                    <div class="winning-number">
                        <img class="popper" src="{{asset('assets/img/lottery/popper.gif')}}" alt="">
                        @foreach($equalNumbers as $numbers)
                        <span class="open-number">{{$numbers}}</span>
                        @endforeach
                    </div>
                    <div class="winning-status">
                        <div class="choosen-number">
                            @foreach($equalNumbers as $numbers)
                            <span>{{$numbers}}</span>
                            @endforeach

                        </div>
                        <div class="choose-status">
                            <b>Congratuation, You Won</b>

                        </div>
                        <div class="choosen-emoji">
                            <img class="emoji-icon" src="{{asset('assets/img/lottery/popper-emoji.gif')}}" alt="">
                        </div>

                    </div>
                </div>
                @endif

                <div class="col-md-6">
                    @if(empty($equalNumbers))
                    <div class="winning-status">
                        <div class="choosen-number">
                            @foreach($winning_number as $wNumber)
                            <span>{{$wNumber}}</span>
                            @endforeach
                        </div>
                        <div class="choose-status">
                            <b>Better Luck Next Time.</b>

                        </div>
                        <div class="choosen-emoji">
                            <img class="emoji-icon" src="{{asset('assets/img/lottery/thumbsup-emoji.gif')}}" alt="">
                        </div>
                    </div>
                    @endif
                </div>
            </div>


        </div>
    </div>
</div>

@endsection