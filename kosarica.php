<?php include_once "config.php"; ?>
<?php
	if (isset($_GET["remove"]) && is_numeric($_GET["remove"])) {
		$key = $_GET["remove"];
		unset($_SESSION["cart"][$key]);

		pageRedirect("/kosarica");
	}


	if (isset($_POST["key"]) && is_numeric($_POST["key"]) && isset($_POST["qty"]) && is_numeric($_POST["qty"]) && $_POST["qty"]>0 ) {
		$key = $_POST["key"];
		$qty = $_POST["qty"];

		if ($qty > 0) {
			$_SESSION["cart"][$key]["qty"] = $qty;
		}

		pageRedirect("/kosarica");
	}
?>
<?php
	$page_title = "Košarica";
	$page_description = "";
?>
<!DOCTYPE html>
<html lang="hr">
	<?php include_once "includes/head.php"; ?>
<body>
	<?php include_once "includes/header.php"; ?>

	<?php include "template-parts/section--delivery.php"; ?>

	<section class="section section--gutter-large cart">
		<div class="container">
			<div class="row">
				<div class="gr-12">
					<h4 class="section__heading"><span>Košarica</span></h4>
				</div>
			</div>
			<div class="row">
				<div class="gr-12 gr-8@lg gr-centered">
				<?php if (isset($_SESSION["cart"]) && count($_SESSION["cart"])>0 ) { ?>
					<div class="cart__list">
						<?php $cart_total = 0; $discount_total = 0; $cart_total_eur = 0;?>
						<?php foreach ($_SESSION["cart"] as $key => $item) { ?>
						<?php
							$product_data = GetProductData($item["product_id"]);

							if (!$product_data) {
								unset($_SESSION["cart"][$key]);
								continue;
							}

							$product_total = $item["qty"]*$product_data["prices"]["cart_price"];
							$cart_total = $cart_total + $product_total;

							$image_url = GetMediaURL($product_data["featured_image_id"], "medium");
						?>
						<div class="cart__list_item">
							<div class="card card--03">
								<a href="/kosarica?remove=<?php echo $key; ?>" class="card__remove_btn"></a>
								<figure class="card__figure" style="background-image: url('<?php echo $image_url; ?>')"></figure>
								<div class="card__content">
									<div class="card__meta">
										<h5 class="heading"><?php echo $product_data["name"] ?></h5>
									</div>
									<div class="card__totals">
										<div class="qty">
											<form action="" class="form" method="post">
												<input type="hidden" name="key" value="<?php echo $key; ?>">
												<input type="number" name="qty" value="<?php echo $item["qty"]; ?>" min="1" class="form__input" onchange="this.form.submit()">
											</form>
										</div>
										<div class="price">
											<p class="price__single"><?php echo $item["qty"]." x ".formatPrice($product_data["prices"]["cart_price"]) . "kn"; ?></p>
											<h5 class="price__total">
												<span><?php echo formatPrice($item["qty"]*$product_data["prices"]["cart_price"]) . "kn"; ?></span>
											</h5>
										</div>
									</div>
								</div>
							</div>	
						</div>
						<?php } ?>

						<div class="cart__totals">
							<div class="row">
								<div class="gr-12 text-right">
									<?php
										$cart_total_no_tax = (100*$cart_total) / 125;
										$cart_total_tax = $cart_total - $cart_total_no_tax;
									?>
									<p>
										Ukupno bez PDV-a: <strong><?php echo formatPrice($cart_total_no_tax) . "kn"; ?></strong><br>
										PDV (25%): <strong><?php echo formatPrice($cart_total_tax) . "kn"; ?></strong>
									</p>

									<span>Ukupno</span>
									<div class="total">
										<span><?php echo formatPrice($cart_total) . "kn"; ?></span>
									</div>
									<a href="/kosarica-podaci" class="btn btn--icon">Dovrši kupnju <i class="icon icon-arrow-right"></i></a>
								</div>
							</div>
						</div>
					</div>
					<?php } else { ?>
						<p>Košarica je prazna</p>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>

	<?php include "template-parts/section--sale.php"; ?>
	
	<?php include_once "includes/footer.php"; ?>
	<?php include_once "includes/footer_inc.php"; ?>
</body>
</html>