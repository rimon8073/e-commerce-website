<?php
$filepath = realpath(dirname(__FILE__));
include_once  ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>
<?php
class Brand {
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
}
  public function brandInsert($brandName){
		$brandName = $this->fm->validation($brandName);
     	$brandName = mysqli_real_escape_string($this->db->link,$brandName);

     	if (empty($brandName)) {
     	$meg = "<span class='error'> Brand Field Must Not Empty</span>";
     		return $meg;
     	}else{
     		$query= "INSERT INTO tbl_brand (brandName) VALUES ('$brandName')";
             $brandinsert = $this->db->insert($query);
             if ($brandinsert) {
           $meg="<span class='success'>Brand insert sucessfully</span>";
             	return $meg;
             }else{
             $meg="<span class='error'>Not insert sucessfully </span>";
             	return $meg;
             }
     	}
	}
public function getAllBrand(){
		$query = " SELECT * FROM tbl_brand ORDER BY brandId DESC ";
		$result = $this->db->select($query);
		return $result;
	}
	public function getBrandById($id){
		$query = " SELECT * FROM tbl_brand WHERE brandId = '$id' ";
		$result = $this->db->select($query);
		return $result;
	}
public function brandUpdate($brandName,$id){
     $brandName = $this->fm->validation($brandName);
    $brandName = mysqli_real_escape_string($this->db->link,$brandName);
    $id = mysqli_real_escape_string($this->db->link,$id);
    if (empty($brandName)) {
     $meg = "<span class = 'error'> Brand Field Must Not Empty</span>";
     		return $meg;
     	}else{
     		$query = "UPDATE tbl_brand 
     		 SET 
     		brandName= '$brandName'  
     		WHERE brandId ='$id'";
     		$updated_row = $this->db->update($query);
     		if ($updated_row) {
     	       $meg="<span class='success'>Brand update sucessfully</span>";
             	return $meg;	
     		}else{
     		 	$meg="<span class='error'>Not update sucessfully </span>";
             	return $meg;
     		 } 
     	}
	}
	public function delBrandById($id){
		$query = " DELETE  FROM tbl_brand WHERE brandId = '$id' ";
		$deldata = $this->db->delete($query);
		if ($deldata) {
     	       $meg="<span class='success'>Delete sucessfully</span>";
             	return $meg;	
     		}else{
     		 	$meg="<span class='error'> delete Not sucessfully </span>";
             	return $meg;
     		 }
	}

}

?>