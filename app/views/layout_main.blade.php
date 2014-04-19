<?php 
$pagekeywords = 'United States Congress, Members of Congress, report cards, job performance, Gov Scores';
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
<title>Gov Scores &#187; <?php //if (isset($pagename)) { echo $pagename; } ?></title>
<meta name="description" content="<?php //if (isset($pagedescription)) { echo $pagedescription; } ?>">
<meta name="keywords" content="<?php //if (isset($pagekeywords)) { echo $pagekeywords; } ?>">

<!-- Google+ Metadata - DO AUTHOR RANK AND RICH SNIPPETS /-->
<meta itemprop="name" content="">
<meta itemprop="description" content="">
<meta itemprop="image" content="">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Facebook Metadata /-->
<meta property="fb:page_id" content="">
<meta property="og:image" content="">
<meta property="og:description" content="">
<meta property="og:title" content="">

<link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
<link rel="icon" href="/images/favicon.ico" type="image/x-icon">

<link href='http://fonts.googleapis.com/css?family=Gentium+Book+Basic|Open+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=GFS+Didot' rel='stylesheet' type='text/css'>

<!--link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'-->

<!--link href='http://fonts.googleapis.com/css?family=News+Cycle|Droid+Serif:400,400italic' rel='stylesheet' type='text/css'-->

{{ HTML::style('css/application.min.css') }}
{{ HTML::script('js/modernizr-2.6.2.min.js') }}

</head>

<body class="<?php //if (isset($bodyclass)) { echo implode(' ',$bodyclass); } ?>">

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
				<a href="/" title="Go to the home page"><img id="logo-img-mobile" class="logo-navbar" src="/images/logos/icon_gov_mobile.png"></a>
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
<?php 
/*if (in_array('home', $bodyclass)) { ?>	
@include('_partials.rowcanvas_home')
<?php } 
elseif (in_array('about', $bodyclass)) { ?>
@include('_partials.rowcanvas_about')
<? }*/ ?>
				<!-- sidebar column -->
				<div id="main-sidebar" class="col-xs-3 col-sm-3 col-md-2 sidebar-offcanvas" role="navigation">
					<div class="gs-sidebar">
						<!-- display logo for sizes +xs -->
						<a href="/" title="Go to the home page"><img id="logo-img-big" class="logo-sidebar" src="/images/logos/icon_gov.png"></a>
<?php 
/*if (in_array('home', $bodyclass)) { ?>	
@include('_partials.sidebar_home')
<?php } 
elseif (in_array('about', $bodyclass)) { ?>
@include('_partials.sidebar_about')
<? }*/ ?>
					</div>
				 </div>
				<!-- end main-sidebar column -->

				@yield('content')
				
				<br/>
				<div style="clear:both;margin-top:2em;margin-bottom:4em;border:2px solid red;float:right;width:50%;">
<?php
ini_set('display_errors',1); 
 error_reporting(E_ALL);
 
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
				</div>

		</div><!-- end gs-guts columns-->
	
	</div><!-- end gs-content row -->

</div><!-- end gs-wrap container -->


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