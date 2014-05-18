<?php 
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
//phpinfo();
$pagekeywords = 'Gov Scores Administration';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>

<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Gov Scores Administration - <?php echo $pagename; ?></title>
<meta name="description" content="<?php echo $pagekeywords.' - '.$pagedescription; ?>">
<meta name="keywords" content="<?php echo $pagekeywords; ?>">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
<link rel="icon" href="/images/favicon.ico" type="image/x-icon">

<link href='http://fonts.googleapis.com/css?family=Gentium+Book+Basic|Open+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=GFS+Didot' rel='stylesheet' type='text/css'>

{{ HTML::style('css/application.min.css') }}
{{ HTML::script('js/modernizr-2.6.2.min.js') }}

</head>

<body class="<?php echo implode(' ',$bodyclass); ?>">

<div class="container" id="gs-wrap">
	
	<!-- display header for xs -->
	<div class="navbar-header">
		<ul class="gs-navbar">
			<li class="navbar-menu">
				<button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".sidebar-nav">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</li>
			<li class="navbar-logo">
				<a href="/" title="Go to the website home page"><img id="logo-img-mobile" class="logo-navbar" src="/images/logos/icon_gov_mobile.png"></a>
			</li>
			<li class="navbar-avatar dropdown">
				<div class="block-avatar" class="dropdown-toggle" data-toggle="dropdown"><a href="#"><img class="navbar-avatar" src="/images/users/user_img.jpg"></a></div>
				<ul class="dropdown-menu pull-right menu-avatar">
					<li><a role="menuitem" href="#">Profile</a></li>
					<li><a role="menuitem" href="#">Settings</a></li>
					<li class="divider"></li>
					<li><a role="menuitem" href="#">Sign Out</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<!-- end header for xs -->
	
	<?php // set bg for sidebar here ?>
	<div class="row" id="gs-content">

		<div class="col-xs-12" id="gs-guts">
			<div id="row-canvas" class="row row-offcanvas row-offcanvas-left admin">
				<div id="main-sidebar" class="col-xs-3 col-sm-3 col-md-2 sidebar-offcanvas" role="navigation">
					<div class="gs-sidebar">
						<!-- display logo for sizes +xs -->
						<a href="/" title="Go to the website home page"><img id="logo-img-big" class="logo-sidebar" src="/images/logos/icon_gov.png"></a>
						
						<ul class="gs-sidenav sidebar-nav">

<?php if ( isset($bodyclass) & !in_array('dashboard',$bodyclass)) { ?>
							<li style="background-color:#fff;text-transform:none;letter-spacing:0;"><a class="" href="{{ URL::route('admin') }}" title=""> &#171; back to Admin Home</a></li>
<? } ?>							
							<li<?php if ( isset($bodyclass) & in_array('congresses',$bodyclass)) {echo ' class="active"';} ?>><a class="nav-link" href="{{ URL::route('admin') }}" title="Congresses"><span aria-hidden="true" class="icon-flag"></span> Congresses</a></li>
								
						<ul class="gs-sidenav-inner">
						<li<?php if ( isset($bodyclass) & in_array('sessions',$bodyclass)) {echo ' class="active"';} ?>><a class="nav-link" href="{{ URL::route('admin.persons.index') }}" title="Bills and Resolutions"><span aria-hidden="true" class="icon-users"></span> Sessions</a></li>
							
						<li<?php if ( isset($bodyclass) & in_array('bills',$bodyclass)) {echo ' class="active"';} ?>><a class="nav-link" href="{{ URL::route('admin.persons.index') }}" title="Bills and Resolutions"><span aria-hidden="true" class="icon-users"></span> Bills</a></li>
							
						<li<?php if ( isset($bodyclass) & in_array('persons',$bodyclass)) {echo ' class="active"';} ?>><a class="nav-link" href="{{ URL::route('admin.persons.index') }}" title="People"><span aria-hidden="true" class="icon-users"></span> People</a></li>

						<li<?php if ( isset($bodyclass) & in_array('committees',$bodyclass)) {echo ' class="active"';} ?>><a class="nav-link" href="{{ URL::route('admin.persons.index') }}" title="Bills and Resolutions"><span aria-hidden="true" class="icon-users"></span> Committees</a></li>
							
						<li<?php if ( isset($bodyclass) & in_array('votes',$bodyclass)) {echo ' class="active"';} ?>><a class="nav-link" href="{{ URL::route('admin.persons.index') }}" title="Bills and Resolutions"><span aria-hidden="true" class="icon-users"></span> Votes</a></li>
							
						<li<?php if ( isset($bodyclass) & in_array('budgets',$bodyclass)) {echo ' class="active"';} ?>><a class="nav-link" href="{{ URL::route('admin.persons.index') }}" title="Bills and Resolutions"><span aria-hidden="true" class="icon-users"></span> Budgets</a></li>	
																
						</ul>

							<li><a class="nav-link" href="" title=""><span aria-hidden="true" class="icon-library"></span> Reports</a></li>

							<li><a class="nav-link" href="{{-- URL::route('admin.users.index') --}}" title=""><span aria-hidden="true" class="icon-library"></span> Users</a></li>
							
							<!-- display avatar for sizes +xs -->
							<li class="sidebar-avatar">
								<a class="nav-link" href="/username" title="Your Profile"><div class="block-avatar"><img class="side-avatar" src="/images/users/user_img.jpg"></div><div class="sidebar-username">Profile</div></a>
							</li>

						</ul>
						
					</div><!-- end gs-sidebar-->
				 </div><!-- end main-sidebar -->

				 <div id="main-content-admin" class="col-xs-12 col-sm-9 col-md-10 main-col-padding">
				 	<div class="slide-wrapper">
				        <div class="slide" id="">
				            <div class="slide-inner">

				            	@yield('content')

							</div><!-- / slide-inner -->
				        </div><!-- / slide -->
				    </div><!-- / slide-wrapper -->

				</div><!-- end main-content-admin -->

			</div><!-- end row-canvas -->
		</div><!-- end gs-guts columns-->
	</div><!-- end gs-content row -->
</div><!-- end gs-wrap container -->

<!--div style="clear:both;margin-top:2em;margin-bottom:4em;border:2px solid red;float:right;width:50%;">
<?php
var_dump(gethostname());
//echo Session::getToken();
echo '<pre>Environment';
print_r($_ENV);
echo '</pre>';
echo '<pre>Server';
print_r($_SERVER);
echo '</pre>';
echo '<pre>postdsdfsd';
print_r($_POST);
echo '</pre>';
echo '<pre>session';
//print_r($_SESSION);
echo '</pre>';
?>
</div-->


{{ HTML::script('js/jquery-2.0.min.js') }}
{{ HTML::script('js/jquery-ui-1.10.3.custom.min.js') }}

<!--script src="js/jquery.ui.touch-punch.min.js"></script-->
{{ HTML::script('js/sass-bootstrap.min.js') }}

{{-- HTML::script('js/easing.min.js') --}}

<!--script src="js/bootstrap-select.js"></script>
<script src="js/bootstrap-switch.js"></script>
<script src="js/flatui-checkbox.js"></script>
<script src="js/flatui-radio.js"></script>
<script src="js/jquery.tagsinput.js"></script>
<script src="js/jquery.placeholder.js"></script>
<script src="js/jquery.stacktable.js"></script>
<script src="js/flatuiapp.js"></script-->	

{{ HTML::script('js/jquery.stellar.min.js') }}
{{ HTML::script('js/waypoints.min.js') }}

{{ HTML::script('js/application.js') }}



</body>
</html>