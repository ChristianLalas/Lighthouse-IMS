<?php include('includes/meta.php'); ?>
<?php include('includes/header-script.php'); ?>

<body ng-app = "accounts"  ng-controller = "accountsCtrl">
    <input type="hidden" id="route" value="<?php echo site_url();?>">
    <div id="wrapper">

        <!-- Navigation -->
        <?php include('includes/main-nav.php'); ?>

        <!--Content-->
        <div id="page-wrapper" style="  background-image:linear-gradient(to right, #63B8FF, #FF69B4);">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header wsub">ACCOUNTS
                    <br><span>ALL PERSONNEL ACCOUNTS</span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
           <?php foreach($accounts as $row):
                                              if($row->accID == $accountUN){
                                              if($row->accType == "MANAGER"){ ?>
			<div class="add-new-item" align="right">
                        <button type="button" class="btn btn-default" data-toggle="modal" ng-click='addUserButton()'>
                            <i class="fa fa-plus"></i> Add New Account</button>
                        <h1></h1>
                    </div>
            <?php } } endforeach; ?>

                <div class="col-lg-12">
                    <div class="panel panel-default">
                            <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-hover" id="accountsTable">
                                <thead>
                                    <tr>
                                        <th><center>Name</th>
                                        <th><center>UserName</th>
                                        <th><center>Password</th>
                                        <th><center>Contact No.</th>
                                        <th><center>Address</th>
                                        <th><center>Type</th>
                                        <?php foreach($accounts as $row):
                                              if($row->accID == $accountUN){
                                              if($row->accType == "MANAGER"){ ?>
                                        <th><center>Actions</th>
                                                <?php } else { ?>
                                        <th><center>Item Status</th>
                                                <?php }} endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
				    <?php foreach ($users as $row): ?>
                                    <tr>
                                        <td><center><?php echo html_escape($row->accFN); echo " "; echo html_escape($row->accLN);?></th>
                                        <td><center><?php echo html_escape($row->accUN)?></th>
                                        <td><center><button ng-click='showPass(<?php echo $row->accID?>)' class="btn btn-default">Show</button></th>
                                        <td><center><?php echo $row->accContctNo?></th>
                                        <td><center><?php echo html_escape($row->accAd)?></th>
                                        <td><center><?php echo html_escape($row->accType)?></th>
                                        <?php foreach($accounts as $rows):
                                             
                                              if($rows->accID == $accountUN){
                                              
                                              if($rows->accType == "MANAGER"){ 
                                                   if($row->accID != $accountUN){?>
                                       <td><center><input type="button" value = "EDIT"  class="btn btn-default" ng-click='editUserButton(<?php echo $row->accID;?>)'/>

                                            <?php if($row->accStat == "ENABLED"){ ?> 
                                                <button  type="button" class="btn btn-default">
                                                    <a href="<?php echo site_url('Accounts/accountDisable/').$accountUN.'/'.$row->accID;?>"><?php echo "DISABLE";?></a>
                                                </button>
                                            <?php } else if($row->accStat == "DISABLED") {  ?>
                                                <button  type="button" class="btn btn-default">
                                                    <a href="<?php echo site_url('Accounts/accountEnable/').$accountUN.'/'.$row->accID;?>"><?php echo "ENABLE";?></a>
                                                </button>
                                                </td>
                                            <?php } } else {?>
                                        
                                        <td><center><?php echo "N/A"; ?></td>
                                    </tr>
                                <?php }} else { ?>
                                <td><center><?php echo $row->accStat?></th>
                            <?php } } endforeach; endforeach;?>  
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->.
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Modals -->
    <div id='modals'>
        <script type="text/ng-template" id="showPassword.html">
            <div class="showPassword">
                <div class="modal-header">
                    <h3 class="modal-title">Need Admin's authorization to the view Password</h3>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" placeholder="Username" ng-model="authUsername" />
                    <input type="password" class="form-control" placeholder="Password" ng-model="authPassword" />
                    <div ng-show="showAuthPassWarnning"> 
                        <p>{{ authWarnning }}</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" value = "Confirm" ng-click="confirmPassBtn(authUsername, authPassword)" class="btn btn-default" />
                </div>
            </div>
        </script> 

        <script type="text/ng-template" id="showAuthPass.html">
            <div class="showAuthPass">
                <div class="modal-header"> 
                    <h4>Current Password</h4>
                </div>
                <div class="modal-body">
                    <p>Password: {{ currentPass }}</p>
                </div>
                <div class="modal-footer">
                    <input type="button" value = "Close" ng-click="close()" class="btn btn-default"/>
                </div>
            </div>
        </script>

        <script type="text/ng-template" id="success.html">
            <div class="succesChange" >
                <div class="modal-body">
                    <h4> {{ msg }} </h4>
                    <input type="button" value = "OK" ng-click="ok()" class="btn btn-default"/>
                </div>
            </div>
        </script>

        <script type="text/ng-template" id="userFields.html">
            <div class="userFields">
                <div class="modal-header"> 
                    <h4>{{header}}</h4>
                </div>
                <div class="modal-body">
                    <form name="userFields" ng-submit="submitForm(userFields.$valid)" novalidate>
                        <div class="form-group" ng-class="{ 'has-error' : userFields.LastName.$invalid && !userFields.LastName.$pristine }">
                            <label>Last Name</label>
                            <input type="text" name="LastName" class="form-control" ng-model="LastName" ng-minlength="2" ng-maxlength="150" required>
                            <p ng-show="userFields.LastName.$invalid && !userFields.LastName.$pristine" class="help-block">*Please Enter Your Last Name*</p>
                        
                        </div> 

                        <div class="form-group" ng-class="{ 'has-error' : userFields.FirstName.$invalid && !userFields.FirstName.$pristine }">
                            <label>First Name</label>
                            <input type="text" name="FirstName" class="form-control" ng-model="FirstName" ng-minlength="2" ng-maxlength="150" required>
                            <p ng-show="userFields.FirstName.$invalid && !userFields.FirstName.$pristine" class="help-block">*Please Enter Your First Name*</p>
                        </div>

                        <div class="form-group" ng-class="{ 'has-error' : userFields.Address.$invalid && !userFields.Address.$pristine }">
                            <label>Address</label>
                            <input type="text" name="Address" class="form-control" ng-model="Address" ng-minlength="10" ng-maxlength="150" required>
                            <p ng-show="userFields.Address.$invalid && !userFields.Address.$pristine" class="help-block">*Please Enter Your Address*</p>
                        </div> 

                         <div class="form-group">
                            <label >Email:</label>
                            <input class="form-control" type="email" id="email" ng-model="email">
                        </div>

                        <div class="form-group" ng-class="{ 'has-error' : userFields.ContactNo.$invalid && !userFields.ContactNo.$pristine }">
                            <label>Contact No.</label>
                            <input type="text" name="ContactNo" class="form-control" ng-model="ContactNo" ng-minlength="10" ng-maxlength="11" required>
                            <p ng-show="userFields.ContactNo.$invalid && !userFields.ContactNo.$pristine" class="help-block">*Please Enter Your Contact Number*</p>
                        </div> 

                        <div class="form-group">
                            <label>Account Type</label>
                            <select ng-model="AccountType" class="form-control">
                                <option value="NULL">Select Type</option>
                                <option value="CHECKER">CHECKER</option>
                                <option value="MANAGER">MANAGER</option>

                            </select>
                            <p class="text-danger" ng-show="accTypeWarning">*Please Select Account Type*</p>
                        </div>

                        <div ng-show="showUsernameAndPass">
                            <div class="form-group" ng-class="{ 'has-error' : userFields.username.$invalid && !userFields.username.$pristine }">
                            <label >Username:</label>
                            <input class="form-control" type="text" id="username" name="username" ng-model="username" ng-minlength="4" ng-maxlength="25" ng-change="checkUsername()" required>
                            <p ng-show="userFields.username.$invalid && !userFields.username.$pristine" class="help-block">*Please Enter Your Username*</p>
                            <p class="text-danger" ng-show="usernameWarning">*Username Has Already Been Taken*</p>
                            </div>

                            <div class="form-group" ng-class="{ 'has-error' : userFields.newPassword.$invalid && !userFields.newPassword.$pristine }">
                            <label >Password:</label>
                            <input class="form-control" id="newPassword" name="newPassword" ng-model="newPassword" ng-minlength="6" ng-maxlength="15" required>
                            <p ng-show="userFields.newPassword.$invalid && !userFields.newPassword.$pristine" class="help-block">*Please Enter Your New Password*</p>
                            <p class="text-danger" ng-show="passWarning">*Password Did Not Match*</p>
                            </div>

                            <div class="form-group" ng-class="{ 'has-error' : userFields.confPassword.$invalid && !userFields.confPassword.$pristine }">
                            <label >Cornfirm Password:</label>
                            <input class="form-control" id="confPassword" name="confPassword" ng-model="confPassword" ng-minlength="6" ng-maxlength="15" required>
                            <p ng-show="userFields.confPassword.$invalid && !userFields.confPassword.$pristine" class="help-block">*Please Confirm Your Passsword*</p>
                            <p class="text-danger" ng-show="passWarning">*Password Did Not Match*</p>
                            </div> 
                        </div>

                        <button type="submit" class="btn btn-primary" id="save" >Save</button>  
                        <input type="button" value = "Cancel" ng-click="cancel()" class="btn btn-default"/>
                    </form>
                </div>
        </script>
    </div>
    

    <?php include('includes/footer-script.php'); ?>
    <?php include('includes/modals.php'); ?>


    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>/js/accounts.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function() {
            $('#accountsTable').DataTable({
                responsive: true
            });
        });

    </script>

<footer align="center">
            <p><?php echo date("M/d/Y"); ?></p>
            <p>LIGHTHOUSE <?php echo date('Y'); ?>. All Rights Reserved</p>
        </footer>
</body>

</html>
