<?php include('adminserver.php') ?>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="ulkoasu.css">
</head>
<body>
  <div class="header">
  	<h2>Kirjaudu sisään ylläpitäjä</h2>
  </div>
	 
  <form method="post" action="admin.php">
  	<?php include('tarkistus.php'); //Salasana on tällä kertaa raakana koska vain yksin admin ja etten unohtaisi sitä :D ?>
  	<div class="input-group">
  		<label>Käyttäjänimi</label>
  		<input type="text" name="kayttajanimi" >
  	</div>
  	<div class="input-group">
  		<label>Salasana</label>
  		<input type="password" name="salasana">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="admin">Kirjaudu</button>
		<p> <a href="kirjau.php" style="color: red;">Takaisin</a> </p>
  	</div>
  </form>
</body>
</html>