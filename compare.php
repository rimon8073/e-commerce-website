<?php include 'inc/header.php'; ?>
<?php 
$login  = Session:: get("Custlogin");
if ($login == false) { 
header("location:login.php");
}
?>
<style>
table.tblone img {height: 70px;font-weight: 150px;}	
</style>

</script>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Compare Products</h2>
			    	
						<table class="tblone">
							<tr>
								<th>SL</th>
								<th>Product Name</th>
								<th>Price</th>
								<th>Image</th>
								<th>Action</th>
							</tr>
							<?php  
							$cmrId  = Session::get("cmrId");
							$getPd = $pd->getComparedData($cmrId);
							if ($getPd){
								$i = 0;
								while ($result = $getPd->fetch_assoc()){
									$i++;	
							
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td>$<?php echo $result['price']; ?></td>
								<td><img src="admin/<?php echo $result['image'];?> " alt=""/></td>
								<td><a href="details.php?proid=<?php echo $result['productId']?>">View</a> </td>

							</tr>
							<?php } }  ?>
							</table>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php';?>


