<?php include('serveri.php');
 if (!Admin()) { // Tarkistaa onko admin vai ei
	
	header('location: Etusivu.php');
}
 ?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="ulkoasu.css">
</head>
<body>
	<div class="header">
		<h2>Admin - Luo käyttäjä</h2>
	</div>
	
	<form method="post" action="luo.php">

		<!-- Admin voi lisätä muita admineita tai käyttäjiä -->

		<div class="input-group">
			<label>Käyttäjänimi</label>
			<input type="text" name="kayttajanimi" value="<?php echo $kayttajanimi; ?>">
		</div>
		<div class="input-group">
			<label>Käyttäjätyyppi</label>
			<select name="tyyppi" id="tyyppi" >
				<option value=""></option>
				<option value="admin">Admin</option>
				<option value="user">tyyppi</option>
			</select>
		</div> 
		<div class="input-group">
			<label>Salasana</label>
			<input type="password" name="salasana_1">
		</div>
		<div class="input-group">
			<label>Vahvista salasana</label>
			<input type="password" name="salasana_2">
		</div>
		<div class="input-group">	
			<button type="submit"  class="btn" name="rekisteri">Luo käyttäjä</button>
			<p> <a href="Etusivu.php" style="color: blue;">Takaisin</a> </p>
		</div>
	</form>
</body>
</html>