<?php
$filepath = realpath(dirname(__FILE__));
include_once  ($filepath.'/../lib/Database.php');
include_once  ($filepath.'/../helpers/Format.php');
?>
<?php

class Product {
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	
public function productInsert($data,$file){
	
$productName =mysqli_real_escape_string($this->db->link, $data['productName']);
$catId = mysqli_real_escape_string($this->db->link, $data['catId']);
$brandId =mysqli_real_escape_string($this->db->link, $data['brandId']);
$body =mysqli_real_escape_string($this->db->link, $data['body']);
$price =mysqli_real_escape_string($this->db->link, $data['price']);
$type =mysqli_real_escape_string($this->db->link, $data['type']);

    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $file['image']['name'];
    $file_size = $file['image']['size'];
    $file_temp = $file['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "uploads/".$unique_image;
    if ($productName == "" || $catId == "" || $brandId == "" || $body == ""||$price == ""||$file_name == "" || $type == "") {
     	$meg = "<span class='error'> Field Must Not Empty</span>";
     		return $meg;
     	}
     	elseif ($file_size >1048567) {
     echo "<span class='error'>Image Size should be less then 1MB!
     </span>";
    }
    elseif (in_array($file_ext, $permited) === false) {
    echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
    } 
     	else{
     move_uploaded_file($file_temp, $uploaded_image);
    $query = "INSERT INTO tbl_product(productName ,catId, brandId, body, price,image, type) VALUES('$productName','$catId','$brandId','$body','$price','$uploaded_image','$type')";
    $inserted_row = $this->db->insert($query);

    if ($inserted_row) {
     $meg ="<span class='success'>Product Inserted Successfully.
     </span>";
     return $meg;
    }else {
     $meg = "<span class='error'>Product Not Inserted !</span>";
    return $meg;
    }
     	}
     }
     	public function getAllProduct(){
     		$query = " SELECT  tbl_product.*, tbl_category.catName, tbl_brand.brandName FROM tbl_product 
     		INNER JOIN tbl_category 
     		ON tbl_product.catId =tbl_category.catId
     		INNER JOIN tbl_brand
     		ON tbl_product.brandId =tbl_brand.brandId

     		ORDER BY tbl_product.productId DESC ";
		$result = $this->db->select($query);
		return $result;
     	}

     public function getProById($id){
		$query = " SELECT * FROM tbl_product WHERE productId = '$id' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function productUpdate($data,$file,$id){
		$productName =mysqli_real_escape_string($this->db->link, $data['productName']);
$catId = mysqli_real_escape_string($this->db->link, $data['catId']);
$brandId =mysqli_real_escape_string($this->db->link, $data['brandId']);
$body =mysqli_real_escape_string($this->db->link, $data['body']);
$price =mysqli_real_escape_string($this->db->link, $data['price']);
$type =mysqli_real_escape_string($this->db->link, $data['type']);

    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $file['image']['name'];
    $file_size = $file['image']['size'];
    $file_temp = $file['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "uploads/".$unique_image;
    if ($productName == "" || $catId == "" || $brandId == "" || $body == ""||$price == "" || $type == "") {
     	$meg = "<span class='error'> Field Must Not Empty</span>";
     		return $meg;
     	} else{
     		if (!empty($file_name)) {
     			
     		
     	if ($file_size >1048567) {
     echo "<span class='error'>Image Size should be less then 1MB!
     </span>";
    }
    elseif (in_array($file_ext, $permited) === false) {
    echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
    } 
     	else{
     move_uploaded_file($file_temp, $uploaded_image);
    
    	$query= " UPDATE tbl_product 
    	SET 
    	productName = '$productName',
    	catId = '$catId',
    	brandId = '$brandId',
    	body = '$body',
    	price = '$price',
    	image = '$uploaded_image',
    	type = '$type'	
    	WHERE productId = '$id' ";
    $updated_row = $this->db->update($query);

    if ($updated_row) {
     $meg ="<span class='success'>Product Updated Successfully.
     </span>";
     return $meg;
    }else {
     $meg = "<span class='error'>Product Not updated !</span>";
    return $meg;
    }
     	}
}
     	else
     	{

    	$query = " UPDATE tbl_product 
    	SET 
    	productName = '$productName',
    	catId       = '$catId',
    	brandId     = '$brandId',
    	body        = '$body',
    	price       = '$price',
    	type        = '$type'
    	WHERE
    	 productId  = '$id'";
      $updated_row = $this->db->update($query);

    if ($updated_row) {
     $meg ="<span class='success'>Product Updated Successfully!.
     </span>";
     return $meg;
    }else {
     $meg = "<span class='error'>Product Not updated !</span>";
    return $meg;
    }
     	}
     }
}
public function delProById($id){
	$query = " SELECT * FROM tbl_product WHERE productId = '$id' ";
	$getData = $this->db->select($query);
    if ($getData) {
         	while ( $delImg= $getData->fetch_assoc()) {
         		$dellink=$delImg['image'];
         		unlink($dellink);
         	}
         }
         $delquery=" DELETE  FROM tbl_product WHERE productId = '$id' ";
         $deldata = $this->db->delete($delquery);
         if ($deldata) {
     	       $meg="<span class='success'>product Delete sucessfully</span>";
             	return $meg;	
     		}else{
     		 	$meg="<span class='error'>product Not delete  </span>";
             	return $meg;
     		 }     
}
   public function getFeaturedProduct(){
   	$query="SELECT * FROM tbl_product WHERE type='0' ORDER BY productId DESC LIMIT 4 ";
   	$result =$this->db->select($query);
   	return $result;
   }
   public function getNewProduct(){
   	$query="SELECT * FROM tbl_product  ORDER BY productId DESC LIMIT 4 ";
   	$result =$this->db->select($query);
   	return $result;
   }

   public function getSingleProduct($id){
   	$query = " SELECT  tbl_product.*, tbl_category.catName, tbl_brand.brandName FROM tbl_product 
     		INNER JOIN tbl_category 
     		ON tbl_product.catId =tbl_category.catId
     		INNER JOIN tbl_brand
     		ON tbl_product.brandId =tbl_brand.brandId AND tbl_product.productId='$id'";

		$result = $this->db->select($query);
		return $result;
   }
   public function LatestFromIphone(){
   	$query="SELECT * FROM tbl_product WHERE brandId='6'  ORDER BY productId DESC LIMIT 1 ";
   	$result =$this->db->select($query);
   	return $result;
   }
    public function LatestFromSamsung(){
   	$query="SELECT * FROM tbl_product WHERE brandId='1'  ORDER BY productId DESC LIMIT 1 ";
   	$result =$this->db->select($query);
   	return $result;
   }
    public function LatestFromAcer(){
   	$query="SELECT * FROM tbl_product WHERE brandId='4'  ORDER BY productId DESC LIMIT 1 ";
   	$result =$this->db->select($query);
   	return $result;
   }
    public function LatestFromCanon(){
   	$query="SELECT * FROM tbl_product WHERE brandId='2'  ORDER BY productId DESC LIMIT 1 ";
   	$result =$this->db->select($query);
   	return $result;
   }
   public function productByCat($id){
   	    $catId = mysqli_real_escape_string($this->db->link, $id);
   	    $query = " SELECT * FROM tbl_product WHERE catId = '$catId' ";
		$result = $this->db->select($query);
		return $result;
   }
   public function insertCompareData($cmprid,$cmrId){
    $cmrId = mysqli_real_escape_string($this->db->link, $cmrId);
    $productId = mysqli_real_escape_string($this->db->link, $cmprid);

    $cquery = "SELECT * FROM tbl_compare WHERE cmrId='$cmrId' AND productId='$productId'";
    $cheak =$this->db->select($cquery);
    if ($cheak) {
      $meg="<span class='error'>Already Added</span>";
      return $meg;
    }
     
     $query="SELECT * FROM tbl_product WHERE productId='$productId'";
     $result =$this->db->select($query)->fetch_assoc(); 
     if ($result) {
       $productId = $result['productId'];
       $productName = $result['productName'];
       $price = $result['price'];
       $image = $result['image'];
      $query = "INSERT INTO tbl_compare(cmrId ,productId, productName, price,image) VALUES('$cmrId','$productId','$productName','$price','$image')";
                      $inserted_row = $this->db->insert($query);
                      if ($inserted_row) {
                $meg="<span class='success'>Added ! cheak Compare Page </span>";
                return $meg;
            }else{
                $meg="<span class='error'>Not Added</span>";
                return $meg;
             }
               }
             
   }
   public function getComparedData($cmrId){
    $query="SELECT * FROM tbl_compare  WHERE cmrId='$cmrId' ORDER BY id DESC ";
    $result =$this->db->select($query);
    return $result;
   }
   public function delCompareData($cmrId){
     $query=" DELETE  FROM tbl_compare WHERE cmrId = '$cmrId' ";
     $deldata = $this->db->delete($query);
   }
   public function saveWlistData($id, $cmrId){
    $cquery = "SELECT * FROM tbl_wlist WHERE cmrId='$cmrId' AND productId='$id'";
    $cheak =$this->db->select($cquery);
    if ($cheak) {
      $meg="<span class='error'>Already Added This Product !</span>";
      return $meg;
    }
    $pquery="SELECT * FROM tbl_product WHERE productId ='$id'";
    $result =$this->db->select($pquery)->fetch_assoc(); 
        if ($result) {
         $productId = $result['productId'];
          $productName = $result['productName'];
            $price = $result['price'];
             $image = $result['image'];
              $query = "INSERT INTO tbl_wlist(cmrId ,productId, productName, price,image) VALUES('$cmrId','$productId','$productName','$price','$image')";
              $inserted_row = $this->db->insert($query);
                      if ($inserted_row) {
                $meg="<span class='success'>Added ! cheak Wlist Page</span>";
                return $meg;
            }else{
                $meg="<span class='error'>Not Added</span>";
                return $meg;
             }
   } 
 }
 public function getWlistData($cmrId){
   $query="SELECT * FROM tbl_wlist  WHERE cmrId='$cmrId' ORDER BY id DESC ";
    $result =$this->db->select($query);
    return $result;
   
 }
   public function delWlistData($cmrId, $productId){
     $query=" DELETE  FROM tbl_wlist WHERE cmrId = '$cmrId' AND  productId ='$productId'";
     $deldata = $this->db->delete($query);
   }
}
?>