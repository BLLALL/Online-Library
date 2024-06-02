<?php

require 'views/partials/head.view.php';
require 'Connection.php';
?>

<body>
  <header>
    <header> <?php
              session_start();
              require 'views/partials/nav.view.php';
              ?>
    </header>
  </header>

  <div class="container">
    <div class="auther">
      <h2>
        المؤلفين
      </h2>
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php $db = new Database();
        $query = 'select * from bookstore.author';
        $db->query($query);
        $authors = $db->get();
        foreach ($authors as $author) :
          $img_dir = 'images/' . $author['img_dir']; ?>
          <div class="col">
            <div class="card one">
              <?php $id = $author['id']; ?>
              <?php echo '<a href="authordet.php?id=' . $id . '"><img src="' . $img_dir .
                '" class="card-img-top" alt="..."></a>'; ?>

              <div class="card-body">
                <h5>
                  <?= $author['name'] ?>
                </h5>
              </div>
            </div>
          </div>
        <?php endforeach;
        ?>


      </div>
    </div>
  </div>



  <script src="JS/script.js"></script>
</body>

</html>