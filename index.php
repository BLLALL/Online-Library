<?php require 'views/partials/head.view.php'; ?>

<?php require 'Connection.php'; ?>

<?php require 'functions.php';

$_SERVER['REQUEST_URI'] = '/WEB_Project/index.php';


session_start();



?>

<body>


  <!-- Nav -->

  <header>

    <?php

    // dd($_SERVER['REQUEST_URI']);

    require 'views/partials/nav.view.php'; ?>
  </header>

  <?php


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
                  <?php
                  if ($_SESSION['id']) : ?>
                    <i id="fav" class="fa-regular fa-heart <?= $is_fav["book_id"] == $result['id'] ? "fa-solid" : ''; ?>"></i>
                  <?php
                  endif;
                  ?>
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


  <!-- ------------------------------------------------------------------ -->
  <!-- Intro -->
  <div class="desc">
    <div class="container">
      <p> موقع عربي متكامل لقراءه وتحميل الكتب</p>
      <p class="tst"> وامكانية شراء الكتب الورقيه</p>
      <!-- Search -->
      <div class="search">
        <form method="GET">
          <input type="text" placeholder="البحث عن اسم كتاب او مؤلف" name="search_query">

          <button type="submit" name="search">
            <i class="fa-solid fa-magnifying-glass srch"></i>
          </button>
        </form>
      </div>
    </div>

  </div>

  <!-- Body -->

  <div class="content">
    <div class="container">
      <aside>
        <h1 class="lable">أقسام الكتب</h1>
        <ul>
          <?php $db = new Database();
          $query = 'select * from bookstore.category';
          $db->query($query);
          $categories = $db->get();
          $count = 0;
          foreach ($categories as $category) : ?>
            <?php // if($count = 10) break;
            // $count++;
            ?>
            <li><a href="cat_det.php?id= <?= $category['id'] ?>" style="font-size: 15px;"><?= $category['name'] ?></a></li>
          <?php endforeach;
          ?>
        </ul>
        <h1 class="lable">المؤلفين</h1>
        <ul>
          <?php $db = new Database();
          $query = 'select * from bookstore.author';
          $db->query($query);
          $authors = $db->get();
          $count = 0;
          foreach ($authors as $author) : ?>
            <?php // if($count = 10) break;
            // $count++;
            ?>
            <li><a href="authordet.php?id= <?= $author['id'] ?>" style="font-size: 15px;"><?= $author['name'] ?></a></li>
          <?php endforeach;
          ?>

        </ul>
      </aside>
      <div class="all">


        <div class="newadd">
          <h2>
            المضاف حديثا
          </h2>
          <div class="row row-cols-1 row-cols-lg-4 row-cols-md-2 row-cols-sm-1 g-4 ms-2 mt-1">


            <?php $db = new Database();

            $query = 'select * from bookstore.book order by publishing_date desc';
            $db->query($query);
            $books = $db->get();
            $count = 0;

            foreach ($books as $book) :
              $img_dir = 'images/' . $book['img_dir'];

              if ($count === 8) break;
              $count++;
              if ($_SESSION) :
                $fav_query = 'SELECT bookstore.user_fbooks.book_id FROM bookstore.user_fbooks WHERE bookstore.user_fbooks.book_id = :bId
              AND bookstore.user_fbooks.user_id = :id';

                $db->query($fav_query, [
                  'bId' => $book['id'],
                  'id' => $_SESSION['id']
                ]);

                $is_fav = $db->find();
              endif;
            ?>

              <div class="col">

                <div class="card one">

                  <?php $id = $book['id']; ?>
                  <?php echo '<a href="details.php?id=' . $id . '"><img src="' . $img_dir .
                    '" class="card-img-top" alt="..."></a>'; ?>
                  <div class="card-body">
                    <h5 class="card-title book-name" <?php if ((strlen($book['title'])) > 40) : ?> style="font-size: 13px;" <?php endif; ?>><a href="details.php?id= <?= $book['id'] ?>" style="color: black;font-family: 'Cairo', sans-serif; text-decoration:none; ">
                        <?= $book['title'] ?></a></h5>
                    <p class="card-text author"><a href="authordet.php?id= <?= $book['author_id'] ?>" style="color: black;font-family: 'Cairo', sans-serif; text-decoration:none; font-family: 'Katibeh', serif; ">
                        <?= $book['author_name'] ?></a></p>

                    <form method="GET">
                      <a href="favourites.php?book_id= <?= $book['id'] ?>" color="black" style="color: red;">
                        <?php
                        if ($_SESSION) : ?>
                          <i id="fav" class="fa-regular fa-heart <?= $is_fav["book_id"] !== $result['id'] ? "fa-solid" : ''; ?>"></i>
                        <?php
                        endif;
                        ?>

                      </a>
                    </form>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>


          </div>
        </div>
        <!-- most popular -->
        <div class="mostpopular">
          <h2>الأكثر مبيعا</h2>
          <div class="row row-cols-1 row-cols-lg-4 row-cols-md-2 row-cols-sm-1 g-4 ms-2 mt-1">
            <div class="col">
              <div class="card one">
                <img src="./images/a.jpeg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title book-name">اماريتا</h5>
                  <p class="card-text author">عمرو عبدالحميد</p>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card one">
                <img src="./images/b.jfif" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title book-name">امانوس</h5>
                  <p class="card-text author">حنان لاشين</p>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card one">
                <img src="./images/c.jfif" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title book-name" style="font-size: 15px;">محاط بالمرضى النفسيين</h5>
                  <p class="card-text author">توماس ايركسون</p>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card one">
                <img src="./images/six.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title book-name">ارض زيكولا</h5>
                  <p class="card-text author">عمرو عبدالحميد</p>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card one">
                <img src="./images/d.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title book-name">سقطرى</h5>
                  <p class="card-text author">حنان لاشين</p>
                </div>
              </div>
            </div>
            <!-- --------- -->
            <div class="col">
              <div class="card one">
                <img src="./images/fiv.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title book-name">علاقات خطره</h5>
                  <p class="card-text author">محمد طه</p>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="card one">
                <img src="./images/eig.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title book-name">ايكادولى</h5>
                  <p class="card-text author">حنان لاشين</p>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card one">
                <img src="./images/e.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title book-name">قواعد العشق الاربعون</h5>
                  <p class="card-text author">ايليف شافاق</p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>


  <?php include 'views/partials/footer.view.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="JS/script.js"></script>
  <script src="JS/fav.js"></script>
</body>

</html>