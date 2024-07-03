@extends('layouts.master')
<?php

if ($lottery->isNotEmpty()) {

    $lottery_id = $lottery[0]->id;
} else {
    $lottery_id = 0;
}
?>


@section('content')
<div class="banner">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6">
                <div class="banner-content">
                    <h4 class="sub-title">passionate to online lotto?</h4>
                    <h1 class="title">choose a <span class="special">quick pick</span> for <span class="b-spc">Lotto
                            online</span></h1>
                    <div class="all-btns">
                        <a class='btn-pok' href='{{ route('landing.lottery') }}'>Play Lottery <i class="fa-solid fa-angle-right"></i></a>
                        <a class='btn-pok-2' href='{{ route('landing.about-us') }}'>Explore More <i class="fa-solid fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-8 col-sm-9 d-xl-flex d-lg-flex d-block align-items-end">
                <div class="part-img">
                    <img class="main-img" src="{{ asset('assets/img/banner-img.png') }}" alt="">
                    <img src="{{ asset('assets/img/power-ball.png') }}" alt="" class="power-ball pok-1">
                    <img src="{{ asset('assets/img/power-ball3.png') }}" alt="" class="power-ball pok-3">
                    <img src="{{ asset('assets/img/power-ball4.png') }}" alt="" class="power-ball pok-4">
                    <img src="{{ asset('assets/img/power-ball5.png') }}" alt="" class="power-ball pok-5">
                    <img src="{{ asset('assets/img/power-ball2.png') }}" alt="" class="power-ball pok-2">
                </div>
            </div>
        </div>
    </div>
</div>


<div class="lotteries">
    <div class="bg-shape-2">
        <img src="{{ asset('assets/img/bg-shape/bg-shape-2.png') }}" alt="">
    </div>
    <div class="bg-shape-1">
        <img src="{{ asset('assets/img/bg-shape/bg-shape-1.png') }}" alt="">
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
                            <!-- <div class="part-lottery-function-btn mt-2">
                                <div class="nav nav-pills" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-info-tab" data-bs-toggle="pill" data-bs-target="#pills-info" type="button" role="tab" aria-controls="pills-info" aria-selected="false">Prizes & info</button>
                                    </li>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div style="font-size: 34px;line-height: 44px;font-weight: 600;margin-top: -11px;margin-bottom: 2px; color: white">
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
</div>


{{-- Below section is static --}}
<div class="about">
    <img src="{{ asset('assets/img/bg-shape/bg-shape-3.png') }}" alt="" class="bg-shape-3">
    <img src="{{ asset('assets/img/bg-shape/bg-shape-4.png') }}" alt="" class="bg-shape-4">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-4 d-xl-flex d-lg-flex d-block align-items-end justify-content-end">
                <div class="part-img">
                    <img class="main-img" src="{{ asset('assets/img/about/about-img.png') }}" alt="">
                    <img class="bg-img" src="{{ asset('assets/img/about/img-2.png') }}" alt="">
                    <img class="shape-img" src="{{ asset('assets/img/about/img-1.png') }}" alt="">
                    <img src="{{ asset('assets/img/about/ball-1.png') }}" alt="" class="ball-1">
                    <img src="{{ asset('assets/img/about/ball-2.png') }}" alt="" class="ball-2">
                </div>
            </div>
            <div class="col-xl-8 col-lg-8">
                <div class="about-text">
                    <div class="section-title for-about-section">
                        <h3 class="sub-title">About us</h3>
                        <h2 class="title">We provide best Mega jackpot</h2>
                    </div>
                    <div class="part-bottom">
                        <div class="part-statics">
                            <div class="single-statics">
                                <div class="part-icon">
                                    <img src="{{ asset('assets/img/about/icon-1.png') }}" alt="">
                                </div>
                                <div class="part-txt">
                                    <span class="number">25.3k</span>
                                    <span class="text">players</span>
                                </div>
                            </div>
                            <div class="single-statics">
                                <div class="part-icon">
                                    <img src="{{ asset('assets/img/about/icon-2.png') }}" alt="">
                                </div>
                                <div class="part-txt">
                                    <span class="number">46+</span>
                                    <span class="text">lotteries</span>
                                </div>
                            </div>
                            <div class="single-statics">
                                <div class="part-icon">
                                    <img src="{{ asset('assets/img/about/icon-3.png') }}" alt="">
                                </div>
                                <div class="part-txt">
                                    <span class="number">270+</span>
                                    <span class="text">jackpot</span>
                                </div>
                            </div>
                        </div>
                        <div class="part-descr">
                            <p>Problem set compensation the harmonics, understood.
                                Hundreds times, of until they employed sure a behind boundless their for
                                boss's the certainly and gilded form of tend every of better an over when of
                                than an are until time. <span class="txt-bold">Would of impenetrable</span>
                                just the out diesel as it near at that.
                            </p>
                            <ul>
                                <li>He of his in its price always and feedback of films.</li>
                                <li>towards sight as not and each and, good.</li>
                                <li>tone, the of preparations never a even viable a.</li>
                            </ul>
                            <a class='btn-pok' href='{{ route('landing.about-us') }}'>Know more <i class="fa-solid fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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



