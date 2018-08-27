@extends('layouts.master-page')

@section('content')
<div class="main">
  <!-- MAIN CONTENT -->
  <div class="main-content">
    <div class="container-fluid">
      <!-- OVERVIEW -->
      <div class="panel panel-headline">
        <div class="panel-heading">
          <h3 class="panel-title">
            @if(Auth::user()->bank == 0)
              Welcome to the Dashboard

            @else
              Welcome to {{\App\Bank::findOrfail(Auth::user()->bank)->name }} Dashboard
            @endif
          </h3>
          <p class="panel-subtitle">{{ date('l, d M Y') }}</p>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-3">
              <div class="metric">
                <span class="icon"><i class="fa fa-users"></i></span>
                <p>
                  <span class="number">{{ \App\User::where('bank',Auth::user()->bank)->count() }}</span>
                  <span class="title">Users</span>
                </p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="metric">
                <span class="icon"><i class="fa fa-shopping-bag"></i></span>
                <p>
                  <span class="number">{{ DB::table('transactions')->join('users','transactions.bank_officer','users.id'
)->join('banks','banks.id','users.bank')->where('banks.id',Auth::user()->bank)->count() }}</span>
                  <span class="title">Remitance Processed</span>
                </p>
              </div>
            </div>
            <!-- <div class="col-md-3">
              <div class="metric">
                <span class="icon"><i class="fa fa-eye"></i></span>
                <p>
                  <span class="number">274,678</span>
                  <span class="title">Visits</span>
                </p>
              </div>
            </div> -->
          </div>
        </div>
      </div>
      <!-- END OVERVIEW -->
    </div>
  </div>
  <!-- END MAIN CONTENT -->
</div>
@endsection

@section('added_scripts')
  <script src="{{ url('/scripts/klorofil-common.js') }}"></script>
  <script src="{{ url('/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
  <script src="{{ url('/vendor/chartist/js/chartist.min.js') }}"></script>
  <script src="{{ url('/js/new_script.js') }}"></script>
@endsection
