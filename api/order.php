<?php

class order {

   function send($params) {
      foreach ($params as $key => $value) {
         $value = strip_tags($value);
         $value = addslashes($value);

   	           switch ($key) {
   	   	          case "name":
   	   	             $name = $value;
   	   	          break;
   		          case "rel":
   			         $rel = $value;
   			      break;
   		          case "comment";
   		             $comment = $value;
   			      break;
   	           }
            }

            if (empty($name) or empty($rel) or empty($comment)) {
               $answer = '{"response":"6"}';
            } else {
     
               require_once "db.php";

               $database = new database();
               $db = $database -> opendb();

               if (!$db) {
      	          $answer = '{"response":"5"}';
               } else { 
                  
                  mysqli_query($db,"INSERT INTO orders (name, rel, comment) VALUES ('$name', '$rel', '$comment')");

                  $subject = "Lumo";
                  $text = "Имя: ".$name."<br> Способ связи: ".$rel."<br>Комментарий: ".$comment;
                  $headers = "From: Lumo <info@lumoprod.ru>\r\n"
                        ."Reply-To: Lumo <info@lumoprod.ru>\r\n"
                        ."Content-type: text/html; charset=utf-8\r\n"
                        ."X-Mailer: PHP/" . phpversion();
                   
                   mail("info@lumoprod.ru", $subject, $text, $headers);
                   mail("danildovgal@gmail.com", $subject, $text, $headers);

                   $chars = 'qwertyuiopasdfghjklzxcvbnm0123456789';
                   $numChars = strlen($chars);
                   $token = '';

                   $answer = '{"response":"0"}';
    
                }

                $database -> closedb($db);

             }

            return $answer;
    
   }

}

?>