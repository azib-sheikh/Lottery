@extends('layouts.backend.backend-dashboard')

@section('title','Create Lottery Master')


@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('admin.lotteryMaster.index') }}">
                                    <button class="btn btn-primary">Go Back</button>
                                </a>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.lotteryMaster.store') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="quiz_name">Lottery Name</label>
                                            <input type="text" name="lottery_name" value="{{ old('lottery_name') }}" placeholder="Enter lottery Name" class="form-control" id="lottery_name" required>
                                            @error('lottery_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="start_date">Description</label>
                                            <textarea  required name="description" placeholder="Enter description" class="form-control" id="description" cols="30" rows="10" required>{{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="submit" value="Save" class="btn btn-success">
                                            </div>
                                        </div>
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
