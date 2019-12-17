<?php
session_start();
//Toinen serveri ihan vain selkeyden takia

$kayttajanimi = "";
$tarkistus = array(); 

// Yhteys tietokantaan
$db = mysqli_connect('localhost', 'root', '', 'admintiedot'); //Tänne pitää muokata oman tietokannan tiedot
if (isset($_POST['admin'])) {
  $kayttajanimi = mysqli_real_escape_string($db, $_POST['kayttajanimi']);
  $salasana = mysqli_real_escape_string($db, $_POST['salasana']);

  if (empty($kayttajanimi)) {
  	array_push($tarkistus, "Käyttäjänimi puuttuu!");
  }
  if (empty($salasana)) {
  	array_push($tarkistus, "Salasana tarvitaan!");
  } //Tarkistukset 

  if (count($tarkistus) == 0) {
  //Salasana on tällä kertaa raakana koska vain yksin admin ja etten unohtaisi sitä :D
  	$query = "SELECT * FROM admin WHERE kayttajanimi='$kayttajanimi' AND salasana='$salasana'";
  	$results = mysqli_query($db, $query); //Tarkistetaan tietokannasta että annetut tiedot täsmäävät
  	if (mysqli_num_rows($results) == 1) { 
  	  $_SESSION['kayttajanimi'] = $kayttajanimi;//Onnistunut kirjautuminen
  	  $_SESSION['success'] = "Olet sisäänkirjautunut";
  	  header('location: Etusivu2.php');
  	}else {
  		array_push($tarkistus, "Salasana tai käyttäjänimi on väärin! Kokeile uudestaan");
  	}
  }
}
?>