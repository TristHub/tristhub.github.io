<?php
   $hostname = 'localhost';
   $username = 'root';
   $password = '';
   $dbname = 'db';
   $conn = new mysqli($hostname, $username, $password, $dbname);
   if(!$conn){
       echo 'There was an error while connecting to the database!';
       exit();
   }

   if(isset($_POST['projectID'])){
      $stmt = $conn->prepare("SELECT * FROM yourTable WHERE projectid = ?");
      $stmt->bind_param("s", $_POST['projectID']);
      $stmt->execute();
      $result = $stmt->get_result();
      if($result->num_rows < 1){
          $stmt2 = $conn->prepare("INSERT INTO yourTable (projectid) VALUES (?)");
          $stmt2->bind_param("s", $_POST['projectID']);
          $stmt2->execute();
          echo 'Project Shared.';
          exit();
      } else {
         echo 'The project ID has already been shared!';
         exit();
      }
   } else {
       echo 'Invalid method';
       exit();
   }
?>