<div class="working-process">
    <img src="assets/img/bg-shape/bg-shape-3.png" alt="" class="bg-shape-3">
    <img src="assets/img/bg-shape/wp-shape-2.png" alt="" class="wp-bg-shape-2">
    <img src="assets/img/bg-shape/wp-shape-3.png" alt="" class="wp-bg-shape-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8">
                <div class="section-title">
                    <h3 class="sub-title">How it works</h3>
                    <h2 class="title">easiest way to picking a number</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-sm-6">
                <div class="single-process">
                    <div class="part-icon">
                        <img src="assets/img/working-process/icon-1.png" alt="">
                    </div>
                    <div class="part-text">
                        <span class="step-number">1.</span>
                        <span class="step-title">Set a budget.</span>
                        <p>Playing the lottery is gambling, so keep it fun by treating it as part of your entertainment
                            budget.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-sm-6">
                <div class="single-process pp-2">
                    <div class="part-text">
                        <span class="step-title">Choose your lottery.</span>
                        <p>There are 5 exciting draw-based jackpot you can try one or all of them.
                            like powerball etc.</p>
                        <span class="step-number two">2.</span>
                    </div>
                    <div class="part-icon">
                        <img src="assets/img/working-process/icon-2.png" alt="">
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-sm-6">
                <div class="single-process">
                    <div class="part-icon">
                        <img src="assets/img/working-process/icon-3.png" alt="">
                    </div>
                    <div class="part-text">
                        <span class="step-number">3.</span>
                        <span class="step-title">Pick your numbers.</span>
                        <p>Since it’s all by chance, enjoy picking your numbers or seeing what the lottery terminal
                            generates.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-sm-6">
                <div class="single-process pp-2">
                    <div class="part-text">
                        <span class="step-title">Check your numbers.</span>
                        <p>If you are a winner, claim your prize: be sure to visit a retailer before your prize expires
                            in 12 months.</p>
                        <span class="step-number four">4.</span>
                    </div>
                    <div class="part-icon">
                        <img src="assets/img/working-process/icon-4.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="feature">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-8 col-md-8">
                <div class="part-left">
                    <div class="section-title">
                        <h3 class="sub-title">Why we are best</h3>
                        <h2 class="title">We are proud to provide best services to our clients</h2>
                    </div>
                    <div class="part-img">
                        <img class="main-img" src="assets/img/feature/feature-img.png" alt="">
                        <img class="bg-img" src="assets/img/about/img-2.png" alt="">
                    </div>
                </div>
            </div>
            <div class="col-xl-7 col-lg-12">
                <div class="feature-list">
                    <div class="row">
                        <div class="col-xl-6 col-lg-4 col-md-6 col-sm-6">
                            <div class="single-feature">
                                <div class="part-icon">
                                    <img src="assets/img/feature/icon-1.png" alt="">
                                </div>
                                <div class="part-text">
                                    <span class="title">SSL security layer</span>
                                    <p>it's the standard technology for keeping an internet connection secure and
                                        safeguarding any sensitive.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-4 col-md-6 col-sm-6">
                            <div class="single-feature">
                                <div class="part-icon">
                                    <img src="assets/img/feature/icon-2.png" alt="">
                                </div>
                                <div class="part-text">
                                    <span class="title">Quick Notifications</span>
                                    <p>When you’ve successfully matched enough numbers to win a prize, we notify you via
                                        email and/or SMS</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-4 col-md-6 col-sm-6">
                            <div class="single-feature">
                                <div class="part-icon">
                                    <img src="assets/img/feature/icon-3.png" alt="">
                                </div>
                                <div class="part-text">
                                    <span class="title">No Lost Tickets</span>
                                    <p>Since it’s all by chance, enjoy picking your numbers or seeing what the lottery
                                        terminal generates.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-4 col-md-6 col-sm-6">
                            <div class="single-feature">
                                <div class="part-icon">
                                    <img src="assets/img/feature/icon-4.png" alt="">
                                </div>
                                <div class="part-text">
                                    <span class="title">No Long Lines</span>
                                    <p>Since it’s all by chance, enjoy picking your numbers or seeing what the lottery
                                        terminal generates.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-4 col-md-6 col-sm-6">
                            <div class="single-feature">
                                <div class="part-icon">
                                    <img src="assets/img/feature/icon-5.png" alt="">
                                </div>
                                <div class="part-text">
                                    <span class="title">Secure Payments</span>
                                    <p>Since it’s all by chance, enjoy picking your numbers or seeing what the lottery
                                        terminal generates.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-4 col-md-6 col-sm-6">
                            <div class="single-feature">
                                <div class="part-icon">
                                    <img src="assets/img/feature/icon-6.png" alt="">
                                </div>
                                <div class="part-text">
                                    <span class="title">24/7 friendly support</span>
                                    <p>Since it’s all by chance, enjoy picking your numbers or seeing what the lottery
                                        terminal generates.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
                var lotteryNumbersArray = $result['lotteryNumbersArray'];
                var lotteryWinningAmountArray = $result['lotteryWinningAmountArray'];
                var lottery_image = $result['lottery_image'];

                $('#lottery_name').html(lottery_name);
                $('#lottery_price').html(lottery_price);
                $('#lottery_image').attr('src', lottery_image);
                $('#expires_on').html("Lottery open at :" + expires_on);
                $('#lotteryNumbersArray').html(lotteryNumbersArray);
                $('#lotteryWinningAmountArray').html(lotteryWinningAmountArray);
                setDateForTimer(expires_on);
            }
        })
    }
