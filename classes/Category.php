<?php
$filepath = realpath(dirname(__FILE__));
include_once  ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>
<?php
class Category {
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function catInsert($catName){
		$catName = $this->fm->validation($catName);
     	$catName = mysqli_real_escape_string($this->db->link,$catName);

     	if (empty($catName)) {
     	$meg = "<span class='error'> Category Field Must Not Empty</span>";
     		return $meg;
     	}else{
     		$query= "INSERT INTO tbl_category(catName) VALUES ('$catName')";
             $catinsert = $this->db->insert($query);
             if ($catinsert) {
           $meg="<span class='success'>Category insert sucessfully</span>";
             	return $meg;
             }else{
             $meg="<span class='error'>Not insert sucessfully </span>";
             	return $meg;
             }
     	}
	}
	public function getAllCat(){
		$query = " SELECT * FROM tbl_category ORDER BY catId DESC ";
		$result = $this->db->select($query);
		return $result;
	}
	public function getCatById($id){
		$query = " SELECT * FROM tbl_category WHERE catId = '$id' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function catUpdate($catName,$id){
     $catName = $this->fm->validation($catName);
    $catName = mysqli_real_escape_string($this->db->link,$catName);
    $id = mysqli_real_escape_string($this->db->link,$id);
    if (empty($catName)) {
     $meg = "<span class = 'error'> Category Field Must Not Empty</span>";
     		return $meg;
     	}else{
     		$query = "UPDATE tbl_category 
     		 SET 
     		catName= '$catName'  
     		WHERE catId ='$id'";
     		$updated_row = $this->db->update($query);
     		if ($updated_row) {
     	       $meg="<span class='success'>Category update sucessfully</span>";
             	return $meg;	
     		}else{
     		 	$meg="<span class='error'>Not update sucessfully </span>";
             	return $meg;
     		 } 
     	}
	}
	public function delCatById($id){
		$query = " DELETE  FROM tbl_category WHERE catId = '$id' ";
		$deldata = $this->db->delete($query);
		if ($deldata) {
     	       $meg="<span class='success'> Delete sucessfully</span>";
             	return $meg;	
     		}else{
     		 	$meg="<span class='error'> delete Not sucessfully </span>";
             	return $meg;
     		 }
	}

}
?>