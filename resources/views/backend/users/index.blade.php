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
                                <div class="card-title"><b>Users</b></div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="usertable">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Profile Picture</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Mobile</th>
                                                <th class="text-center">Gender</th>
                                                <th class="text-center">Creation Date</th>
                                                <th class="text-center">Date of Birth</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $user)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td class="text-center">
                                                        @if ($user->profile_picture)
                                                            <img src="{{ asset($user->profile_picture) }}"
                                                                alt="Profile Picture"
                                                                style="max-width: 50px; max-height: 50px;">
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{ $user->name }}</td>
                                                    <td class="text-center">{{ $user->email }}</td>
                                                    <td class="text-center">{{ $user->mobile }}</td>
                                                    <td class="text-center">{{ $user->gender }}</td>
                                                    <td class="text-center">{{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y g:i A') }}</td>
                                                    <td class="text-center">{{ $user->date_of_birth }}</td>
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
            $("#usertable").DataTable({
                // "responsive": true,
                // "lengthChange": false,
                "autoWidth": false,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            });
        });
    </script>
@endpush
