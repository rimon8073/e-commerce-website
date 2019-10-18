<?php include 'inc/header.php';?>
<?php 
          $login  = Session:: get("Custlogin");
          if ($login == false) { 
	      header("location:login.php");
}
?>
<?php 

     if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
        $cmrId  = Session:: get("cmrId");
        $insertOrder=$ct->productOrder($cmrId);
        $delData =  $ct->delCustomerCart();
        header("location:success.php");
     }
     
?>
<style>
.division{width: 50%;float: left;}   
.tblone{width: 550px;margin: 0 auto ;border: 5px solid #dddd;}
.tblone tr td{text-align: justify;}
.tbltwo{float:right;text-align:left; margin: 0 auto; width:50% ;border: 3px solid #dddd;margin-right: 54px;margin-top: 12px;}
.tbltwo tr td{text-align: justify;padding: 5px 10px;}
.ordernow{padding-bottom: 20px}
.ordernow a{width: 200px;margin: 20px auto 0;text-align: center;padding: 5px;font-size: 30px;display: block;background:#ff0000;color: #fff;border-radius: 4px;}
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="division">
                <table class="tblone">
                            <tr>
                                <th >SL</th>
                                <th >Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                            </tr>
                            <?php  
                            $getPro=$ct->getCartProduct();
                            if ($getPro) {
                                $i=0;
                                $sum=0;
                                $qty=0;
                                while ($result=$getPro->fetch_assoc()) {
                                    $i++;
                                
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['productName']; ?></td>
                                <td>$<?php echo $result['price']; ?></td>
                                <td><?php echo $result['quantity']; ?></td>
                                
                                <td>$<?php 
                                $total= $result['price'] * $result['quantity'];
                                echo $total;
                                 ?> </td>
                            </tr>
                            <?php 
                            $qty=$qty+$result['quantity'];
                            $sum=$sum+$total;
                            ?>
                            <?php } }  ?>
                            
                        </table>
                        <table class="tbltwo">
                            <tr>
                                <td >Sub Total  </td>
                                <td>:</td>
                                <td>$<?php echo $sum; ?></td>
                            </tr>
                            <tr>
                                <td>VAT  </td>
                                <td>:</td>
                                <td>10%($<?php echo $vat=$sum * .1; ?>)</td>
                            </tr>
                            <tr>
                                <td>Grand Total </td>
                                <td>:</td>
                                <td>
                                <?php 
                                 $vat = $sum * .1;
                                 $gttotal = $sum+$vat;
                                 echo $gttotal;
                                ?>
                                 </td>
                            </tr>
                            <tr>
                                <td >Total Quantity  </td>
                                <td>:</td>
                                <td><?php echo $qty; ?></td>
                            </tr>
                       </table>

            </div>
            <div class="division">
                <?php 
            $id=Session::get("cmrId");
            $getdata=$cmr->getCustomerData($id);
            if ($getdata) {
                while ($result=$getdata->fetch_assoc()) {

            ?>
               <table class="tblone">
        <tr>
            <td colspan="3">
            <h2 style="text-align: center">Your Profile Info</h2>
        </td>
        </tr>
        <tr>
            <td width="20%">Name</td>
            <td width="5%">:</td>
            <td><?php echo $result['name']; ?></td>
        </tr>
        <tr>
            <td>Address</td>
            <td>:</td>
            <td><?php echo $result['address']; ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td>:</td>
            <td><?php echo $result['email']; ?></td>
        </tr>
        <tr>
            <td>Phone</td>
            <td>:</td>
            <td><?php echo $result['phone']; ?></td>
        </tr>
        <tr>
            <td>City</td>
            <td>:</td>
            <td><?php echo $result['city']; ?></td>
        </tr>
        <tr>
            <td>Country</td>
            <td>:</td>
            <td><?php echo $result['country']; ?></td>
        </tr>
        <tr>
            <td>Zip Code</td>
            <td>:</td>
            <td><?php echo $result['zip']; ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><a href="editprofile.php">Update Details</a></td>
        </tr>
    </table> 
    <?php } } ?>
  </div>
 	</div>
	</div>
    <div class="ordernow">
       
            <a href="?orderid=order">Order</a>
    </div>
</div>
   <?php include 'inc/footer.php';?>
