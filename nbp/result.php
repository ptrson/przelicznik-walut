<?php
header('Content-Type: text/html');
header('Cache-Control: no-cache');

$KodWalutyZrodlowej = $_GET['KodWalutyZrodlowej'];
$KodWalutyDocelowej = $_GET['KodWalutyDocelowej'];
$kwota = $_GET['kwota'];

    if($KodWalutyZrodlowej != $KodWalutyDocelowej)
    {
       
        if($KodWalutyZrodlowej != "PLN")
        {
            $get = file_get_contents("http://api.nbp.pl/api/exchangerates/rates/a/".$KodWalutyZrodlowej."/?format=json"); 
            $result = json_decode($get, true);
        }
        
        if($KodWalutyDocelowej != "PLN")
        {
            $get = file_get_contents("http://api.nbp.pl/api/exchangerates/rates/a/".$KodWalutyDocelowej."/?format=json"); 
            $result2 = json_decode($get, true);
        }
        if($KodWalutyZrodlowej=="PLN")
        {
            $wynik = $kwota / $result2['rates'][0]['mid'];
            echo "<strong>$kwota $KodWalutyZrodlowej</strong> po przeliczaniu z dnia {$result2['rates'][0]['effectiveDate']} wynosi <strong>$wynik $KodWalutyDocelowej</strong>";
        }
        else if ($KodWalutyDocelowej == "PLN")
        {
            $wynik = $kwota * $result['rates'][0]['mid'];
            echo "<strong>$kwota $KodWalutyZrodlowej</strong> po przeliczaniu z dnia {$result['rates'][0]['effectiveDate']} wynosi <strong>$wynik $KodWalutyDocelowej</strong>";
        }
        else
        {
            
            $wynik = $kwota * $result['rates'][0]['mid'] / $result2['rates'][0]['mid'];
            echo "<strong>$kwota $KodWalutyZrodlowej</strong> po przeliczaniu z dnia {$result['rates'][0]['effectiveDate']} wynosi <strong>$wynik $KodWalutyDocelowej</strong>";
        }
    }
    else 
    {
        echo "<strong>Kod Waluty docelowej i źródłowej nie może być taki sam!!! </strong>" ;
    }
    
	
?>