</script>
<script>
    function setDateForTimer(expires_on) {

        const dt = new Date(expires_on);
        const padL = (nr, len = 2, chr = `0`) => `${nr}`.padStart(2, chr);
        console.log("expires_on=" + expires_on)
        // console.log("s=" + `${dt.getFullYear()}-${padL(dt.getDate())}-${padL(dt.getMonth()+1)} ${padL(dt.getHours())}:${padL(dt.getMinutes())}`);
        var countDownDateF = `${dt.getFullYear()}-${padL(dt.getDate())}-${padL(dt.getMonth()+1)} ${padL(dt.getHours())}:${padL(dt.getMinutes())}`;
        console.log("countDownDateF=" + countDownDateF)
        // Set the date we're counting down to
        // var countDownDate = new Date('2024-07-11 18:00').getTime();

        var countDownDate = new Date(countDownDateF).getTime();
        console.log("countDownDate=" + countDownDate)

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="multiTimer"
            document.getElementById("multiTimer").innerHTML = days + "d " + hours + "h " +
                minutes + "m " + seconds + "s ";

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("multiTimer").innerHTML = "Result declared!";
            }
        }, 1000);
    }

    function formatDate(date) {
        var d = new Date(date),
            day = '' + (d.getMonth() + 1),
            month = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [year, month, day].join('-');
    }
</script>
@endpush