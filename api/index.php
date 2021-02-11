<?php 

if (count($_GET) > 0) {

    $api = array_keys($_GET)[0];
    $params = $_GET[$api];

  	require_once "engine.php";

  	$engine = new engine();

    echo $engine -> answer($api, $params);


    } else {
      $answer = '{"response":"1"}';
      echo $answer;
    }



 ?>
