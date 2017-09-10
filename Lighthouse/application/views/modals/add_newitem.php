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

    <?php
      try{
        $pdo = new PDO("mysql:host=localhost;dbname=danesinventory","root","");
      } catch (PDOException $e) {
        exit("Database Connection Error!");
      }
    ?>

</head>
                <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"></button>
                    <center><h3 class="modal-title"><b>Add New Item!</h3>
                </div>
                        <form method="post" action="<?php echo site_url('Item_List/newItem');?>" name="form">
    <!-- Item Name -->  <div>
                        <div class="col-sm-12">
                            <h4><b>Item Name</h4>
                          </div>
                        <br />
                          <div class="col-sm-12"><center>
                            <input type="text" name="Itemname" class="form-control"> 
                          </div>  
                        </div>
                        <br />
    <!-- Item Type -->  <div>
                          <div class="col-sm-12">
                            <h4><b>Item Type</b></h4>
                          </div>
                        <br />
                          <div class="col-sm-12">
                          <select name="Itemtype"class="form-control">
                         <?php
                          $query = $pdo -> prepare("SELECT * FROM itemtype;");
                          $query -> execute();
                          $itemtype = $query->fetchAll();

                          foreach ($itemtype as $row):?>
                            <option value="<?php echo $row["itemTypeID"]?>"><?php echo $row["itemTypeName"]; ?></option>
                            <?php echo $row["itemTypeName"]; ?>
                         <?php endforeach; ?>
                          </select>

                        </div>
                        <br />
    <!-- Item RO Lvl --><div>
                          <div class="col-sm-12">
                            <h4><b>Item Re-Order Level</h4>
                          </div>
                        <br />
                          <div class="col-sm-12">
                            <input type="number" name="Itemrlvl" class="form-control"> 
                          </div>
                        </div>
                        <br />
<!-- Item Delivery Unit --><div>
                            <br />
                              <div class="col-sm-12">
                                <h4><b>Delivery Unit</h4>
                              </div>
                            <br />
                              <div class="col-sm-12">
                              <select name="Deliveryu" class="form-control">
                                <?php
                                $query = $pdo -> prepare("SELECT * FROM units;");
                                $query -> execute();
                                $units = $query->fetchAll();
                                 foreach ($units as $row):?>
                                    <option value="<?php echo $row["unitID"]?>"><?php echo $row["unitName"]?></option>
                                <?php endforeach; ?>
                                </select>
                              </div>
                            </div>
                            <br />
                            <br />
<!-- Item Issuance Unit --><div>
                            <br />
                              <div class="col-sm-12">
                                <div class="col-sm-4">
                                  <h4><b><center>Unit Count</h4>
                                </div>
                                <div class="col-sm-8">
                                  <h4><b><center>Issuance Unit</h4>
                                </div>
                              </div>
                            <br />
                              <div class="col-sm-4">
                                <input type="number" name="Unitcnt" class="form-control"> 
                              </div>
                              <div class="col-sm-8">
                                
                                <select name="Issuanceu" class="form-control">
                                <?php 

                                $query = $pdo -> prepare("SELECT * FROM convunits;");
                                $query -> execute();
                                $convunits = $query->fetchAll();

                                foreach ($convunits as $row):?>
                                    <option value="<?php echo $row["convUnitID"]?>"><?php echo $row["convUnitName"]?></option>
                                <?php endforeach; ?> 
                                </select>
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