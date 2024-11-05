@extends('layouts.master')

<?php

if ($lottery->isNotEmpty()) {

    $lottery_id = $lottery[0]->id;
} else {
    $lottery_id = 0;
}
?>

@section('content')
<!-- breadcrumb begin  -->
<div class="breadcrumb-pok">
    <img class="br-shape-left" src="assets/img/breadcrumb/left-bg.png" alt="">
    <img class="br-shape-right" src="assets/img/breadcrumb/right-bg.png" alt="">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8">
                <div class="breadcrumb-content">
                    <span class="subtitle">Lotteries</span>
                    <h2 class="title">Quick Pick or Choose Your Own Numbers</h2>
                    <div class="page-links">
                        <ul>
                            <li>
                                <a href='index.html'>Home</a>
                            </li>
                            <li>
                                <span class="current-page">Lotteries</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end  -->

<!-- lottery begin -->
<div class="lotteries">
    <div class="bg-shape-2">
        <img src="assets/img/bg-shape/bg-shape-2.png" alt="">
    </div>
    <div class="bg-shape-1">
        <img src="assets/img/bg-shape/bg-shape-1.png" alt="">
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                <div class="section-title">
                    <h3 class="sub-title">All lotteries</h3>
                    <h2 class="title">pick your lucky number</h2>
                </div>
            </div>
        </div>
        <div class="part-picking-number">
            <div class="lotteries-selection-menu">
                <ul>
                    @if($lottery->isNotEmpty())
                    <input type="hidden" id="set_lottery_id" value="">
                    @foreach($lottery as $data)
                    <li>
                        <a class="single-lottery-item active" lottery_id="{{$data->id}}" data-bs-toggle="tab" data-bs-target="#pills-numbers" type="button" role="tab">
                            <span class="lottery-icon">
                                <img src="{{ asset($data->lotteryMaster->lottery_image) }}" alt="">
                            </span>
                            <span class="lottery-name">{{ $data->lotteryMaster->lottery_name }}</span>
                        </a>
                    </li>
                    @endforeach
                    @endif
                    {{-- <li>
                            <a class="single-lottery-item" data-bs-toggle="tab" data-bs-target="#singleLottery"
                                type="button" role="tab">
                                <span class="lottery-icon">
                                    <img src="{{ asset('assets/img/lottery/euro-millions.png') }}" alt="">
                    </span>
                    <span class="lottery-name">Euro Millions</span>
                    </a>
                    </li> --}}
                </ul>
            </div>
            <div class="animation-body animated">
                <div class="picking-number-header">
                    <img src="{{ asset('assets/img/lottery/lottery-header-right-img.png') }}" alt="" class="lottery-bg-img">
                    <div class="part-lottery-info">
                        <div class="part-img selected-lottery-logo">
                            <img id="lottery_image" src="{{ asset('assets/img/lottery/euro-jackpot-big.') }}" alt="">
                        </div>
                        <div class="part-text">
                            {{--<span class="lottery-name">{{ $lottery->lotteryMaster->lottery_name }}</span>--}}
                            <span class="lottery-name" id="lottery_name"></span>
                            <span class="estimate-prize">Estimated prize : <span class="prize-amount" id="lottery_price">00</span></span>
                        </div>
                    </div>
                    <div class="cd-wrapper">
                        <span id="expires_on">{{--Lottery open at : {{ \Carbon\Carbon::parse($lottery->expires_on)->format('d-m-Y H:i') }}--}}</span>
                        <span id="multiTimer"></span>
                    </div>
                    {{-- <div class="part-lottery-function-btn">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-numbers-tab" data-bs-toggle="pill" data-bs-target="#pills-numbers" type="button" role="tab" aria-controls="pills-numbers" aria-selected="true">pick any 6 numbers</button>
                            </li>
                        </ul>
                    </div> --}}
                </div>
                <div class="picking-number-body">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-numbers" role="tabpanel" aria-labelledby="pills-numbers-tab">
                            <div class="picking-number-palate">
                                <div class="number-box common" id="lotteryNumbersArray">

                                </div>
                                <div class="number-box winning" id="lotteryWinningAmountArray">

                                </div>
                                {{--<div class="number-box common">
                                    @foreach ($lottery[0]->lotteryNumbers as $item)
                                    <button class="single-number">
                                        {{ $item->number }}
                                </button>
                                @endforeach
                            </div>--}}
                        </div>
                        {{--<div class="picking-number-result">
                            <div class="part-title">
                                <h3 class="title">Selected numbers:</h3>
                            </div>
                            <div class="result-number-palate">

                            </div>
                            <div class="picking-number-quick-buttons">
                                <button class="clear-btn" id="clear-all-numbers">Clear <i class="fa-solid fa-xmark"></i></button>
                                <button class="auto-select-btn" id="auto-select-btn">Auto select <i class="fa-solid fa-arrows-rotate"></i></button>
                            </div>
                        </div>--}}
                        <div class="picking-number-final-step">
                            <div class="part-text">
                                <p><span class="b-txt">Note :</span> Problem set compensation the harmonics,
                                    understood. Hundreds times,<br /> of until they employed sure a behind boundless
                                    their for.</p>
                            </div>
                            <div class="part-btn">
                                <button class='btn-pok' id="continueToCart">Continue to cart <i class="fa-solid fa-angle-right"></i></button>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="tab-pane fade" id="singleLottery" role="tabpanel"
                                aria-labelledby="pills-numbers-tab">
                                <div class="picking-number-palate">
                                    <div class="number-box special">
                                        <button class="single-number">
                                            01
                                        </button>
                                        <button class="single-number">
                                            02
                                        </button>
                                        <button class="single-number">
                                            03
                                        </button>
                                        <button class="single-number">
                                            04
                                        </button>
                                        <button class="single-number">
                                            05
                                        </button>
                                        <button class="single-number selected special">
                                            06
                                        </button>
                                        <button class="single-number">
                                            07
                                        </button>
                                        <button class="single-number">
                                            08
                                        </button>
                                        <button class="single-number">
                                            09
                                        </button>
                                        <button class="single-number">
                                            10
                                        </button>
                                        <button class="single-number">
                                            11
                                        </button>
                                        <button class="single-number">
                                            12
                                        </button>
                                        <button class="single-number">
                                            13
                                        </button>
                                        <button class="single-number">
                                            14
                                        </button>
                                        <button class="single-number">
                                            15
                                        </button>
                                        <button class="single-number">
                                            16
                                        </button>
                                        <button class="single-number">
                                            17
                                        </button>
                                        <button class="single-number">
                                            18
                                        </button>
                                        <button class="single-number">
                                            19
                                        </button>
                                        <button class="single-number">
                                            20
                                        </button>
                                    </div>
                                </div>
                                <div class="picking-number-result">
                                    <div class="part-title">
                                        <h3 class="title">Selected numbers:</h3>
                                    </div>
                                    <div class="result-number-palate">
                                        <button class="single-number selected" id="4">
                                            04
                                        </button>
                                        <button class="single-number selected" id="16">
                                            16
                                        </button>
                                        <button class="single-number selected" id="22">
                                            22
                                        </button>
                                        <button class="single-number selected" id="30">
                                            30
                                        </button>
                                        <button class="single-number selected" id="38">
                                            38
                                        </button>
                                        <button class="single-number selected special" id="06">
                                            06
                                        </button>
                                    </div>
                                    <div class="picking-number-quick-buttons">
                                        <button class="clear-btn" id="clear-all-numbers">Clear <i
                                                class="fa-solid fa-xmark"></i></button>
                                        <button class="auto-select-btn" id="auto-select-btn">Auto select <i
                                                class="fa-solid fa-arrows-rotate"></i></button>
                                    </div>
                                </div>
                                <div class="picking-number-final-step">
                                    <div class="part-text">
                                        <p><span class="b-txt">Note :</span> Problem set compensation the harmonics,
                                            understood. Hundreds times,<br /> of until they employed sure a behind boundless
                                            their for.</p>
                                    </div>
                                    <div class="part-btn">
                                        <a class='btn-pok' href='lotteries.html'>Continue to cart <i
                                                class="fa-solid fa-angle-right"></i></a>
                                    </div>
                                </div>
                            </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- lottery end -->

