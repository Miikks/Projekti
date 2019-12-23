<?php include('serveri.php') ?>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="ulkoasu.css">
</head>
<body>
  <div class="header">
  	<h2>Kirjaudu sisään</h2>
  </div>
	 <!-- "Aloitussivu", tästä pääsee muuaalle -->
  <form method="post" action="kirjau.php">
  	<?php include('tarkistus.php'); ?>
  	<div class="input-group">
  		<label>Käyttäjänimi</label>
  		<input type="text" name="kayttajanimi" >
  	</div>
  	<div class="input-group">
  		<label>Salasana</label>
  		<input type="password" name="salasana">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="kirjau">Kirjaudu</button>
  	</div>
  	<p>
  	 Et ole vielä jäsen? <a href="rekisteri.php">Rekisteröidy</a> 
  	</p>
  </form>
</body>
</html>