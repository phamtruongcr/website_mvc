
<?php
	include 'inc/header.php';
	include 'inc/slider.php';
?>
	

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      		<?php 
	      			$product_featured = $product->get_product_featured();
	      			if ($product_featured) {
	      				while ($result = $product_featured->fetch_assoc()) {
	      				    
	      		 ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?productId=<?php echo($result['productId']) ?>"><img src="admin/uploads/<?php echo $result['img'] ?>" alt="" width="200px" height="200px" /></a>
					 <h2><?php echo $result['productName']; ?></h2>
					 <p>
					 <?php
					 	$len = strlen($result['product_desc']);
					 	$len = ($len < 35) ? $len : 35;
					 	echo $fm->textShorten($result['product_desc'], $len); 
					 ?>
					 </p>
					 <p><span class="price"><?php echo $result['price']." VND"; ?></span></p>
				     <div class="button"><span><a href="details.php?productId=<?php echo($result['productId']) ?>" class="details">Details</a></span></div>
				</div>
				<?php 
						}
	      			}
				 ?>
				
			</div>
		<div class="content_bottom">
    		<div class="heading">
    			<h3>New Products</h3>
    		</div>
    		<div class="clear">
    			
    		</div>
    	</div>
    	<div class="content_bottom">
			<div class="section group">
				<?php
					$item_per_page = 8;
					$current_page = (isset($_GET['page'])) ? $_GET['page'] : 1;
					$total_records = $product->get_all_product()->num_rows;
					$total_pages = ceil($total_records/$item_per_page);

	      			$product_new = $product->get_product_new($item_per_page, $current_page);
	      			if ($product_new) {
	      				while ($result = $product_new->fetch_assoc()) {
	      				    
	      		 ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php"><img src="admin/uploads/<?php echo $result['img'] ?>" alt="" width="200px" height="200px" /></a>
					 <h2><?php echo $result['productName']; ?></h2>
					 <p>
					 <?php
					 	$len = strlen($result['product_desc']);
					 	$len = ($len < 35) ? $len : 35;
					 	echo $fm->textShorten($result['product_desc'], $len); 
					 ?>
					 </p>
					 <p><span class="price"><?php echo $result['price']." VND"; ?></span></p>
				     <div class="button"><span><a href="details.php?productId=<?php echo($result['productId']) ?>" class="details">Details</a></span></div>
				</div>

				<?php 
						}
	      			}
				 ?>
			</div>
			<?php include 'pagination.php' ?>
		</div>
    </div>
 </div>

<?php
	include 'inc/footer.php';
?>
	

