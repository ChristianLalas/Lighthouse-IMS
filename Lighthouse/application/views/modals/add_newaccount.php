<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inventory</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- Customized CSS -->
    <link href="<?php echo base_url('/vendor/bootstrap/css/styles.css');?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url('/vendor/metisMenu/metisMenu.min.css');?>" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="<?php echo base_url('/vendor/datatables-plugins/dataTables.bootstrap.css');?>" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo base_url('/vendor/datatables-responsive/dataTables.responsive.css');?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('/dist/css/sb-admin-2.css" rel="stylesheet');?>">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('/vendor/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">

    <link rel="shortcut icon" type="image/x-icon" href="logo.png">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
                <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"></button>
                    <center><h3 class="modal-title"><b>Add New Account!</h3>
                </div>
                        <form method="post" action="<?php echo site_url('Accounts/newAccount');?>" name="form">
    <!-- First Name -->  <div>
                        <div class="col-sm-12">
                            <h4><b>First Name</h4>
                          </div>
                        <br />
                          <div class="col-sm-12"><center>
                            <input type="text" name="Fname" class="form-control"> 
                          </div>  
                        </div>
                        <br />
    <!-- Last Name -->  <div>
                          <div class="col-sm-12">
                            <h4><b>Last Name</b></h4>
                          </div>
                        <br />
                          <div class="col-sm-12">
                            <input type="text" name="Lname" class="form-control"> 
                          </div>
                        </div>
                        <br />
 <!-- Account Type --><div>
                          <div class="col-sm-12">
                            <h4><b>Account Type</h4>
                          </div>
                        <br />
                          <div class="col-sm-12">
                            <select name="Acctype" class="form-control">
                              <option value="CHECKER">CHECKER</option>
                              <option value="MANAGER">MANAGER</option>
                              <option value="INVENTORER">INVENTORER</option>
                            </select>
                          </div>
                        </div>
                        <br />
    <!-- Address --><div>
                          <div class="col-sm-12">
                            <h4><b>Address</h4>
                          </div>
                        <br />
                          <div class="col-sm-12">
                            <input type="text" name="Address" class="form-control"> 
                          </div>
                        </div>
                        <br />
<!-- Contact Number --><div>
                            <br />
                              <div class="col-sm-12">
                                <h4><b>Contact Number</h4>
                              </div>
                            <br />
                              <div class="col-sm-12">
                                <input type="number" name="Contactno" class="form-control">
                              </div>
                            </div>
                            <br />
<!-- E-Mail Address --><div>
                            <br />
                              <div class="col-sm-12">
                                <h4><b>E-Mail Address</h4>
                              </div>
                            <br />
                              <div class="col-sm-12">
                                <input type="text" name="Eaddress" class="form-control">
                              </div>
                            </div>
                            <br />
                            <br />
<!-- Auths --><div>
                            <br />
                              <div class="col-sm-12">
                                <div class="col-sm-6">
                                  <h4><b><center>Username</h4>
                                </div>
                                <div class="col-sm-6">
                                  <h4><b><center>Password</h4>
                                </div>
                              </div>
                            <br />
                              <div class="col-sm-6">
                                <input type="text" name="Username" class="form-control"> 
                              </div>
                              <div class="col-sm-6">
                                <input type="text" name="Password" class="form-control"> 
                              </div>
                            <br />
                            </div>
                            <br />
                <div class="modal-footer">
                <br />
                    <input class="btn btn-default" type="submit" value="Add"/>
                       </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

    <script src="<?php echo base_url('/vendor/jquery/jquery.min.js');?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('/vendor/bootstrap/js/bootstrap.min.js');?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url('/vendor/metisMenu/metisMenu.min.js');?>"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url('/vendor/datatables/js/jquery.dataTables.min.js');?>"></script>
    <script src="<?php echo base_url('/vendor/datatables-plugins/dataTables.bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('/vendor/datatables-responsive/dataTables.responsive.js');?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>/dist/js/sb-admin-2.js"></script>
    </body>
    </html>