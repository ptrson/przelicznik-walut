<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
        
		header('Location: ../index.php');
		
	}
	
?>

<?php
require_once "class.Controller.php";
$controller = new Controller();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog</title>

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
                        <a href="../index.php">Strona Główna</a>
                    </li>
                    <li class="page-scroll">
                        <a href="blogpolog.php">Blog</a>
                   
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
            <?php				
	$wpisy = $controller->getPosty();
	?>
							
                                <h1><b>BLOG</b></h1>
									
								<div class="panel panel-default">
									<div class="panel-heading"><h1><b>Dodaj wpis</b></h1></div>
									
									<form method="post">

									
									<label class="control-label col-sm-2">Tytuł:</label> 
									<div class="input-group">
										<div class="input-group-btn">
											<input type="text" class="form-control" name="tytul" placeholder="Tytuł.."><br>
										</div>
									</div>

									
									<label class="control-label col-sm-2" for="tekst">Tresc:</label> 
									<div class="input-group">
										<div class="input-group-btn">
											<input type="text" name="tekst" class="form-control" placeholder="Post..">
										</div>
									</div>

									
									<label class="control-label col-sm-2" for="autor">Autor:</label>
									<div class="input-group">
									<input type="text" class="form-control" name="autor" placeholder="Autor.."><br>
										<div class="input-group-btn">
											<input type="hidden" class="form-control" value="dodajPost" name="action">
											<input type="submit" class="btn btn-primary" value="Wyślij">
										</div>
									</div>

									
									</form>
								</div>
								
								
			<?php for($i=0; $i<count($wpisy); $i++) { ?>
							<div class="panel panel-default">
                                 <div class="panel-heading"><h3><b><?php echo $wpisy[$i]['tytul']; ?></b></h3></div>
                                    <div class="panel-heading">
                                    <p><?php echo $wpisy[$i]['tresc']; ?></p>
                                    <h4><b><?php echo $wpisy[$i]['autor']; ?></b></h4>
									</div>
								  <div class="panel-body">
                                    
									<div class="clearfix"></div>
                                    
									<?php
									$komentarze = $controller->getKomentarze($wpisy[$i]['id']);
									?>
						
									<ul>
										<?php
												for ($j=0; $j<count($komentarze); $j++) {
										?>
														<li style="list-style:none;">
															<?php 
															echo "<hr>";
																echo "<b>" . $komentarze[$j]['autor'] . "</b>: ";
																	echo $komentarze[$j]['tresc'];
															?>
														</li>
															<?php } ?>
									</ul>
									
									<hr>
                                    <form  method="post">
									
									
                                    <label class="control-label col-sm-2">Komentarz:</label> 
									<div class="input-group">
                                      <input type="text" class="form-control" placeholder="Komentarz.." name="tekst">
									  <div class="input-group-btn">
												<input type="hidden" value="dodajKomentarz" name="action">
												<input type="hidden" value="<?php echo $wpisy[$i]['ID']; ?>" name="id">
												<input type="submit" class="btn btn-primary" value="Wyślij"><br>
                                      </div>
									</div> 
									
                                    <label class="control-label col-sm-2">Autor:</label>
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Autor.." name="autor">
										<div class="input-group-btn">
												
										</div>
									</div> 
                                    
                                    </form>
                                    
                                  </div>
                               </div>

			<?php } ?>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        
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
    <!-- jQuery Version 1.11.1 -->
    <script src="../bootstrap-3.3.7/dist/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>

</body>

</html>
