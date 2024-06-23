@extends('layouts.user.user-dashboard')

@section('css')
    <style>
        .position-relative {
            position: relative;
            display: inline-block;
            /* Ensure it only takes as much space as the image */
        }

        .camera-icon {
            position: absolute;
            bottom: 5px;
            /* Adjust this value as needed */
            right: 5px;
            /* Adjust this value as needed */
            background: #ffffff;
            /* Change background color if needed */
            border-radius: 50%;
            /* To make it circular */
            padding: 5px;
            /* Adjust padding as needed */
            cursor: pointer;
        }
    </style>
@endsection


@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">

                {{-- Breadcrumb --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <a href="{{ route('user.dashboard') }}">
                            <button class="btn btn-primary">Go back</button>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Edit Profile</li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                @php
                                    $profilePicPath = is_null($user->profile_picture) || empty($user->profile_picture) 
                                                      ? asset('profile.png') 
                                                      : asset($user->profile_picture);
                                @endphp
                                <form action="{{ route('user.profile.update') }}" method="POST" id="profileForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="text-center">
                                        <div class="position-relative">
                                            <img src="{{ $profilePicPath }}" alt="" class="profile-user-img img-fluid img-circle">
                                            <label for="profile_picture">
                                                <i class="fa fa-camera camera-icon" aria-hidden="true"></i>
                                            </label>
                                            <input type="file" class="d-none" name="profile_picture" id="profile_picture" accept="image/x-png,image/gif,image/jpeg">
                                        </div>
                                        @error('profile_picture')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <h3 class="profile-username text-center">{{ $user->name }}</h3>
                                    <p class="text-muted text-center">Member since {{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</p>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <label for="email"><b>Email</b></label>
                                            <input type="text" class="float-right form-control input-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}">
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </li>
                                        <li class="list-group-item">
                                            <label for="mobile"><b>Mobile Number</b></label>
                                            <input type="text" class="float-right form-control input-sm" name="mobile" value="{{ old('mobile', $user->mobile) }}" readonly>
                                        </li>
                                        <li class="list-group-item">
                                            <label for="pan"><b>PAN Number</b></label>
                                            <input type="text" class="float-right form-control input-sm @error('pan') is-invalid @enderror" name="pan" value="{{ old('pan', $user->additionalDetail->pan_number ?? '') }}">
                                            @error('pan')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </li>
                                        <li class="list-group-item">
                                            <label for="account_number"><b>Account Number</b></label>
                                            <input type="text" class="float-right form-control input-sm @error('account_number') is-invalid @enderror" name="account_number" value="{{ old('account_number', $user->additionalDetail->account_number ?? '') }}">
                                            @error('account_number')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </li>
                                        <li class="list-group-item">
                                            <label for="ifsc_code"><b>IFSC Code</b></label>
                                            <input type="text" class="float-right form-control input-sm @error('ifsc_code') is-invalid @enderror" name="ifsc_code" value="{{ old('ifsc_code', $user->additionalDetail->ifsc_code ?? '') }}">
                                            @error('ifsc_code')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </li>
                                        <li class="list-group-item">
                                            <label for="verificationDoc"><b>Verification Document</b></label>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <select name="verification_document_type" class="form-control" id="verification_document_type">
                                                        <option value="">Choose verification document type</option>
                                                        <!-- Populate options based on your available document types -->
                                                        <option value="aadhar_card" {{ old('verification_document_type', $user->additionalDetail->verification_document_type ?? '') == 'aadhar_card' ? 'selected' : '' }}>Aadhar Card</option>
                                                        <option value="pan_card" {{ old('verification_document_type', $user->additionalDetail->verification_document_type ?? '') == 'pan_card' ? 'selected' : '' }}>Pan Card</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="file" id="verificationDoc" name="verificationDoc" class="form-control input-sm @error('verificationDoc') is-invalid @enderror">
                                                    @error('verificationDoc')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                @if(!is_null($user->additionalDetail) || !empty($user->additionalDetail) )
                                                    <div class="col-md-2">
                                                        <a href="{{ asset($user->additionalDetail->verification_document_path) }}" target="_blank">
                                                            <i class="fa-solid fa-download"></i>
                                                        </a>
                                                    </div>
                                                @else  
                                                    <div class="col-md-2">
                                                        <span class="text-danger">No document uploaded</span>
                                                    </div>  
                                                @endif
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="row">
                                        <div class="col-md-3 mx-auto">
                                            <button type="submit" class="btn btn-primary">Update Profile</button>
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
