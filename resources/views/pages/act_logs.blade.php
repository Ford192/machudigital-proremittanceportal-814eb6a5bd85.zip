@extends('layouts.master-page')

@section('added_styles')
	https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css
	https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css
@endsection

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

					<h3 class="page-title" >Activities</h3>

          <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter_user">
            <i class="fa fa-plus"> </i> Add a User
          </button> -->
					<br>
					<br>
          <!-- <p class="btn btn-warning"><i class="fa fa-plus"> </i> Add a Bank</p> -->
					<div class="row">
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">List of Activities</h3>
								</div>
								<div class="panel-body">
									<table id="example" class="table table-striped" style="width:100%">
						        <thead>
						            <tr>
						                <th>id</th>
						                <th>description</th>
						                <th>dated</th>
						            </tr>
						        </thead>
						        <tbody>
											@php($usr = DB::table('activity_log')->get())
											@if($usr->count())
												@foreach($usr as $urs)
						            <tr>
						                <td>{{ $urs->id }}</td>
						                <td>{{ $urs->description }}</td>
						                <td>{{ $urs->created_at}}</td>
						            </tr>
												@endforeach
											@endif
						        </tbody>
						    </table>
								</div>
							</div>
							<!-- END TABLE HOVER -->
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Enter Details of User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="{{ route('create_new_person') }}">
						@csrf
						<div class="modal-body">
							<!-- <form> -->
						  <div class="form-group">
						    <label for="exampleFormControlInput1">Fullname</label>
						    <input type="text" class="form-control" name="full_name" id="exampleFormControlInput12" placeholder="Firstname Othername Lastname">
						  </div>
						  <div class="form-group">
						    <label for="exampleFormControlInput1">Email</label>
						    <input type="email" class="form-control" name="email" id="email" placeholder="email">
						  </div>
						  <div class="form-group">
						    <label for="exampleFormControlInput1">Password</label>
						    <input type="password" class="form-control" id="password" name="password">
						  </div>
						  <!-- <div class="form-group">
						    <label for="exampleFormControlInput1">Passowrd Confirmation</label>
						    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
						  </div> -->
							<div class="form-group">
						    <label for="exampleFormControlSelect1">Account Type</label>
						    <select class="form-control" id="account_type" name="account_type" required>
						      <option value="0" selected> --Select an Account-- </option>
								@can('admin')
									<option value="admin">Admin</option>
								@endcan
						      <option value="bank_cm">Bank Admin</option>
						      <option value="bank_teller">Bank Teller</option>
						    </select>
						  </div>
							@if(Auth::user()->bank == 0)
						  <div class="form-group">
						    <label for="exampleFormControlSelect1">Banks</label>
						    <select class="form-control" id="bank" name="bank">
									<!-- <option value="0" selected> --Select a Bank-- </optiotrn> -->
						      <option value="0">System Admin</option>
									@php($bk = \App\Bank::where('status', 0)->get())
									@if(isset($bk))
										@foreach($bk as $bkk)
											<option value="{{ $bkk->id}}">{{ $bkk->name}}</option>
										@endforeach
									@endif
						    </select>
						  </div>
							@else
								<input type="hidden" value="{{ Auth::user()->bank }}" name="bank">
							@endif
							<div class="form-group">
						    <label for="exampleFormControlInput1">Bank Branch</label>
						    <input type="text" class="form-control" name="bank_branch" id="branch" placeholder="bank branch">
						  </div>
						  <!-- <div class="form-group">
						    <label for="exampleFormControlTextarea1">Example textarea</label>
						    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
						  </div> -->
						<!-- </form> -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>

@endsection

@section('added_scripts')
	<script src="{{ url('/scripts/klorofil-common.js') }}"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		} );
	</script>
@endsection
