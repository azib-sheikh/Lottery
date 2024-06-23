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
                        <p id="lottery_master"><b>Lottery Master:</b> {{ $lottery->lotteryMaster->lottery_name }}</p>
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
                                            <th>Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($chosenNumbers as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->number }}</td>
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