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

					<h3 class="page-title" >Banks</h3>

          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter_bank">
            <i class="fa fa-plus"> </i> Add a Bank
          </button>
					<br>
					<br>
          <!-- <p class="btn btn-warning"><i class="fa fa-plus"> </i> Add a Bank</p> -->
					<div class="row">
						@if(isset($all_banks))
							@foreach($all_banks as $abk)
							<div class="col-md-6">
								<!-- PANEL NO PADDING -->
								<div class="panel">
									<div class="panel-heading">
										<h3 class="panel-title label">{{ $abk->created_at->toDayDateTimeString()}}</h3>
										<div class="right">
											<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
											<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
										</div>
									</div>
									<div class="panel-body text-left">
										<table border="0" width='100%'>
											<tr>
												<td style="width:250px;padding:0; margin:0;">
													<!-- <i class="fa fa-thumbs-o-up fa-5x"></i> -->
													<img class="img img-thumbnail" src="{{ url('/images/'.$abk->bank_logo) }}" style="width:220px; padding:0; margin:0;">
												</td>
												<td>
													<h3>{{ $abk->name }}</h3>
													<p>{{ \App\User::where('bank',$abk->id)->count() }} users</p>
													<p>{{ DB::table('transactions')->join('users','transactions.bank_officer','users.id'
				)->join('banks','banks.id','users.bank')->where('banks.id',$abk->id)->count() }} remitance</p>

												</td>
											</tr>
										</table>
									</div>
									<div class="panel-footer">
										@if($abk->status == 1)
											<a href="{{ url('/bank/'.$abk->id.'/state/0') }}" class="text-right label label-success">activate</a>
										@elseif($abk->status == 0)
											<a href="{{ url('/bank/'.$abk->id.'/state/1') }}" class="text-right label label-warning">de-activate</a>
										@endif
									</div>
								</div>
								<!-- END PANEL NO PADDING -->
							</div>
							@endforeach
						@endif
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter_bank" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Enter Details of Bank</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="{{ route('new_bank') }}" enctype="multipart/form-data">
						@csrf
            <div class="modal-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="bank_n" aria-describedby="emailHelp" placeholder="name of Bank" required>
              </div>
              <div class="form-group">
                <label for="exampleFormControlFile1">Bank Logo</label>
                <input type="file" class="form-control-l form-control-file" name="bank_lo" id="exampleFormControlFile1">
              </div>
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
@endsection
