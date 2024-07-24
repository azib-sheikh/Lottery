@extends('layouts.backend.backend-dashboard')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.min.css">
@endpush


@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><b>Transaction</b></div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="usertable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Amount</th>
                                            <th class="text-center">Payment reference number</th>
                                            <th class="text-center">Action</th>
                                            <th class="text-center">Mode of payment</th>
                                            <th class="text-center">Payment image</th>
                                            <th class="text-center">Created at</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($user_transactions)
                                        @foreach ($user_transactions as $transactions)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $transactions->user->name }}</td>
                                            <td class="text-center">{{ $transactions->user->email }}</td>
                                            <td class="text-center">{{ $transactions->amount }}</td>

                                            <td class="text-center">{{ $transactions->payment_reference_number }}</td>
                                            @if($transactions['action'] == 1)
                                            <td class="text-center">Deposit</td>
                                            @elseif($transactions['action'] == 2)
                                            <td class="text-center">Withdrawal</td>
                                            @elseif($transactions['action'] == 3)
                                            <td class="text-center">Buy Lotter</td>
                                            @endif


                                            @if($transactions['mode_of_payment'] == 0)
                                            <td class="text-center">Not define</td>
                                            @elseif($transactions['mode_of_payment'] == 1)
                                            <td class="text-center">QR Code to deposit amount</td>
                                            @elseif($transactions['mode_of_payment'] == 2)
                                            <td class="text-center">neft/rtgs/imps to deposit amount</td>
                                            @elseif($transactions['mode_of_payment'] == 3)
                                            <td class="text-center">Wallet to buy lottery </td>
                                            @endif

                                            <td class="text-center">
                                                @if($transactions->payment_image)
                                                <img src="{{asset($transactions->payment_image)}}" style="max-width: 50px; max-height: 50px;">
                                                @endif
                                            </td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($transactions->created_at)->format('d-m-Y g:i A') }}</td>

                                            @if($transactions['status'] == 1)
                                            <td class="text-center">Success</td>
                                            @elseif($transactions['status'] == 2)
                                            <td class="text-center">Reject</td>
                                            @elseif($transactions['status'] == 3)
                                            <td class="text-center">
                                                <button type="button" class="btn btn-default update_status" data-id="{{$transactions['id']}}" data-toggle="modal">
                                                    Pending
                                                </button>
                                            </td>
                                            @endif


                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal start here -->
<div class="modal fade" id="modal-accept-reject">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update status</h4>
                <button type="button" class="close close-modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Want to update&hellip;</p>
            </div>
            <input type="hidden" id="transactions_id">
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default close-modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="confirmUpdate('accept')">Accept</button>
                <button type="button" class="btn btn-primary" onclick="confirmUpdate('reject')">Reject</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Modal end here -->
@endsection

@push('scripts')
<script src="{{ asset('assets/adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.min.js"></script>

<script>
    $('.update_status').on('click', function() {
        var tranId = $(this).data('id');
        $('#modal-accept-reject').show();
        $('#modal-accept-reject').removeClass('fade');
        $('#transactions_id').val(tranId);
    });

    $('.close-modal').on('click', function() {
        $('#modal-accept-reject').hide();
        $('#modal-accept-reject').addClass('fade');
    });

    $(function() {
        $("#usertable").DataTable({
            // "responsive": true,
            // "lengthChange": false,
            "autoWidth": false,
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });
</script>
@endpush