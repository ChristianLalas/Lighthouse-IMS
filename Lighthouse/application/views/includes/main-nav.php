        <body style="  background-image:linear-gradient(to right, #63B8FF, #FF69B4);">
        <input type="hidden" id="route" value="<?php echo site_url();?>">
        <nav class="navbar-default navbar--top" role="navigation" style="margin-bottom: 0">
             <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header" >
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="<?php echo site_url('Inventory');?>">
                <img href="<?php echo site_url('Inventory');?>" src="<?php echo base_url('/images/bulb.png');?>" alt=" "class="img-rounded little-logo" height="100px" width="175px">
                </a>
			</div>

            
            <!-- /.navbar-header -->
			
            <ul align="center" class="nav navbar-top-links navbar-right">
               
                <li class="dropdown" >
            
                    <ul class="dropdown-menu dropdown-user">
                        <!--<li><a href="" type="button" class="btn btn-danger"><span class="badge"></span><i class="fa fa-warning fa-fw"></i> LOW STOCKS</a>
                        </li> -->
                        <li><a href=""><i class="fa fa-warning fa-fw"></i> LOW STOCKS</a>
                        </li> 
                        <li class="divider"></li>
                        <!--<li><a href="" type="button" class="btn btn-danger"><span class="badge"></span><i class="fa fa-list fa-fw"></i> REQUESTS</a>
                        </li>--> 
                        <li><a href=""><i class="fa fa-list fa-fw"></i> REQUESTS</a>
                        </li> 
                        </ul>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">
                        <h3><?php foreach ($accounts as $rowss):
                            if($rowss->accID == $accountUN){
                            echo html_escape($rowss->accUN);
                            ?><input type="hidden" id='currentUser' value='<?php echo $rowss->accID;?>' />
                             <input type="hidden" id='currentUserType' value='<?php echo $rowss->accType;?>' />
                           <?php }
                            endforeach;?>
                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i></h3>
                    </a>

                    <ul class="dropdown-menu dropdown-user">
                       <li><a href="<?php echo site_url('User_Profile');?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url('Verifylogin/logOut/').$accountUN;?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
               
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            

           <div class="navbar-default side-nav sidebar" role="navigation" >
                    <div class="sidebar-nav navbar-collapse">
                         <ul class="nav" id="side-menu">
                            <li>
                                <a href="<?php echo site_url('Item_List');?>"><i class="fa fa-folder fa-fw"></i> MASTER LIST</a>
                  
                                <!-- /.nav-second-level -->
                            </li>
                             <li>
           					<li>
                                <a href="<?php echo site_url('Suppliers');?>"><i class="fa fa-plus fa-fw"></i> SUPPLIERS</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('Inventory');?>"><i class="fa fa-plus fa-fw"></i> PRODUCT LIST</a>
                             </li>
                             <li>
                                <a href="<?php echo site_url('Inventory');?>"><i class="fa fa-plus fa-fw"></i> PURCHASE ORDER</a>
                             </li>
                             <li>
                                <a href="<?php echo site_url('Inventory');?>"><i class="fa fa-plus fa-fw"></i> DELIVERY</a>
                             </li>
                             <li>
                                <a href="<?php echo site_url('Inventory');?>"><i class="fa fa-plus fa-fw"></i> RETURN ORDER</a>
                             </li>
                             <li>
                                <a href="<?php echo site_url('Inventory');?>"><i class="fa fa-plus fa-fw"></i> STOCK ADJUSTMENT</a>
                             </li>
                             <li>
                                <a href="<?php echo site_url('Inventory');?>"><i class="fa fa-plus fa-fw"></i> RECONCILATION</a>
                             </li>
                            <li>
                                <a href="<?php echo site_url('Inventory');?>"><i class="fa fa-plus fa-fw"></i> REPORTS</a>
                             </li>
                            <li>
                                <?php foreach($accounts as $rows):
                                    if($rows->accID == $accountUN){
                                    if($rows->accType == "MANAGER"){ ?>
                                <a href=""><i class="fa fa-user fa-fw"></i> ACCOUNTS<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo site_url('Accounts');?>">PROFILE</a>
                                    </li>
                             
                                    <li>
                                        <a href="<?php echo site_url('ActivityLogs');?>">ACTIVITY LOGS</a>
                                    </li> 
                                </ul>
                            </li>
              
                                <?php } } endforeach; ?>

                                <!-- /.nav-second-level -->
                            </li>
                                <!-- /.nav-second-level -->
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
        </nav>
		</body>