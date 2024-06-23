@extends('layouts.backend.backend-dashboard')

@section('title','Create Lottery Master')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.datetimepicker.css') }}">
@endpush


@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('admin.lottery.index') }}">
                                    <button class="btn btn-primary">Go Back</button>
                                </a>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.lottery.store') }}" method="post" id="createLotteryForm">
                                    @csrf
                                    <div class="form-group">
                                        <label for="lottery_master_id">Choose Lottery Master:</label>
                                        <select name="lottery_master_id" id="lottery_master_id" class="form-control" >
                                            <option value="">Choose Lottery Master</option>
                                            @foreach ($lotteryMaster as $item)
                                                <option value="{{ $item->id }}">{{ $item->lottery_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="expires_on">Expiration Date and Time::</label>
                                        <input type="text" class="form-control" id="datetime" name="expires_on" />
                                    </div>
                                
                                    <div id="numbers_section" class="form-group">
                                        <label for="start_number">Start Number:</label>
                                        <input type="number" id="start_number" name="start_number" class="form-control">
                                        <br>
                                        <label for="end_number">End Number:</label>
                                        <input type="number" id="end_number" name="end_number" class="form-control">
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\CreateLotteryRequest', '#createLotteryForm') !!}
<script src="{{ asset('assets/js/jquery.datetimepicker.full.js') }}"></script>

<script>
    jQuery('#datetime').datetimepicker({
        format:'d-m-Y H:i'
    });
</script>

@endpush
