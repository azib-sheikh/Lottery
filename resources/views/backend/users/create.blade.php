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
                            <a href="{{ route('admin.users.index') }}">
                                <button class="btn btn-primary">Go Back</button>
                            </a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.users.store') }}" method="post" id="createLotteryForm">
                                @csrf

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" />
                                </div>
                                <div class="form-group">
                                    <label for="name">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" />
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile: (Without Country Code)</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" value="{{old('mobile')}}" />
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" />
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
<script src="{{ asset('assets/js/jquery.datetimepicker.full.js') }}"></script>

<script>
    jQuery('#datetime').datetimepicker({
        format: 'd-m-Y H:i'
    });
</script>

@endpush