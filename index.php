<?php include_once "config.php"; ?>
<?php
	$page_description = "";
?>
<!DOCTYPE html>
<html lang="hr">
	<?php include_once "includes/head.php"; ?>
<body>
	<?php include_once "includes/header.php"; ?>

	<section class="section hero">
		<div class="hero__slider">
			<div class="slide">
				<img src="/images/slide-1.jpg" class="rspimg" alt="">
			</div>
			<div class="slide">
				<img src="/images/slide-2.jpg" class="rspimg" alt="">
			</div>
		</div>
	</section>

	<section class="section products">
		<div class="container">
			<div class="row">
				<div class="gr-12">
					<div class="products__header">
						<h5 class="heading">Izdvojeno iz ponude</h5>
					</div>

					<div class="products__list">
						<?php
							$sql = "SELECT * FROM products ORDER BY RAND() LIMIT 4";
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
			<div class="row">
				<div class="gr-12 text-center">
					<a href="/shop" class="btn mt30">Shop</a>
				</div>
			</div>
		</div>
	</section>

	<section class="section delivery">
		<div class="container">
			<div class="row">
				<div class="gr-12">
					<div class="delivery__cards">
						<div class="delivery__cards_item">
							<div class="card card--02">
								<div class="card__content">
									<i class="icon icon-truck"></i>
									<h5 class="heading">Dostava za hrvatsku 2 do 5 radnih dana</h5>
								</div>
							</div>
						</div>
						<div class="delivery__cards_item">
							<div class="card card--02">
								<div class="card__content">
									<i class="icon icon-credit-card"></i>
									<h5 class="heading">Mogućnost plaćanja pouzećem ili internet bankarstvom</h5>
								</div>
							</div>
						</div>
						<div class="delivery__cards_item">
							<div class="card card--02">
								<div class="card__content">
									<i class="icon icon-gift"></i>
									<h5 class="heading">Bestplatna dostava za narudžbe iznad 500kn</h5>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php include "template-parts/section--sale.php"; ?>
	
	<?php include_once "includes/footer.php"; ?>
	<?php include_once "includes/footer_inc.php"; ?>
</body>
</html>