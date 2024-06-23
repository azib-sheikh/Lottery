@extends('layouts.user.user-dashboard')
@section('content')
    {{-- put all the content inside content-wrapper class --}}
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <h1>Welcome, {{ Str::ucfirst(Auth::user()->name) }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Home</li>
                        </ol>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">

                                    @php
                                        if (is_null($user->profile_picture) || empty($user->profile_picture)) {
                                            $profilePicPath = asset('profile.png');
                                        } else {
                                            $profilePicPath = asset($user->profile_picture);
                                        }
                                    @endphp

                                    <img src="{{ $profilePicPath }}" alt=""
                                        class="profile-user-img img-fluid img-circle">
                                </div>
                                <h3 class="profile-username text-center">{{ $user->name }}</h3>
                                <p class="text-muted text-center">Member since
                                    {{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Mobile Number</b> <a class="float-right">{{ $user->mobile }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>PAN Number:</b> <a
                                            class="float-right">{{ $user->additionalDetail->pan_number ?? 'Not Uploaded' }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Account Number</b> <a
                                            class="float-right">{{ $user->additionalDetail->account_number ?? 'Not Uploaded' }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>IFSC Code</b> <a
                                            class="float-right">{{ $user->additionalDetail->ifsc_code ?? 'Not Uploaded' }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Supporting Document <span
                                                class="badge badge-primary">{{ $user->additionalDetail->verification_document_type ?? '' }}</span></b>
                                        <div class="float-right">
                                            @if (isset($user->additionalDetail->verification_document_path) &&
                                                    !is_null($user->additionalDetail->verification_document_path))
                                                <a target="_blank"
                                                    href="{{ asset($user->additionalDetail->verification_document_path) }}"><i
                                                        class="fa-solid fa-download"></i></a>
                                            @else
                                                Not uploaded
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                                <div class="row">
                                    <div class="col-md-3 mx-auto">
                                        <a href="{{ route('user.profile.edit') }}">
                                            <button class="btn btn-primary">Edit profile</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                    <a href="{{ route('user.lottery.index') }}" class="small-box-footer">
                                        <div class="info-box bg-gradient-success">
                                            <span class="info-box-icon"><i class="fa-solid fa-dice-d20"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Lotteries</span>
                                            </div>
                                        </div>
                                    </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <!-- small box -->
                                <a href="{{ route('user.transaction.index') }}" class="small-box-footer">
                                    <div class="info-box bg-gradient-warning">
                                        <span class="info-box-icon text-light"><i class="fa-solid fa-money-bill-transfer"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text text-light">My transactions</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <a href="#" class="small-box-footer">
                                    <div class="info-box bg-gradient-danger">
                                        <span class="info-box-icon"><i class="fa-solid fa-trophy"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">My Winnings</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>


            </div> <!-- container fluid ends -->
        </div>
    </div>
@endsection

@push('script')
@endpush
