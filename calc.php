<?php
	header('Content-Type: text/html');
	header('Cache-Control: no-cache');

	$kod_waluty = $_GET['waluta'];
	
	$walutaZ = $_GET['walutaZ'];
	$kwota = $_GET['kwota'];
	$data = $_GET['data'];
	$korekta = "";
	
	if ($data != date("Y-m-d")) {	
		$urlWgDaty = 'http://api.nbp.pl/api/exchangerates/rates/c/';
		$korekta = '/'.$data.'/';
		$pole = 'ask';
	} else {
		$urlWgDaty = 'http://api.nbp.pl/api/exchangerates/rates/a/';
		$pole = 'mid';
	}
	
	if ($kod_waluty != 'pln') {
		$kurs_json = file_get_contents($urlWgDaty.$kod_waluty.'/'.$korekta.'?format=json');
		$kurs_tabela = json_decode($kurs_json, true);
		$kurs_docelowa = $kurs_tabela['rates'][0][$pole];
		$dzien = $kurs_tabela['rates'][0]['effectiveDate'];
	} else {
		$kurs_docelowa = 1;	
	}
	
	if ($walutaZ != 'pln') {
		$kurs_json = file_get_contents($urlWgDaty.$walutaZ.'/'.$korekta.'?format=json');
		$kurs_tabela = json_decode($kurs_json, true);
		$kurs_zrodlowa = $kurs_tabela['rates'][0][$pole];
		$dzien = $kurs_tabela['rates'][0]['effectiveDate'];
	} else {
		$kurs_zrodlowa = 1;
	}
	
	if ($kod_waluty == 'pln' && $walutaZ == 'pln') {
		$kurs_docelowa = 1;
		$kurs_zrodlowa = 1;
		$dzien = date("Y-m-d");
	}
	
	$wynik = $kurs_zrodlowa * $kwota / $kurs_docelowa;
	
	echo '<div class="alert alert-success">Wynik wyliczony na podstawie średnich kursów z dnia '.$dzien.' to <strong>'.$wynik.' '.$kod_waluty.'</strong></div>';
	flush();
?>