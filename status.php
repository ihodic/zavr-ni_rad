<?php include_once "config.php"; ?>
<?php
	$page_title = "Status";

	$status = $_GET["status"];
?>
<!DOCTYPE html>
<html lang="hr">
	<?php include_once "includes/head.php"; ?>
<body class="status-page">
	<section class="section section--gutter-large">
		<div class="container">
			<div class="row">
				<div class="gr-12 gr-6@lg gr-centered text-center">

				<?php if ($status=="error") { ?>
					<h4 class="section__heading"><span>Greška</span></h4>
					<p>Došlo je do nepredviđene greške! Za pomoć slobodno nam se javite na info@clarissima.hr</p>
					<p><a href="/" class="btn">Vrati se na naslovnicu</a></p>
				<?php } ?>


				<?php if ($status=="order-success") { ?>
					<h4 class="section__heading"><span>Narudžba poslana</span></h4>
					<p>
						Hvala vam na vašoj narudžbi. Naši zaposlenici obraditi će narudžbu u najkraćem mogućem roku. Za sva pitanja slobodno nam se javite na info@rocast.hr
					</p>
					<p><a href="/" class="btn">Vrati se na naslovnicu</a></p>
				<?php } ?>
				</div>
			</div>
		</div>
	</section>

	<?php include_once "includes/footer_inc.php"; ?>
</body>
</html>