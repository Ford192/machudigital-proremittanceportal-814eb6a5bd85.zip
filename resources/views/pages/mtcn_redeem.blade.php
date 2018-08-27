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
								<h3 class="panel-title">Transaction Details</h3>
								<!-- <p class="panel-subtitle">Panel to display most important information</p> -->
							</div>
							<div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('mtcn_save') }}">
      						      @csrf
                  <div class="form-group">
      							<label for="inputEmail3" class="col-sm-4 control-label">Receiver's Name</label>
      							<div class="col-sm-8">
      								<input type="text" class="form-control" id="inputEmail3" value="{{session('trans_data')['lastname'].' '.session('trans_data')['firstname'] }}" name="recname" disabled>
      							</div>
      						</div>
      						<div class="form-group">
      							<label for="inputEmail3" class="col-sm-4 control-label">Receiver's ID Type</label>
      							<div class="col-sm-8">
      								<select class="form-control" id="inputEmail3" name="id_type" required>
      									<option value=" ">Select an ID</option>
      									<option value="Voter's ID">Voter's ID</option>
      									<option value="NHIS">NHIS</option>
      									<option value="Passport">Passport</option>
      									<option value="Drivers License">Drivers License</option>
      									<option value="National ID">National ID</option>
      									<option value="SSNIT">SSNIT</option>
      								</select>
      							</div>
      						</div>
      						<div class="form-group">
      							<label for="inputEmail3" class="col-sm-4 control-label">Receiver's ID Number</label>
      							<div class="col-sm-8">
      								<input type="text" class="form-control" id="inputEmail3" name="id_number" placeholder="eg. 67890" required>
      							</div>
      						</div>
      						<div class="form-group">
      							<label for="inputEmail3" class="col-sm-4 control-label">Receiver's Tel</label>
      							<div class="col-sm-8">
      								<input type="text" class="form-control" id="inputEmail3" name="phone" placeholder="02099888888 , 02477789999" required>
      							</div>
      						</div>
      						<div class="form-group">
      							<label for="inputEmail3" class="col-sm-4 control-label">Receiver's Location</label>
      							<div class="col-sm-8">
      								<input type="text" class="form-control" id="inputEmail3" name="rec_location" value="{{session('trans_data')['receiving_country'] }}" disabled>
      							</div>
      						</div>
      						<div class="form-group">
      							<label for="inputEmail3" class="col-sm-4 control-label">Receiver's Currency</label>
      							<div class="col-sm-8">
      								<input type="text" class="form-control" id="inputEmail3" name="rec_currency" value="{{session('trans_data')['receiving_currency'] }}" disabled>
      							</div>
      						</div>
      						<div class="form-group">
      							<label for="inputEmail3" class="col-sm-4 control-label">Receiver's Date of Birth</label>
      							<div class="col-sm-6">
      								<input type="date" class="form-control" id="inputEmail3" name="dob" placeholder="date of birth" required>
      							</div>
      						</div>
      						<div class="form-group">
      							<label for="inputEmail3" class="col-sm-4 control-label">Gender</label>
      							<div class="col-sm-8">
      								<input type="radio" id="inputEmail3" name="gender" value="male"> Male
      								<input type="radio" id="inputEmail3" name="gender" value="male"> Female
      							</div>
      						</div>
      						<hr>
      						<div class="form-group">
      							<label for="inputEmail3" class="col-sm-4 control-label">Sender Name</label>
      							<div class="col-sm-8">
      								<input type="text" class="form-control" id="inputEmail3" name="s_name" value="{{session('trans_data')['sender_lastname'].' '.session('trans_data')['sender_firstname'] }}" disabled>
      							</div>
      						</div>
      						<div class="form-group">
      							<label for="inputEmail3" class="col-sm-4 control-label">Sender Location</label>
      							<div class="col-sm-8">
      								<input type="text" class="form-control" id="inputEmail3" name="s_loc" value="{{session('trans_data')['sending_country'] }}" disabled>
      							</div>
      						</div>
      						<div class="form-group">
      							<label for="inputEmail3" class="col-sm-4 control-label">Amount</label>
      							<div class="col-sm-8">
      								<input type="number" class="form-control" id="inputEmail3" name="amount" value="{{session('trans_data')['total_to_pay'] }}" disabled>
      							</div>
      						</div>
      						<div class="form-group">
      							<label for="inputEmail3" class="col-sm-4 control-label">Service Type</label>
      							<div class="col-sm-8">
      								<input type="text" class="form-control" id="inputEmail3" name="service_type" value="{{session('trans_data')['service_type'] }}" disabled>
      							</div>
      						</div>
      						<div class="form-group">
      							<label for="inputEmail3" class="col-sm-4 control-label">Purpose</label>
      							<div class="col-sm-8">
      								<input type="text" class="form-control" id="inputEmail3" name="purpose" value="{{session('trans_data')['purpose'] }}" disabled>
      							</div>
      						</div>
      						<div class="form-group">
      							<label for="inputEmail3" class="col-sm-4 control-label">Mobile Account</label>
      							<div class="col-sm-8">
      								<input type="text" class="form-control" id="inputEmail3" name="m_account" value="{{session('trans_data')['mobile_account'] }}" disabled>
      							</div>
      						</div>
      						<div class="form-group">
      							<div class="col-sm-offset-2 col-sm-8">
      								<button type="submit" name="save" style="background-color:blue; color:white" class="btn btn-default">Submit</button>
      							</div>
      						</div>
      					</form>
							</div>
						</div>
						<!-- END PANEL HEADLINE -->
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
