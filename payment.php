<?php include 'inc/header.php';?>
<?php 
          $login  = Session:: get("Custlogin");
          if ($login == false) { 
	      header("location:login.php");
}
?>
<style>
.payment{width: 550px;height: 240px; margin: 0 auto;border: 2px solid #ddd;background: yellowgreen;}
.payment h2{text-align: center;margin: 15px;border-bottom: 5px solid #d9d9;padding-bottom: 10px;color: #000;font-weight: bold;}
.payment a{font-size: 25px;background-color: red;color: white;padding: 5px;border-radius: 10px;margin-left:10px}
.back{width: 100px;margin: 0 auto;margin-top:15px;}
.back a{text-align: center;font-size: 22px;background-color: black;color: white;padding:7px;margin-top: 10px;}
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="payment">
    			<center>
    			<h2>Choose Payment </h2>
    			<a href="offlinepayment.php">Offline Payment</a><br><br>
    			<a href="online.php">Online Payment</a>
    		</center>
    		</div>
    		<div class="back">
    			<a href="cart.php">Previous</a>
    		</div>

 	</div>
	</div>
</div>
   <?php include 'inc/footer.php';?>
