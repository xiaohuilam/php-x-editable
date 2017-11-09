<?php
require 'vendor/autoload.php';

if('save' == ($_GET['action'] ?? null)) {
	echo 'OK';exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="col-md-6 col-md-offset-3">
	<h1>PHP Editable Demo</h1>
	<h1>Line Break</h1>
	<h1>Line Break</h1>
	<h1>Line Break</h1>
	<?php
		Editable\Test\Editable::test();
	?>
	</div>
</body>
</html>
