<?php
    session_start();
?>
<?php
  require_once "connect.php";         
?>
<!DOCTYPE html>
<html lang="pl">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Rejestracja</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="../css/freelancer.css" rel="stylesheet">

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
    <script>
        function laduj()
            {
                odliczanie();
                
                
                
            };
         function odliczanie()
        {

                var dzisiaj = new Date();

                 var dzien = dzisiaj.getDate();
                                if (dzien<10) dzien = "0"+dzien;

                 var miesiac = dzisiaj.getMonth()+1;
                 if (miesiac<10) miesiac = "0"+miesiac;

                 var rok = dzisiaj.getFullYear();
                 if (rok<10) rok = "0"+rok;  
                 var godzina = dzisiaj.getHours();
                  if (godzina<10) godzina = "0"+godzina;
              var minuta = dzisiaj.getMinutes();
                 if (minuta<10) minuta = "0"+minuta;
                 var sekunda = dzisiaj.getSeconds();
                 if (sekunda<10) sekunda = "0"+sekunda;



                 document.getElementById("zegar").innerHTML = dzien+"/"+miesiac+"/"+rok+" | "+godzina+":"+minuta+":"+sekunda;
                setTimeout("odliczanie()",1000);
            
           }
    
		
	</script>
	
</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                
                <ul class="nav navbar-nav navbar-right">

                    <li class="page-scroll">
                       <a class="navbar-brand" href="../index.php">Zaloguj </a>
                    </li>
                     <li class="page-scroll">
                       <p class="navbar-brand">|</p>
                    </li>
                    
                    <li class="page-scroll">
                         <a href="#logowanie" class="navbar-brand" href="zarejestruj.php">Zarejestruj </a>
                    </li>
                    
                </ul>
                   
               
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">

                   
                   
                    <li class="page-scroll">
                        <a href="../index.php">Strona Główna</a>
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
            <img class="img-responsive" src="../img/profile.png" alt="">
                <div class="intro-text" id="logowanie" >
                    <span class="name">Poradnik ekonomiczny</span>
                        <hr class="star-light">
                            
                               
                               <span class="skills">Zadbaj z nami o swój portfel</br></br>
                                <div class="col-lg-4 col-lg-offset-4">
                                    <form method="post">
                                            
                                          <input type="text" class="form-control text-center" placeholder="Login" name="name"><br>
                                           
                                           
                                          <input type="password" class="form-control text-center" placeholder="Password" name="pass"><br>
                                           
                                          <input type="email" class="form-control text-center" placeholder="email" name="email"><br>
                                          <input type="submit" class="btn btn-success btn-lg" value="Zarejestruj">
                                    </form>

                                 </div>
                                </span>
                                </br>
                                
                                <div class="col-lg-8 col-lg-offset-2 ">
<?php
                                    if((isset($_POST['name'])) && ($_POST['name'])!=null )
                                    {
                                        $name = $_POST['name'];
                                        $pass = $_POST['pass'];
                                        $email = $_POST['email'];
                                        $tabela = "uzytkownicy";
                                        
                                   
                                       
                                            
                                        $bd = @new mysqli($host, $db_user, $db_password, $db_name);
                                         if ($bd->connect_errno!=0)
                                        {
                                                echo "Error: ".$bd->connect_errno;
                                        }
                                        else
                                        {
                                                
                                           
                                                
                                                $result = $bd->query("SELECT user FROM uzytkownicy where user='$name' || email='$email'");    
                                                $ilu_userow = $result->num_rows;
                                                
                                                if($ilu_userow==0)
                                                    {   
                                                        $_SESSION['zarejestrowany'] =  false;
                                                        $wiersz = $result->fetch_assoc();
                                                            
                                                        $sql = "INSERT INTO `$tabela` (`id`, `user`, `pass`, `email`, `dnipremium`) VALUES (null,'$name','$pass','$email',10)";
                                                        $result = $bd->query($sql);
                                                  
                                                        echo "Konto o nazwie ".$name." zostało dodane do bazy</br> Możesz przejść do strony logowania. ";    
                                                        
                                                    }
                                                else        
                                                    {
                                                        echo "Konto o podanej nazwie lub adresie email istnieje w bazie !!!";
                                                    }
                                                     
                                                    
                                              
                                        }
                                        mysqli_close($bd);
                                      }
?>
</div> 
                </hr>                      
            </div>
        </div>
    </header>

    
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
                                <a href="https://plus.google.com/explore" target="_blank" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="http://twitter.pl" target="_blank" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="https://pl.linkedin.com/" target="_blank" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
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
