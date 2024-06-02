<?php
require 'Connection.php';

function del_book($title)
{
    $db = new Database();
    $query = "delete from bookstore.book where bookstore.book.title = :title";

    $db->query($query, [
        'title' => $title
    ]);
}

function del_cat($name)
{
    $db = new Database();
    $query = "delete from bookstore.category where bookstore.category.name = :name";

    $db->query($query, [
        'name' => $name
    ]);
}
function del_author($name)
{
    $db = new Database();
    $query = "delete from bookstore.author where bookstore.author.name = :name";

    $db->query($query, [
        'name' => $name
    ]);
}
function del_adm($email)
{
    $db = new Database();
    $query = "delete from bookstore.admin where bookstore.admin.email = :email";
    $db->query($query, [
        'email' => $email
    ]);

}
