<?php
session_start();


$kayttajanimi = "";
$tarkistus = array(); 

// Yhteys tietokantaan
$db = mysqli_connect('localhost', 'root', '', 'rekisteri'); //Tänne pitää muokata oman tietokannan tiedot

// Rekisteröi käyttäjä
if (isset($_POST['rekisteri'])) {
  
  $kayttajanimi = mysqli_real_escape_string($db, $_POST['kayttajanimi']);
  $salasana_1 = mysqli_real_escape_string($db, $_POST['salasana_1']);
  $salasana_2 = mysqli_real_escape_string($db, $_POST['salasana_2']);

  //Tarkistetaan ettei mitään puutu
  if (empty($kayttajanimi)) { array_push($errors, "Käyttäjä vaaditaan"); }
  if (empty($salasana_1)) { array_push($errors, "Salasana vaaditaan"); }
  if ($salasana_1 != $salasana_2) { //tarkistetaan salasanat että ovat samat
	array_push($tarkistus, "Salasanat eivät täsmää");
  }

  //Tarkistetaan ettei käyttäjää ole jo
  $user_check_query = "SELECT * FROM kayttajat WHERE kayttajanimi='$kayttajanimi'  LIMIT 1";
  $tulos = mysqli_query($db, $user_check_query);
  $kayttaja = mysqli_fetch_assoc($tulos);
  
  if ($kayttaja) { // Jos käyttäjä oli jo
    if ($kayttaja['kayttajanimi'] === $kayttajanimi) {
      array_push($tarkistus, "Käyttäjänimi on jo käytössä");
    }
  }

  // Hyväksy käyttäjä jos ei ongelmia
  if (count($tarkistus) == 0) {
  	$salasana = md5($salasana_1); //Salasana ei mene pelkkänä tekstinä tietokantaan

  	$query = "INSERT INTO kayttajat (kayttajanimi, salasana) 
  			  VALUES('$kayttajanimi', '$salasana')";
  	mysqli_query($db, $query);
  	$_SESSION['kayttajanimi'] = $kayttajanimi;
  	$_SESSION['success'] = "Olet nyt sisäänkirjautunut";
  	header('location: Etusivu.php'); // Ohjaa etusivulle
  }
} //Kirjaudutaan sisään
if (isset($_POST['kirjau'])) {
  $kayttajanimi = mysqli_real_escape_string($db, $_POST['kayttajanimi']);
  $salasana = mysqli_real_escape_string($db, $_POST['salasana']);

  if (empty($kayttajanimi)) {
  	array_push($tarkistus, "Käyttäjänimi puuttuu!");
  }
  if (empty($salasana)) {
  	array_push($tarkistus, "Salasana tarvitaan!");
  } //Tarkistukset 

  if (count($tarkistus) == 0) {
  	$salasana = md5($salasana);
  	$query = "SELECT * FROM kayttajat WHERE kayttajanimi='$kayttajanimi' AND salasana='$salasana'";
  	$results = mysqli_query($db, $query); //Tarkistetaan tietokannasta että annetut tiedot täsmäävät
  	if (mysqli_num_rows($results) == 1) { 
  	  $_SESSION['kayttajanimi'] = $kayttajanimi;//Onnistunut kirjautuminen
  	  $_SESSION['success'] = "Olet sisäänkirjautunut";
  	  header('location: Etusivu.php');
  	}else {
  		array_push($tarkistus, "Salasana tai käyttäjänimi on väärin! Kokeile uudestaan");
  	}
  }
}
?>
