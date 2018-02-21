<?php

	session_start();
	
	

?>
           

           
<?php
            require_once 'PHPMailer-master/PHPMailerAutoload.php';
?>

<!DOCTYPE html>
<html lang="pl">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-112751519-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-112751519-1');
	</script>

	
	
    <title>Przeliczanie walut</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/freelancer.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
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
    
		function runAjax() 
		{
			var xmlhttp;
			if (window.XMLHttpRequest)
			{
				// kod dla IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{	// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			} 
			a = document.getElementsByName("KodWalutyZrodlowej")[0].value;
			b = document.getElementsByName("KodWalutyDocelowej")[0].value;
			c = document.getElementsByName("kwota")[0].value;
             
			xmlhttp.open("POST", "nbp/result.php?KodWalutyZrodlowej="+a+"&KodWalutyDocelowej="+b+"&kwota="+c, true);
			xmlhttp.onreadystatechange = function()
			{
				if(xmlhttp.readyState== 4 && xmlhttp.status==200){document.getElementById("result").innerHTML=xmlhttp.responseText;}
			}
			xmlhttp.send();
		}
	</script>
	
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
              <ul class="nav navbar-nav navbar-right">

                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="blog/blogpolog.php">Blog</a>
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

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                
				
				  <?php
                           if(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true))
                                 {

                                      echo  '<a class="navbar-brand" href="logowanie/logout.php">Wyloguj Się</a>';
                                 }


                else { ?>
                <ul class="nav navbar-nav navbar-right">

                    <li class="page-scroll">
                       <a class="navbar-brand" href="#logowanie">Zaloguj</a>
                    </li>
                     <li class="page-scroll">
                       <p class="navbar-brand">|</p>
                    </li>
                    
                    <li class="page-scroll">
                         <a class="navbar-brand" href="logowanie/zarejestruj.php">Zarejestruj</a>
                    </li>
                    
                </ul>
                   
                <?php } ?>
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
                   <form action="logowanie/zaloguj.php" method="post" class="text-center" >
                        
                        <img class="img-responsive" src="img/witacz.jpg" alt="">
                        <div class="intro-text" id="logowanie" >
                        <span class="name">Poradnik ekonomiczny</span>
                        <hr class="star-light">
                        <span class="skills">Zadbaj z nami o swój portfel</br></br>
                    
                        
                           
                        <?php
                           if(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true))
                                 {

                                        echo "<h2><b>Witaj ".$_SESSION['user']."!</b></h2>";
                                        echo "<p><b>E-mail</b>: ".$_SESSION['email'];
                                        echo "<br/><b>Dni premium</b>: ".$_SESSION['dnipremium']."</p>";

                                        echo '<h1>Dziękujemy za zalogowanie w naszym serwisie</h1></br></br>';
                                        echo '<h3>Zapraszamy do dalszego korzystania.</br></h3>' ;
                                 }


                           else { ?>
                               
                               
                               <b>Aby posiadać dostęp do całego serwisu musisz się  <a href="logowanie/zarejestruj.php" style="color:#1973ac">zarejestrować </a></b></br></br>
                               
                               <b>Jeżeli już posiadasz konto w naszym serwisie, zaloguj się </b>
                               
                               </span>
                               </br></br></br></br>
                               
                               
                               <div class="col-lg-4 text-center col-lg-offset-4" >
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

    <!-- Portfolio Grid Section -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Przelicznik Walut</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <form class="form-horizontal col-sm-offset-4">
					<div class="form-group">
						<label class="control-label col-sm-2" for="kwota">Kwota:</label>
						<div class="col-sm-4">
							<input type="number" class="form-control" name="kwota" placeholder="Wpisz kwote">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="KodWalutyZrodlowej">Kod waluty źródłowej:</label>
						<div class="col-sm-4">	
							<select name="KodWalutyZrodlowej" class="form-control">
								<option>PLN</option>
								<option>THB</option>
								<option>EUR</option>
								<option>CHF</option>
								<option>GBP</option>
								<option>USD</option>
								<option>AUD</option>
								<option>HKD</option>
								<option>CAD</option>
								<option>HUF</option>
								<option>UAH</option>
								<option>JPY</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="KodWalutyDocelowej">Kod waluty docelowej:</label>
						<div class="col-sm-4">
							<select name="KodWalutyDocelowej" class="form-control">
								<option>PLN</option>
								<option>THB</option>
								<option>EUR</option>
								<option>CHF</option>
								<option>GBP</option>
								<option>USD</option>
								<option>AUD</option>
								<option>HKD</option>
								<option>CAD</option>
								<option>HUF</option>
								<option>UAH</option>
								<option>JPY</option>
							</select>
						</div>
					</div>
                    
					<div class="control-label col-sm-6">
						<button type="button" class="btn btn-primary" onclick="runAjax()">Przelicz</button>
					</div>
				</form>
                </br>
                </br>
                </br>
                </br>
                
                    <div class="col-lg-12 text-center" id="result" style="margin-top: 20px"></div>
                     
                    </a>
                </div>
                
                    </a>
                </div>
               
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Zarządzaj swoimi kontaktami</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row text-center">
               
               <?php
                           if(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true))
                                 {
               ?>
                                <div class="col-lg-4 col-lg-offset-2">
                                    <form method="post">
                                            Imie:<br>
                                          <input type="text" class="form-control" name="name"><br>
                                            Nazwisko:<br>
                                          <input type="text" class="form-control" name="lastname"><br>
                                            Telefon:<br>
                                          <input type="phone" class="form-control" name="phone"><br>
                                            Email:<br>
                                          <input type="email" class="form-control" name="email"><br>
                                          <input type="submit" class="btn btn-success btn-lg" value="Dodaj">
                                    </form>




                                </div>
                                </br>
                                <div class="col-lg-8 col-lg-offset-2 ">
                                    <form method="post" style="float:left">
                                      Usuwanie, podaj ID:
                                      <input type="text" style="color: black"  name="delete_id" size="5"> <input type="submit" class="btn btn-success btn-lg" value="Usuń">
                                    </form>
                                    
                                    <?php
                                        $nazwa_bazy = "baza_kontaktowa";
                                        $tabela = "kontakt";
//login i hasło do bazy SQL 
                                        $bd = mysqli_connect ("localhost","root","",$nazwa_bazy);
                                        if (mysqli_connect_errno()){
                                            printf("błąd połączenia", mysqli_connect_error());
                                            die();
                                        } 
                                        if(isset($_POST['name'])){
                                            $name = $_POST['name'];
                                            $lastname = $_POST['lastname'];
                                            $phone = $_POST['phone'];
                                            $email = $_POST['email'];

                                            $query = "INSERT INTO `$nazwa_bazy`.`$tabela` (`id`, `user`, `imie`, `tel`, `email`) "; 
                                            $query = $query . " VALUES ('null', '$lastname', '$name', '$phone', '$email')";
                                            $result = mysqli_query($bd, $query);

                                            echo "Dodano osobe: " . $name . " " . $lastname . " " . $phone . " " . $email;
                                        }
                                        if(isset($_POST['delete_id'])){
                                            $delete_id = $_POST['delete_id'];

                                            $query = "DELETE FROM `$nazwa_bazy`.`$tabela` WHERE `kontakt`.`id` = $delete_id ";
                                            $result = mysqli_query($bd, $query);
                                        }
                                        if(isset($_GET['delete'])){
                                            $delete = $_GET['delete'];

                                            $query = "DELETE FROM `$nazwa_bazy`.`$tabela` WHERE `kontakt`.`id` = $delete ";
                                            $result = mysqli_query($bd, $query);
                                        }

                                        $sort = null;
                                        if(isset($_GET['sort'])){
                                            $sort = "order by " . $_GET['sort'];
                                        }

                                        $query = "select*from $tabela $sort";
                                        $result = mysqli_query($bd, $query);
                                        $id_notatki=1;
                                        $query_notatki = "select*from notatki where Id=$id_notatki";
                                        $result_notatki = mysqli_query($bd, $query_notatki);

                                        echo "<table class='table table-striped ' >
                                                <tr>
                                                    <th><a href='?sort=id'>Id</a></th>
                                                    <th><a href='?sort=nazwisko'>Nazwisko</a></th>
                                                    <th><a href='?sort=imie'>Imie</a></th>
                                                    <th><a href='?sort=telefon'>Telefon</a></th>
                                                    <th><a href='?sort=email'>Email</a></th>
                                                    <th>Edycja</th>
                                                </tr>";
                                        while ($row = mysqli_fetch_array ($result))
                                        {
                                            echo "<tr style='color:black'>";
                                            echo "<td scope='row'>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['nazwisko'] . "</td>";
                                            echo "<td>" . $row['imie'] . "</td>";
                                            echo "<td>" . $row['tel'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td><a href='?delete=" . $row['id'] . "' alt='Usuń' style='color:black'>X</a> <a href='baza/edit.php?id=" . $row['id'] . "' alt='Edycja' style='color:black'>Edit</a></td>";
                                            echo "</tr>";
                                        }
                                        echo "</table>";
                                    ?>
                    <?php } ?>
                    
                    
                    
<?php if(!isset($_SESSION['zalogowany']) )
                                  { ?>
                
                       <b>Jeżeli chcesz dodawać kontakty do bazy, musisz się zalogować </b></br></br>
                        <a href="#logowanie" class="btn btn-success btn-lg">Przejdź do logowania</a></br></br>
<?php } ?>
                
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
           

           
           
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Napisz do nas</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">

                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                    <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                    
                    
                    
                    <?php
                           if(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true))
                                 { ?>
                    
                    
<?php

                            if (isset($_POST["odbiorca_"]) && isset($_POST["temat_"]) && isset($_POST["tresc_"]))
                            {

                                $mail =  new PHPMailer;

                                $mail->SMTPDebug = 0;                               
// tu należy wpisać adres hosta, mail i hasło 
                                $mail->isSMTP();                                     
                                $mail->Host = 'smtp.gmail.com';  
                                $mail->SMTPAuth = true;                               
                                $mail->Username = 'owsiiztestowy@gmail.com';                
                                $mail->Password = 'Komputer12';                          
                                $mail->SMTPSecure = 'tls';                           
                                $mail->Port = 587;  
                                $mail->isSMTP();                                      

                                 $mail->setFrom('owsiiztestowy@gamil.com', 'Mailer');
                                 $mail->addAddress($_POST["odbiorca_"], 'Odbiorca');    
                                 $mail->Subject = $_POST["temat_"];
                                 $mail->Body    = $_POST["tresc_"];

                                if(!$mail->send()) {
                                    echo 'Wiadomość nie mogła zostać wysłana.';
                                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                                } else {
                                    echo 'Wiadomość została wysłana';
                                }
                            }
?>
                      
                      
                      
                      
                      
                      <form method="post" name="" id="">
                       

                        <div class="row control-group">
                            <div class="form-group col-xs-6 floating-label-form-group controls">
                                <label>Temat</label>
                                <input type="text" class="form-control" placeholder="Name" name="temat_" required data-validation-required-message="Please enter your name.">
                                
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-6 floating-label-form-group controls">
                                <label>Adres E-mail</label>
                                <input type="email" class="form-control" placeholder="Email Address" name="odbiorca_" required data-validation-required-message="Please enter your email address.">
                                
                            </div>
                        </div>
                       
        
                        <div class="row control-group">
                            <div class="form-group col-xs-6 floating-label-form-group controls">
                                <label>Wiadomość</label>
                                <textarea rows="5" class="form-control" placeholder="Message" name="tresc_" required data-validation-required-message="Please enter a message."></textarea>
                                
                            </div>
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button type="submit" class="btn btn-success btn-lg">Wyślij</button>
                            </div>
                        </div>
                    </form>
                    
                    
                    <?php } ?>
                    
              
    <?php if(!isset($_SESSION['zalogowany']))
                                  { ?>
    
                           <b> Formularz kontaktowy dostępny tylko dla użytkowników zalogowanych </b></br></br>
                    <a href="#logowanie" class="btn btn-primary" >Przejdź do logowania</a>
    
    
      <?php } ?>             
                    
                    
                    
                    
                </div>
            </div>
        </div>
    </section>

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
                                <a href="https://plus.google.com/explore" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="http://twitter.pl" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="https://pl.linkedin.com/" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
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
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/freelancer.min.js"></script>

</body>

</html>
