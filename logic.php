<?php
// --------------------------------
// 0. Connect Variable
// --------------------------------
$servername = "localhost";
$username = "root";
$password = "root";
$database = "example";
	
// --------------------------------
// 1. Create database if missing
// --------------------------------
try {
	$CONN = new PDO("mysql:host=$servername;dbname=".$database, $username, $password);
	$CONN->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
	
	try {
		$CONN = new PDO("mysql:host=".$servername, $username, $password);
		$CONN->exec("CREATE DATABASE ".$database);
		$CONN = new PDO("mysql:host=$servername;dbname=".$database, $username, $password);
		$CONN->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$tables = ["users","data"];
		foreach($tables as $table){
			
			$q = "CREATE TABLE ".$table." (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, sample_content VARCHAR(150))";
			$STMT = $CONN->prepare($q);
			$STMT->execute();
			
			for($row=0;$row<100;$row++){
				$q = "INSERT INTO ".$table." SET sample_content=:sample_content";
				$STMT = $CONN->prepare($q);
				$STMT->execute(["sample_content"=>rand(1000000000,9999999999)]);
			}
		}
	} catch(PDOException $f) {
		echo "ERROR: ".$f->getMessage();
		exit;
	}
	
	

	
}


// --------------------------------
// 2. Select
// --------------------------------

	
try {
	$CONN = new PDO("mysql:host=$servername;dbname=".$database, $username, $password);
	$CONN->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	if(isset($_GET['l2'])){
		$q = "SELECT * FROM ".$_GET['l1']." WHERE id=:id";
		$query = "Query: SELECT * FROM ".$_GET['l1']." WHERE id=".$_GET['l2'];
		$STMT = $CONN->prepare($q);
		$STMT->execute(["id"=>$_GET['l2']]);
	} else {
		$q = "SELECT * FROM ".$_GET['l1'];
		$query = "Query: SELECT * FROM ".$_GET['l1'];
		$STMT = $CONN->prepare($q);
		$STMT->execute();		
	}
	
	
	$o = $STMT->FetchAll(PDO::FETCH_ASSOC);
	
	} catch(PDOException $e) {
		$query = "Structure your search in the url like this: <code>URL/table/id</code>";
	}

// --------------------------------
// 3.Output
// --------------------------------
$content .= "<table><thead><th>id</th><th>sample_content</th></thead>";

foreach($o as $rows){

	$content .= "<tr>";
	foreach($rows as $row){
		$content .= "<td>".$row."</td>";
	}
	$content .= "</tr>";
	
	
}
$content .= "</table>";
