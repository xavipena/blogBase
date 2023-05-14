<?
	 ini_set('display_errors',1); 
	 error_reporting(E_ALL);
 
	 // base de dades de producci�
	 $db = new mysqli("mysql.url.com","user","password","databse");
	  /* check connection */
	 if ($db->connect_errno) {
		 printf("Connect failed: %s\n", $db->connect_error);
		 exit();
	 }
	 mysqli_set_charset($db, 'utf8');
 ?>
