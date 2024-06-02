<?php
require 'functions.php';
require 'views/Signup.view.php';
require 'Connection.php';
?>

<?php


if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $db = new Database();

  

    $query = 'insert into bookstore.user (username, email, phone, password) values(:username, :email, :phone, :password)';

    $db -> query($query, [
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'password' => $_POST['password']
    ]);


    header('Location: login.php');
    
}
?>