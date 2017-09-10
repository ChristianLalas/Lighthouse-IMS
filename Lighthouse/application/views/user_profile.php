<?php include('includes/meta.php'); ?>
<?php include('includes/header-script.php'); ?>

<body ng-app = 'userProfile' ng-controller= 'userProfileCtrl'> 
    <input type="hidden" id="route" value="<?php echo site_url();?>">
	<div id="wrapper">
		<?php include('includes/main-nav.php'); ?>

        <!--Content-->
		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header wsub" align="center">PROFILE
                    <br><span></span></h1>
                </div>	
            </div>
         <?php foreach($accounts as $row):?>
                <?php if($row->accID == $accountUN){?>
            <div class="row">
                <div class="col-lg-12 uprof" align="center">
                    <img style="width:12%;" src="<?php echo base_url('/images/user-prof.png');?>" alt="">
                    <br>
                    <br><strong><h2><?php echo html_escape($row->accFN ." ". $row->accLN);?></h2></strong>
                    <large><?php echo $row-> accType?></large>
                </div>
            </div>

            <div class="user_p">
                <form name="editProfile" ng-submit="submitForm(editProfile.$valid)" novalidate>

                    <input type="hidden" ng-model="accountID" ng-init="accountID='<?php echo $row->accID?>'">
                    <div class="form-group" ng-class="{ 'has-error' : editProfile.fName.$invalid && !editProfile.fName.$pristine }">
                        <label >First Name:</label>
                        <input class="form-control" type="text" id="fName" name="fName" ng-model="fName" ng-init="fName='<?php echo $row->accFN?>'" ng-minlength="2" ng-maxlength="30" disabled required>
                        <p ng-show="editProfile.fName.$invalid && !editProfile.fName.$pristine" class="help-block">*Please Enter Your First Name*</p>
                    </div>

                    <div class="form-group" ng-class="{ 'has-error' : editProfile.lName.$invalid && !editProfile.lName.$pristine }">
                        <label >Last Name:</label>
                        <input class="form-control" type="text" id="lName" name="lName" ng-model="lName" ng-init="lName='<?php echo $row->accLN?>'" ng-minlength="2" ng-maxlength="30" disabled required>
                        <p ng-show="editProfile.lName.$invalid && !editProfile.lName.$pristine" class="help-block">*Please Enter Your Last Name*</p>
                    </div>

                    <div class="form-group">
                        <label >Email:</label>
                        <input class="form-control" type="email" id="email" ng-model="email" ng-init="<?php echo $row->accEAd?>" disabled>
                    </div>

                    <div class="form-group" ng-class="{ 'has-error' : editProfile.contact.$invalid && !editProfile.contact.$pristine }">
                        <label >Contact Number:</label>
                        <input class="form-control" type="text" id="contact" name="contact" ng-model="contact" ng-init="contact='<?php echo $row->accContctNo?>'" ng-minlength="10" ng-maxlength="11" disabled required>
                        <p ng-show="editProfile.contact.$invalid && !editProfile.contact.$pristine" class="help-block">*Please Enter Your Contact Number*</p>
                    </div>

                    <div class="form-group" ng-class="{ 'has-error' : editProfile.address.$invalid && !editProfile.address.$pristine }">
                        <label >Address:</label>
                        <input class="form-control" type="text" id="address" name="address" ng-model="address" ng-init="address='<?php echo $row->accAd?>'" ng-minlength="5" ng-maxlength="65" disabled required>
                        <p ng-show="editProfile.address.$invalid && !editProfile.address.$pristine" class="help-block">*Please Enter Your Address*</p>
                    </div>

                    <div class="form-group" ng-class="{ 'has-error' : editProfile.username.$invalid && !editProfile.username.$pristine }">
                        <label >Username:</label>
                        <input class="form-control" type="text" id="username" name="username" ng-model="username" ng-init="username='<?php echo $row->accUN?>'" ng-minlength="4" ng-maxlength="25" ng-change="checkUsername()" disabled required>
                        <p ng-show="editProfile.username.$invalid && !editProfile.username.$pristine" class="help-block">*Please Enter Your Username*</p>
                        <p class="text-danger" ng-show="usernameWarning">*Username Has Already Been Taken*</p>
                    </div>

                    <div class="form-group">
                        <label >Current Password:</label>
                        <input class="form-control" type="{{pass}}" id="password" name="password" ng-model="password" ng-init="password='<?php echo $row->accPass?>'" disabled>
                    </div>

                    <div class="form-group" ng-class="{ 'has-error' : editProfile.newPassword.$invalid && !editProfile.newPassword.$pristine }">
                        <label >New Password:</label>
                        <input class="form-control" id="newPassword" name="newPassword" ng-model="newPassword" ng-minlength="6" ng-maxlength="15" disabled>
                        <p ng-show="editProfile.newPassword.$invalid && !editProfile.newPassword.$pristine" class="help-block">*Please Enter Your New Password*</p>
                        <p class="text-danger" ng-show="passWarning">*Password Did Not Match*</p>
                    </div>

                    <div class="form-group" ng-class="{ 'has-error' : editProfile.confPassword.$invalid && !editProfile.confPassword.$pristine }">
                        <label >Confirm Password:</label>
                        <input class="form-control" id="confPassword" name="confPassword" ng-model="confPassword" ng-minlength="6" ng-maxlength="15" ng-change="confirmPassword()" disabled>
                        <p ng-show="editProfile.confPassword.$invalid && !editProfile.confPassword.$pristine" class="help-block">*Please Confirm Your Passsword*</p>
                        <p class="text-danger" ng-show="passWarning">*Password Did Not Match*</p>
                    </div> 
                
                <div class="userp_button">
                    <button type="button" class="btn btn-default" ng-click='edit()'>Edit</button>
                    <button type="submit" class="btn btn-primary" id="save" disabled>Save</button> 
                </div>
                <?php } endforeach;?>
                </form>
                <br class="clear">
                <br class="clear">
            </div>
        </div>
    </div>

    <?php include('includes/footer-script.php'); ?>
    <?php include('includes/modals.php'); ?>

    <script src="<?php echo base_url();?>/js/userProfile.js"></script>

    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
        <footer align="center">
            <p><?php echo date("M/d/Y"); ?></p>
            <p>Danes Bakeshop <?php echo date('Y'); ?>. All Rights Reserved</p>
        </footer>
</body>

</html>
