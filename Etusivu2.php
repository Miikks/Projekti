<?php 

// Tarkistaa onko käyttäjä kirjautunut, jos ei niin heittää suoraan kirjautumissivulle

include('serveri.php');
if (!onkokirjautunut()) {
	$_SESSION['msg'] = "Kirjaudu ensin sisään";
	header('location: kirjau.php');
}
  if (isset($_GET['ulos'])) { //Tarkistaa onko painettu kirjaudu ulos nappia
  	session_destroy();
  	unset($_SESSION['kayttajanimi']);
  	header("location: kirjau.php");
  }
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="ulkoasu.css">
</head>
<body>

<div class="header">
</div>
<div class="content">
  <?php  if (isset($_SESSION['kayttajanimi'])) : ?>
  <p> Seuraavalla sivulla voit katsella tilastoja. Vain ylläpitäjät voivat muokata tilastoja </p>
		
  <br>
    	<p valitse mieleisesi sivusto</p>
		<br>
		<p> <a href="Etusivu2.php?ulos='1'" style="color: red;">Kirjaudu ulos</a> </p>
		<p> <a href="Etusivu.php" style="color: blue;">Takaisin</a> </p>
		<br>
		<p> <a href="tulokset.php" style="color: blue;">Katso otteluiden tuloksia</a> </p>
		
    <?php endif ?>
</div>
		
</body>
</html>