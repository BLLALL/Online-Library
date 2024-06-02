<?php

require 'Connection.php';
require 'functions.php';

$price = intval($_GET['title']);
$title = substr($_GET['title'], 4);
// dd($title);
$_SERVER['REQUEST_URI'] = '/WEB_Project/buying_form.php';
$db = new Database();
$query = 'SELECT id FROM bookstore.book WHERE title = ?';
$db->query($query, [$title]);

$book_id = $db->find();



require 'views/partials/head.view.php';

session_start();

?>

<body>
    <header>
        <?php
        require 'views/partials/nav.view.php';

        ?>
    </header>

    <?php



    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $db = new Database();
        $query = 'INSERT INTO bookstore.purchases (user_id, book_id) VALUES (?, ?)';
        $db->query($query, [
            $_SESSION['id'],
            $book_id['id']
        ]);
        header('Location: My_Account/purchases.php');


    }
    
    ?>
    


    <div class="container">
        <div class="sec">
            <table>
                <thead>
                    <tr>
                        <th colspan="2">تفاصيل المشتريات </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>اسم الكتاب : <?= $title ?> </td>
                    </tr>
                    <tr>
                        <td>سعر الكتاب : <?= $price ?></td>

                    </tr>
                </tbody>
            </table>
            <form method="POST">
                <h2>شراء الكتب</h2>
                <label for="name">اسم بطاقة الائتمان </label>
                <input type="text" id="name" name="name" required>
                <label for="card_num"> رقم بطاقة الائتمان </label>
                <input type="text" name="card_num" required>

                <input type="submit" value="شراء">
            </form>
        </div>

    </div>
    <?php
    require 'views/partials/footer.view.php';
    ?>
    <script src="JS/script.js"></script>
</body>

</html>