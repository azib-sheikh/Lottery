@extends('layouts.master')

@section('content')

<!-- breadcrumb begin  -->
<div class="breadcrumb-pok">
    <img class="br-shape-left" src="assets/img/breadcrumb/left-bg.png" alt="">
    <img class="br-shape-right" src="assets/img/breadcrumb/right-bg.png" alt="">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8">
                <div class="breadcrumb-content">
                    <span class="subtitle">Sign Up</span>
                    <h2 class="title">Sign-up to create an account</h2>
                    <div class="page-links">
                        <ul>
                            <li>
                                <a href='index.html'>Home</a>
                            </li>
                            <li>
                                <span class="current-page">Sign Up</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end  -->

<!-- sign-up begin -->
<div class="sign-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-10">
                <div class="poklotto-form" id="poklotto_register_form">
                    <h3 class="steps-heading-title title">Getting started</h3>
                    <div class="part-form">
                        <form action="{{ route('register') }}" method="post" id="registerForm">
                            @csrf
                                    <div class="row">
                                        @if($errors->any())
                                            {!! implode('', $errors->all('<span class="text text-danger text-center">:message</span>')) !!}
                                        @endif 
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 my-1">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" id="name" class="" name="name" placeholder="Ex: John">
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 my-1">
                                            <label for="mail_address" class="form-label">Email:</label>
                                            <input type="email" id="mail_address" name="email" placeholder="Ex: yourmail@address">
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 my-1">
                                            <label for="mobile" class="form-label">Mobile: (without country code)</label>
                                            <input type="text" id="mobile" name="mobile"  placeholder="Ex: 8468921900">
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 my-1">
                                            <label for="password" class="form-label">Password:</label>
                                            <input type="password" id="password" name="password">
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 my-1">
                                            <label for="birth-date" class="form-label">Date of birth</label>
                                            <input type="date" id="birth-date" name="date_of_birth" class="form-control" placeholder="Ex: 19/05/98">
                                        </div>
                                    </div> 
                                    <div class="agreement-article">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" name="tnc">
                                            <label class="form-check-label" for="inlineCheckbox1">I accept the terms and conditions.</label>
                                        </div>
                                    </div>
                                    <input type="submit" value="Signup" class="form-control btn btn-sm btn-primary text-white">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- sign-up end -->

@endsection

@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\UserRegisterRequest', '#registerForm') !!}
@endpush
