<?php
$filepath=realpath(dirname(__FILE__));
include_once  ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>
<?php

class Customer{
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function customerRegistration($data){
		$name = mysqli_real_escape_string($this->db->link, $data['name']);
		$address = mysqli_real_escape_string($this->db->link, $data['address']);
		$city = mysqli_real_escape_string($this->db->link, $data['city']);
		$country = mysqli_real_escape_string($this->db->link, $data['country']);
		$zip = mysqli_real_escape_string($this->db->link, $data['zip']);
		$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
	  
	    if ($name == "" || $address == "" || $city == "" || $country == ""||$zip == ""||$phone == "" || $email == "" || $password =="") {
     	$meg = "<span class='error'> Field Must Not Empty !! </span>";
     		return $meg;
     	}
     	$mailquery= "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
     	$mailchk = $this->db->select($mailquery);
     	if ($mailchk != false) {
     		$meg = "<span class='error'>Email Already exit !!! </span>";
             return $meg;
      }
      else{
      	 $query = "INSERT INTO tbl_customer(name ,address, city, country, zip,phone, email,password) VALUES('$name','$address','$city','$country','$zip','$phone','$email','$password')";
           $inserted_row = $this->db->insert($query);
           if ($inserted_row) {
           $meg ="<span class='success'>Customer Registration Successfull,Now Login...
            </span>";
            return $meg;
    }else {
     $meg = "<span class='error'>Customer data Not Inserted !</span>";
    return $meg;
    }
   }

	}
	public function customerLogin($data){
   $email = mysqli_real_escape_string($this->db->link, $data['email']);
   $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
	if (empty($email)  || empty($password)) {
     		$meg = "Username or Password Must not empty !!";
     		return $meg;
     	}
     	else{
     		$query="SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password' ";
     		
             $result = $this->db->select($query);
     		if ($result != false) {
     			$value = $result->fetch_assoc();
     			Session::set("Custlogin",true);
     			Session::set("cmrId", $value['id']);
     			Session::set("cmrName", $value['name']);
     			header("location:index.php");

     		}else{
     			$meg = "Username or Password Not Match !";
     		    return $meg;
     		}
     	}
	}
	public function getCustomerData($id){
		$query="SELECT * FROM tbl_customer WHERE id='$id'";
		$result =$this->db->select($query);
		return $result;
	}
	public function customerUpdate($data,$cmrId){
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
		$address = mysqli_real_escape_string($this->db->link, $data['address']);
		$city = mysqli_real_escape_string($this->db->link, $data['city']);
		$country = mysqli_real_escape_string($this->db->link, $data['country']);
		$zip = mysqli_real_escape_string($this->db->link, $data['zip']);
		$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		
	  
	    if ($name == "" || $address == "" || $city == "" || $country == ""||$zip == ""||$phone == "" || $email == "" ) {
     	$meg = "<span class='error'> Field Must Not Empty !! </span>";
     		return $meg;
     	}
     	else{
      	 $query = "INSERT INTO tbl_customer(name ,address, city, country, zip,phone, email) VALUES('$name','$address','$city','$country','$zip','$phone','$email')";
           
          $query = "UPDATE tbl_customer 
     		 SET 
     		name= '$name',
     		address= '$address',
     		city= '$city',
     		country= '$country',
     		zip= '$zip',
     		phone= '$phone',
     		email= '$email'  
     		WHERE id ='$cmrId'";
     		$updated_row = $this->db->update($query);
     		if ($updated_row) {
     	       $meg="<span class='success'>Customer Data update sucessfully Please Click Menu Button</span>";
             	return $meg;	
     		}else{
     		 	$meg="<span class='error'>Not update sucessfully </span>";
             	return $meg;
     		 } 
         }
	}
}
?>