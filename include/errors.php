<?php if (count($errorlist) > 0) : ?>
  <div class="message error validation_errors" >
  	<?php foreach ($errorlist as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php endif ?>