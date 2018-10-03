@extends('layouts.master-page')

@section('content')
<!-- MAIN -->
	<div class="main">
		<!-- MAIN CONTENT -->
		<div class="main-content">
			<div class="container-fluid">
				<h3 class="page-title">Dashboard</h3>
				@if(session('message'))
				<div class="row">
					<div class="col-md-6">
						<!-- PANEL WITH FOOTER -->
						<div class="panel panel-danger">
							<div class="panel-heading">
								<h3 class="panel-title">Error</h3>
								<div class="right">
									<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
								</div>
								<!-- <p class="panel-subtitle">Panel to display most important information</p> -->
							</div>
							<div class="panel-body">
								<!-- <h3 class="panel-title">MTCN Already Exist in Database</h3> -->
								<p class="panel-subtitle">{{ session('message') }}</p>
							</div>
						</div>
						<!-- END PANEL WITH FOOTER -->
					</div>
				</div>
				@endif
				<div class="row">
					<div class="col-md-8">
						<!-- PANEL HEADLINE -->
						<div class="panel panel-headline">
							<div class="panel-heading">
								<h3 class="panel-title">Search for MTCN</h3>
								<!-- <p class="panel-subtitle">Panel to display most important information</p> -->
							</div>
							<div class="panel-body">
								<form method="post" action="{{ route('mtcn_number_search')}}">
									@csrf
								  <div class="form-group">
								    <!-- <label for="exampleInputEmail1">Email address</label> -->
								    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="mtcn_number" placeholder="Eg. 123333333">
								    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
								  </div>
								  <button type="submit" class="btn btn-primary">Submit</button>
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

		@if(session('hut'))
		<script type="text/javascript">
			function openWin()
			{
				myWindow=window.open("{{ url('/receipt/printable') }}",'receipt','height=1000,width=1200');
				myWindow.focus();
				myWindow.print();
			// myWindow.close();
			}
			window.onload = openWin;
			</script>
		@endif
@endsection
