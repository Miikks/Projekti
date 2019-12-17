<?php  if (count($tarkistus) > 0) : ?>
  <div class="virhe">
  	<?php foreach ($tarkistus as $virhe) : ?>
  	  <p><?php echo $virhe ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>