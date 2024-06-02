<?php
require 'Connection.php';

require 'functions.php';

session_start();

// Get the book ID from the URL parameter
$bookId = isset($_GET['book_id']) ? intval($_GET['book_id']) : 0;

$db = new Database();

global $isBookInFavorites;
if ($bookId > 0) {
    // Check if the book is not already in the favorites

    $checkQuery = 'SELECT * FROM bookstore.user_fbooks WHERE user_id = :user_id AND book_id = :book_id';


    $db->query($checkQuery, [
        'user_id' => $_SESSION['id'],
        'book_id' => $_GET['book_id']
    ]);

    $isBookInFavorites = $db->find();

 

    if ($isBookInFavorites == 0) {
        
        // Book is not in favorites, insert a new record
        $insertQuery = 'INSERT INTO bookstore.user_fbooks (user_id, book_id, date) VALUES (:user_id, :book_id, NOW())';

        $db->query($insertQuery, [
            'user_id' => $_SESSION['id'],
            'book_id' => $_GET['book_id'],
        ]);

    }
    
    else {

        // Book is in favorites, delete the row fron the record
        $deleteQuery = 'DELETE FROM bookstore.user_fbooks WHERE user_id = :user_id AND book_id = :book_id';
        $db->query($deleteQuery, [
            'user_id' => $_SESSION['id'],
            'book_id' => $_GET['book_id']
        ]);
    }
    // Optionally, you can redirect the user back to the book page or another page
    header('Location: My_Account/Fav.php');
    exit();
}
