<?php require 'Connection.php'; ?>
<?php require 'functions.php'; ?>
<?php //require '../views/partials/head.view.php'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Details_book</title>
  <link rel="stylesheet" href="CSS/all.css">
  <link rel="stylesheet" href="CSS/all.min.css">
  <link rel="stylesheet" href="CSS/book_details.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&family=Katibeh&family=Reem+Kufi:wght@700&display=swap" rel="stylesheet">
</head>

<body>
  <!-- navbar -->
  <header> <?php
            session_start();

            require 'views/partials/nav.view.php';
            ?>
  </header>
  <!--End navbar -->

  <!-- start details -->

  <main>
    <div class="container">
      <div style="display: flex;
    flex-direction:row;" class="card_details">
        <div class="content_card">
          <span class="detail">
            <div class="name_book">
              <?php $db = new Database();
              $id = $_GET['id'];
              $query = 'select * from bookstore.book where id = :id';
              $db->query($query, ["id" => $id]);
              $requested = $db->find();
              ?>
              <span>
                <?= $requested["title"] ?>
              </span>
            </div>
            <div class="authors">
              <span class="name">المؤلف:</span>
              <span class="cont">
                <?= $requested["author_name"] ?>
              </span>
            </div>
            <div class="categ">
              <?php
              $query = 'SELECT bookstore.category.name
              FROM bookstore.category
              JOIN bookstore.book ON bookstore.book.category_id = bookstore.category.id
              WHERE bookstore.book.id = :id;';
              $db->query($query, ["id" => $id]);
              $req = $db->find();
              ?>

              <span class="name">القسم:</span>
              <span class="cont">
                <?= $req["name"] ?>
              </span>
            </div>




            <div class="lang">
              <span class="name">اللغه:</span>
              <span class="cont">العربية</span>
            </div>
            <div class="date_pub">
              <span class="name">تاريخ الاصدار:</span>
              <span class="cont">
                <?= $requested["publishing_date"] ?>
              </span>
            </div>
            <div class="type">
              <span class="cont">pdf</span>
              <span class="name">:نوع الملف</span>
            </div>
            <div class="discription">
              <span class="name">وصف الكتاب:</span>
              <span class="cont" style="margin-left: 30px;line-height: 35px;">
                <?= $requested["descriptions"] ?>
              </span>
            </div>
          </span>
        </div>
        </span>
        <?php $img_dir = 'images/' . $requested["img_dir"] ?>
        <div>
          <!-- <img class ="dd" src="<?php //$img_dir; 
                                      ?>" > -->
          <img style="
    margin-bottom: -10px;
    margin-top: 30px;
    padding-left: 15px;
    padding-right: 15px;
    border-radius: 30px;" src="<?php echo $img_dir; ?>" width="1500" height="350">
          <?php //'<img class="dd" src="' . $img_dir . '">' 
          ?>
        </div>
      </div>
    </div>
    </div>
    <?php if($requested['price'] === 'مجاني') : ?>
    <div class="circles">
      <div class="loading">
        <span><i class="fa-solid fa-download"></i></span>
        <p>
          <a style="font-weight: bold;" href="download.php?file=<?= $requested["book_dir"] ?>">تحميل</a>
        </p>
      </div>
      
      <div class="reading">
        <span><i class="fa-solid fa-book-open"></i></span>
        <form method="POST">
          <p><button style="font-weight: bold; font-size: 25px; color: white; background-color: rgb(95, 72, 61); border: none;" name="read-book">قراءة</button></p>
        </form>
      </div>
    </div>
    <?php endif;
    ?>
    </div>
  </main>




  <?php
  if (isset($_POST['read-book'])) :  ?>

    
    <iframe src="<?= 'books/' . $requested["book_dir"] ?>" width="100%" height="600px"></iframe>

  <?php endif; ?>

  <!--  start footer -->
  <?php
  require 'views/partials/footer.view.php';

  ?>
  <!--  end footer -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>