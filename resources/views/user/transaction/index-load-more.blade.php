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