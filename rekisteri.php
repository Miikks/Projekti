<?php include('serveri.php') ?>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="ulkoasu.css">
</head>
<body>
  <div class="header">
  	<h2>Tervetuloa asiakkaaksi!</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('tarkistus.php'); ?>
  	<div class="input-group">
  	  <label>Käyttäjänimi</label>
  	  <input type="text" name="kayttajanimi" value="<?php echo $kayttajanimi; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Salasana</label>
  	  <input type="password" name="salasana_1">
  	</div>
  	<div class="input-group">
  	  <label>Salasana toisen kerran</label>
  	  <input type="password" name="salasana_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="rekisteri">Tallenna</button>
  	</div>
  	<p>
		Olet jo jäsen? <a href="kirjau.php">Kirjaudu tästä linkistä</a>
  	</p>
  </form>
</body>
</html>