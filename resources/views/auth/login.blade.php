@extends('layouts.master')

@section('content')
<!-- breadcrumb begin  -->
<div class="breadcrumb-pok">
    <img class="br-shape-left" src="{{ asset('assets/img/breadcrumb/left-bg.png') }}" alt="">
    <img class="br-shape-right" src="{{ asset('assets/img/breadcrumb/right-bg.png') }}" alt="">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8">
                <div class="breadcrumb-content">
                    <span class="subtitle">Sign In</span>
                    <h2 class="title">Sign In to enter, if you've an account</h2>
                    <div class="page-links">
                        <ul>
                            <li>
                                <a href='index.html'>Home</a>
                            </li>
                            <li>
                                <span class="current-page">Sign In</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end  -->

<!-- sign-in begin -->
<div class="sign-in">
    <div class="container">
        <div class="row justify-content-lg-between justify-content-center">
            <div class="col-xl-5 col-lg-6">
                <div class="poklotto-form">
                    <h3 class="title">Login to proceed further</h3>
                    <div class="part-form">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="row">
                                @if($errors->any())
                                    {!! implode('', $errors->all('<span class="text text-danger text-center">:message</span>')) !!}
                                @endif    
                                <div class="col-xl-12">
                                    <label for="mobile" class="form-label">Mobile Number</label>
                                    <input type="text" name="mobile" id="mobile" placeholder="Ex: 1234567890">
                                </div>
                                <div class="col-xl-12">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" >
                                </div>
                            </div>
                            <div class="part-submit">
                                <button class="btn-pok" type="submit">
                                    sign In <i class="fa-solid fa-angle-right"></i>
                                </button>
                                <p>No account yet in Poklotto?
                                    <a class='reg-link' href='{{ route('auth.register') }}'>Register</a> here to signup.</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-5 col-md-8 col-sm-10 d-xl-flex d-lg-flex d-block align-items-center">
                <div class="part-right">
                    <div class="part-img">
                        <img src="{{ asset('assets/img/sign-in/sign-in-img.png') }}" alt="">
                    </div>
                    <div class="part-text">
                        <div class="section-title">
                            <h3 class="sub-title">Welcome to Online lottery platform</h3>
                            <h2 class="title">Sign in and pick lucky number with just one click.</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- sign-in end -->

@endsection