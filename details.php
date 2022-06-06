<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>


<?php 
    
    if (!isset($_GET['productId']) || $_GET['productId'] == NULL) {
         echo "<script>window.location = '404.php'</script>";
    }else {
        $id = $_GET['productId'];
    }


 	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

 		$quanity =  $_POST['quanity'];
        $addToCart = $ct->add_to_cart($quanity, $id);
    }
 ?>

 <div class="main">
    <div class="content">
    	<div class="section group">

    		<?php 
    			$get_product_detail = $product->get_detail($id);
    			if ($get_product_detail) {
    				while ($result_product_detail = $get_product_detail->fetch_assoc()) {
    				    
    				
    		 ?>

			<div class="cont-desc span_1_of_2">				
				<div class="grid images_3_of_2">
					<img src="admin/uploads/<?php echo $result_product_detail['img']; ?>"  alt="" />
				</div>
				<div class="desc span_3_of_2">
					<h2> <?php echo $result_product_detail['productName']; ?> </h2>
					<p>
					<?php
					 	$len = strlen($result_product_detail['product_desc']);
					 	$product_desc = ($len < 100) ? $result_product_detail['product_desc'] : $fm->textShorten($result_product_detail['product_desc'], 100);
					 	echo $product_desc;
					 	; 
					 ?>
					</p>					
					<div class="price">
						<p>Price: <span> <?php echo $result_product_detail['price']." VND"; ?> </span></p>
						<p>Category: <span><?php echo $result_product_detail['catName']; ?></span></p>
						<p>Brand:<span><?php echo $result_product_detail['brandName']; ?></span></p>
					</div>
					<div class="add-cart">
						<form action="" method="post">
							<input type="number" class="buyfield" name="quanity" value="1" min="1" />
							<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
						</form>				
					</div>
				</div>
				<div class="product-desc">
					<h2>Product Details</h2>
					<?php echo $result_product_detail['product_desc']; ?>
		    	</div>
			</div>
			<?php 
					}
    			}
			 ?>
			<div class="rightsidebar span_3_of_1">
				<h2>CATEGORIES</h2>
				<ul>
					<?php 
						$get_category = $cat->show_category();
						if($get_category){
							while ($result_category = $get_category->fetch_assoc()) {
							    
							
					 ?>
			      	<li><a href="productbycat.php?catId=<?php echo($result_category['catId']) ?>"><?php echo $result_category['catName']; ?></a></li>
			      	<?php 
			      			}
						}
			      	 ?>
				</ul>
	
				</div>
 		</div>
 	</div>
	
<?php
	include 'inc/footer.php';
?>