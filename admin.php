<?php require 'funs.php'; ?>
<?php require 'functions.php';
?>
<!DOCTYPE html>
<html lang="ar">

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>اقرأ</title>
  <link rel="stylesheet" href="CSS/admin.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&family=Katibeh&family=Reem+Kufi:wght@700&display=swap"
    rel="stylesheet" />
  <style>
    #myDIV {
      width: 100%;
      padding: 50px 0;
      text-align: center;
      background-color: #877268;
      margin-top: 20px;
      display: none;
    }

    #mydiv2 {
      width: 100%;
      padding: 50px 0;
      text-align: center;
      background-color: #877268;
      margin-top: 20px;
      display: none;
    }

    #mydiv3 {
      width: 100%;
      padding: 50px 0;
      text-align: center;
      background-color: #877268;
      margin-top: 20px;
      display: none;
    }

    #mydiv4 {
      width: 100%;
      padding: 50px 0;
      text-align: center;
      background-color: #877268;
      margin-top: 20px;
      display: none;
    }

    #mydiv5 {
      width: 100%;
      padding: 50px 0;
      text-align: center;
      background-color: #877268;
      margin-top: 20px;
      display: none;
    }

    #mydiv6 {
      width: 100%;
      padding: 50px 0;
      text-align: center;
      background-color: #877268;
      margin-top: 20px;
      display: none;
    }

    #IdAddAdmin {
      width: 100%;
      padding: 50px 0;
      text-align: center;
      background-color: #877268;
      margin-top: 20px;
      display: none;
    }

    #IdDelAdmin {
      width: 100%;
      padding: 50px 0;
      text-align: center;
      background-color: #877268;
      margin-top: 20px;
      display: none;
    }
  </style>
</head>

