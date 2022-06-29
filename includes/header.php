<header class="header">
	<div class="container">
		<div class="header__inner">
			<a href="/" class="header__logo"><img src="/images/RocastLogo-final.png" alt="Logo"></a>
			
			<div class="header__menu">
				<ul class="menu">
					<li class="menu__item"><a href="/" class="menu__link">Naslovnica</a></li>
					<li class="menu__item"><a href="/shop" class="menu__link">Shop</a></li>
					<li class="menu__item"><a href="/snizenje" class="menu__link">Sniženje</a></li>
					<li class="menu__item"><a href="/kontakt" class="menu__link">Kontaktirajte nas</a></li>
				</ul>
			</div>

			<div class="header__actions">
				<div class="cart">
					<a href="/kosarica" class="cart__link">
						<?php if (isset($_SESSION["cart"]) && count($_SESSION["cart"])>0 ) { ?>
						<?php 
							$cart_total = 0;
							$cnt = 0;
							foreach ($_SESSION["cart"] as $key => $item) {

								$product_data = getProductData($item["product_id"]);

								$product_total = $item["qty"]*$product_data["prices"]["cart_price"];
								$cart_total = $cart_total + $product_total;

								$cnt++;
							}
						?>
						<span class="cart__items"><i class="icon icon-cart"></i> <?php echo $cnt; ?></span>
						<span class="cart__total"><?php echo formatPrice($cart_total) . "kn"; ?></span>
						<?php } else { ?>
						<span class="cart__items"><i class="icon icon-cart"></i> <span>Košarica</span></span>
						<?php } ?>
					</a>
				</div>
			</div>

			<button class="header__hamburger"><span>menu</span></button>
		</div>
	</div>
</header>