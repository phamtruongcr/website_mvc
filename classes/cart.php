<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
 ?>

<?php 
	/**
	 * summary
	 */
	class cart
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

	    public function add_to_cart($quanity, $id){

	    	$quanity = $this->fm->validation($quanity);

	    	$quanity = mysqli_real_escape_string($this->db->link, $quanity);
	    	$id = mysqli_real_escape_string($this->db->link, $id);
	    	$sId = session_id();

	    	$query = "SELECT * FROM tbl_product where productId = '$id'";
	    	$result = $this->db->select($query)->fetch_assoc();

	    	$image = $result["img"];
	    	$productName = $result["productName"];
	    	$price = $result["price"];

	    	$query_check_cart = "SELECT * FROM tbl_cart where productId = '$id' AND sId = '$sId'";
	    	$check_cart = $this->db->select($query_check_cart);

	    	if ($check_cart) {
	    		$result_check_cart = $check_cart->fetch_assoc();
	    		$quanity += $result_check_cart['quanity'];
	    		$query_update = "UPDATE tbl_cart SET quanity = '$quanity' where productId = '$id' AND sId = '$sId'";
    			$result_update = $this->db->update($query_update);
    			if($result_update){
	    			header('Location:cart.php');
	    		}else {
	    			header('Location:404.php');
	    		}
	    	}else {
	    		$query_insert = "INSERT INTO tbl_cart(productId, sId, productName, price, quanity, image) VALUES('$id', '$sId', '$productName', '$price', '$quanity', '$image')";
    			$result_insert = $this->db->insert($query_insert);
	    		if($result_insert){
	    			header('Location:cart.php');
	    		}else {
	    			header('Location:404.php');
	    		}
    		}
	    }

	    public function get_product_cart(){
	    	$sId = session_id();

	    	$query = "SELECT * FROM tbl_cart where sId = '$sId'";
	    	$result = $this->db->select($query);
	    	return $result;
	    }

	    public function update_quanity_cart($quanity, $cartId){
	    	$query_update = "UPDATE tbl_cart SET quanity = '$quanity' where cartId = '$cartId'";
    		$result_update = $this->db->update($query_update);
    		if($result_update){
    			header('Location:cart.php');
    		}else {
    			$msg = "<span class='error'>Product Quanity Update Not Success</span>";
    			return $msg;
    		}
	    }

	    public function del_cart($cartId){
	    	$query = "DELETE FROM tbl_cart where cartId = '$cartId'";
	    	$result = $this->db->delete($query);
	    	if($result){
    			header('Location:cart.php');
    		}else {
    			$alert = "<span class='error'>Product Delete Not Success</span>";
    			return $alert;
    		}
	    }

	    public function check_cart(){
	    	$sId = session_id();

	    	$query = "SELECT * FROM tbl_cart where sId = '$sId'";
	    	$result = $this->db->select($query);
	    	return $result;
	    }
	}
 ?>