@extends('layouts.backend.backend-dashboard')

@section('title','Edit Lottery Master')

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
                            <form action="{{ route('admin.lottery.update') }}" method="post" id="editeLotteryForm">
                                @csrf

                                <input type="hidden" name="lottery_id" value="{{$lottery->id}}">
                                <div id="numbers_section" class="form-group">
                                    <label for="">Lottery Name</label>
                                    <input type="text" id="" readonly value="{{$lottery->lotteryMaster->lottery_name}}" class="form-control">
                                    <br>
                                    <label for="winning_number">Winning Number(Ex: 1,2,3)</label>
                                    <input type="text" id="winning_number" name="winning_number" value="{{$lottery->winning_number ?$lottery->winning_number :''}}" class="form-control" required>
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
        format: 'd-m-Y H:i'
    });
</script>

@endpush