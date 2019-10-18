<?php include 'inc/header.php'; ?>
<?php 
$login  = Session:: get("Custlogin");
if ($login == false) {
	header("location:login.php");
}
?>
<?php 
if (isset($_GET['customerId'])) {
	$id=$_GET['customerId'];
	$time=$_GET['time'];
	$price=$_GET['price'];
	$confirm=$ct->productShiftConfirm($id, $time, $price);
}
?>
<style>
.tblone tr th{text-align:justify-all;}
</style>
<div class="main">
	<div class="content">
		<div class="section group">
			<div class="order">
				<h2>order details Page</h2>
				<table class="tblone">
							<tr>
								<th>NO</th>
								<th>Product Name</th>
								<th>Image</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Date</th>
								<th>status</th>
								<th>Action</th>
							</tr>
							<?php  

							$cmrId  = Session::get("cmrId");
							$getorder = $ct->getorderedproduct($cmrId);
							if ($getorder) {
								$i=0;
								
								while ($result=$getorder->fetch_assoc()) {
									$i++;
								
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td><img src="admin/<?php echo $result['image']; ?> " alt=""/></td>
								<td><?php echo $result['quantity']; ?></td>
								
								<td>$<?php $result['price'];?> </td>
								 <td><?php echo $fm->formatDate($result['date']); ?></td>
								 <td><?php 
								 if ($result['status'] == '0') {
								 	echo "pending";
								 } elseif($result['status']== '1') {
								 	echo "Shifted";
								  }else{
								 	echo "OK";
								 }
								  ?>
								 	
								 </td>
								 <?php if ($result['status']== '1') { ?>
								 <td><a href="?customerId=<?php echo $cmrId; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date'];?>">Confirm</a></td>	
								<?php  } elseif($result['status']=='2') {  ?>
								<td>DONE</td>
							<?php } elseif ($result['status'] == '0') {?>
							<td>N/A</td>
							<?php } ?>
							</tr>
							
							<?php } }  ?>
							
						</table>
			</div>
		</div>
		<div  class="clear"></div>
	</div>
</div>
<?php  include 'inc/footer.php'; ?>