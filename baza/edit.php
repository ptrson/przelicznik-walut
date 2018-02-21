<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
        
		header('Location: ../index.php');
		exit();
	}
	
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Przelicznik walut</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="../css/freelancer.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    
		
	
</head>

<body id="page-top" class="index" onload="laduj();">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <?php
                           if(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true))
                                 {

                                      echo  '<a class="navbar-brand" href="../logowanie/logout.php">Wyloguj Się</a>';
                                 }


                else { ?>
                    <a class="navbar-brand" href="#logowanie">Zaloguj Się</a>
                <?php } ?>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#portfolio">Przelicznik Walut</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#about">Baza</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#contact">KONTAKT</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                   <form action="../logowanie/zaloguj.php" method="post" class="text-center" >
                        
                        <img class="img-responsive" src="../img/profile.png" alt="">
                        <div class="intro-text" id="logowanie" >
                        <span class="name">I'm Engineer</span>
                        <hr class="star-light">
                        <span class="skills">Web Developer -  Artist - User Designer</br></br>
                    
                        
                           
                        <?php
                           if(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true))
                                 {

                                        echo "<h2><b>Witaj ".$_SESSION['user']."!</b></h2>";
                                        echo "<p><b>E-mail</b>: ".$_SESSION['email'];
                                        echo "<br/><b>Dni premium</b>: ".$_SESSION['dnipremium']."</p>";

                                      
                                 }


                           else { ?>
                               
                               
                               <b>Aby posiadać dostęp do całego serwisu musisz się zalogować !!!</b></span>
                               </br></br></br></br>
                               
                               
                               <div class="col-lg-4 text-center col-lg-offset-4" id="">
                                <input type="text" class="form-control text-center" placeholder="Login" name="login">
                                 </br>
                                
                                <input type="password" class="form-control text-center" placeholder="Password" name="haslo"> </br>
                                <input type="submit" class="btn btn-success btn-lg"  value="Zaloguj się" /></br></br>
                               
                         
                                
                            
                        <?php } ?>
                        <?php
                            if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
                        ?>
                           </div>
                            </form>

                         
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    
    <!-- About Section -->
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Zarządzaj swoimi kontaktami</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="col-lg-12 text-center row text-center">
               
               
        <h1>Wprowadź dane do zmiany Kontaktu</h1>
 </br></br>
<?php
        $uid = "";
        $nazwisko =  "";
        $imie = "";
        $telefon = "";
         $email = "";


        $nazwa_bazy = "pawel";
         $tabela = "kontakt";

         $bd = mysqli_connect ("localhost","root","",$nazwa_bazy);
        if (mysqli_connect_errno()){
                printf("błąd połączenia", mysqli_connect_error());
                die();
             } 


                                if(isset($_GET['id'])){
                                    $id = $_GET['id'];
                                }
                                if(isset($_GET['delete'])){
                                    $delete = $_GET['delete'];

                                    $query = "DELETE FROM `$nazwa_bazy`.`notatki` WHERE `notatki`.`Id_notatka` = $delete";
                                    $result = mysqli_query($bd, $query);
                                }





                                $query = "select*from $tabela";
                                $result = mysqli_query($bd, $query);

                                while($row = mysqli_fetch_array ($result))
                                {
                                    if ($row['id'] == $id)
                                    {
                                        $uid = $row['id'];
                                        $nazwisko =  $row['nazwisko'];
                                        $imie = $row['imie'];
                                        $telefon = $row['tel'];
                                        $email = $row['email'];
                                    }
                                }
                                ?>

                                
                                
                                <div class="col-lg-4 col-lg-offset-4">
                                    <form method="post"  style="text-center">
                                            Imie:<br>
                                          <input type="text" class="form-control" name="name" value="<?php echo $imie; ?>"><br>
                                            Nazwisko:<br>
                                          <input type="text" class="form-control" name="lastname" value="<?php echo $nazwisko; ?>"><br>
                                            Telefon:<br>
                                          <input type="phone" class="form-control" name="phone" value="<?php echo $telefon; ?>"><br>
                                            Email:<br>
                                          <input type="email" class="form-control" name="email" value="<?php echo $email; ?>"><br>
                                          <input type="submit" class="btn btn-success btn-lg" value="Aktualizuj">
                                        
                                    </form>

                                    <a href="../index.php" class="btn btn-success btn-lg">Wróć do strony głównej</a>

                 </br></br> </br></br>
                                </div>
                                
                                
                </br></br> </br></br> </br></br> </br></br> </br></br> </br></br> </br></br> </br></br> </br></br>
                                
                                <div class="col-sm-4">
                                 <?php
                                if(isset($_POST['name'])){
                                    $name = $_POST['name'];
                                    $lastname = $_POST['lastname'];
                                    $phone = $_POST['phone'];
                                    $email = $_POST['email'];

                                    $query = "UPDATE $tabela SET nazwisko='$lastname', imie='$name', tel='$phone', email='$email' WHERE id='$id';";
                                    $result = mysqli_query($bd, $query);
                                    header("Location: ../index.php");
                                die();
                                }


                                echo "</table>";

                                ?>
                                    </div>
                               
                    
                    
                    
                    

                
                </div>
            </div>
        </div>
    </section>
    
    
    
    <!-- Page Content -->

    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    
                    <div class="footer-col col-md-6 col-lg-offset-3">
                        <h3>Odwiedź nas na innych portalach</h3>
                        <ul class="list-inline">
                            <li>
                                <a href="http://facebook.com"  target="_blank" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-dribbble"></i></a>
                            </li>
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                   <div class="col-lg-2">
                        <div id="zegar" class="napis" style="text-align:center"> </div>
                        <script type="text/javascript"> </script>
                    </div>
                    <div class="col-lg-4 col-lg-offset-2">
                        Copyright &copy; My Website 2017 - P&copy;G
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- Portfolio Modals -->
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Project Title</h2>
                            <hr class="star-primary">
                            <img src="../img/portfolio/cabin.png" class="img-responsive img-centered" alt="">
                            <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://startbootstrap.com">April 2014</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://startbootstrap.com">Web Development</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Project Title</h2>
                            <hr class="star-primary">
                            <img src="../img/portfolio/cake.png" class="img-responsive img-centered" alt="">
                            <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://startbootstrap.com">April 2014</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://startbootstrap.com">Web Development</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Project Title</h2>
                            <hr class="star-primary">
                            <img src="../img/portfolio/circus.png" class="img-responsive img-centered" alt="">
                            <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://startbootstrap.com">April 2014</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://startbootstrap.com">Web Development</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Project Title</h2>
                            <hr class="star-primary">
                            <img src="../img/portfolio/game.png" class="img-responsive img-centered" alt="">
                            <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://startbootstrap.com">April 2014</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://startbootstrap.com">Web Development</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Project Title</h2>
                            <hr class="star-primary">
                            <img src="../img/portfolio/safe.png" class="img-responsive img-centered" alt="">
                            <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://startbootstrap.com">April 2014</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://startbootstrap.com">Web Development</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Project Title</h2>
                            <hr class="star-primary">
                            <img src="../img/portfolio/submarine.png" class="img-responsive img-centered" alt="">
                            <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://startbootstrap.com">April 2014</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://startbootstrap.com">Web Development</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="../js/jqBootstrapValidation.js"></script>
    <script src="../js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="../js/freelancer.min.js"></script>

</body>

</html>
