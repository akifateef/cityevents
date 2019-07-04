<?php include'header.php'; ?>
<br><br><br><br><br>
<body class="login">
    <div class="row">
        <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4" style="margin-left: 32%;">
            <div class="logo margin-top-30">

            </div>
            
            <!-- start: LOGIN BOX -->
            <div align="center">
                 <div class="box-login">
                
                <form class="form-login" method="POST" action="<?php echo base_url()?>admin/user/login">
                <?php 
if($_GET['register'] =='success'){
?>
<div class="alert alert-success">
  <strong>You've registered Successfuly,</strong> Please Login Now !
</div>
<?php }?>
                    <fieldset>
                        <legend>
                            Sign in to your account
                        </legend>
                        <p>
                            Please enter your Username and Password to log in.
                        </p>
                        <div class="form-group ">
                             <div align="center">
                             <label>Username</label>
                                <span class="input-icon">
                                    
                                    <input id="email" type="text" class="form-control" name="user_name" value="" required autofocus>

                                        <span class="help-block">
                                        <strong></strong>
                                    </span>
                                    <i class="fa fa-user"></i>
                                </span>
                        </div>
                        <div class="form-group form-actions">
                        <label>Password</label>
                                <span class="input-icon" >
                                     <input id="password" type="password" class="form-control" name="password" required>       
                                </span>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" style="
    margin-top: 36px;
    padding: 8px;
">Login</button>
<br>
                        <div class="new-account">
                             <div align="center">
                            <p>Don't have an account yet? </p>
                            <a href="<?php echo base_url()?>event/register">
							<p style="color:red;"> Create an account </p>
                               
								
                            </a>
							<br>
					
							
                        </div>
                    </fieldset>
                </form>

            </div>
           
       
<br>

<?php include'footer.php'; ?>

</html>


