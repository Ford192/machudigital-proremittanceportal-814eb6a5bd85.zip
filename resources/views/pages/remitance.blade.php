@extends('layouts.master-page')

@section('content')

<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">

				@if(session('status'))
					<div class="alert alert-{{session('status')}} alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						<i class="fa fa-check-circle"></i> {{ session('message')}}
					</div>
				@endif

					<h3 class="page-title" >Remitance</h3>

          <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter_bank">
            <i class="fa fa-plus"> </i> Add a Bank
          </button> -->
					<br>
					<br>
          <!-- <p class="btn btn-warning"><i class="fa fa-plus"> </i> Add a Bank</p> -->
					<div class="row">
            @if(isset($transx))
              @foreach($transx as $rem)
                <div class="col-md-6">
      						<!-- PANEL WITH FOOTER -->
      						<div class="panel">
      							<div class="panel-heading">
      								<h3 class="panel-title label">MTCN :{{ $rem->mtcn }}</h3>
      								<div class="right">
      									<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
      									<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
      								</div>
      								<!-- <p class="panel-subtitle">Panel to display most important information</p> -->
      							</div>
      							<div class="panel-body">
      								<h4><span class="text-primary">Transaction ID :</span><b>{{ $rem->transaction_id }}</b></h4>
      								<h4><span class="text-primary">Receiver Name :</span><b>{{ $rem->rec_name }}</b></h4>
      								<h4><span class="text-primary">ID Type :</span><b>{{ $rem->rec_id_type }}</b></h4>
      								<h4><span class="text-primary">ID Number :</span><b>{{ $rem->rec_id_number }}</b></h4>
      								<h4><span class="text-primary">Country :</span><b>{{ $rem->rec_country }}</b></h4>
      								<h4><span class="text-primary">Gender :</span><b>{{ $rem->rec_gender }}</b></h4>
      								<h4><span class="text-primary">Receiver Tel :</span><b>{{ $rem->rec_tel }}</b></h4>
      								<h4><span class="text-primary">Receiver DOB :</span><b>{{ $rem->dob }}</b></h4>
      								<h4><span class="text-primary">Sender Name :</span><b>{{ $rem->s_name }}</b></h4>
      								<h4><span class="text-primary">Sender Location :</span><b>{{ $rem->s_location }}</b></h4>
      								<h4><span class="text-primary">Amount :</span><b>{{ $rem->amount }}</b></h4>
      								<h4><span class="text-primary">Currency Receiving :</span><b>{{ $rem->rec_currency }}</b></h4>
      								<h4><span class="text-primary">Service Type :</span><b>{{ $rem->service_type }}</b></h4>
      								<h4><span class="text-primary">Purpose :</span><b>{{ $rem->purpose }}</b></h4>
      								<h4><span class="text-primary">Mobile Account :</span><b>{{ $rem->mobile_account }}</b></h4>
      								<h4><span class="text-primary">Bank Officer :</span><b>{{ \App\User::find($rem->bank_officer)->name }}</b></h4>
      								<h4><span class="text-primary">Created_at :</span><b>{{ $rem->created_at->toDayDateTimeString() }}</b></h4>
      								<!-- <h4><span class="text-primary">Name :</span><b>How are u</b></h4> -->
      							</div>
      						</div>
      						<!-- END PANEL WITH FOOTER -->
      					</div>
              @endforeach

					</div>
          {{ $transx->links() }}
          @endif
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>

@endsection

@section('added_scripts')
  <script src="{{ url('/scripts/klorofil-common.js') }}"></script>
@endsection
