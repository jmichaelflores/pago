<?php  
try {
		
		$con = new PDO('mysql:host=localhost;dbname=pagodeconsejeria','root', '');


}
catch(PDOException $e){
	print "!Error!: " . $e->getMessage() . "<br/>";
	die();
}

?>