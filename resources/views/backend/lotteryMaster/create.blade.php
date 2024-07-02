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
                            <form action="{{ route('admin.lotteryMaster.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="quiz_name">Lottery Name</label>
                                        <input type="text" name="lottery_name" value="{{ old('lottery_name') }}" placeholder="Enter lottery Name" class="form-control" id="lottery_name" required>
                                        @error('lottery_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="lottery_price">Lottery Price</label>
                                        <input type="text" name="lottery_price" value="{{ old('lottery_price') }}" placeholder="Enter lottery Price" class="form-control" id="lottery_price" required>
                                        @error('lottery_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="lottery_type">Lottery Type</label>
                                        <select name="lottery_type" id="lottery_type" class="form-control" required>
                                            <option value="">Choose Lottery Type</option>
                                            <option value='1'>Single</option>
                                            <option value='2'>Multiple</option>
                                        </select>
                                        @error('lottery_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="lottery_winning_amount">Winning Amount</label>
                                        <select name="lottery_winning_amount" id="lottery_winning_amount" class="form-control" required>
                                            <option value="">Choose Winning Amount</option>
                                            <option value='1'>X1</option>
                                            <option value='2'>X2</option>
                                            <option value='3'>X3</option>
                                            <option value='4'>X4</option>
                                            <option value='5'>X5</option>
                                            <option value='6'>X6</option>
                                        </select>
                                        @error('lottery_winning_amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="start_date">Description</label>
                                        <textarea required name="description" placeholder="Enter description" class="form-control" id="description" cols="30" rows="10" required>{{ old('description') }}</textarea>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="lottery_image">Lottery Image</label>
                                        <input type="file" name="lottery_image" value="" placeholder="Enter lottery Image" class="form-control" id="lottery_image" required>
                                        @error('lottery_image')
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