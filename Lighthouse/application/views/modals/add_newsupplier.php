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
                    <center><h3 class="modal-title"><b>Add New Supplier!</h3>
                </div>
                        <form method="post" action="<?php echo site_url('Suppliers/newSupplier');?>" name="form">
    <!-- Item Type -->  <div>
                        <div class="col-sm-12">
                            <h4><b>Supplier Name</h4>
                          </div>
                        <br />
                          <div class="col-sm-12"><center>
                            <input type="text" name="Suppliername" class="form-control"> 
                          </div>  
                        </div>
                        <br />
    <!-- Item Type -->  <div>
                          <div class="col-sm-12">
                            <h4><b>Supplier Address</b></h4>
                          </div>
                        <br />
                          <div class="col-sm-12">
                            <input type="text" name="Supplieraddress" class="form-control"> 
                          </div>
                        </div>
                        <br />
    <!-- Item RO Lvl --><div>
                          <div class="col-sm-12">
                            <h4><b>Office Contact Number</h4>
                          </div>
                        <br />
                          <div class="col-sm-12">
                            <input type="number" name="Supcontactno" class="form-control"> 
                          </div>
                        </div>
                        <br />
<!-- Item Delivery Unit --><div>
                            <br />
                              <div class="col-sm-12">
                                <h4><b>Supplier Contact Person</h4>
                              </div>
                            <br />
                              <div class="col-sm-12">
                                <input type="text" name="Supcontactper" class="form-control">
                              </div>
                            </div>
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