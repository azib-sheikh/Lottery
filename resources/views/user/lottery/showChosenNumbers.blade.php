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
                    <div class="card card-primary card-outline">
                       <div class="card-header">
                            <div class="card-title"><b>Today Lottery, choose numbers</b></div>
                       </div>
                       <div class="card-body">
                            <div class="row">
                                @foreach($chosenNumbers as $number)
                                <div class="col-md-2">
                                    <label>
                                        <input type="checkbox" name="numbers[]" value="{{ $number->number }}" checked disabled>
                                        {{ $number->number }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                       </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

@endsection