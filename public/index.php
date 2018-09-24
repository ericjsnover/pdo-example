<?php

# This is a simple framework, don't forget that!

// --------------------------------
// Hide your logic like this..
// --------------------------------
include '../logic.php';

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>PDO Example</title>

  <link rel="stylesheet" href="assets/stylesheet.css">

</head>

<body>
	<h1>PDO Example</h1>
	<p><?=$query?></p>
	
 <?=$content?>
</body>
</html>