<?php
$filepath = realpath(dirname(__FILE__));
include_once  ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>
<?php

class Cart{
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function addToQuantity($quantity,$id){
		$quantity = $this->fm->validation($quantity);
     	$quantity = mysqli_real_escape_string($this->db->link,$quantity);
     	$productId = mysqli_real_escape_string($this->db->link,$id);
     	$sId = session_id();
     	$squery=" SELECT * FROM tbl_product WHERE productId='$productId' ";
     	$result=$this->db->select($squery)->fetch_assoc();
     	$productName=$result['productName'];
     	$price=$result['price'];
     	$image=$result['image'];
     	$Chquery= " SELECT * FROM tbl_cart WHERE productId='$productId' AND sId='$sId' ";
     	$getPro=$this->db->select($Chquery);

     	if ($getPro) {
     		$meg="Product Already Added";
     		return $meg;
     	}else{ 
       $query = "INSERT INTO tbl_cart(sId ,productId, productName, price,quantity, image) VALUES('$sId','$productId','$productName','$price','$quantity','$image')";
    $inserted_row = $this->db->insert($query);

    if ($inserted_row) {
     header("location:cart.php");
    }else {
     header("location:404.php");
    }
}
	}
	public function getCartProduct(){
		$sId=session_id();
		$query="SELECT * FROM tbl_cart WHERE sId='$sId'";
		$result =$this->db->select($query);
		return $result;
	}
	public function updateCartQuantity($cartId,$quantity){
	$cartId = mysqli_real_escape_string($this->db->link,$cartId);
    $quantity = mysqli_real_escape_string($this->db->link,$quantity);
    $query = "UPDATE tbl_cart 
     		 SET 
     		quantity = '$quantity'  
     		WHERE cartId ='$cartId'";
     		$updated_row = $this->db->update($query);
     		if ($updated_row) {
     	       header("location:cart.php");	
     		}else{
     		 	$meg="<span class='error'>Quantity Not update sucessfully </span>";
             	return $meg;
     		 } 

	}
	public function delProductByCart($delId){
		$delId = mysqli_real_escape_string($this->db->link,$delId);
		$query = " DELETE  FROM tbl_cart WHERE cartId = '$delId' ";
		$deldata = $this->db->delete($query);
		if ($deldata) {
     	       echo "<script>window.location= 'cart.php' ;</script>";	
     		}else{
     		 	$meg="<span class='error'>Product Not  deleted </span>";
             	return $meg;
     		 }
	}
	public function cheakCartTable(){
		$sId=session_id();
		$query="SELECT * FROM tbl_cart WHERE sId='$sId'";
		$result =$this->db->select($query);
		return $result;
	}
    public function delCustomerCart(){
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId='$sId'";
        $result=$this->db->delete($query);
        return $result;
    }
    public function productOrder($cmrId){
        $sId=session_id();
        $query="SELECT * FROM tbl_cart WHERE sId='$sId'";
        $getPro =$this->db->select($query); 
        if ($getPro) {
             while ($result=$getPro->fetch_assoc()) {
                 $productId=$result['productId'];
                  $productName=$result['productName'];
                   $quantity=$result['quantity'];
                    $price=$result['price'] * $quantity;
                     $image=$result['image'];
                 
                 $query = "INSERT INTO tbl_order(cmrId ,productId, productName,quantity, price,image) VALUES('$cmrId','$productId','$productName','$quantity','$price','$image')";
    $inserted_row = $this->db->insert($query);
                    }
         } 
    }
    public function payableAmount($cmrId){
        $query="SELECT price FROM tbl_order WHERE cmrId='$cmrId' AND date = now()";
        $result =$this->db->select($query);
        return $result;
    }
    public function getorderedproduct($cmrId){
       $query="SELECT * FROM tbl_order WHERE cmrId='$cmrId' ORDER BY date DESC ";
       $result =$this->db->select($query);
       return $result; 
    }
   public function cheakOrderDetails($cmrId){
        $query="SELECT * FROM tbl_order WHERE cmrId='$cmrId'";
        $result =$this->db->select($query);
        return $result;
    }
    public function getAllOrderProduct(){
        $query="SELECT * FROM tbl_order ORDER BY date DESC ";
        $result =$this->db->select($query);
        return $result;
    }
    public function productShifted($id, $time, $price){
     $id = mysqli_real_escape_string($this->db->link,$id);
     $date = mysqli_real_escape_string($this->db->link,$time);
     $price = mysqli_real_escape_string($this->db->link,$price);
     $query = "UPDATE tbl_order 
             SET 
            status = '1'  
            WHERE cmrId ='$id' AND date='$date' AND price='$price' ";
            $updated_row = $this->db->update($query);
            if ($updated_row) {
                $meg="<span class='success'>Data update sucessfully </span>";
                return $meg;
            }else{
                $meg="<span class='error'>Data Not update sucessfully </span>";
                return $meg;
             }
  
    }
    public function delproductShifted($id, $time, $price){
    $id = mysqli_real_escape_string($this->db->link,$id);
     $date = mysqli_real_escape_string($this->db->link,$time);
     $price = mysqli_real_escape_string($this->db->link,$price);
     $query = " DELETE  FROM tbl_order  WHERE cmrId ='$id' AND date='$date' AND price='$price'";
        $deldata = $this->db->delete($query);
        if ($deldata) {
               $meg="<span class='success'> Delete sucessfully</span>";
                return $meg;    
            }else{
                $meg="<span class='error'> delete Not sucessfully </span>";
                return $meg;
             } 
    }
   public function productShiftConfirm($id, $time, $price){
     $id = mysqli_real_escape_string($this->db->link,$id);
     $date = mysqli_real_escape_string($this->db->link,$time);
     $price = mysqli_real_escape_string($this->db->link,$price);
     $query = "UPDATE tbl_order 
             SET 
            status = '2'  
            WHERE cmrId ='$id' AND date='$date' AND price='$price'";
            $updated_row = $this->db->update($query);
            if ($updated_row) {
                $meg="<span class='success'>update sucessfully </span>";
                return $meg;
            }else{
                $meg="<span class='error'> Not update sucessfully </span>";
                return $meg;
             }
   }
}
?>