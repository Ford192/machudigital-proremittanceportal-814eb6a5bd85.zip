@extends('layouts.master-page')

@section('added_styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
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

            <h3 class="page-title" >Transaction Report</h3>
            <br>
            <br>
            <!-- <p class="btn btn-warning"><i class="fa fa-plus"> </i> Add a Bank</p> -->
            <div class="row">
                <div class="col-md-12">
                    <!-- TABLE HOVER -->
                    <div class="panel">
                        <div class="panel-heading">
{{--                            <h3 class="panel-title">Transactions</h3>--}}
                            <div class="form-inline">
                                <div class="input-daterange input-group" id="datepicker">
                                    <input type="date" class="input-sm form-control" name="start" id="start" value="{{old('start',null)}}"/>
                                    <span class="input-group-addon">to</span>
                                    <input type="date" class="input-sm form-control" name="end" id="end" value="{{old('end',null)}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            {!! $dataTable->table() !!}
                        </div>
                    </div>
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
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}

    <script>
        $("#start").change(function () {
            var location = window.location.href;

            if (location.indexOf("?")  === -1)
                location += "?";

            location += "&start_date="+$(this).val();

            window.location.href = location;
        });

        $("#end").change(function () {
            var location = window.location.href;

            if (location.indexOf("?")  === -1)
                location += "?";

            location += "&start_date="+$(this).val();

            window.location.href = location;
        });


    </script>
@endsection
