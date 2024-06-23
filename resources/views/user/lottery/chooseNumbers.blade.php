@extends('layouts.user.user-dashboard')

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
                <div class="col-md-12">
                    <card class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="card-title">Selected Number in this lottery:</div>
                        </div>
                        <div class="card-body">
                            {{ implode(',',$selectedNumbers) }}
                        </div>
                    </card>
                    <div class="card card-primary card-outline">
                       <div class="card-header">
                            <div class="card-title"><b>Today Lottery, choose numbers</b></div>
                       </div>
                       <div class="card-body">
                        <form id="lottery-form" action="{{ route('user.lottery.checkout') }}" method="POST">
                            @csrf
                            <input type="hidden" name="lotteryId" value="{{ $lottery->id }}">
                            <input type="hidden" name="lotteryMasterId" value="{{ $lottery->lottery_master_id }}">

                            <div class="row">
                                @php
                                    $numbers = $lottery->lotteryNumbers;
                                    $numbers = $numbers->whereNotIn('number', $selectedNumbers);
                                    // dd($numbers->whereNotIn('number', $selectedNumbers))
                                @endphp
                                @foreach($numbers as $number)
                                <div class="col-md-2">
                                    <label>
                                        <input type="checkbox" name="numbers[]" value="{{ $number->number }}">
                                        {{ $number->number }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                       </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

@endsection