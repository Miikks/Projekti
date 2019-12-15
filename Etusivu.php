<?php 
  session_start(); 
// Tarkistaa onko käyttäjä kirjautunut, jos ei niin heittää suoraan kirjautumissivulle
  if (!isset($_SESSION['kayttajanimi'])) {
  	$_SESSION['msg'] = "Sinun pitää ensin kirjautua sisään";
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
 
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    
    <?php  if (isset($_SESSION['kayttajanimi'])) : ?>
    	<p>Tervetuloa!  <?php echo $_SESSION['kayttajanimi']; ?> Jatka eteenpäin tai kirjaudu tarvittaessa ulos</p>
		<br>
    	<p> <a href="Etusivu.php?ulos='1'" style="color: red;">Kirjaudu ulos</a> </p>
		<br>
		<p> <a href="Etusivu2.php" style="color: green;">Seuraavalle sivulle</a> </p>
    <?php endif ?>
</div>
		
</body>
</html>