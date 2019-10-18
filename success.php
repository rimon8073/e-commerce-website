<?php include 'inc/header.php';?>

<?php 
          $login  = Session:: get("Custlogin");
          if ($login == false) { 
          header("location:login.php");
}
?>

<style>
.psuccess{width: 550px;min-height: 240px; margin: 0 auto;border: 2px solid #ddd;background: yellowgreen;}
.psuccess h2{text-align: center;margin: 15px;border-bottom: 5px solid #d9d9;padding-bottom: 10px;color: #000;font-weight: bold;}
.psuccess p{font-size: 25px;padding: 5px;line-height: 25px; margin-left:10px}
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="psuccess">
          <h2>Success</h2>
          <?php  
          $cmrId  = Session:: get("cmrId");
          $amount = $ct->payableAmount($cmrId);                   
          if ($amount) {             
            $sum = 0;
             while ($result=$amount->fetch_assoc()) {
               $price = $result['price'];
               $sum = $sum+$price;                     
          }
        }
          ?>

               <p>Total Payable Amount(including Vat): $                
                <?php 
                       $vat = $sum * 0.1;
                       $total = $vat+$sum;
                       echo $total;
                ?> 
                </p>
                <p>Thanks For Purchase.we will contact you as soon as possible for your delivery details.Again ReCheak your order details.<a href="orderdetails.php">Visit Here</a></p>
    		
    		</div>
    		
 	</div>
	</div>
</div>
   <?php include 'inc/footer.php';?>
