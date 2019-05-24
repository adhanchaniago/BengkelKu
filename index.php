<?php
session_start();
if(empty($_SESSION['username'])){
  header("location:login.php");
}
?>
<!DOCTYPE html>

<html>

<head>
  <title>Bengkel</title>

  <!-- Panggil Bootstrap -->
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
  <script src="jquery/jquery.min.js"></script>
  <script src="jquery/bootstrap.min.js"></script>
  <style type="text/css">
    body{
      background-color: #f0f5f5;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-default navbar-static-top">
    <div class="container">
      <div class="navbar-header">
       <!-- Skrip dibawah ini akan aktif ketika posisi mobile -->
       <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
       </button>
       <a class="navbar-brand" href="index.php">Bengkel Online</a>
     </div>
     <!-- Daftar menu yang diinginkan-->
     <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">

        <li>
          <a href="index.php">
            <span class="glyphicon glyphicon-home"></span> Beranda
          </a>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-folder-open"></span> &nbsp;Mastering Data 
            <b class="caret"></b>
          </a>
          <ul class="dropdown-menu">

            <li>
             <a href="index.php?lihat=jasa/index">
               <span class="glyphicon glyphicon-user"></span> &nbsp;Master Jasa</a>
             </li>
             <li>
               <a href="index.php?lihat=sparepart/index">
                 <span class="glyphicon glyphicon-lock"></span> &nbsp;Master Sparepart</a>
               </li>

             </ul>
           </li>

           <li>
            <a href="index.php?lihat=Transaksi/index">
              <span class="glyphicon glyphicon-usd"></span> Transaksi
            </a>
          </li>
          
          <li class="right">
            <a href="logout.php">
              <span class=" glyphicon glyphicon-log-out"></span> Logout
            </a>
          </li>

        </ul>
      </div><!-- #navbar -->
    </div><!-- .container -->
  </nav><!-- .navbar -->


  <div class="container">

    <?php
    /*Skrip dibawah berfungsi memanggil perintah sesuai nama file*/
    if(!empty($_GET['lihat'])){
      include('panggil/'.$_GET['lihat'].'.php');
    }

    else{
      include 'beranda.php';
    }
    ?>

  </div> <!-- .container -->


  <!-- Panggil JavaScript -->
  <!-- <script src="jquery/jquery.min.js"></script> -->
  <!-- <script src="bootstrap/js/bootstrap.min.js"></script>     -->
</body>

</html>
