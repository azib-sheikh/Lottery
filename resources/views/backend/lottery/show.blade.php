@extends('layouts.backend.backend-dashboard')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.min.css">
@endpush

@section('title','Show Lottery')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Lottery Numbers</h1>
                </div>
                <div class="card-body text-center">
                    <p id="lottery_master"><b>Lottery Master:</b> <a href="{{route('admin.lottery.showChosenNumbers', ['lotteryId' => $lottery->id])}}">{{ $lottery->lotteryMaster->lottery_name }}</a></p>
                    <p><b>Lottery Opens at:</b> {{ $lottery->expires_on }}</p>
                </div>
            </div>


            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">Numbers:</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <tbody>
                                    @php
                                    $totalNumbers = count($lottery->lotteryNumbers);
                                    $columns = ceil(sqrt($totalNumbers));
                                    $numbersPerColumn = ceil($totalNumbers / $columns);
                                    @endphp

                                    @for ($i = 0; $i < $numbersPerColumn; $i++)
                                        <tr>
                                        @for ($j = 0; $j < $columns; $j++)
                                            @php $index=$i + $j * $numbersPerColumn;
                                            @endphp
                                            @if ($index < $totalNumbers)
                                            @if($numberCounts && array_key_exists($lottery->lotteryNumbers[$index]->number,$numberCounts))
                                            <td>{{ $lottery->lotteryNumbers[$index]->number }} X {{$numberCounts[$lottery->lotteryNumbers[$index]->number]}} times</td>
                                            @else
                                            <td>{{ $lottery->lotteryNumbers[$index]->number }} X (0 times)</td>
                                            @endif
                                            @endif
                                            @endfor
                                            </tr>
                                            @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection