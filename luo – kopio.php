<?php include('serveri.php') ?>
<?phpif (!Admin()) { // Tarkistaa onko admin vai ei
	$_SESSION['msg'] = "Ei oikeuksia";
	header('location: kirjau.php');
} ?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="ulkoasu.css">
</head>
<body>
	<div class="header">
		<h2>Admin - Luo käyttäjä</h2>
	</div>
	
	<form method="post" action="luo.php">

		

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
		<div class="input-group">	<!-- Piilotettuna koska kuka vaan voi lisätä, tarkoituksen olisi että vain admin voi -->
			<button type="submit" hidden class="btn" name="rekisteri">Luo käyttäjä</button>
			<p> <a href="Etusivu.php" style="color: blue;">Takaisin</a> </p>
		</div>
	</form>
</body>
</html>