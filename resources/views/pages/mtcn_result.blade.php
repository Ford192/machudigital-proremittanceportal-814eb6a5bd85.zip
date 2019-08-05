@extends('layouts.master-page')

@section('content')
<!-- MAIN -->
	<div class="main">
		<!-- MAIN CONTENT -->
		<div class="main-content">
			<div class="container-fluid">
				<h3 class="page-title">Dashboard</h3>
				<div class="row">
					<div class="col-md-8">
						<!-- PANEL HEADLINE -->
						<div class="panel panel-headline">
							<div class="panel-heading">
								<h3 class="panel-title">Results for MTCN - {{ $resp['transaction']['partner_id']}}</h3>
								<!-- <p class="panel-subtitle">Panel to display most important information</p> -->
							</div>
							<div class="panel-body">
								<table class="table" border="1" style="width:100%">
									<tr>
										<th colspan="2">Transaction Details</th>
									</tr>
									<tr>
										<td>Transaction ID</td>
										<td><h4>{{ $resp['transaction']['id'] }}</h4></td>
									</tr>
									<tr>
										<td>External ID</td>
										<td><h4>{{ $resp['transaction']['extr_id'] }}</h4></td>
									</tr>
									<tr>
										<td>Amount</td>
										<td><h4>{{ $resp['transaction']['receiving_currency'] .' '.$resp['transaction']['amount_payout'] }}</h4></td>
									</tr>
									<tr>
										<td>Service Type</td>
										<td><h4>{{ $resp['transaction']['service_type'] }}</h4></td>
									</tr>
									<tr>
										<td>Purpose</td>
										<td><h4>{{ $resp['transaction']['purpose'] }}</h4></td>
									</tr>
									<tr>
										<td>Mobile Account</td>
										<td><h4>{{ $resp['transaction']['mobile_account'] }}</h4></td>
									</tr>
									<tr>
										<th colspan="2">Reciever's  Details</th>
									</tr>
									<tr>
										<td>Name</td>
										<td><h4>{{ $resp['transaction']['lastname'].' '.$resp['transaction']['firstname'] }}</h4></td>
									</tr>
									<tr>
										<td>Reciever's location</td>
										<td><h4>{{ $resp['transaction']['receiving_country'] }}</h4></td>
									</tr>
									<tr>
										<td>Reciever's Currency</td>
										<td><h4>{{ $resp['transaction']['receiving_currency'] }}</h4></td>
									</tr>
									<tr>
										<th colspan="2">Sender's  Details</th>
									</tr>
									<tr>
										<td>Name</td>
										<td><h4>{{ $resp['transaction']['sender_lastname'].' '.$resp['transaction']['sender_firstname'] }}</h4></td>
									</tr>
									<tr>
										<td>location</td>
										<td><h4>{{ $resp['transaction']['sending_country'] }}</h4></td>
									</tr>
									<tr>
										<td>Reciever's Currency</td>
										<td><h4>{{ $resp['transaction']['receiving_currency'] }}</h4></td>
									</tr>
								</table>
								<a href="{{ url('/mtcn/redeem/'.$resp['transaction']['partner_id'].'/save/') }}" class="btn btn-primary">Accept</a>
							</div>
						</div>
						<!-- END PANEL HEADLINE -->
					</div>
					<div class="col-md-4">
						<!-- PANEL WITH FOOTER -->
						<div class="panel">
							<div class="panel-heading">
								<h3 class="panel-title">Search for MCTN</h3>
								<div class="right">
									<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
								</div>
								<!-- <p class="panel-subtitle">Panel to display most important information</p> -->
							</div>
							<div class="panel-body">
								<form method="post" action="{{ route('mtcn_number_search')}}">
									@csrf
								  <div class="form-group">
								    <!-- <label for="exampleInputEmail1">Email address</label> -->
								    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Eeg. 123333333">
								    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
								  </div>
								  <button type="submit" class="btn btn-primary">Submit</button>
								</form>
							</div>
						</div>
						<!-- END PANEL WITH FOOTER -->
					</div>
				</div>
			</div>
		</div>
		<!-- END MAIN CONTENT -->
	</div>
	<!-- END MAIN -->
@endsection

@section('added_scripts')
	  <script src="{{ url('/scripts/klorofil-common.js') }}"></script>
@endsection
