<?php
require "TovarGet.php"?>
<!DOCTYPE html>
<html lang="ru">

<head>

	<meta charset="utf-8">
	<base href="/">

	<title>Вкусное рядом - Консервированные овощи</title>
	<meta name="description" content="">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<!-- Template Basic Images Start -->
	<meta property="og:image" content="img/green.png">
	<link rel="icon" href="img/favicon/favicon.ico">
	<link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon-180x180.png">
	<!-- Template Basic Images End -->
	
	<!-- Custom Browsers Color Start -->
	<meta name="theme-color" content="#04B404">
	<!-- Custom Browsers Color End -->

	<link rel="stylesheet" href="css/main.min.css">

</head>

<body>

	<!-- Custom HTML -->

 <header>
      <div class="container">
      <nav class="navbar navbar-expand-xl navbar-light" style="color: #white;">
  			<a class="navbar-brand d-none d-sm-block d-sm-none d-md-block" href="#">
  			<img src="img/logo_all_pikto.png" width="120" height="35" class="d-inline-block align-top" alt="">
  				<strong>Вкусное Рядом</strong>
  			</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="\"> Главная<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.html">О нас </a>
            </li>            
            <li class="nav-item active">
              <a class="nav-link" href="product.html"><i class="fab fa-product-hunt"></i> Продукты </a>
            </li>                        
          </ul>
		      <span class="navbar-text"><i class="fas fa-phone-square"></i> <strong>+7(812)333-33-55 </strong></span>
          <button href="#form" class="btn btn-outline-success my-2 my-sm-0 popup-with-form" type="submit" style="margin-left: 10px;">Оставить сообщение</button>
        </div>
      </nav>
    </div>
  </header>
    <main role="main">

<div class="section-pic" style="background-image: url('img/splash_fon/vegitables.jpg');">
  <div class="row">
    <div class="col-12">
  <p class="text-center" style="color: #fff; font-size: 54px; font-weight: 500; line-height: 1.1;padding-top: 400px;"> КОНСЕРВИРОВАННЫЕ ОВОЩИ</p>
    </div>
  </div>
</div>

<div class="row d-lg-none">
  <nav class="nav">
    <a class="nav-link" href="canned_vegetables.html"><strong>Консервированные овощи</strong></a>
    <a class="nav-link" href="condensed_milk.html">Сгущенное молоко</a>
    <a class="nav-link" href="canned_meat.html">Тушенка</a>
    <a class="nav-link" href="cheese_butter.html">Сыры, масло, обезжиренное молоко</a>
  </nav> 
</div>
<div class="row">
  <div class="col-3 d-none d-lg-block">
    <nav class="nav flex-column ">
      <p class="nav-link" href="product.html"><strong>Продукты питания</strong></p>
      <a class="nav-link " href="canned_vegetables.html"><strong>Консервированные овощи</strong></a>
      <a class="nav-link" href="condensed_milk.html">Сгущенное молоко</a>
      <a class="nav-link" href="canned_meat.html">Тушенка</a>
      <a class="nav-link active" href="cheese_butter.html">Сыры, масло, обезжиренное молоко</a>
    </nav>
  </div>
  <div class="col center-block">
    <div class="row">
        <?php foreach($tovars_ID1 as $tovar){?>    
      <div class="col">
        <div class="card" style="height: 480px; width: 18rem;">
          <img class="card-img-top mx-auto pt-2" src="i/<?php echo "$tovar->imagepath" ?>" alt="Вкусное рядом! <?php echo "$tovar->name" ?>" style="width: 180px; display: block;" data-holder-rendered="true">
          <div class="card-body">
            <h5 class="card-title"><?php echo "$tovar->name" ?></h5>
            <p class="card-text"><?php echo "$tovar->secondname" ?></p>
          </div>
        </div>
      </div> 
       <?php }?>                        
    </div>
  </div>
</div>
</div> 
<form id="form" class="white-popup-block mfp-hide">
  <div class="popup__inner">
  <h1>ОБРАТНАЯ СВЯЗЬ</h1>
    <p>Если у вас остались вопросы — напишите нам и мы ответим вам в самое ближайшее время</p>
        <input id="name" name="name" type="text" placeholder="Имя">
        <input id="email" name="email" type="email" placeholder="example@domain.com" required="">
        <input id="phone" name="phone" type="tel" placeholder="Eg. +447500000000" required="">
        <textarea id="textarea"></textarea>
  <button type="submit">ОТПРАВИТЬ</button>
  </div>
</form>
<hr class="featurette-divider">       
      </div><!-- /.container -->
            <!-- FOOTER -->
            <footer class="container">
            <ul class="nav justify-content-end">
              <li class="nav-item">
                <a class="nav-link active" href="#">Главная</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">О нас</a>
              </li>        
              <li class="nav-item">
                <a class="nav-link" href="#">Контакты</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Продукты питания</a>
              </li>
            </ul>
            </footer>
          </main>


	<script src="js/scripts.min.js"></script>

</body>
</html>
