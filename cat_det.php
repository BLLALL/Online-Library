<?php require 'Connection.php'; ?>

<?php require 'functions.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اقرأ</title>
    <link rel="stylesheet" href="CSS/all.css">
    <link rel="stylesheet" href="CSS/all.min.css">
    <link rel="stylesheet" href="CSS/cat_det.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&family=Katibeh&family=Reem+Kufi:wght@700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Nav -->
    <header>
        <?php require 'views/partials/nav.view.php'; ?>
    </header>
    <!-- start details -->
    <?php $db = new Database();
    $id = $_GET['id'];
    $query = 'select * from bookstore.category where id = :id';
    $db->query($query, ["id" => $id]);
    $requested = $db->find();
    //dd($requested);
    ?>
    <main>
        <div class="container">
            <div class="container">
                <div class="card_details">
                    <div class="photo_author">
                        <?php $img_dir = 'images/' . $requested["img_dir"] ?>
                        <img src="<?php echo $img_dir; ?>" width="1500" height="350">
                    </div>
                    <div class="all_details">
                        <p class="name_author">
                            <?= $requested["name"] ?>
                        </p>
                        <div class="details_author">

                            <?php $db = new Database();
                            $id = $_GET['id'];
                            $query = 'select * from bookstore.book where category_id = :id';
                            $db->query($query, ["id" => $id]);
                            $books = $db->find();
                            // dd($books);
                            ?>

                            <div class="all_book">
                                <p>: من اهم الكتب في هذا القسم </p>
                                <?php //foreach ($books as $book): 
                                ?>
                                <p>
                                    <?= $books['title'] . '-' ?>
                                </p>
                                <?php //endforeach; 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- all books -->
            <div class="container">
                <div class="allbooks">
                    <div class="name">
                        <p>الكتب</p>
                        <hr>
                    </div>
                    <div class="row row-cols-1 row-cols-lg-4 row-cols-md-2 row-cols-sm-1 g-2 ms-2 mt-5">
                        <div class="col card_1">
                            <div class="card one">
                                <!-- <img class="img1" src="./images/امانوس.jpeg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title book-name">امانوس</h5> -->
                                <?php
                                $db = new Database();
                                $id = $_GET['id'];
                                $query = 'SELECT * FROM bookstore.book WHERE category_id = :id';
                                $db->query($query, [
                                    'id' => $id
                                ]);
                                $books = $db->get();
                                foreach ($books as $book) : ?>
                                    <?php
                                    $b_img = $book['img_dir'];

                                    $img_ = "images/" . $b_img;
                                    ?>
                                    <?php
                                    echo '<a href="details.php?id=' .$book["id"].'"><img src="' . $img_ . '" class="card-img-top" alt="..."></a>'  ?>
                                        <!-- <img class="img1" src="" class="card-img-top" alt="..."> -->
                                        <div class="card-body">
                                            <h5 class="card-title    book-name">
                                                <?= $book['title'] ?>
                                            </h5>
                                        </div>
                                    <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </main>
    <!--  start footer -->
    <?php
    require 'views/partials/footer.view.php';
    ?>
    <!--  end footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="JS/script.js"></script>
</body>

</html>