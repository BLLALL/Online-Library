<?php require 'functions.php';
require 'Connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تفاصيل المؤلف</title>
  <link rel="stylesheet" href="CSS/all.css">
  <link rel="stylesheet" href="CSS/all.min.css">
  <link rel="stylesheet" href="CSS/autherDet.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&family=Katibeh&family=Reem+Kufi:wght@700&display=swap" rel="stylesheet">
</head>

<body>
  <!-- navbar -->
  <header>
    <?php
    session_start();
    require 'views/partials/nav.view.php';
    ?>

  </header>
  <!--End navbar -->
  <!-- start details -->
  <?php $db = new Database();
  $id = $_GET['id'];
  $query = 'select * from bookstore.author where id = :id';
  $db->query($query, ["id" => $id]);
  $requested = $db->get();
  //dd($requested);
  ?>
  <main>
    <div class="container">
      <div class="card_details">
        <div class="photo_author">
          <?php $img_dir = 'images/' . $requested[0]["img_dir"] ?>
          <img src="<?php echo $img_dir; ?>">
        </div>
        <div class="all_details">
          <p class="name_author">
            <?= $requested[0]["name"] ?>
          </p>
          <div class="details_author">
            <p>
              <?= $requested[0]["description"] ?>
            </p>
            <?php $query = 'select * from bookstore.book JOIN bookstore.author ON bookstore.book.author_id = bookstore.author.id
              where bookstore.author.id = :id';
            $db->query($query, ["id" => $id]);
            $books = $db->get();
            //dd($books);
            ?>
            <div class="all_book">
              <p>: من الكتب الخاصة بالكاتب </p>
              <?php foreach ($books as $book) : ?>
                <p>
                  <?= $book['title'] . '-' ?>
                </p>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>

      <!-- all books -->
      <div class="allbooks">
        <div class="name">
          <p>الكتب</p>
          <hr>
        </div>
        <div class="row row-cols-1 row-cols-lg-4 row-cols-md-2 row-cols-sm-1 g-2 ms-2 mt-5">
          <div class="col card_1">
            <div class="card one">
              <?php $db = new Database();
              $id = $_GET['id'];
              $query = 'select * from bookstore.book where author_id = :id';
              $db->query($query, ["id" => $id]);
              $books = $db->get();
              // dd($books);
              ?>

              <?php foreach ($books as $book) : ?>
                <?php $img_ = "images/" . $book['img_dir'];



                if ($_SESSION) :
                  $fav_query = 'SELECT bookstore.user_fbooks.book_id FROM bookstore.user_fbooks WHERE bookstore.user_fbooks.book_id = :bId
                                AND bookstore.user_fbooks.user_id = :id';

                  $db->query($fav_query, [
                    'bId' => $book['id'],
                    'id' => $_SESSION['id']
                  ]);

                  $is_fav = $db->find();
                endif;

                echo '<a href="details.php?id=' . $book["id"] . '"><img src="' . $img_ .
                  '" class="card-img-top" alt="..."></a>'; ?>
                <!-- <img class="img1" src="" class="card-img-top" alt="..."> -->
                <div class="card-body">
                  <h5 class="card-title book-name">
                    <?= $book['title'] ?>
                    <p class="card-text author"><a href="authordet.php?id= <?= $book['author_id'] ?>" style="color: black;font-family: 'Cairo', sans-serif; text-decoration:none; font-family: 'Katibeh', serif; ">
                        <?= $book['author_name'] ?></a></p>
                    <?php
                    if ($_SESSION) : ?>

                      <form method="GET">
                        <a href="favourites.php?book_id= <?= $book['id'] ?>" color="black" style="color: red;">
                          <i id="fav" class="fa-regular fa-heart <?= $is_fav["book_id"] == $book['id'] ? "fa-solid" : ''; ?>"></i>
                        </a>
                      </form>
                    <?php endif; ?>
                  </h5>
                </div>
              <?php endforeach; ?>
            </div>
          </div>

        </div>
      </div>
    </div>
  </main>
  <!-- End details -->
  <!--  start footer -->
  <?php
  require 'views/partials/footer.view.php';
  ?>
  <!--  end footer -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>