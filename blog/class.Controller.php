<?php
require_once "class.DB.php";
class Controller
{
	
	public function __construct()
	{
		$this->action();
	}
	
	public function action()
	{
		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			if(isset($_POST['action']))
			{
				$akcja = $_POST['action'];
				switch($akcja)
				{
					case 'dodajPost':
						$this->dodaniePosta();
						break;
					case 'dodajKomentarz':
						$this->dodanieKomentarza();
						break;
					default: 
						break;
				}
			}
		}
	}
	
	public function dodaniePosta()
	{
		$tytul = $_POST['tytul'];
		$tresc = $_POST['tekst'];
		$autor = $_POST['autor'];
		
		$query ="
		INSERT INTO `zalogowani`.`posty` (`autor`, `tytul`, `tresc`) 
		VALUES ('$autor', '$tytul', '$tresc');
		";
		$db = new DB();
		$db -> query($query);
	}
	
	public function dodanieKomentarza()
	{
		$id_posta = $_POST['id'];
		$tresc = $_POST['tekst'];
		$autor = $_POST['autor'];
		
		$query ="
		INSERT INTO `zalogowani`.`komentarze` (`id_posta`,`autor`, `tresc`) 
		VALUES ('$id_posta', '$autor', '$tresc');
		";
		$db = new DB();
		$db -> query($query);
	}	
	
	public function getPosty()
	{
		$db = new DB();
		$query = "select * from posty";
		$result = $db -> query($query);
		return $result;
	}
	
	public function getKomentarze($id_posta)
	{
		$db = new DB();
		$query = "select * from komentarze where id_posta=$id_posta";
		$result = $db -> query($query);
		return $result;
	}
}
?>