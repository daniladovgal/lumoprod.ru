<?php 

class engine {
    
   function answer($api, $params) {

      $api = explode("_", $api);

      if (empty($api[0]) or empty($api[1])) {
         return '{"response":"1"}';
      } else {

   	  $class = strtolower($api[0]);
   	  $function = strtolower($api[1]);

         $params = json_decode($params);

         $jsonerr = json_last_error() === JSON_ERROR_NONE;

         if ($jsonerr != 1) {

         return '{"response":"4"}';

         } else {

            if (!file_exists($class.".php")) {
               return '{"response":"2"}';
            } else {

               require_once $class.".php";

               if (!class_exists($class)) {
                  return '{"response":"2"}';
               } else {

                  $apiclass = new $class();

                  if (!method_exists($apiclass, $function)) {
                     return '{"response":"3"}';
                  } else {
                    
                     session_start();

                     if (empty($_SESSION["human"])) {
                        $GLOBALS["human"] = false;
                     } else {
                        $GLOBALS["human"] = $_SESSION["human"];
                     }
       
                     if (empty($_SESSION["id"])) {
                        $GLOBALS["id"] = "";
                     } else {
                        $GLOBALS["id"] = $_SESSION["id"];
                     }

                     if (empty($_SESSION["token"])) {
                        $GLOBALS["token"] = "";
                     } else { 
                        $GLOBALS["token"] = $_SESSION["token"];
                     }
       
                     if (empty($_SESSION["lat"])) {
                        $GLOBALS["lat"] = "";
                     } else {
                        $GLOBALS["lat"] = $_SESSION["lat"];
                     }

                     if (empty($_SESSION["lon"])) {
                        $GLOBALS["lon"] = "";
                     } else {
                        $GLOBALS["lon"] = $_SESSION["lon"];
                     }

                     if (empty($_SESSION["imgs"])) {
                        $GLOBALS["imgs"] = "";
                     } else {
                        $GLOBALS["imgs"] = $_SESSION["imgs"];
                     }

                     session_write_close();


                     return $apiclass -> $function($params); 


                  } 
    
             } 

          } 
 
       } 

     }
   }

}


?>