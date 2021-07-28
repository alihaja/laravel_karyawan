<?php
//insert.php;

if(isset($_POST["pendidikan"]))
{
 $connect = new PDO("mysql:host=localhost;dbname=projects", "root", "");
 $id_user = uniqid();
 for($count = 0; $count < count($_POST["pendidikan"]); $count++)
 {  
  $query = "INSERT INTO pendidikan 
  (id_user, pendidikan, jurusan, masuk, lulus) 
  VALUES (:id_user, :pendidikan, :jurusan, :masuk, lulus)
  ";
  $statement = $connect->prepare($query);
  $statement->execute(
   array(
    ':id_user'   => $id_user,
    ':pendidikan'  => $_POST["pendidikan"][$count], 
    ':jurusan' => $_POST["jurusan"][$count], 
    ':masuk'  => $_POST["masuk"][$count],
    ':lulus'  => $_POST["lulus"][$count]
   )
  );
 }
 $result = $statement->fetchAll();
 if(isset($result))
 {
  echo 'ok';
 }
}
?>