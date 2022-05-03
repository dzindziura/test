<?php


$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root';
$db_db = 'wp32';

// Create connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_db);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
// $sql = "CREATE TABLE Email (
// id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// email VARCHAR(150) NOT NULL
// )";
// if ($conn->query($sql) === TRUE) {
//   echo "Table MyGuests created successfully";
// } else {
//   echo "Error creating table: " . $conn->error;
// }
// if(isset($_POST['email'])){
if (empty($_POST["email"])) {
      $errorMSG = "<li>Name is required</<li>";
  } else {
      $email = $_POST["email"];
  }
// if($_POST['email']){
//   $email = $_POST['email'];
// }
// if($email!=''){
// $sql2 = 'INSERT INTO Email(email) VALUES ($email);';
// if ($conn->query($sql2) === TRUE) {
// echo "done";
// // }
// }
// // }
// echo json_encode(['code'=>404, 'msg'=>$email ]);

 ?>
