<?php include('includes/meta.php'); ?>
<html>
<body>

 <?php echo validation_errors(); ?>
    <?php echo form_open('verifylogin'); ?>
    <div class="container" >
            <div class="row">
                <div class="m-y-4">
                    <center><br><br><br><br><br><br></center>
                </div>
                <center><div class="col-md-4 col-md-offset-4 row-md-5" >
                    <div class="login-panel panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title" align="center" style="font-weight: bold; ">Please Log In</h3>
                        </div>
                        <div class="panel-body m-t-0">
                            <form role="form">
                                <fieldset>
                      			<?php echo form_open('Verifylogin'); ?>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="username" name="username" type="text" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="password" name="password" type="password" value="">
                                    </div>
                                    
                                    <input class="btn btn-lg btn-primary btn-block" type="submit" value="Login"/>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>
