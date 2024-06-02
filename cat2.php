<?php

require 'functions.php';
require 'Connection.php';


require 'views/partials/head.view.php';
?>
<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {


  $db = new Database();



  $query = "select * from bookstore.category where name = :search_query";


  $db->query($query, [
    'search_query' => $_POST['search']
  ]);


  $category = $db->find();


  $img_dir = 'images/' . $category['img_dir'];

?>
  <div class="row row-cols-1 row-cols-lg-4 row-cols-md-2 row-cols-sm-1 g-4 ms-2 mt-1 justify-content-center m-5">
    <div class="col first_card">
      <div class="card one">
        <img src="<?= $img_dir ?>" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title book-name" style="font-size: 20px;font-weight: bold;"> <?= $category['name'] ?></h5>
        </div>
      </div>
    </div>
  </div>

<?php
  die;
}
?>

<body>
  <!-- navbar -->
  <header> <?php
            require 'views/partials/nav.view.php';
            ?>
  </header>
  <!--End navbar -->
  <!--Book Category -->
  <main>
    <div class="container">
      <!-- title -->
      <div class="title">
        <p>أقسام الكتب</p>
      </div>
      <!-- search -->
      <div class="search">
        <form method="POST">
          <input type="text" required placeholder="البحث عن قسم" name="search">
          <button><i class="fa-solid fa-magnifying-glass srch"></i></button>
        </form>
      </div>

      <!-- categiry -->
      <div class="book_categories">

        <div class="row row-cols-1 row-cols-lg-4 row-cols-md-2 row-cols-sm-1 g-4 ms-2 mt-1">
          <?php $db = new Database();

          $query = 'select * from bookstore.category';
          $db->query($query);
          $categories = $db->get();

          $count = 0;
          foreach ($categories as $category) :
            $img_dir = 'images/' . $category['img_dir'];
            if ($category['name'] === 'قسم مقارنة الأديان') continue;
          ?>

            <div class="col first_card">
              <div class="card one">
                <?php echo '<a href="cat_det.php?id=' . $category['id'] . '"><img src="' . $img_dir .
                  '" class="card-img-top" alt="..."></a>'; ?> <div class="card-body">
                  <h5 class="card-title book-name"> <?= $category['name'] ?></h5>
                </div>
              </div>
            </div>

          <?php endforeach; ?>


          <div class="col">
            <div class="card one">
              <img src="./images/مقارنه اديان.jpg" class="card-img-top" alt="..." style="height: 237px;">
              <div class="card-body">
                <h5 class="card-title book-name" style="font-size: 20px;font-weight: bold; ">قسم مقارنة الاديان</h5>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
  </script>
  <script src="JS/script.js"></script>
</body>

</html>