<!-- cta begin -->
<div class="cta">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-9 col-lg-9 col-sm-8 d-xl-flex d-lg-flex d-block align-items-center">
                <div class="part-text">
                    <h2 class="title">If you have any query about lottery or anything!</h2>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3">
                <div class="btn-cta">
                    <a class='btn-pok' href='contact.html'>Contact Us <i class="fa-solid fa-angle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- cta end -->
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        var lottery_id = "{{ $lottery_id }}";
        getLotteryData(lottery_id);
    });
    $(".single-lottery-item").on('click', function() {
        var lottery_id = $(this).attr('lottery_id');
        getLotteryData(lottery_id);

    });



    function getLotteryData(lottery_id = null) {
        $("#set_lottery_id").val(lottery_id);
        var url = "{{route('home.lottery_details_ajax')}}"
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                "_token": "{{csrf_token()}}",
                "lottery_id": lottery_id,
            },
            success: function($result) {
                console.log($result['lotteryWinningAmountArray'])
                var lottery_name = $result['lottery_name'];
                var lottery_price = $result['lottery_price'];
                var lottery_type = $result['lottery_type'];
                var lottery_winning_amount = $result['lottery_winning_amount'];
                var lottery_winning_amount = $result['lottery_winning_amount'];
                var expires_on = $result['expires_on'];
                var expires_on_timer = $result['expires_on_timer'];
                var lotteryNumbersArray = $result['lotteryNumbersArray'];
                var lotteryWinningAmountArray = $result['lotteryWinningAmountArray'];
                var lottery_image = $result['lottery_image'];

                $('#lottery_name').html(lottery_name);
                $('#lottery_price').html(lottery_price);
                $('#lottery_image').attr('src', lottery_image);
                $('#expires_on').html("Lottery open at : " + expires_on);
                $('#lotteryNumbersArray').html(lotteryNumbersArray);
                $('#lotteryWinningAmountArray').html(lotteryWinningAmountArray);
                setDateForTimer(expires_on_timer);
            }
        })
    }
</script>

<script>
    var countdown; // Declare a global variable to store the interval ID

    function setDateForTimer(expires_on_timer) {

        // Clear any existing interval to avoid multiple timers running simultaneously
        if (countdown) {
            clearInterval(countdown);
        }
        // Set the target date and time
        var targetDate = new Date(expires_on_timer).getTime();

        // Update the countdown every second
        countdown = setInterval(function() {
            // console.log('expires_on_timer=' + expires_on_timer);
            // console.log('targetDate=' + targetDate);
            // Get current date and time
            var now = new Date().getTime();

            // Calculate the time difference between now and the target date
            var remainingTime = targetDate - now;
            // console.log('remainingTime=' + remainingTime);
            // Calculate days, hours, minutes, and seconds
            var days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
            var hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

            // Display the result in the "timer" element
            document.getElementById("multiTimer").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

            // If the countdown is over, display a message and clear the interval
            if (remainingTime < 0) {
                clearInterval(countdown);
                document.getElementById("multiTimer").innerHTML = "EXPIRED";
            }
        }, 1000);
    }
</script>
@endpush