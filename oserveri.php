<?php //Tuloksille oma serveri selkeyden vuoksi
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'tilastot'); //Yhteys

	
	$koti = "";
	$vieras = "";
	$kmaalit = "";
	$vmaalit = "";
	$pmaara = "";
	$id = 0;
	$update = false;

	if (isset($_POST['tallenna'])) {
		$koti = $_POST['koti'];
		$vieras = $_POST['vieras'];
		$kmaalit = $_POST['kmaalit'];
		$vmaalit = $_POST['vmaalit'];
		$pmaara = $_POST['pmaara'];
// Tallentaa tietokantaan
		mysqli_query($db, "INSERT INTO ottelut (kotijoukkue,vierasjoukkue,kmaalit,vmaalit,paivamaara) VALUES ('$koti', '$vieras','$kmaalit','$vmaalit','$pmaara')"); 
		$_SESSION['viesti'] = "Tiedot tallennettu"; 
		header('location: tulokset.php');
	}
	if (isset($_POST['paivita'])) {
	$id = $_POST['id'];
	$koti = $_POST['koti'];
	$vieras = $_POST['vieras'];
	$kmaalit = $_POST['kmaalit'];
	$vmaalit = $_POST['vmaalit'];
	$pmaara = $_POST['pmaara'];
		// Päivittää tietokantaan
	mysqli_query($db, "UPDATE ottelut SET kotijoukkue='$koti', vierasjoukkue='$vieras',kmaalit='$kmaalit',vmaalit='$vmaalit',paivamaara='$pmaara' WHERE id=$id");
	$_SESSION['viesti'] = "Tiedot on päivitetty!"; 
	header('location: tulokset.php');
} // Poistaa tietokannasta
if (isset($_GET['poista'])) {
	$id = $_GET['poista'];
	mysqli_query($db, "DELETE FROM ottelut WHERE id=$id");
	$_SESSION['message'] = "Tulokset on poistettu!"; 
	header('location: tulokset.php');
}