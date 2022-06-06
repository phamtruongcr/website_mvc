<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
 ?>

<?php 
	/**
	 * summary
	 */
	class product
	{
	    /**
	     * summary
	     */

	    private $db;
	    private $fm;

	    public function __construct()
	    {
	     	$this->db = new Database();
	     	$this->fm = new Format();
	    }

	    public function insert_product($data, $files){

	    	$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
	    	$category = mysqli_real_escape_string($this->db->link, $data['category']);
	    	$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
	    	$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
	    	$price = mysqli_real_escape_string($this->db->link, $data['price']);
	    	$type = mysqli_real_escape_string($this->db->link, $data['type']);

	    	//Kiem tra hinh anh va lay hinh anh cho vao folder upload
	    	$permited = array('jpg', 'jpeg', 'png', 'gif');
	    	$file_name = $_FILES['image']['name'];
	    	$file_size = $_FILES['image']['size'];
	    	$file_temp = $_FILES['image']['tmp_name'];

	    	$div = explode('.', $file_name);
	    	$file_ext = strtolower(end($div));
	    	$unique_image = substr(md5(time()), 0,10).'.'.$file_ext;
	    	$uploaded_image = "uploads/".$unique_image;
	    	// $image = mysqli_real_escape_string($this->db->link, $data['image']);
	    	
	    	if( $productName=="" || $category=="" || $brand=="" || $product_desc=="" || $price=="" || $type=="" || $file_name==""){
	    		$alert = "<span class='error'>Fields must be not empty</span>";
	    		return $alert;
	    	}else{
	    		move_uploaded_file($file_temp, $uploaded_image);
	    		$query = "INSERT INTO tbl_product(productName, catId, brandId, product_desc, type, price, img) VALUES('$productName', '$category', '$brand', '$product_desc', '$type', '$price', '$unique_image')";
	    		$result = $this->db->insert($query);
	    		if($result){
	    			$alert = "<span class='success'>Insert Product Successfully</span>";
	    			return $alert;
	    		}else {
	    			$alert = "<span class='error'>Insert Product Not Success</span>";
	    			return $alert;
	    		}
	    	}
	    }

	    public function show_product(){

	    	// $query = "SELECT p.*, c.catName, b.brandName 
	    	// FROM tbl_product as p, tbl_category as c, tbl_brand as b where p.catId = c.catId 
	    	// AND p.brandId = b.brandId
	    	// order by p.productId DESC";
	    	// $result = $this->db->select($query);
	    	
	    	$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 
	    	FROM tbl_product 
	    	INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 
	    	INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
	    	order by tbl_product.productId DESC";
	    	$result = $this->db->select($query);

	    	return $result;

	    }

	    public function getProductById($id){
	    	
	    	$query = "SELECT * FROM tbl_product where productId = '$id'";
	    	$result = $this->db->select($query);
	    	return $result;
	    }

	    public function del_product($id){
	    	$query = "DELETE FROM tbl_product where productId = '$id'";
	    	$result = $this->db->delete($query);
	    	if($result){
    			$alert = "<span class='success'>Product Delete Successfully</span>";
    			return $alert;
    		}else {
    			$alert = "<span class='error'>Product Delete Not Success</span>";
    			return $alert;
    		}
	    }

	    public function update_product($data, $files, $id){
	    	$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
	    	$category = mysqli_real_escape_string($this->db->link, $data['category']);
	    	$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
	    	$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
	    	$price = mysqli_real_escape_string($this->db->link, $data['price']);
	    	$type = mysqli_real_escape_string($this->db->link, $data['type']);

	    	//Kiem tra hinh anh va lay hinh anh cho vao folder upload
	    	$permited = array('jpg', 'jpeg', 'png', 'gif');
	    	$file_name = $_FILES['image']['name'];
	    	$file_size = $_FILES['image']['size'];
	    	$file_temp = $_FILES['image']['tmp_name'];

	    	$div = explode('.', $file_name);
	    	$file_ext = strtolower(end($div));
	    	$unique_image = substr(md5(time()), 0,10).'.'.$file_ext;
	    	$uploaded_image = "uploads/".$unique_image;
	    	// $image = mysqli_real_escape_string($this->db->link, $data['image']);
	    	
	    	if( $productName=="" || $category=="" || $brand=="" || $product_desc=="" || $price=="" || $type==""){
	    		$alert = "<span class='error'>Fields must be not empty</span>";
	    		return $alert;
	    	}else {
	    		if(!empty($file_name)){
	    			if ($file_size > 2097152) {
	    				$alert = "<span class='error'>Image size should be less then 3MB".$file_size."</span>";
	    				return $alert;
	    			}elseif (in_array($file_ext, $permited) === false) {
	    				$alert = "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
	    				return $alert;
	    			}
	    			move_uploaded_file($file_temp, $uploaded_image);
	    			$query = 
		    		"UPDATE tbl_product 
		    		SET productName = '$productName', catId = '$category', brandId = '$brand', product_desc = '$product_desc', type = '$type', price = '$price', img = '$unique_image' 
		    		where productId = '$id'";
	    		}else{
		    		$query = 
		    		"UPDATE tbl_product 
		    		SET productName = '$productName', catId = '$category', brandId = '$brand', product_desc = '$product_desc', type = '$type', price = '$price' 
		    		where productId = '$id'";
		    	}
		    	$result = $this->db->insert($query);
	    		if($result){
	    			$alert = "<span class='success'>Update Product Successfully</span>";
	    			return $alert;
	    		}else {
	    			$alert = "<span class='error'>Update Product Not Success</span>";
	    			return $alert;
	    		}
		    }
	    }

	    //END ADMIN

	    public function get_product_featured(){
	    	$query = "SELECT * FROM tbl_product where type = 1 order by productId desc limit 8 offset 0";
	    	$result = $this->db->select($query);
	    	return $result;	
	    }

	   
	    public function get_product_new($item_per_page, $current_page){
	    	$offset = ($current_page-1)*$item_per_page;
	    	$query = "SELECT * FROM tbl_product order by productId desc limit $item_per_page offset $offset";
	    	$result = $this->db->select($query);
	    	return $result;	
	    }

	    public function get_all_product(){
	    	$query = "SELECT * FROM tbl_product";
	    	$result = $this->db->select($query);
	    	return $result;	
	    }

	    public function get_detail($id){

	    	// $query = "SELECT p.*, c.catName, b.brandName 
	    	// FROM tbl_product as p, tbl_category as c, tbl_brand as b where p.catId = c.catId 
	    	// AND p.brandId = b.brandId
	    	// order by p.productId DESC";
	    	// $result = $this->db->select($query);
	    	
	    	$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 
	    	FROM tbl_product 
	    	INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 
	    	INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
	    	where tbl_product.productId  = '$id'";
	    	$result = $this->db->select($query);

	    	return $result;

	    }
	}
 ?>