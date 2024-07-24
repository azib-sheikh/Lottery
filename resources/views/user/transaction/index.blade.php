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
                        <li class="breadcrumb-item active">Transaction</li>
                    </ol>
                </div>
            </div>

            <div class="row" id="items-container">

                @if($user_transactions)
                @foreach($user_transactions as $transaction)
                <div class="col-md-6">
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
                </div>

                @endforeach
                @endif

            </div>
            <div class="text-center">
                <button class="btn btn-primary" data-page="2" id="load-more-button">Load More</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#load-more-button').on('click', function() {
            var button = $(this);
            var page = button.data('page');

            $.ajax({
                url: "{{ route('user.transaction.load-more') }}",
                method: 'GET',
                data: {
                    page: page
                },
                success: function(response) {
                    console.log(response);
                    // Append the new items to the container
                    // response.user_transactions.forEach(function(item) {
                    //     $('#items-container').append('<div class="item">' + item.name + '</div>');
                    // });

                    $('#items-container').append(response.user_transactions);

                    // Update the page number for the next request
                    button.data('page', page + 1);

                    // Hide the button if there are no more pages
                    if (!response.hasMorePages) {
                        button.hide();
                    }
                }
            });
        });
    });
</script>

@endsection