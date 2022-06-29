<?php include_once "config.php"; ?>
<?php
	$page_title = "Sniženje";
	$page_description = "";
?>
<!DOCTYPE html>
<html lang="hr">
	<?php include_once "includes/head.php"; ?>
<body>
	<?php include_once "includes/header.php"; ?>

	<section class="section products">
		<div class="container">
			<div class="row">
				<div class="gr-12">
					<h3 class="heading">Proizvodi na sniženju</h3>

					<div class="products__list">
						<?php
							$sql = "SELECT * FROM products WHERE sale_price > 0 ORDER BY publish_date DESC";
							$result = $conn->query($sql);
						?>
						<?php while($items = $result->fetch_assoc()) { ?>
						<div class="products__list_item">
							<?php include "template-parts/card--product.php"; ?>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<?php include_once "includes/footer.php"; ?>
	<?php include_once "includes/footer_inc.php"; ?>
</body>
</html>