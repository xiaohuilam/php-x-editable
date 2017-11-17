<?php
require 'vendor/autoload.php';

if('save' == ($_GET['action'] ?? null)) {
	echo 'OK';exit;
} else if('marriage' == ($_GET['action'] ?? null)) {
	$groups = array(
	  array('value' => 0, 'text' => 'Unmarried 未婚'),
	  array('value' => 1, 'text' => 'Marriaged 已婚'),
	  array('value' => 2, 'text' => 'Divorced 离异'),
	  array('value' => 3, 'text' => 'Widowed 丧偶'),
	);
	echo json_encode($groups);  
	exit;
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
	<?php echo Editable\Example\Editable::test();?>
	</div>
</body>
</html>
