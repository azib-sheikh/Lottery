@extends('layouts.user.user-dashboard')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">

            {{-- Breadcrumb --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <a href="{{ route('user.transaction.index') }}">
                        <button class="btn btn-primary">Go back to Transaction</button>
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Transaction Detail</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="card-title">Transaction Detail</div>
                        </div>
                        <div class="card-body">
                            <div class="invoice p-3 mb-3">
                                <!-- title row -->
                                <div class="row">
                                  <div class="col-12">
                                    <h4>
                                      <i class="fas fa-globe"></i> Lottery
                                      <small class="float-right">Date: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</small>
                                    </h4>
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                  <div class="col-sm-4 invoice-col">
                                    From
                                    <address>
                                      <strong>Lottery Admin</strong><br>
                                      New Delhi<br>
                                      Phone: +91-8468921900<br>
                                      Email: admin@lottery.com
                                    </address>
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-sm-4 invoice-col">
                                    To
                                    <address>
                                      <strong>{{ Str::ucfirst(Auth::user()->name) ?? '' }}</strong><br>
                                      New Delhi <br>
                                      Phone: {{ Auth::user()->mobile ?? '' }} <br>
                                      Email: {{ Auth::user()->email ?? '' }}
                                    </address>
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-sm-4 invoice-col">
                                    <b>Invoice #007612</b><br>
                                    <br>
                                    <b>Order ID:</b> 4F3S8J<br>
                                    <b>Payment Completed on:</b> 2/22/2014<br>
                                    <b>Account Number:</b> 123654789
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- /.row -->
                  
                                <!-- Table row -->
                                <div class="row">
                                  <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                      <thead>
                                      <tr>
                                        <th>Qty</th>
                                        <th>Product</th>
                                        <th>Description</th>
                                        <th>Subtotal</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <tr>
                                        <td>2</td>
                                        <td>Mega jackpot</td>
                                        <td>Win Mega jackpot lottery</td>
                                        <td>1000</td>
                                      </tr>
                                      <tr>
                                        <td>2</td>
                                        <td>Mini jackpot</td>
                                        <td>Win Mini jackpot lottery</td>
                                        <td>500</td>
                                      </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- /.row -->
                  
                                <div class="row">
                                  <!-- accepted payments column -->
                                  <div class="col-6">
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-6">
                                    {{-- <p class="lead">Amount Due 2/22/2014</p> --}}
                  
                                    <div class="table-responsive">
                                      <table class="table">
                                        <tr>
                                          <th style="width:50%">Subtotal:</th>
                                          <td>1500</td>
                                        </tr>
                                        <tr>
                                          <th>Tax (2%)</th>
                                          <td>300</td>
                                        </tr>
                                        <tr>
                                          <th>Total:</th>
                                          <td>1800</td>
                                        </tr>
                                      </table>
                                    </div>
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- /.row -->
                  
                                <!-- this row will not appear when printing -->
                                {{-- <div class="row no-print">
                                  <div class="col-12">
                                    <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                    <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                                      Payment
                                    </button>
                                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                      <i class="fas fa-download"></i> Generate PDF
                                    </button>
                                  </div>
                                </div>
                              </div> --}}
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
        $(document).ready( function () {
            $('#transactionTable').DataTable();
        } );
    </script>
@endsection