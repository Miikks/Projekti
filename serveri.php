<?php
session_start();


$kayttajanimi = "";
$tarkistus = array(); 

// Yhteys tietokantaan
$db = mysqli_connect('localhost', 'root', '', 'rekisteri'); //Tänne pitää muokata oman tietokannan tiedot
if (isset($_POST['rekisteri'])) {
	rekisteri();
}
// Rekisteröi käyttäjä
function rekisteri(){
  global $db, $tarkistus, $kayttajanimi;

	$kayttajanimi =  e($_POST['kayttajanimi']);
	$salasana_1  =  e($_POST['salasana_1']);
	$salasana_2 =  e($_POST['salasana_2']);

//Tarkistaa ettei ole tyhjiä
	if (empty($kayttajanimi)) { 
		array_push($tarkistus, "Käyttäjänimi tarvitaan"); 
	}
	if (empty($salasana_1)) { 
		array_push($tarkistus, "Salasana tarvitaan"); 
	}
	if ($salasana_1 != $salasana_2) {
		array_push($tarkistus, "Salasanat eivät täsmää");
	}
	//Tarkistetaan ettei käyttäjänimeä ole jo tietokannassa
	$kayttajanimi_check_query = "SELECT * FROM kayttajat WHERE kayttajanimi='$kayttajanimi' LIMIT 1";
  $tavoite = mysqli_query($db, $kayttajanimi_check_query);
  $user = mysqli_fetch_assoc($tavoite);
  
  if ($user) { // jos kayttajanimi on olemassa
    if ($user['kayttajanimi'] === $kayttajanimi) {
      array_push($tarkistus, "Käyttäjänimi on jo käytössä");
    }
  }

	// Tarkistetaan että on 0 virhettä formissa
	if (count($tarkistus) == 0) {
		$salasana_1 = md5($salasana_1); // Salataan salasana ettei ole raakana tietokannassa

		if (isset($_POST['tyyppi'])) {
			$tyyppi = e($_POST['tyyppi']);
			$query = "INSERT INTO kayttajat (kayttajanimi,salasana,tyyppi) 
					  VALUES('$kayttajanimi','$salasana_1', '$tyyppi')";
			mysqli_query($db, $query);
			header('location: Etusivu.php');
		}else{
			$query = "INSERT INTO kayttajat (kayttajanimi,salasana,tyyppi) 
					  VALUES('$kayttajanimi', '$salasana_1', 'tyyppi')";
			mysqli_query($db, $query);

			// nappaa luodun käyttäjän id
			$nappaa_id = mysqli_insert_id($db);

			$_SESSION['user'] = idtalteen($nappaa_id); // Laittaa kirjautuneen käyttäjän sessioon
			header('location: Etusivu.php');				
		}
	}
} 
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
} //Funktio id nappaamiseen
function idtalteen($id){
	global $db;
	$query = "SELECT * FROM kayttajat WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
} // Tarkistaa onko admin kirjautunut sisään
function Admin()
{
	if (isset($_SESSION['kayttajanimi']) && $_SESSION['kayttajanimi']['tyyppi'] == 'admin' ) {
		return true;
	}else {
		return false;
	}
} //Tarkistetaan kirjautuminen
function onkokirjautunut()
{
	if (isset($_SESSION['kayttajanimi'])) {
		return true;
	}else{
		return false;
	}
}
if (isset($_POST['kirjau'])) {
	kirjautunut();
}


function kirjautunut(){
	global $db, $kayttajanimi, $tarkistus;

	
	$kayttajanimi = e($_POST['kayttajanimi']);
	$salasana = e($_POST['salasana']);

	// Tarkista ettei mitään puutu
	if (empty($kayttajanimi)) {
		array_push($tarkistus, "Käyttäjänimi vaaditaan");
	}
	if (empty($salasana)) {
		array_push($tarkistus, "Salasana vaaditaan");
	}

	// Kirjaudu jos ei ongelmia
	if (count($tarkistus) == 0) {
		$salasana = md5($salasana);

		$query = "SELECT * FROM kayttajat WHERE kayttajanimi='$kayttajanimi' AND salasana='$salasana' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // Käyttäjä löytyy
			// Tarkista onko admin vai tavallinen (tyyppi)
			$kayttajakirja = mysqli_fetch_assoc($results);
			if ($kayttajakirja['tyyppi'] == 'admin') {

				$_SESSION['kayttajanimi'] = $kayttajakirja;
				$_SESSION['success']  = "Olet kirjautunut adminina";
				header('location: Etusivu.php');		  
			}else{
				$_SESSION['kayttajanimi'] = $kayttajakirja;
				$_SESSION['success']  = "Olet kirjautunut tavallisena käyttäjän";

				header('location: Etusivu.php');
			}
		}else {
			array_push($tarkistus, "Salasana tai käyttäjä ei täsmää");
		}
	}
}
?>
