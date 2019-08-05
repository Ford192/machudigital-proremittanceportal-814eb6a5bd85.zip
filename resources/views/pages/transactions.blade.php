@extends('layouts.master-page')

@section('added_styles')
	https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css
	https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css
{{--    <link rel="stylesheet" href="">--}}
    https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css
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

					<h3 class="page-title" >Users</h3>

					<br>
					<br>
          <!-- <p class="btn btn-warning"><i class="fa fa-plus"> </i> Add a Bank</p> -->
					<div class="row">
						<div class="col-md-12">
                        {!! $dataTable->table() !!}
							<!-- TABLE HOVER -->
{{--							<div class="panel">--}}
{{--								<div class="panel-heading">--}}
{{--									<h3 class="panel-title">List of Users</h3>--}}
{{--								</div>--}}
{{--								<div class="panel-body">--}}
{{--									<table id="example" class="table table-striped" style="width:100%">--}}
{{--						        <thead>--}}
{{--						            <tr>--}}
{{--						                <th>Name</th>--}}
{{--						                <th>Email</th>--}}
{{--						                <th>Account Type</th>--}}
{{--						                <th>Bank</th>--}}
{{--						                <th>Branch</th>--}}
{{--						                <th></th>--}}
{{--						            </tr>--}}
{{--						        </thead>--}}
{{--						        <tbody>--}}
{{--											@if(isset($usr))--}}
{{--												@foreach($usr as $urs)--}}
{{--						            <tr>--}}
{{--						                <td>{{ $urs->name }}</td>--}}
{{--						                <td>{{ $urs->email }}</td>--}}
{{--						                <td>{{ $urs->account_type}}</td>--}}
{{--						                <td>--}}
{{--															@if($urs->bank == 0)--}}
{{--																Instant Mny Admin--}}
{{--															@else--}}
{{--																{{ \App\Bank::findOrFail($urs->bank)->name }}--}}
{{--															@endif--}}
{{--														</td>--}}
{{--						                <td>{{ $urs->bank_branch }}</td>--}}
{{--						                <td>--}}
{{--															@if($urs->is_active == 0)--}}
{{--																<a href="{{ url('/person/'.$urs->id.'/state/1/change') }}" class="text-right label label-success">activate</a>--}}
{{--															@elseif($urs->is_active == 1)--}}
{{--																<a href="{{ url('/person/'.$urs->id.'/state/0/change') }}" class="text-right label label-warning">de-activate</a>--}}
{{--															@endif--}}
{{--														</td>--}}
{{--						            </tr>--}}
{{--												@endforeach--}}
{{--											@endif--}}
{{--						        </tbody>--}}
{{--						    </table>--}}
{{--								</div>--}}
{{--							</div>--}}
							<!-- END TABLE HOVER -->
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>

@endsection

@section('added_scripts')
	<script src="{{ url('/scripts/klorofil-common.js') }}"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
{{--	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>--}}
{{--	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>--}}
{{--	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		} );
	</script>--}}


    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}
@endsection
