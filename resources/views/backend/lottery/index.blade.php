@extends('layouts.backend.backend-dashboard')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.min.css">
@endpush

@section('title','Lottery')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.lottery.create') }}">
                                <button class="mx-1 btn btn-primary">Create Lottery</button>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Lottery Master Name</th>
                                            <th class="text-center">Lottery Open at</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $lottery)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center"><a href="{{route('admin.lottery.edit',['lottery_id' => $lottery->id])}}">{{ $lottery->lotteryMaster->lottery_name }}</a></td>
                                            <td class="text-center">{{ $lottery->expires_on }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.lottery.show', ['lottery_id' => $lottery->id]) }}">
                                                    <button class="btn btn-primary">Show Lottery</button>
                                                </a>
                                                <a href="{{ route('admin.lottery.showChosenNumbers', ['lotteryId' => $lottery->id]) }}">
                                                    <button class="btn btn-primary">Users submissions</button>
                                                </a>
                                            </td>
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