@extends('layouts.backend.backend-dashboard')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.min.css">
@endpush

@section('title','Lottery Master')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.lotteryMaster.create') }}">
                                <button class="mx-1 btn btn-primary">Create Lottery Master</button>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Winning Amount</th>
                                            <th class="text-center">Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $lotteryMaster)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $lotteryMaster->lottery_name }}</td>
                                            <td class="text-center">{{ $lotteryMaster->lottery_price }}</td>
                                            <td class="text-center">
                                                <?php
                                                if ($lotteryMaster->lottery_type == 1) {
                                                    echo "Single";
                                                } else {
                                                    echo "Multiple";
                                                }

                                                ?>

                                            </td>
                                            <td class="text-center">{{ $lotteryMaster->lottery_winning_amount }}</td>
                                            <td class="text-center">{{ $lotteryMaster->description }}</td>
                                        </tr>
                                        @endforeach
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
@endsection

@push('scripts')
<script src="{{ asset('assets/adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(function() {
        $("#table").DataTable({
            // "responsive": true,
            // "lengthChange": false,
            "autoWidth": false,
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });
</script>
@endpush