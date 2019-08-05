<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <title>Receipt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  	<meta name="description" content="Portal to confirm Zeepay Remittances">
    <meta name="author" content="Zeepay Ghana (Dennis Machu, Nana Yaw)">
  </head>

  <style media="print">
    @page {
    size: auto;
    margin: 0;
    }
    body{
      margin: 0;
      padding:0;
    }
    </style>
    @php($logo1 = \App\Bank::findOrfail(Auth::user()->bank)->bank_logo)
    @php($logo2 = \App\Bank::findOrfail(Auth::user()->bank)->name)
  <body class="container">

    <div style="border:1px solid red; padding:2em;margin-top:2em">
      <!-- <div class="col-lg-12"> -->
        <img class="img img-responsive" src="{{ url('/images/'.$logo1) }}" style="width:20%;">
        <p class="text-right" style="float:right;">
          <b>Date : </b><u>{{ date("l, d M Y")}}</u> <br>
          <b>Receipt Number : </b><u>{{ strtoupper(substr($logo2 ,0,3).session('trans_data')['id']) }}</u> <br>
          <b>Branch :</b> <u>{{ Auth()->user()->bank_branch }}</u>
        </p>
        <!-- <p class="text-left">Branch: <u>{{ Auth()->user()->bank_branch }}</u></p> -->
      <!-- </div> -->
        <hr>
        <div class="row">
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <h5><u>Sender Details</u></h5>
            <div style="border:0.2px dotted black;padding:1em 2em">
              <p><b>Name: </b><u>{{ strtoupper(session('trans_data')['sender_lastname'].' '.session('trans_data')['sender_firstname']) }}</u></p>
              <p><b>Location: </b><u>{{ strtoupper(session('trans_data')['sending_country']) }}</u></p>
              <p><b>Amount: </b><u>{{ session('trans_data')['receiving_currency'].session('trans_data')['total_to_pay'] }}</u></p>
            </div>
          </div>

          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <h5><u>Receiver's Details</u></h5>
            <div style="border:0.2px dotted black;padding:1em 2em">
              <p><b>Name: </b><u>{{ strtoupper(session('trans_data')['lastname'].' '.session('trans_data')['firstname']) }}</u></p>
              <p><b>ID Type: </b><u>{{ session('retn')['id_type'] }}</u></p>
              <p><b>ID Number: </b><u>{{ session('retn')['id_number'] }}</u></p>
              <p><b>Location: </b><u>{{ strtoupper(session('trans_data')['receiving_country']) }}</u></p>
              <p><b>Telepone: </b><u>{{ session('retn')['phone'] }}</u></p>
            </div>
          </div>
        </div>

        <br>
        <br>
        <br>
        <div class="row">
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <hr>
            <p class="text-center">Customer Signature</p>
          </div>

          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            &nbsp;
          </div>

          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <hr>
            <p class="text-center">Bank Officer's Signature</p>
        </div>
      </div>
      &copy; {{ date("Y") }} Zeepay Ghana.All rights reserved.|Powered by: Zeepay.
    </div>

    <hr>

    <div style="border:1px solid red; padding:2em;margin-top:2em">
      <!-- <div class="col-lg-12"> -->
        <img class="img img-responsive" src="{{ url('/images/'.$logo1) }}" style="width:20%;">
        <!-- <img class="img img-responsive" src="{{ url('/zeepay-apple.png') }}" style="width:350px; height:95px"> -->
        <p class="text-right" style="float:right;">
          <b>Date : </b><u>{{ date("l, d M Y")}}</u> <br>
          <b>Receipt Number : </b><u>{{ strtoupper(substr($logo2 ,0,3).session('trans_data')['id']) }}</u> <br>
          <b>Branch :</b> <u>{{ Auth()->user()->bank_branch }}</u>
        </p>
        <!-- <p class="text-left">Branch: <u>{{ Auth()->user()->bank_branch }}</u></p> -->
      <!-- </div> -->
        <hr>
        <div class="row">
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <h5><u>Sender Details</u></h5>
            <div style="border:0.2px dotted black;padding:1em 2em">
              <p><b>Name: </b><u>{{ strtoupper(session('trans_data')['sender_lastname'].' '.session('trans_data')['sender_firstname']) }}</u></p>
              <p><b>Location: </b><u>{{ strtoupper(session('trans_data')['sending_country']) }}</u></p>
              <p><b>Amount: </b><u>{{ session('trans_data')['receiving_currency'].session('trans_data')['total_to_pay'] }}</u></p>
            </div>
          </div>

          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <h5><u>Receiver's Details</u></h5>
            <div style="border:0.2px dotted black;padding:1em 2em">
              <p><b>Name: </b><u>{{ strtoupper(session('trans_data')['lastname'].' '.session('trans_data')['firstname']) }}</u></p>
              <p><b>ID Type: </b><u>{{ session('retn')['id_type'] }}</u></p>
              <p><b>ID Number: </b><u>{{ session('retn')['id_number'] }}</u></p>
              <p><b>Location: </b><u>{{ strtoupper(session('trans_data')['receiving_country']) }}</u></p>
              <p><b>Telepone: </b><u>{{ session('retn')['phone'] }}</u></p>
            </div>
          </div>
        </div>

        <br>
        <br>
        <br>
        <div class="row">
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <hr>
            <p class="text-center">Customer Signature</p>
          </div>

          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            &nbsp;
          </div>

          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <hr>
            <p class="text-center">Bank Officer's Signature</p>
        </div>

        </div>
        &copy; {{ date("Y") }} Zeepay Ghana.All rights reserved.|Powered by: Zeepay.
      </div>
    <!-- <input type="button" value="Open window" onclick="openWin()" /> -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script type="text/javascript">
      function openWin()
      {
        myWindow=window.open("https://www.w3schools.com");
        myWindow.focus();
        myWindow.print();
    // myWindow.close();
      }
    </script>
  </body>
</html>
