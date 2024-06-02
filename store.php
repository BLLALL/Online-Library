<?php
require 'views/partials/head.view.php';
require 'Connection.php';
require 'functions.php';

session_start();

if (isset($_GET['search'])) {



?> <style>
    :root {
      --main-color: #e3cec5;
      --secondcolor: rgb(95, 72, 61);
    }

    body {
      background-color: var(--main-color);
      text-align: right;
    }
  </style> <?php
            $db = new Database();

            // dd($_GET);

            $query = "select * from bookstore.book where title = :title";

            $db->query($query, [
              'title' => $_GET['search_query']
            ]);

            $result = $db->find();


            if ($result) :
            ?>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center m-5">
      <div class="col">

        <div class="card">
          <?php $img_dir = 'images/' . $result['img_dir'];
              $id = $result['id'];
          ?>
          <?php echo '<a href="details.php?id=' . $id . '"><img src="' . $img_dir .
                '" class="card-img-top" alt="..."></a>';
              $fav_query = 'SELECT bookstore.user_fbooks.book_id FROM bookstore.user_fbooks WHERE bookstore.user_fbooks.book_id = :bId
              AND bookstore.user_fbooks.user_id = :id';

              $db->query($fav_query, [
                'bId' => $result['id'],
                'id' => $_SESSION['id']
              ]);

              $is_fav = $db->find();

          ?>
          <div class="card-body">
            <h5 class="card-title book-name" <?php if ((strlen($result['title'])) > 40) : ?> style="font-size: 13px;" <?php endif; ?>><a href="details.php?id= <?= $result['id'] ?>" style="color: black;font-family: 'Cairo', sans-serif; text-decoration:none; ">
                <?= $result['title'] ?></a></h5>
            <p class="card-text author"><a href="authordet.php?id= <?= $result['author_id'] ?>" style="color: black;font-family: 'Cairo', sans-serif; text-decoration:none; font-family: 'Katibeh', serif; ">
                <?= $result['author_name'] ?></a></p>
            <form method="GET">
              <a href="favourites.php?book_id= <?= $result['id'] ?>" color="black" style="color: red;">
                <i id="fav" class="fa-regular fa-heart <?= $is_fav["book_id"] == $result['id'] ? "fa-solid" : ''; ?>"></i>
              </a>
            </form>
          </div>
        </div>
      </div>
    </div>

  <?php
            elseif (!$result) :
  ?> <h1 style=" text-red-500 mt-2"><?= "لم نجد ما تبحث عنه، من فضلك استعمل كلمات اكثر دقة." ?> </h1> <?php endif;
                                                                                                      ?>

<?php
  die;
}

?>

<body>
  <header>
    <?php
    require 'views/partials/nav.view.php';
    ?>
  </header>
  <div class="container">
    <h1 class="tit">مرحبا بك في متجر اقرأ للكتب نتمنى أن تجد ما يسرك و ينفعك</h1>
    <hr>
    <?php
    $db = new Database();
    $query = "select * from bookstore.book where price != 'مجاني'";
    $db->query($query);
    global $priced_books;
    $priced_books = $db->get();
    ?>
    <!-- Search -->
    <div class="search">
      <form method="GET">
        <input type="text" placeholder="البحث عن اسم كتاب بالمتجر" name="search_query">

        <button type="submit" name="search">
          <i class="fa-solid fa-magnifying-glass srch"></i>
        </button>
      </form>
    </div>
    <div class="newadd">
      <div class="row row-cols-1 row-cols-lg-4 row-cols-md-2 row-cols-sm-1 g-4 ms-2 mt-1">
        <?php foreach ($priced_books as $priced_book) :

        ?>
          <div class="col">
            <div class="card one">
              <?php $img_dir = 'images/' . $priced_book['img_dir'];
              echo '<a href="details.php?id=' . $priced_book['id'] . '"><img src="' . $img_dir .
                '" class="card-img-top" alt="..."></a>';

              $fav_query = 'SELECT bookstore.user_fbooks.book_id FROM bookstore.user_fbooks WHERE bookstore.user_fbooks.book_id = :bId
              AND bookstore.user_fbooks.user_id = :id';

              $db->query($fav_query, [
                'bId' => $priced_book['id'],
                'id' => $_SESSION['id']
              ]);

              $is_fav = $db->find();
              ?>
              <div class="card-body">
                <h5 class="card-title book-name" <?php if ((strlen($priced_book['title'])) > 40) : ?> style="font-size: 13px;" 
                  <?php endif; ?>>
                  <a href="details.php?id= <?= $priced_book['id'] ?>" 
                  style="color: black;font-family: 'Cairo', sans-serif; text-decoration:none; ">
                    <?= $priced_book['title'] ?>
                  </a>
                </h5>
                <p class="card-text author"><a href="authordet.php?id= <?= $priced_book['author_id'] ?>"
                style="color: black;font-family: 'Cairo', sans-serif; text-decoration:none; font-family: 'Katibeh', serif; ">
                    <?= $priced_book['author_name'] ?></a></p>
                <form method="GET">
                  <a href="favourites.php?book_id= <?= $priced_book['id'] ?>" color="black" style="color: red;">
                    <i id="fav" class="fa-regular fa-heart <?= $is_fav["book_id"] == $priced_book['id'] ? "fa-solid" : ''; ?>"></i>
                  </a>
                </form>
                <!-- <h5 class="card-title book-name" onclick="newpage()"><?= $priced_book['title'] ?></h5> -->
                <h4 class="card-text price"><?= $priced_book['price'] . '£' ?></h4>
                <button class="addToCard" style="border: solid; border-style: outset; border-color: var(--secondcolor);">
                  <a href="buying_form.php?title= <?= $priced_book['price']?><?= $priced_book['title']?>"  style="text-decoration: none; color: #000;">شراء الكتاب</a>
                </button>
              </div>
            </div>
          </div>
        <?php endforeach; ?>

        <!-- the updated -->
        <!-- <div class="col">
          <a href="bookDet.html">

            <div class="card one">
              <img src="./images/eig.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title book-name" onclick="newpage()">ايكادولى</h5>
                <h4 class="card-text price"> 200E</h4>
                <button class="addToCard"><a href="buying_form.html">شراء الكتاب</a></button>
              </div>
            </div>

          </a>
        </div> -->
        <!-- end -->

      </div>
    </div>
  </div>
  <?php
  require 'views/partials/footer.view.php';
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="JS/script.js"></script>
</body>

</html>