@extends('layouts.user.user-dashboard')

@section('css')
    <style>
          .transaction-card{
            padding: 20px;
   border-bottom: 1px solid #ccc5;
        }
        .trans-info{
            width: 70%;
            display: flex;
        }
        .trans-amount{
            width: 30%;
    display: flex;
    justify-content: flex-end;
        }
        .trans-icon i{
            padding: 10px;
            margin-right: 10px;
            color: #fff;
            background: linear-gradient(223.14deg, #F44A33 -17.3%, #E8AE3D 101.56%);
            border-radius: 5px;
        }
        .content-wrapper{
            background: #fff;
        }
        .transaction-foot{
            display: flex;
            justify-content: space-between;
            padding-left: 39px;
            
        }
        .trans-view .link-btn{
           color: #ff7033;
           position: relative;
           padding-right: 25px;
           cursor: pointer;
           transition: all 300ms ease-in;
           
        }
        .trans-view .link-btn:hover{
            padding-right: 30px;
        }
         .trans-view .link-btn::after{
            content: '\f061'; /* Unicode for the Font Awesome user icon */
                font-family: 'Font Awesome 6 Free'; 
            width: 20px;
            height: 20px;
            position: absolute;
            right: 0px;
            font-weight: 900;
         }
       .my-balance{
        background-color: #fff;
        border-radius:20px; 
        padding: 30px 20px;
        box-shadow: 0px 0px 5px #ccc;
       }
       
       .wallet-amount h4{
font-size: 32px;
font-weight: 700;
margin-bottom: 25px;
       }
       .all-transaction{
        margin-top: 15px;
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
                        <button class="btn btn-primary">Go back to Dashboard</button>
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">My Wallet</li>
                    </ol>
                </div>
            </div>

            <div class="row mt-5">
               
                <div class="col-md-6">
                  <div class="my-balance">
                    <p class="mb-1">Avaiable Balance</p>
                    <div class="wallet-amount">
                        <h4>$3000</h4>   
                    </div>
                    
                    <hr>
                    <div class="recent-transaction">
                        <p class="m-0 font-bold">Recent Transaction</p>
                         <div class="transaction-card">
                        <div class="d-flex">
                            <div class="trans-info">
                                <div class="trans-icon">
                                    <i class="fa-solid fa-indian-rupee-sign"></i>
                                </div>
                                <div class="trans-data">
                                <strong class="d-block">Amount Paid</strong>
                                 <i class="text-dark">10-12-24
                                </i> 
                                </div>
                               
                            </div>
                            <div class="trans-amount">
                                <div>
                                <strong class="d-block">900
                                    
                                </strong>
                                <i class="text-success">Credited</i>
                                </div>
                            </div>
                        </div>
                        <div class="transaction-foot">
                            <div class="trans-id">
                                <strong>Ref:</strong>
                                <i>Acw8u2xNEfg</i>
                            </div>
                            
                           
                        </div>
                    </div>
                    <div class="transaction-card">
                        <div class="d-flex">
                            <div class="trans-info">
                                <div class="trans-icon">
                                    <i class="fa-solid fa-indian-rupee-sign"></i>
                                </div>
                                <div class="trans-data">
                                <strong class="d-block">Amount Paid</strong>
                                 <i class="text-dark">10-12-24
                                </i> 
                                </div>
                               
                            </div>
                            <div class="trans-amount">
                                <div>
                                <strong class="d-block">900
                                    
                                </strong>
                                <i class="text-success">Credited</i>
                                </div>
                            </div>
                        </div>
                        <div class="transaction-foot">
                            <div class="trans-id">
                                <strong>Ref:</strong>
                                <i>Acw8u2xNEfg</i>
                            </div>
                            
                           
                        </div>
                    </div>
                    <div class="transaction-card">
                        <div class="d-flex">
                            <div class="trans-info">
                                <div class="trans-icon">
                                    <i class="fa-solid fa-indian-rupee-sign"></i>
                                </div>
                                <div class="trans-data">
                                <strong class="d-block">Amount Paid</strong>
                                 <i class="text-dark">10-12-24
                                </i> 
                                </div>
                               
                            </div>
                            <div class="trans-amount">
                                <div>
                                <strong class="d-block">900
                                    
                                </strong>
                                <i class="text-success">Credited</i>
                                </div>
                            </div>
                        </div>
                        <div class="transaction-foot">
                            <div class="trans-id">
                                <strong>Ref:</strong>
                                <i>Acw8u2xNEfg</i>
                            </div>
                            
                           
                        </div>
                    </div>
                    <div class="transaction-card">
                        <div class="d-flex">
                            <div class="trans-info">
                                <div class="trans-icon">
                                    <i class="fa-solid fa-indian-rupee-sign"></i>
                                </div>
                                <div class="trans-data">
                                <strong class="d-block">Amount Paid</strong>
                                 <i class="text-dark">10-12-24
                                </i> 
                                </div>
                               
                            </div>
                            <div class="trans-amount">
                                <div>
                                <strong class="d-block">900
                                    
                                </strong>
                                <i class="text-success">Credited</i>
                                </div>
                            </div>
                        </div>
                        <div class="transaction-foot">
                            <div class="trans-id">
                                <strong>Ref:</strong>
                                <i>Acw8u2xNEfg</i>
                            </div>
                            
                           
                        </div>
                    </div>
                    <div class="transaction-card">
                        <div class="d-flex">
                            <div class="trans-info">
                                <div class="trans-icon">
                                    <i class="fa-solid fa-indian-rupee-sign"></i>
                                </div>
                                <div class="trans-data">
                                <strong class="d-block">Amount Paid</strong>
                                 <i class="text-dark">10-12-24
                                </i> 
                                </div>
                               
                            </div>
                            <div class="trans-amount">
                                <div>
                                <strong class="d-block">900
                                    
                                </strong>
                                <i class="text-success">Credited</i>
                                </div>
                            </div>
                        </div>
                        <div class="transaction-foot">
                            <div class="trans-id">
                                <strong>Ref:</strong>
                                <i>Acw8u2xNEfg</i>
                            </div>
                            
                           
                        </div>
                    </div>
                    </div>
                    <div class="all-transaction">
                        <a class="d-block" href="">View All Transaction</a>
                    </div>
                  </div>
                </div>
               <div class="col-md-6 p-md-3">
                <div class="my-balance w">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-deposit" role="tab" aria-controls="pills-deposit" aria-selected="true">Deposit Money</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-withdraw" role="tab" aria-controls="pills-withdraw" aria-selected="false">Withdraw Money</a>
  </li>
 
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-deposit" role="tabpanel" aria-labelledby="pills-deposit-tab">
<div class="money-form ">
    <form action="">
        <div class="row mb-5">
            <div class="col-8">
                <label for="">Enter Amount</label>
            </div>
            <div class="col-4">
                <input class="form-control" type="number" name="" id="">
            </div>
        </div>
        <button class="btn-pok mid" type="submit">Deposit Money</button>
    </form>
</div>

  </div>
  <div class="tab-pane fade" id="pills-withdraw" role="tabpanel" aria-labelledby="pills-withdraw-tab">
    <div class="money-form ">
    <form action="">
        <div class="row mb-5">
            <div class="col-8">
                <label for="">Enter Amount</label>
            </div>
            <div class="col-4">
                <input class="form-control" type="number" name="" id="">
            </div>
        </div>
        <button class="btn-pok mid" type="submit">Withdraw Money</button>
    </form>
</div>
  </div>
  
</div>
                </div>
               </div>
            </div>
        </div>
    </div>
</div>

@endsection