<body>
  <header>
    <nav>
      <div class="container">
        <div class="ba">
          <div class="mobile-menu">
            <button id="menu-toggle">
              <div class="bar"></div>
              <div class="bar"></div>
              <div class="bar"></div>
            </button>
            <ul class="menu-items">
              <li class="special"><a href="login.html">تسجيل الدخول</a></li>
              <li class="speciall"><a href="SignUp.html">انشاء حساب</a></li>
              <li><a href="auther.html">عمليات الشراء</a></li>
              <li><a href="#">المؤلفين الحاليين</a></li>
              <li><a href="#">الأقسام الحاليه</a></li>
              <li><a href="index.html">الصفحه الرئيسيه</a></li>
            </ul>
            </ul>
          </div>
        </div>
        <ul class="list">
          <div class="log">
            <li class="special"><a href="login.html">تسجيل الدخول</a></li>
            <li class="speciall"><a href="neeew.html">انشاء حساب</a></li>
          </div>
          <li><a href="auther.html">عمليات الشراء</a></li>
          <li><a href="#">المؤلفين الحاليين</a></li>
          <li><a href="#">الأقسام الحاليه</a></li>
          <li><a href="index.html">الصفحه الرئيسيه</a></li>
        </ul>

        <div class="logo">
          <h1>اقرأ</h1>
          <i class="fa-solid fa-book-open"></i>
        </div>

      </div>
    </nav>
  </header>
  <!-- -------------------- -->
  <div class="container">
    <div class="modifysec">
      <div class="lable">
        <h1 class="firsth">مرحبا بك فى اقرأ</h1>
        <h1 class="sech">من فضلك اختر نوع التعديل الذى تريد</h1>
      </div>
      <div class="line"></div>
      <!--buttons-->
      <div class="options">
        <div class="part2">
          <button class="b4" id="bb4" onclick="myFunction()">
            اضافه كتاب
          </button>
          <button class="b5" id="bb5" onclick="myFunction3()">
            حذف كتاب
          </button>
        </div>
        <div class="part1">
          <button class="b1" id="bb1" onclick="myFunction1()">
            اضافه فئه
          </button>
          <button class="b2" id="bb2" onclick="myFunction4()">حذف فئه</button>
        </div>
        <div class="part3">
          <button class="b6" id="bb6" onclick="myFunction2()">
            اضافة مؤلف
          </button>
          <button class="b7" id="bb7" onclick="myFunction5()">
            حذف مؤلف
          </button>
        </div>
        <div class="part4">
          <button class="b8" id="bb8" onclick="myFunction6()">اضافة مشرف</button>
          <button class="b9" id="bb9" onclick="myFunction7()">حذف مشرف</button>
        </div>

        <!-- Delete Admin -->
        <div class="addAdmin" id="IdDelAdmin">
          <form method="POST" action="admin.php">
            <div>
              <label>البريد الالكتروني</label>
              <input type="email" name="delemail">
            </div>
            <button type="submit">التأكيد</button>
          </form>
        </div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delemail'])) {
          $do = $_POST['delemail'];
          del_adm($do);
        }
        ?>


        <!--delete book-->
        <div class="delbook" id="mydiv4">
          <form method="POST" action="admin.php">
            <div class="data1">
              <label>حدد اسم الكتاب </label>
              <input type="text" name="title" id="" />
            </div>

            <button type="submit">التأكيد</button>
          </form>
        </div>
        <?php

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])) {
          $var = $_POST['title'];
          del_book($var);
        }
        ?>

        <!--del author-->
        <div class="addaut" id="mydiv6">
          <form method="POST" action="admin.php">
            <div>
              <label>حدد اسم المؤلف</label>
              <input type="text" name="a_name">
            </div>
            <button type="submit">التأكيد</button>
          </form>
        </div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['a_name'])) {
          $hh = $_POST['a_name'];
          del_author($hh);
        }
        ?>
        <!--del Category-->
        <div class="addcat" id="mydiv5">
          <form method="POST" action="admin.php">
            <div>
              <label>حدد اسم الفئه</label>
              <input type="text" name="cat_name" />
            </div>
            <button type="submit">التأكيد</button>
          </form>
        </div>
        <?php
        //dd($_POST);
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cat_name'])) {
          $var1 = $_POST['cat_name'];
          del_cat($var1);
        }
        ?>




        <!--book add -->
        <div id="myDIV" class="addbook">
          <form method="POST" action="admin.php">
            <div class="klk">
              <div class="data1">
                <label>حدد اسم الكتاب </label>
                <input type="text" name="title" id="" />
              </div>
              <div class="data2">
                <label for="">حدد الفئه</label>
                <input type="text" name="category" />
              </div>
              <div class="data3">
                <label for="">حدد اسم الكاتب</label>
                <input type="text" name="author_name" />
              </div>
              <div class="data4">
                <label for="">حدد صوره الغلاف </label>
                <input type="text" name="img_dir" />
              </div>
              <div class="data5">
                <label for="">حدد السعر </label>
                <input type="text" placeholder="اختيارى" name="price" />
              </div>
              <div class="data6">
                <label>ارفق ملف الكتاب</label>
                <input type="text" name="book_dir">
              </div>
              <div class="data7">
                <label for="">وصف الكتاب</label>
                <!-- <textarea name="" id="" cols="120" rows="3" name="descriptions"></textarea> -->
                <input type="text" name="descriptions">
              </div>
              <!-- <button>التأكيد</button> -->
              <button type="submit">التأكيد</button>

            </div>
          </form>
        </div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['price'])) {
          $db = new Database();
          $query = 'select bookstore.category.id from bookstore.category where name = :category';
          $db->query($query, [
            'category' => $_POST['category']
          ]);
          $category_id = $db->find();
          $category_id = $category_id['id'];
          $query = 'select bookstore.author.id from bookstore.author where name = :author';
          $db->query($query, [
            'author' => $_POST['author_name']
          ]);
          $author_id = $db->find();
          $author_id = $author_id['id'];
          $query2 = 'insert into bookstore.book (title, category_id, author_name, img_dir, price, book_dir, descriptions, author_id)
values (?,?,?,?,?,?,?,?)';
          $params = [
            $_POST['title'],
            $category_id,
            $_POST['author_name'],
            $_POST['img_dir'],
            $_POST['price'],
            $_POST['book_dir'],
            $_POST['descriptions'],
            $author_id
          ];
          $db->query($query2, $params);
          
        }
        ?>

        <!--category add -->

        <div class="addcat" id="mydiv2">
          <form method="POST" action="admin.php">
            <div>
              <label>حدد اسم الفئه</label>
              <input type="text" name="name" />
            </div>
            <div>
              <label>ارفق صوره الفئه</label>
              <input type="text" name="cat_img_dir">
            </div>
            <button type="submit">التأكيد</button>
          </form>
        </div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cat_img_dir'])) {
          $n = $_POST['name'];
          $im = $_POST['cat_img_dir'];
          $db = new Database();

          $query = "insert into bookstore.category (name,img_dir) values (:name,:img_dir) ";

          $db->query($query, [
            'name' => $n,
            'img_dir' => $im
          ]);

        }

        ?>


        <!--author add-->
        <div class="addaut" id="mydiv3">
          <form method="POST" action="admin.php">
            <div>
              <label>حدد اسم المؤلف</label>
              <input type="text" name="name">
            </div>
            <div>
              <label>صوره المؤلف</label>
              <input type="text" name="a_img_dir">
            </div>
            <button type="submit">التأكيد</button>
          </form>
        </div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['a_img_dir'])) {
          $v1 = $_POST['name'];
          $v2 = $_POST['a_img_dir'];
          $db = new Database();
          $query = "insert into bookstore.author (name,img_dir) values (:name,:img_dir) ";

          $db->query($query, [
            'name' => $v1,
            'img_dir' => $v2
          ]);
          unset($_POST);
        }

        ?>

        <!-- Add Admin -->
        <div class="addAdmin" id="IdAddAdmin">
          <form method="POST" action="admin.php">
            <div>
              <label>اسم المستخدم</label>
              <input type="text" name="username">
            </div>
            <div>
              <label>كلمة المرور </label>
              <input type="password" name="pass">
            </div>
            <div>
              <label>البريد الالكتروني</label>
              <input type="email" name="email">
            </div>
            <button type="submit">التأكيد</button>
          </form>
        </div>
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
          $w = $_POST['username'];
          $w2 = $_POST['pass'];
          $w3 = $_POST['email'];
          $db = new Database();
          $query = "insert into bookstore.admin (username,password,email) values (:username,:password,:email) ";

          $db->query($query, [
            'username' => $w,
            'email' => $w3,
            'password' => $w2
          ]);
          // unset($_POST);
        }
        ?>
        <?php unset($_POST); ?>

      </div>
    </div>
  </div>



  <footer style="margin-top: 300px;">
    <p class="cpy">
      جميع حقوق الملكيه محفوظه للمؤلفين والموقع غير مسؤول عن افكار المؤلفين
    </p>
    <div class="flx">
      <p>: تواصل معنا</p>
      <div class="container">
        <ul>
          <li>
            <a href="#"><i class="fa-brands fa-facebook"></i>Iqraa.facebook.com</a>
          </li>
          <li>
            <a href="#"><i class="fa-solid fa-envelope"></i>Iqraa420@gmail.com</a>
          </li>
          <li>
            <a href="#"><i class="fa-brands fa-instagram"></i>Iqraa.instagram.com</a>
          </li>
          <li>
            <a href="#"><i class="fa-brands fa-twitter"></i>Iqraa.twitter.com</a>
          </li>
        </ul>
      </div>
    </div>
  </footer>
  <script>
    function myFunction() {
      var x = document.getElementById("myDIV");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }
    function myFunction1() {
      var x = document.getElementById("mydiv2");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }
    function myFunction2() {
      var x = document.getElementById("mydiv3");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }
    function myFunction3() {
      var x = document.getElementById("mydiv4");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }
    function myFunction4() {
      var x = document.getElementById("mydiv5");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }
    function myFunction5() {
      var x = document.getElementById("mydiv6");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }
    function myFunction6() {
      var x = document.getElementById("IdAddAdmin");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }
    function myFunction7() {
      var x = document.getElementById("IdDelAdmin");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }
  </script>
  <script src="JS/script.js"></script>

</body>

</html>