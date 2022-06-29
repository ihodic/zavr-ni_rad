<?php $item_data = GetProductData($items); ?>
<a href="<?php echo $item_data["permalink"]; ?>" class="card card--01">
	<figure class="card__figure">
		<div class="card__figure_background" style="background-image: url('<?php echo $item_data["featured_image_url"]; ?>');"></div>
		<?php if ($item_data["prices"]["sale_price"]>0) { ?>
		<div class="card__figure_badge"><span>%</span></div>
		<?php } ?>
	</figure>

	<div class="card__content">
		<h6 class="heading"><?php echo $item_data["name"]; ?></h6>
		<div class="price">
			<div class="price__col">
				<span class="price__current"><?php echo $item_data["prices"]["cart_price"] . "kn"; ?> </span>
				<?php if ($item_data["prices"]["sale_price"]>0) { ?>
				<span class="price__old"><strike><?php echo $item_data["prices"]["regular_price"] . "kn"; ?></strike></span>
				<?php } ?>
			</div>
		</div>
	</div>
</a>