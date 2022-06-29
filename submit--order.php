<?php include_once "config.php"; ?>
<?php
	if (!isset($_SESSION["cart"]) || count($_SESSION["cart"])==0 ) {
		pageRedirect("/status/error");
	}
	
	if ( !isset($_POST["name"]) ||
		 !isset($_POST["email"]) ||
		 !isset($_POST["address"]) ||
		 !isset($_POST["postal_code"]) ||
		 !isset($_POST["city"]) ||
		 !isset($_POST["country"]) ||
		 !isset($_POST["phone"]) || 
		 !isset($_POST["payment_option"]) || 
		 !isset($_SESSION["cart"])
	) {
		pageRedirect("/status/error");
	}

	// POST DATA
	$name = htmlspecialchars(trim($_POST["name"]), ENT_QUOTES);
	$email = htmlspecialchars(trim($_POST["email"]), ENT_QUOTES);
	$address = htmlspecialchars(trim($_POST["address"]), ENT_QUOTES);
	$postal_code = htmlspecialchars(trim($_POST["postal_code"]), ENT_QUOTES);
	$city = htmlspecialchars(trim($_POST["city"]), ENT_QUOTES);
	$country = htmlspecialchars(trim($_POST["country"]), ENT_QUOTES);
	$phone = htmlspecialchars(trim($_POST["phone"]), ENT_QUOTES);


	// VALIDATE PAYMENT OPTION
	$payment_option = htmlspecialchars(trim($_POST["payment_option"]), ENT_QUOTES);
	if ($payment_option!="bank_transfer" && $payment_option!="credit_card" && $payment_option!="payment_on_delivery"){
		pageRedirect("/status/error");
	}

	// VALIDATE EMAIL
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		pageRedirect("/status/error");
	}


	// INSERT ORDER INTO DATABASE
	$sql = "INSERT INTO orders (
				name,
				email,
				address,
				postal_code,
				city,
				country,
				phone,
				payment_option
			) VALUES (
				'$name',
				'$email',
				'$address',
				'$postal_code',
				'$city',
				'$country',
				'$phone',
				'$payment_option'
			)";
	
	if ($conn->query($sql) === TRUE) {
		$orderID = $conn->insert_id;
	} else {
		pageRedirect("/status/error");
	}


	// ADD ORDER PRODUCTS INTO DATABASE
	$cart_total = 0;
	$sql_values = "";
	$products_list = "";
	
	foreach ($_SESSION["cart"] as $key => $item) {

		$product_data = GetProductData($item["product_id"]);

		$order_id = $orderID;
		$product_id = $product_data["id"];
		$product_sku = $product_data["sku"];
		$product_name = $product_data["name"];
		$product_price = $product_data["prices"]["cart_price"];

		$qty = $item["qty"];

		$product_total = $qty * $product_price;
		$cart_total = $cart_total + $product_total;

		$sql = "INSERT INTO orders_items (
					order_id, 
					product_id, 
					product_sku, 
					product_name, 
					product_price, 
					qty
				) VALUES (
					'$orderID',
					'$product_id',
					'$product_sku',
					'$product_name',
					'$product_price',
					'$qty'
				)";
		$conn->query($sql);
	}


	// DELIVERY PRICE
	$deliveryData = getDeliveryData($cart_total);
	$delivery_price = $deliveryData["price"];

	//UPDATE ORDER TOTAL
	$sql = "UPDATE orders SET 
		order_total='".formatPriceDB($cart_total)."',
		delivery_price='".formatPriceDB($delivery_price)."' 
		WHERE id=".$orderID;
	$conn->query($sql);
?>
<?php
	if ($payment_option=="bank_transfer" || $payment_option=="payment_on_delivery") {

		// UPDATE ORDER STATUS
		$sql = "UPDATE orders SET 
					status='processing' 
				WHERE id=".$orderID;
		$conn->query($sql);


		unset($_SESSION["cart"]);
		unset($_SESSION["coupon"]);

		pageRedirect("/status/order-success");
	}
?>