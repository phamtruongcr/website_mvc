<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

<?php 

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

 		$quanity =  $_POST['quanity'];
 		$cartId = $_POST['cartId'];

        $updateQuanityCart = $ct->update_quanity_cart($quanity, $cartId);
    }


    if (isset($_GET['cardId'])) {
    	$cartId = $_GET['cardId'];
    	$delcart = $ct->del_cart($cartId);
    }

 ?>

 <?php 
 	if (!isset($_GET['id'])) {
    	echo '<meta http-equiv="refresh" content="0;URL=?id=live">';
    }

  ?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
			    		<?php 
			    			if (isset($updateQuanityCart)) {
			    				echo $updateQuanityCart;
			    			}

			    			if (isset($delcart)) {
			    				echo $delcart;
			    			}
			    		?>
						<table class="tblone">
							<tr>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>

							<?php 
								$get_product_cart = $ct->get_product_cart();
								if ($get_product_cart) {
									$sub_total = 0;
									while ($result_product_cart = $get_product_cart->fetch_assoc()) {
							    		$sub_total += $result_product_cart['price']*$result_product_cart['quanity'];
									
							 ?>

							<tr>
								<td><?= $result_product_cart['productName'] ?></td>
								<td><img src="admin/uploads/<?= $result_product_cart['image'] ?>" alt=""/></td>
								<td><?= $result_product_cart['price'] ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?= $result_product_cart['cartId'] ?>"/>
										<input type="number" min="1" name="quanity" value="<?= $result_product_cart['quanity'] ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td><?= $result_product_cart['price']*$result_product_cart['quanity'] ?></td>
								<td><a href="?cardId=<?= $result_product_cart['cartId'] ?>">Xóa</a></td>
							</tr>
							<?php
									}
								}	
							?>
							
						</table>
						<?php 
							$check_cart = $ct->check_cart();
							if ($check_cart) {
						 ?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td><?= $sub_total ?> <?php Session::set('sum', $sub_total) ?></td>
							</tr>
							<tr>
								<th>VAT 10%: </th>
								<td><?= $sub_total*0.1 ?></td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td><?= $sub_total*1.1 ?> </td>
							</tr>
					   </table>
					   <?php 
					   		}else{
								echo '<div class="center">
								  		<p>Cart Empty.</p>
									</div>';
							}
					    ?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="login.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

<?php
	include 'inc/footer.php';
?>