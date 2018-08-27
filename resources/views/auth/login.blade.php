<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Remit Portal</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="description" content="Portal to confirm Zeepay Remittances">
  <meta name="author" content="Zeepay Ghana (Dennis Machu)">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{ url('/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ url('/vendor/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ url('/vendor/linearicons/style.css') }}">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{ url('/css/login.css') }}">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<!-- <link rel="stylesheet" href="{{ url('/css/demo.css') }}"> -->
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.comcss?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{ url('/img/apple-icon.png') }}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{ url('/img/favicon.png') }}">
</head>

<body>
	<!-- WRAPPER -->
  <div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->
      <h2 class="active"> Sign In </h2>

      <!-- Icon -->
      <div class="fadeIn first">
        <img src="{{ url('/img/logo_1.png') }}" id="icon" alt="User Icon" />
      </div>

      <!-- Login Form -->
      <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
          @csrf
        <input type="email" id="login" class="fadeIn second{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="email" required autofocus>
<br>
				@if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif

        <input type="password" id="password" class="fadeIn third {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
<br>
				@if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
        <input type="submit" class="fadeIn fourth" value="Log In">
      </form>

      <!-- Remind Passowrd -->
      <!-- <div id="formFooter">
        <a class="underlineHover" href="#">Forgot Password?</a>
      </div> -->
			<a class="btn btn-link" href="{{ route('password.request') }}">
					{{ __('Forgot Your Password?') }}
			</a>
    </div>

  </div>
	<!-- END WRAPPER -->
</body>

</html>
