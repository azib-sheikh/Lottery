@extends('layouts.backend.backend-dashboard')


@section('content')


<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-sm-6">
                    <h1>Welcome, {{ Auth::user()->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <a href="{{ route('admin.users.index') }}" class="small-box-footer">
                        <div class="info-box bg-gradient-light">
                            <span class="info-box-icon"><i class="far fa-user"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Users</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <a href="" class="small-box-footer">
                        <div class="info-box bg-gradient-info">
                            <span class="info-box-icon"><i class="far fa-question"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Question and Answers</span>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <!-- small box -->
                        <a href="" class="small-box-footer">
                            <div class="info-box bg-gradient-success">
                                <span class="info-box-icon"><i class="fa-solid fa-pen"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">11 Niyam</span>
                                </div>
                            </div>
                        </a>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <!-- small box -->
                    <a href="" class="small-box-footer">
                        <div class="info-box bg-gradient-warning">
                            <span class="info-box-icon"><i class="fa-solid fa-person-praying"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Tap</span>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <a href="" class="small-box-footer">
                        <div class="info-box bg-gradient-secondary">
                            <span class="info-box-icon"><i class="fa-solid fa-mobile"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Contact Us</span>
                            </div>
                        </div>
                    </a>

                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
        </div> <!-- container fluid ends -->
    </div>
</div>
    
@endsection