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
                    <p id="lottery_master"><b>Lottery Master:</b> <a href="{{ route('admin.lottery.show', ['lottery_id' => $lottery->id]) }}">{{ $lottery->lotteryMaster->lottery_name }}</a></p>
                    <p><b>Lottery Opens at:</b> {{ $lottery->expires_on }}</p>
                </div>
            </div>


            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">User submissions:</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Mobile Number</th>
                                        <th>Selected Number</th>
                                        <th>Count</th>
                                        <th>Price</th>
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItemByLotteryId as $data)
                                    @php
                                    $user = App\Models\User::find($data->user_id);
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->mobile }}</td>
                                        <td>{{ $data->checked_lottery_numbers }}</td>
                                        <td>{{ $data->checked_winning_quantity }}</td>
                                        <td>{{ $data->price }}</td>
                                        <td>{{ $data->amount }}</td>
                                    </tr>
                                    @endforeach
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