<?php


$username="007";
$password="secret";

$user=isset($_POST['username']) //? $_POST['username'] : $_GET['username'];
$pass=isset($_POST['password']) //? $_POST['password'] : $_GET['password'];

if ($user==$username && $pass==$password) {
  echo 'pass';
} else {
  echo 'fail';
}



?>