<?php

   class database {

    function opendb() {

      $dbname = "";
      $dblogin = "";
      $dbpass = "";
      $dbhost = "";
      
      $db = mysqli_connect($dbhost,$dblogin,$dbpass,$dbname);
      mysqli_set_charset($db,"utf8");

      if ($db) {
        return $db;
      } else {
        return false;
      }

    }

    function closedb($db) {

    	mysqli_close($db);

    }

 
}
?>
