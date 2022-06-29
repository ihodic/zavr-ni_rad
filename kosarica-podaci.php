<?php include_once "config.php"; ?>
<?php
	if (!isset($_SESSION["cart"]) || count($_SESSION["cart"])==0 ) {
		pageRedirect("/");
	}
?>
<?php
	$page_title = "Dovrši kupnju";
	$page_description = "";
?>
<!DOCTYPE html>
<html lang="hr">
	<?php include_once "includes/head.php"; ?>
<body>
	<?php include_once "includes/header.php"; ?>
	
	<?php include "template-parts/section--delivery.php"; ?>

	<section class="section section--gutter-large">
		<div class="container">
			<div class="row">
				<div class="gr-12">
					<h4 class="section__heading"><span>Dovrši kupnju</span></h4>
				</div>
			</div>
			<div class="row">
				<div class="gr-12 gr-8@lg gr-centered">
					<form action="/submit/order" method="post" class="form" id="form-cart">
						<fieldset class="form__fieldset">
							<div class="row">
								<div class="gr-12 text-center">
									<h5>Podaci za dostavu</h5>
								</div>
							</div>
							<div class="row">
								<div class="gr-12 gr-6@md">
									<div class="form__group">
										<input type="text" name="name" placeholder="Ime i prezime" class="form__input" required>
									</div>
								</div>
								<div class="gr-12 gr-6@md">
									<div class="form__group">
										<input type="email" name="email" placeholder="Email adresa" class="form__input" required>
									</div>
								</div>
								<div class="gr-12">
									<div class="form__group">
										<input type="text" name="address" placeholder="Adresa" class="form__input" required>
									</div>
								</div>
								<div class="gr-12 gr-6@md">
									<div class="form__group">
										<input type="text" name="postal_code" placeholder="Poštanski broj" class="form__input" required>
									</div>
								</div>
								<div class="gr-12 gr-6@md">
									<div class="form__group">
										<input type="text" name="city" placeholder="Mjesto" class="form__input" required>
									</div>
								</div>
								<div class="gr-12 gr-6@md">
									<div class="form__group">
										<input type="text" name="phone" placeholder="Država" class="form__input" value="Hrvatska" required>
									</div>
								</div>
								<div class="gr-12 gr-6@md">
									<div class="form__group">
										<input type="text" name="phone" placeholder="Telefon" class="form__input" required>
									</div>
								</div>
							</div>

							<div class="row">
							    <div class="gr-12">

							        <div class="cart cart--order">
							            <h5 class="heading text-center">Vaša nardužba</h5>

							            <?php if (isset($_SESSION["cart"]) && count($_SESSION["cart"])>0 ) { ?>
							            <div class="cart__list">
							                <?php $cart_total = 0; ?>
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
							                    <div class="card card--03 card--03-simple">
							                        <div class="card__content">
							                            <div class="card__meta">
							                                <h6 class="heading"><?php echo $product_data["name"] ?></h6>
							                            </div>
							                            <div class="card__totals">
							                                <div class="price">
							                                    <p class="price__single"><?php echo $item["qty"]." x ".formatPrice($product_data["prices"]["cart_price"]). "kn"; ?></p>
							                                    <h5 class="price__total">
							                                        <span><?php echo formatPrice($item["qty"]*$product_data["prices"]["cart_price"]) . "kn"; ?></span>
							                                    </h5>
							                                </div>
							                            </div>
							                        </div>
							                    </div>  
							                </div>
							                <?php } ?>

							                <div class="cart__list_item">
							                    <div class="meta">
							                        <?php $delivery_data = getDeliveryData($cart_total); ?>
							                        <p>Dostava</p>
							                        <div class="shipping">
							                            <strong><?php echo $delivery_data["text"]; ?></strong>
							                        </div>
							                    </div>
							                </div>
							                <div class="cart__list_item">
							                    <div class="meta">
							                        <strong>Ukupno</strong>
							                        <div class="total">
							                            <span><?php echo (formatPrice($cart_total + $delivery_data["price"]))." kn"; ?></span>
							                        </div>
							                    </div>
							                </div>
							            </div>
							            <?php } ?>
							        </div>
							    </div>
							</div>
							<div class="row">
							    <div class="gr-12 gr-6@lg">
							        <h6 class="heading uppercase">Način plaćanja</h6>
							        <div class="form__group">
							            <select name="payment_option" class="form__select" required>
							                <option value="">Odaberite način plaćanja</option>
							                <option value="bank_transfer">Internet bankarstvo / Opća uplatnica</option>
							                <option value="payment_on_delivery">Plaćanje gotovinom prilikom dostave</option>
							            </select>
							        </div>
							    </div>
							</div>

							<div class="row">
							    <div class="gr-12">
							        <div class="form__group">
							            <label class="form__checkbox">
							                <input class="checkbox-input" type="checkbox" name="consent" value="1" required>
							                <i></i><span>Pročitao/la sam i slažem se sa <a href="/uvjeti-poslovanja">Uvjetima kupnje</a> ove web stranice</span>
							            </label>
							        </div>
							    </div>
							    <div class="gr-12 text-center mt20">    
							        <div class="form__group">
							            <button class="btn btn--icon">Naruči <i class="icon icon-arrow-right"></i></button>
							        </div>
							    </div>
							</div>

						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</section>

	<?php include "template-parts/section--sale.php"; ?>
	
	<?php include_once "includes/footer.php"; ?>
	<?php include_once "includes/footer_inc.php"; ?>
</body>
</html>