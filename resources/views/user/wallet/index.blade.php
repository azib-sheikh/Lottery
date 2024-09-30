@extends('layouts.user.user-dashboard')

@section('css')
<style>
    .transaction-card {
        padding: 20px;
        border-bottom: 1px solid #ccc5;
    }

    .trans-info {
        width: 70%;
        display: flex;
    }

    .trans-amount {
        width: 30%;
        display: flex;
        justify-content: flex-end;
    }

    .trans-icon i {
        padding: 10px;
        margin-right: 10px;
        color: #fff;
        background: linear-gradient(223.14deg, #F44A33 -17.3%, #E8AE3D 101.56%);
        border-radius: 5px;
    }

    .content-wrapper {
        background: #fff;
    }

    .transaction-foot {
        display: flex;
        justify-content: space-between;
        padding-left: 39px;

    }

    .trans-view .link-btn {
        color: #ff7033;
        position: relative;
        padding-right: 25px;
        cursor: pointer;
        transition: all 300ms ease-in;

    }

    .trans-view .link-btn:hover {
        padding-right: 30px;
    }

    .trans-view .link-btn::after {
        content: '\f061';
        /* Unicode for the Font Awesome user icon */
        font-family: 'Font Awesome 6 Free';
        width: 20px;
        height: 20px;
        position: absolute;
        right: 0px;
        font-weight: 900;
    }

    .my-balance {
        background-color: #fff;
        border-radius: 20px;
        padding: 30px 20px;
        box-shadow: 0px 0px 5px #ccc;
    }

    .wallet-amount h4 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 25px;
    }

    .all-transaction {
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

                <div class="col-md-6 p-3">
                    <div class="my-balance">
                        <p class="mb-1">Avaiable Balance</p>
                        <div class="wallet-amount">
                            <h4>Rs {{$user['walletBalance']}}</h4>
                        </div>

                        <hr>
                        <div class="recent-transaction">
                            <p class="m-0 font-bold">Recent Transaction</p>
                            @if($user)
                            @if($user['user_transactions'])
                            @foreach($user['user_transactions'] as $transaction)
                            <div class="transaction-card">
                                <div class="d-flex">
                                    <div class="trans-info">
                                        <div class="trans-icon">
                                            <i class="fa-solid fa-indian-rupee-sign"></i>
                                        </div>
                                        <div class="trans-data">
                                            @if($transaction['action'] == 1)
                                            <strong class="d-block">Deposit</strong>
                                            @elseif($transaction['action'] == 2)
                                            <strong class="d-block">Withdrawal</strong>
                                            @elseif($transaction['action'] == 3)
                                            <strong class="d-block">Buy Lotter</strong>
                                            @endif
                                            <i class="text-dark">{{date('d-m-Y',strtotime($transaction['created_at']))}}</i>
                                        </div>

                                    </div>
                                    <div class="trans-amount">
                                        <div>
                                            <strong class="d-block">{{$transaction['amount']}}</strong>

                                            @if($transaction['status'] == 1)
                                            <strong class="text-success">Success</strong>
                                            @elseif($transaction['status'] == 2)
                                            <strong class="text-success">Reject</strong>
                                            @elseif($transaction['status'] == 3)
                                            <strong class="text-success">Pending</strong>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="transaction-foot">
                                    <div class="trans-id">
                                        <strong>Ref:</strong>
                                        <i>{{$transaction['payment_reference_number']}}</i>
                                    </div>

                                </div>
                            </div>
                            @endforeach
                            @endif
                            @endif
                            <!-- <div class="transaction-card">
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
                            </div> -->
                        </div>
                        <div class="all-transaction">
                            <a class="d-block" href="{{route('user.transaction.index')}}">View All Transaction</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-3">
                    <div class="my-balance ">
                        <ul class="nav nav-pills mb-3 position-relative" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-deposit" role="tab" aria-controls="pills-deposit" aria-selected="true">Deposit Money</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-withdraw" role="tab" aria-controls="pills-withdraw" aria-selected="false">Withdraw Money</a>
                            </li>

                            <div class="pay-toggle">
                                <input type="checkbox" name="ccpay" id="ccpay" hidden>
                                <label for="ccpay" class="toggle-pay"></label>
                            </div>

                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-deposit" role="tabpanel" aria-labelledby="pills-deposit-tab">
                                <div class="money-form bank-transfer">
                                    
                                    <form action="{{route('user.wallet.deposit-amount')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-5">
                                            <div class="col-8 mb-3">
                                                <label for="">Banking QR <br>Scan to pay</label>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="qr-container">
                                                    <img src="{{asset('assets/img/qrcode.png')}}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-md-8 mb-3">
                                                <label for="">Enter Amount</label>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <input class="form-control" type="number" name="deposit_amount" id="" required>
                                            </div>
                                             <div class="col-md-8 mb-3">
                                                <label for="">Reference Number</label>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <input class="form-control" type="text" name="payment_reference_number" id="" placeholder="Payment Reference Number" required>
                                            </div>
                                             <div class="col-md-8 mb-3">
                                                <label for="">Payment Slip </label>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <input hidden class="form-control" type="file" name="payment_image" id="slipSS" accept="image/x-png,image/gif,image/jpeg" required>
                                                <label id="fileLabel" class="input-label" for="slipSS">Browse File</label>
                                            </div>
                                        </div>
                                        <button class="btn-pok mid" type="submit">Deposit Money</button>
                                    </form>
                                </div>
                                <div class="money-form payment-gateway d-none">
                                    
                                    <form action="{{route('user.wallet.deposit-amount')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-5">
                                           
                                            <div class="col-md-8 mb-3">
                                                <label for="">Enter Amount</label>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <input class="form-control" type="number" name="deposit_amount" id="" required>
                                            </div>
                                             
                                            <div class="col-12 mt-3">
                                                Pay with UPI or Credit Debit cards
                                            </div>
                                        </div>
                                        <button class="btn-pok mid" type="submit">Deposit Money</button>
                                    </form>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="pills-withdraw" role="tabpanel" aria-labelledby="pills-withdraw-tab">
                                <div class="money-form ">
                                    <form action="{{route('user.wallet.withdraw-amount')}}" method="POST">
                                        @csrf
                                        <div class="row mb-5">
                                            <div class="col-md-8">
                                                <label for="">Enter Amount</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input class="form-control" type="number" name="withdraw_amount" id="" required>
                                            </div>
                                            <div class="col-12 text-right mt-2">
                                                <p><b>Balance </b>Rs {{$user['walletBalance']}}</p>
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
@section('script')

<script>
    document.getElementById('slipSS').addEventListener('change', function() {
        var fileInput = document.getElementById('slipSS');
        var fileLabel = document.getElementById('fileLabel');

        if (fileInput.files.length > 0) {
            var fileName = fileInput.files[0].name;
            if (fileName.length > 10) {
                fileName = fileName.substring(0, 8) + '...';  // Show first 10 letters and add '...'
            }
            fileLabel.textContent = fileName;
        } else {
            fileLabel.textContent = 'Browse File';  // Reset label if no file is selected
        }
    });
 var toggleInput = document.querySelector('#ccpay'); 
    toggleInput.addEventListener('change', function() {
        if (toggleInput.checked) { 
            document.querySelector('.bank-transfer').classList.add('d-none');
            document.querySelector('.payment-gateway').classList.remove('d-none');
        } else {
            document.querySelector('.bank-transfer').classList.remove('d-none');
            document.querySelector('.payment-gateway').classList.add('d-none');
        }
    });


</script>

@endsection