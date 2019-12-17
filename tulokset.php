<?php  include('oserveri.php'); ?>
<?php 
	if (isset($_GET['muokkaus'])) {
		$id = $_GET['muokkaus'];
		$update = true;
		$hae = mysqli_query($db, "SELECT * FROM ottelut WHERE id=$id");

		if (count($hae) == 1  ) {
			$n = mysqli_fetch_assoc($hae); // Tämän kanssa on ongelmia 
			$koti = $n['kotijoukkue'];
			$vieras = $n['vierasjoukkue'];
			$kmaalit = $n['kmaalit'];
			$vmaalit = $n['vmaalit'];
			$pmaara = $n['paivamaara'];
		}
	}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="tilastot.css">
</head>
<body> 
<input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Että saadaan id talteen mutta piilossa niin ei näy -->
<?php if (isset($_SESSION['viesti'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['viesti']; 
			unset($_SESSION['viesti']);
		?>
	</div>
<?php endif ?>

<?php $t = mysqli_query($db, "SELECT * FROM ottelut"); ?>

<table>
	<thead>
		<tr>
			<th>Kotijoukkue</th>
			<th>Vierasjoukkue</th>
			<th>Kotijoukkueen maalit</th>
			<th>Vierasjoukkueen maalit</th>
			<th>Päivämäärä</th>
			<th colspan="2">Muokkaa</th>
			<th colspan="2">Poista</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($t)) { ?>
		<tr>
			<td><?php echo $row['kotijoukkue']; ?></td>
			<td><?php echo $row['vierasjoukkue']; ?></td>
			<td><?php echo $row['kmaalit']; ?></td>
			<td><?php echo $row['vmaalit']; ?></td>
			<td><?php echo $row['paivamaara']; ?></td>
			<td>
				<a href="tulokset.php?muokkaus=<?php echo $row['id']; ?>" class="muokkaus" >Muokkaa</a>
			</td>
			<td>
				<a href="oserveri.php?poista=<?php echo $row['id']; ?>" class="pois">Poista</a>
			</td>
		</tr>
	<?php } ?>
</table>




<form method="post" action="oserveri.php" >
		<div class="input-group">
			<label>Kotijoukkue</label>
			<input type="text" name="koti" value="<?php echo $koti; ?>">
		</div>
		<div class="input-group">
			<label>Vierasjoukkue</label>
			<input type="text" name="vieras" value="<?php echo $vieras; ?>">
		</div>
		<div class="input-group">
			<label>Kotijoukkueen maalit</label>
			<input type="text" name="kmaalit" value="<?php echo $kmaalit; ?>">
		</div>
		<div class="input-group">
			<label>Vierasjoukkueen maalit</label>
			<input type="text" name="vmaalit" value="<?php echo $vmaalit; ?>">
		</div>
		<div class="input-group">
			<label>Päivämäärä</label>
			<input type="text" name="pmaara" value="<?php echo $pmaara; ?>">
		</div>
		<div class="input-group">
			<?php if ($update == true): //Tallenna nappi muuttuu jos pitää päivittää?> 
	<button class="btn" type="submit" name="paivita" style="background: #556B2F;" >Päivitä</button>
<?php else: ?>
	<button class="btn" type="submit" name="tallenna" >Tallenna</button>
<?php endif ?>
		</div>
		<br>
		<p> <a href="Etusivu2.php" style="color: blue;">Takaisin</a> </p>
	</form>
</body>
</html>