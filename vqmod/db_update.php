<?php

$return = false;

if (!empty($_POST['modify'])) {
	// Config
	require_once ('config.php');
	
	// Startup
	require_once (DIR_SYSTEM . 'startup.php');
	
	// Registry
	$registry = new Registry ();
	
	// Database
	$db = new DB ( DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE );
	$registry->set ( 'db', $db );
	
	$query =  $db->query ("ALTER TABLE `".DB_PREFIX."setting` CHANGE `value` `value` LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ");
	
	$return = true;
}

?>

<html>
	<head>
	</head>
	<body>
		<?php if ($return) { ?>
		<h2>Modification was succesful!</h2>
		<h2>Please delete this file!</h2>
		<?php } else { ?>
		<h2>WARNING!</h2>
		<h3>Running this code is extremely dangeorus. USE ONLY AT YOUR OWN RISK!</h3>
		<h3>It's really recommended to create a backup of your database, before running this code.</h3>
		<form method="POST">
			<input type="submit" name="modify" value="Modify DB!" />
		</form>
		<?php } ?>
	</body>
</html>