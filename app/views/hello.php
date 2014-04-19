<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>

<link href='css/application.css' rel='stylesheet' type='text/css'>

</head>
<body>
	<div class="welcome">
		<h1>You have arrived.</h1>
	</div>
</body>
</html>

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
