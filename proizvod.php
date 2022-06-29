<?php include_once "config.php"; ?>
<?php
	if (isset($_GET["add_to_cart"])){
		if (!isset($_SESSION["cart"])) {
			$_SESSION["cart"] = array();
		}

		$id = $_GET["add_to_cart"];
	    $qty = 1;

	    if ($qty > 0) {
	    	$_SESSION["cart"][$id] = array(
	    		'product_id' => $id , 
	    		'qty' => $qty
	    	);

	    	$status = "success";
	    }
	}




    if (isset($_GET["id"])){
        $id = trim($_GET["id"]);
    } else {
        pageRedirect("/");
    }
    
    $sql = "SELECT * FROM products 
			WHERE products.id=".$id;
    $result = $conn->query($sql);
    $items = $result->fetch_assoc();
    
    if(!$items){
        pageRedirect("/");
    }

    $item_data = GetProductData($items);
?>
<?php
	$page_title = $items["name"];
	$page_description = $items["description"];
?>
<!DOCTYPE html>
<html lang="hr">
	<?php include_once "includes/head.php"; ?>
<body>
	<?php include_once "includes/header.php"; ?>
	
	<?php if (isset($status)) { ?>
	<section class="section delivery delivery--dark-bg">
		<div class="container">
			<div class="row">
				<div class="gr-12">
					<?php if ($status=="success") { ?>
					<div class="delivery__ribbon">
						<div class="delivery__ribbon_content">
							<i class="icon icon-cart"></i>
							Proizvod je dodan u košaricu!
						</div>
					</div>
					<?php } ?>

					<?php if ($status=="unvailable") { ?>
					<div class="delivery__ribbon">
						<div class="delivery__ribbon_content">
							<i class="icon icon-remove"></i>
							Proizvod je trenutno nedostupan!
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>
	<?php } ?>
	
	<section class="section products">
		<div class="container">
			<div class="row">
				<div class="gr-12">
					<div class="products__single">
						<?php $images = getProductGalleryImages($id); ?>
						<div class="slider">
							<div class="slider__main">
								<?php 
									if ($images) {
								        foreach ($images as $value) {
								            $gallery_image_url = GetMediaURL($value, "medium");
								    ?>
							        	<div class="slide">
							        		<figure class="slide__figure">
							        			<a href="<?php echo $gallery_image_url ; ?>" data-fancybox="gallery"><img src="<?php echo $gallery_image_url ; ?>" class="rspimg"></a>
							        		</figure>
							        	</div>
								    <?php } ?>
								<?php } ?>
								
							</div>
						</div>

						<div class="info">
							<h3 class="name"><?php echo $item_data["name"]; ?></h3>

							<div class="description">
								<?php echo nl2br($items["description"]); ?>
							</div>

							<div class="price">
								<div class="price__col">
									<span class="price__current"><?php echo $item_data["prices"]["cart_price"] . "kn"; ?> </span>
									<?php if ($item_data["prices"]["sale_price"]>0) { ?>
									<span class="price__old"><strike><?php echo $item_data["prices"]["regular_price"] . "kn"; ?></strike></span>
									<?php } ?>
								</div>
							</div>

							
							<form action="" class="form">
								<input type="hidden" name="add_to_cart" value="<?php echo $items["id"]; ?>">
								
								<div class="form__group">
									<button class="btn btn--icon">Dodaj u košaricu <i class="icon icon-cart"></i></button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row mt50">
				<div class="gr-12">
					<h5 class="heading">Ostali proizvodi</h5>

					<div class="products__list">
						<?php
							$sql = "SELECT * FROM products 
									WHERE id != $id AND status='published' 
									ORDER BY RAND() LIMIT 4";

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


	<?php include "template-parts/section--sale.php"; ?>
	
	<?php include_once "includes/footer.php"; ?>
	<?php include_once "includes/footer_inc.php"; ?>
</body>
</html>