<?php include('includes/meta.php'); ?>
<?php include('includes/header-script.php'); ?>

<body ng-app = "suppliers"  ng-controller = "suppliersCtrl">
    <input type="hidden" id="route" value="<?php echo site_url();?>">
        <!-- Navigation -->
        <?php include('includes/main-nav.php'); ?>

        <!--Content-->
        <div id="page-wrapper">
             <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header wsub" align="center">SUPPLIERS
                    <br><span>ALL SUPPLIERS INFORMATION</span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			
                <div class="add-new-item" align="right">
                    <button type="button" class="btn btn-default" data-toggle="modal" ng-click='addSupplier()'>
                        <i class="fa fa-plus"></i> Add New Supplier
                    </button>
                        <h1></h1>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                            <!-- /.panel-heading -->
                       
                                <div class="panel-body">
                            <table width="100%" class="table table-striped table-hover" id="suppliersTable">
                                <thead>
                                    <tr><center>
                                        <th><center>Company Name</th>
                                        <th><center>Address</th>
                                        <th><center>Contact Person</th>
                                        <th><center>Contact Number</th>
                                        <th><center>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if($suppliers == null){?>
                                    <td>NO DATA FOUND</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                <?php } else {
                                 foreach($suppliers as $row):?>
                                    <tr>
                                        <td><?php echo html_escape($row->supCompany);?></td>
                                        <td><?php echo html_escape($row->supAd);?></td>
                                        <td><?php echo html_escape($row->supContactPer);?></td>
                                        <td><?php echo $row->supContactNo;?></td>
                                        <td><center><?php foreach($accounts as $rows):
                                              if($rows->accID == $accountUN){
                                              if($rows->accType == "MANAGER"){ ?>
											<input type="button" value = "EDIT"  class="btn btn-default" ng-click='editSupplier(<?php echo $row->supID;?>)'/>

                                            <?php if($row->supStat == "ENABLED"){ ?> 
                                                <button  type="button" class="btn btn-default">
                                                    <a href="<?php echo site_url('Suppliers/supplierDisable/').$accountUN.'/'.$row->supID;?>"><?php echo "DISABLE";?></a>
                                                </button>
                                            <?php } else if($row->supStat == "DISABLED") {  ?>
                                                <button  type="button" class="btn btn-default">
                                                    <a href="<?php echo site_url('Suppliers/supplierEnable/').$accountUN.'/'.$row->supID;?>"><?php echo "ENABLE";?></a>
                                                </button>
                                            <?php } } else { echo $row->supStat;
                                             } }endforeach; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; }?>   
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->

                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <script type="text/ng-template" id="success.html">
        <div class="succesChange" >
            <div class="modal-body">
                <h4> {{ msg }} </h4>
                <input type="button" value = "OK" ng-click="ok()" class="btn btn-default"/>
            </div>
        </div>
    </script>

    <script type="text/ng-template" id="warning.html">
         <div class="modal-header"> 
            <h3>Unable To Connect To Server</h3>
        </div>
    </script>

    <script type="text/ng-template" id="supplierFields.html">
        <div class="supplierFields">
            <div class="modal-header"> 
                <h4>{{header}}</h4>
            </div>
            <div class="modal-body">
                <form name="supplierFields" ng-submit="submitForm(supplierFields.$valid)" novalidate>
                    <div class="form-group" ng-class="{ 'has-error' : supplierFields.CompanyName.$invalid && !supplierFields.CompanyName.$pristine }">
                        <label>Company Name</label>
                        <input type="text" name="CompanyName" class="form-control" ng-model="CompanyName" ng-minlength="2" ng-maxlength="150" ng-change="checkCompanyName()" required>
                        <p ng-show="supplierFields.CompanyName.$invalid && !supplierFields.CompanyName.$pristine" class="help-block">*Please Enter Company Name*</p>
                        <p class="text-danger" ng-show="supplierNameWarning">*Supplier Already Exist*</p>
                    </div>

                    <div class="form-group" ng-class="{ 'has-error' : supplierFields.Address.$invalid && !supplierFields.Address.$pristine }">
                        <label>Address</label>
                        <input type="text" name="Address" class="form-control" ng-model="Address" ng-minlength="10" ng-maxlength="150" required>
                        <p ng-show="supplierFields.Address.$invalid && !supplierFields.Address.$pristine" class="help-block">*Please Enter Company Address*</p>
                    </div> 

                     <div class="form-group" ng-class="{ 'has-error' : supplierFields.ContatPer.$invalid && !supplierFields.ContatPer.$pristine }">
                        <label>Contact Person</label>
                        <input type="text" name="ContatPer" class="form-control" ng-model="ContatPer" ng-minlength="2" ng-maxlength="150" required>
                        <p ng-show="supplierFields.ContatPer.$invalid && !supplierFields.ContatPer.$pristine" class="help-block">*Please Enter Contact Person*</p>
                    </div>


                    <div class="form-group" ng-class="{ 'has-error' : supplierFields.ContactNo.$invalid && !supplierFields.ContactNo.$pristine }">
                        <label>Contact No.</label>
                        <input type="text" name="ContactNo" class="form-control" ng-model="ContactNo" ng-minlength="10" ng-maxlength="11" required>
                        <p ng-show="supplierFields.ContactNo.$invalid && !supplierFields.ContactNo.$pristine" class="help-block">*Please Enter Company Contact Number*</p>
                    </div>   
                    <button type="submit" class="btn btn-primary">Save</button>  
                    <input type="button" value = "Cancel" ng-click="cancel()" class="btn btn-default"/>              
            </div>
            </form>
        </div>
        </div>

    </script>

    <?php include('includes/footer-script.php'); ?>
    <?php include('includes/modals.php'); ?>
    <script src="<?php echo base_url();?>/js/suppliers.js"></script>
      <script>
        $(document).ready(function() {
            $('#suppliersTable').DataTable({
                responsive: true
            });
        });

    </script>

<footer align="center">
            <p><?php echo date("M/d/Y"); ?></p>
            <p>LIGHTHOUSE<?php echo date('Y'); ?>. All Rights Reserved</p>
        </footer>
</body>

</html>
