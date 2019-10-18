<?php 
include 'lib/Session.php'; 
Session::init();
include  'lib/Database.php';
include  'helpers/Format.php';

 spl_autoload_register(function($class){
    include_once "classes/".$class.".php";
 });
 $db = new Database();
 $fm = new Format();
 $pd= new Product();
 $ct= new Cart();
 $cat= new Category();
 $br=new Brand();
 $cmr=new Customer();
 ?>


<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE HTML>
<head>
<title>Mukto Online Shop</title>
<link rel="icon" type="text/css" href="images/heading_icon.jpg">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div style="width: 80%;border:1px solid gray" class="wrap">
		<div class="header_top">
			<div class="logo">
				<h3 style="font-weight: bold;font-size: 30px">Mukto Online Shop BD</h3>
				<h4 style="margin-left: 40px">Honesty is the best policy</h4>
			</div>
			  <div style="float: right;" class="header_top_right">
			   
			    <div class="shopping_cart">
					<div class="cart">
						<a href="cart.php" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product">
									<?php
									$getData=$ct->cheakCartTable();
									if ($getData) {
										 $sum=Session::get("sum");
										 $qty=Session::get("qty");
									echo "$". $sum. " | Qty: ".$qty;
									
									}else{
									 echo "(Empty)";
									}
									
									 ?>
								</span>
							</a>
						</div>
						</div>
						<?php 
						if (isset($_GET['cid'])) {	
							$cmrId  = Session::get("cmrId");
							$delData =  $ct->delCustomerCart();
							$delComp =  $pd->delCompareData($cmrId);
							Session::destroy();
						}
						?>
		   <div class="login">

      <?php 
          $login  = Session:: get("Custlogin");
          if ($login == false) { ?>
	      <a href="login.php">Login</a>
 <?php  } else { ?>
          <a href="?cid=<?php Session::get('cmrId'); ?>">Logout</a>  
 <?php } ?>
	</div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div  class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="products.php">Product</a></li>
	  <li><a href="category.php">Category</a></li>
	  
	  <?php 
	  $chkCart=$ct->cheakCartTable();
	  	if ($chkCart) { ?>
	  		 <li><a href="cart.php">Cart</a></li>
	  		 <li><a href="payment.php">Payment</a></li>
	  	<?php } ?>
<?php 
      $cmrId  = Session::get("cmrId");
	  $chkOrder=$ct->cheakOrderDetails($cmrId);
	  	if ($chkOrder) { ?>
	  		 
	  		 <li><a href="orderdetails.php">Order Info</a></li>
	  	<?php } ?>

	 
	  <?php 
	  $login=Session::get("Custlogin");
	  if ($login == true) { ?>
	  	<li><a href="profile.php">Profile</a> </li>
	<?php   } ?>
<!--
<?php  
	
	$getPd=$pd->getComparedData($cmrId);
	if ($getPd) { ?>
   <li><a href="compare.php">Compare</a> </li>
	<?php } ?>
-->
	<?php  
	$cheakwlist=$pd->getWlistData($cmrId);
	if ($cheakwlist) { ?>
   <li><a href="wishlist.php">WishList</a> </li>
	<?php } ?>

	  <li><a href="contact.php">Contact</a> </li>
	  <div class="clear"></div>
	</ul>
</div>