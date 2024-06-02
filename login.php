<?php


require 'functions.php';

require 'Connection.php';


session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $db = new Database();

    $query = 'select * from bookstore.user where username = :user AND password = :pass';

    $db->query($query, [
        'user' => $_POST['username'],
        'pass' => $_POST['password']
    ]);

    $result = $db->find();


    $errors = [];

    if (!$result) {
        $errors['invalid data'] = "لم نجد حساب يوافق البيانات المدخلة";
    } else {


        $_SESSION = $result;
    
       

        header('Location: index.php');
    }
}

require 'views/login.view.php';
