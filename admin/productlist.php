<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/product.php';?>
<?php include_once '../helpers/format.php';?>

<?php 
	$pd = new product();

	if (isset($_GET['productid'])) {
	$id = $_GET['productid'];
	$delproduct = $pd->del_product($id);
 }

 ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
        	<?php 
	            if (isset($delproduct)){
	                echo $delproduct;
	            } 
        	?>   
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Product Name</th>
					<th>Price</th>
					<th>Product Image</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$pd = new product();
					$fm = new Format();
					$productlist = $pd->show_product();

					if ($productlist) {
						$i=0;
						while ($result = $productlist->fetch_assoc()) {
						    $i++;
				 ?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['productName']; ?></td>
					<td><?php echo $result['price']; ?></td>
					<td><img src="uploads/<?php echo $result['img']; ?>" alt="" width="60px" height="60px" ></td>
					<td>
						<?php
							// $cat = new category();
							// $get_cat_name = $cat->getCatById($result['catId']);
							// if($get_cat_name){
							// 	while ($resultCat = $get_cat_name->fetch_assoc()) {
							// 	    echo $resultCat['catName']; 
							// 	}
							// }	
							echo $result['catName'];
						?>	
					</td>
					<td>
						<?php
							// $brand = new brand();
							// $get_brand_name = $brand->getBrandById($result['brandId']);
							// if($get_brand_name){
							// 	while ($resultBrand = $get_brand_name->fetch_assoc()) {
							// 	    echo $resultBrand['brandName']; 
							// 	}
							// }
							echo $result['brandName'];
						?>
					</td>
					<td>
					<?php 
						$len = strlen($result['product_desc']);
						$len = ($len < 35) ? $len : 35; 
						echo $fm->textShorten($result['product_desc'], $len); 
					?>
					</td>
					<td>
						<?php 
							if($result['type']==1){
								echo 'Featured';
							}else {
								echo 'Non-Featured';
							}
						?>
					</td>
					<td><a href="productedit.php?productid=<?php echo $result['productId'] ?>">Edit</a> || <a onclick = "return confirm('Are you want to delete')" href="?productid=<?php echo $result['productId'] ?>">Delete</a></td>
				</tr>
				<?php 
						}
					}
				 ?>
				
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
