<?php
	
	function pageRedirect($url) {
		header("Location: ".ROOT_URL.$url);
		die();
	}


	// GET CLEAN SLUG
	function cleanSlug($str) {

		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		$clean = preg_replace("/[^a-zA-Z0-9\/_| -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_| -]+/", '-', $clean);
	
		return $clean;
	}
	


	function FormatDateLocalized($date) {
		$dateFormated = date("d.m.Y.", strtotime($date));

		return $dateFormated;
	}


	function formatPrice($price) {
		$price = number_format($price,2,",","");

		return $price;
	}

	function formatPriceDB($price) {
		$price = number_format($price,2,".","");

		return $price;
	}



	// GET MEDIA
	function GetMediaURL ($id, $size="full"){
		global $conn;
		
		if (!is_numeric($id)) {
			return "";
			exit();
		}
		
		$sql = "SELECT * FROM media WHERE id=".$id;
		$result = $conn->query($sql);
		$media = $result->fetch_assoc();
        	
		$url_base = SITE_URL."/uploads/";

		if ($size=="medium") {
			$url_base = $url_base."medium/";
		}

		if ($size=="thumbnail") {
			$url_base = $url_base."thumbnails/";
		}
        
        if ($media){
			$img_url = $url_base.$media["filename"];
		} else {
			$img_url = $url_base."default.jpg";
		}
		
		return $img_url;
	}


	// GET PRODUCT DATA 
	function GetProductData($data) {
		global $conn;

		if (is_numeric($data)) {
			$sql = "SELECT * FROM products
					WHERE id=".$data;
			$result = $conn->query($sql);
			$data = $result->fetch_assoc();
		}

		$product_data["id"] = $data["id"];
		$product_data["sku"] = $data["sku"];

		$product_data["name"] = $data["name"];
		$product_data["description"] = $data["description"];

		// CATEGORY
		$product_data["prices"] = getProductPrices($data);
		$product_data["featured_image_url"] = GetMediaURL($data["featured_image"], "medium");
		$product_data["featured_image_id"] = $data["featured_image"];

		$product_data["permalink"] = SITE_URL."/proizvod/".$data["id"]."/".cleanSlug($product_data["name"]);

		return $product_data;
	}


	// GET PRODUCT PRICES
	function getProductPrices($data) {
		$prices["regular_price"] = "";
		$prices["sale_price"] = "";
		$prices["cart_price"] = "";

		if ($data["price"] > 0) {
			$prices["regular_price"] = $data["price"];
			$prices["cart_price"] = $data["price"];

			if ($data["sale_price"] > 0) {
				$prices["sale_price"] = $data["sale_price"];
				$prices["cart_price"] = $data["sale_price"];
			}
		}

		return $prices;
	}


	// GET PRODUCT GALLERY IMAGES
	function getProductGalleryImages($id) {
		global $conn;

		$images = array();

		// PARENT IMAGES
		$sql = "SELECT * FROM products
				WHERE id=".$id;
		$result = $conn->query($sql);
		$items = $result->fetch_assoc();

		if ($items) {
			$featured_image = $items["featured_image"];
			$gallery_image = $items["gallery_image"];

			if ($featured_image) {
				$images[] = $featured_image;
			}

			if ($gallery_image) {
				$gallery_image = json_decode($gallery_image);
				$images = array_merge($images, $gallery_image);
			}
		}

		$images = array_unique($images);
		return $images;
	}



	// GET DELIVERY DATA 
	function getDeliveryData($cart_total) {
		if ($cart_total>500) {
		    $delivery_price = 0;
		    $delivery_text = "Besplatna";
		} else {
		    $delivery_price = 45;
		    $delivery_text = formatPrice($delivery_price)." kn";
		}

		$deliveryData["price"] = $delivery_price;
		$deliveryData["text"] = $delivery_text;

		return $deliveryData;
	}

?>