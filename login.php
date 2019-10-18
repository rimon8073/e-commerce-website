<?php include 'inc/header.php';?>
<?php 
$login  = Session:: get("Custlogin");
if ($login == true) {
	header("location:index.php");
}
?>

<?php 
     if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Login'])){
	  $CustLogin = $cmr->customerLogin($_POST);
	}
	?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
    	 	
        	<h2>Existing Customers</h2>
        	<h5 style="color:purple"><b>Sign in with Email and password.</b></h5>
        	
        	<form action="" method="post" >
                	<input  style="font-size: 15px;font-weight: bold;color: #010010" type="text" name="email" placeholder="Email">
                    <input  style="font-size: 15px;font-weight: bold;color: #010000" type="password" name="password" placeholder="password">
                    <div class="buttons"><div><button class="grey" name="Login">Sign In</button></div></div>

                 </form>
                <?php 
    		if (isset($CustLogin)) {
    			echo $CustLogin;
    		 }
    		 ?>
                    
                    </div>

                    <?php 
				     if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Register'])){
    				  $CustomerReg = $cmr->customerRegistration($_POST);
					}
					?>

    	<div class="register_account">
    		<?php 
    		if (isset($CustomerReg)) {
    			echo $CustomerReg;
    			    		}
    		 ?>
    		<h3>Please Fil Up The Form and Click Create Accoont Button</h3>
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input style="font-size: 15px;color:#012012;font-weight: bold;" type="text" name="name" placeholder="Name" >
							</div>
							
							<div>
							   <input  style="font-size: 15px;color:#012012;font-weight: bold;" type="text" name="city" placeholder="city name">
							</div>
							
							<div>
								<input  style="font-size: 15px;color:#012012;font-weight: bold;" type="text" name="zip" placeholder="Zip-Code">
							</div>
							<div>
								<input  style="font-size: 15px;color:#012012;font-weight: bold;" type="text" name="email" placeholder="Email">
							</div>
		    			 </td>

		    			<td style="padding-left: 15px">
						<div>
							<input  style="font-size: 15px;color:#012012;font-weight: bold;" type="text" name="address" placeholder="Address">
						</div>
		    		<div>
						<select  style="font-size: 15px;color:#012012;font-weight: bold;" id="country" name="country">
							<option value="null">Select a Country</option>         
							<option value="AF">Afghanistan</option>
							<option value="AL">Albania</option>
							<option value="DZ">Algeria</option>
							<option value="AR">Argentina</option>
							<option value="AM">Armenia</option>
							<option value="AW">Aruba</option>
							<option value="AU">Australia</option>
							<option value="AT">Austria</option>
							<option value="AZ">Azerbaijan</option>
							<option value="BS">Bahamas</option>
							<option value="BH">Bahrain</option>
							<option value="BD">Bangladesh</option>

		         </select>
				 </div>		        
	
		           <div>
		          <input  style="font-size: 15px;color:#012012;font-weight: bold;" type="text" name="phone" placeholder="phone number">
		          </div>
				  
				  <div>
					<input style="font-size: 15px;width: 96%;padding:5px;font-weight: bold;color: #111000" type="password" name="password" placeholder="password">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button name="Register" class="grey">Create Account</button></div></div>
		    <h5 style="margin: 10px" class="terms">By clicking 'Create Account' you agree to the <a href="contact.php">Terms &amp; Conditions</a>.</h5>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php';?>
