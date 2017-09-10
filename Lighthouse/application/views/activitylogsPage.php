<?php include('includes/meta.php'); ?>
<?php include('includes/header-script.php'); ?>
<body ng-app = "activityLogs"  ng-controller = "activityLogsCtrl">
    <input type="hidden" id="route" value="<?php echo site_url();?>">
    <div id="wrapper">
       <!-- Navigation -->
       <?php include('includes/main-nav.php'); ?>

        <div id="page-wrapper" style="  background-image:linear-gradient(to right, #63B8FF, #FF69B4);">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header wsub">ACTIVITY LOGS
                    <br><span>ALL PERSONNEL ACTIVITIES</span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			
                <div class="col-lg-12">
                    <div class="panel panel-default">
                            <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th><center>Name</th>
                                        <th><center>Activity</th>
                                        <th><center>Date and Time</th>
                                        <th><center>View Summary</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php foreach($logs as $object):?>
                                    <tr>
                                        <td><center><?php echo html_escape($object->accLN .", ". $object->accFN) ;?>
                                        </td>
                                        <td><center><?php echo $object->aLActivity;?></td>
                                        <td><center><?php echo $object->aLDateTime;?></td>
                                        <td><center><input type="button" value ="View" ng-click='viewSummaryBtn(<?php echo  $object->actLogID; ?>, "<?php echo $object->aLActivity; ?>")' class="btn btn-default">
										</td>
                                    </tr>
                                <?php endforeach ?>   
                                </tbody>
                            </table>
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

    <!-- modals -->
    <script type="text/ng-template" id="viewSummary.html">
            <div class="modal-header">
                <div class="col-lg-12">
                    <div class="col-sm-3">
                        <div class="panel panel-default" align="center">
                            <label>Tranking Number</label>
                            <p class="input-group">
                                {{ trkNo }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-sm-2">
                        <div class="panel panel-default" align="center">
                            <label>Checker</label>
                            <p class="input-group">
                                {{ checker }}
                            </p>
                        </div>
                    </div>
    
                    <div class="col-sm-3">
                        <div class="panel panel-default" align="center">
                            <label>Time & Date Received</label>
                            <p class="input-group">
                                {{ tAD }}
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-1">
                        <p class="input-group">
                            <label></label>
                            <h4 ng-click='x()'>x</h4>
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered" cellspacing="0" width="100%" ng-table = "summaryTable" id = "summaryTable" >
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <tr ng-repeat="x in dataSum">
                            <td>{{ x.itemName }}</td>
                            <td>{{ x.qty }}</td>
                            <td>{{ x.unitName }}</td>
                            <td>{{ x.desc }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </script>

        <script type="text/ng-template" id="viewStkAdjSummaryCtrl.html">
            <div class="modal-header">
                <h4 ng-click='x()'>x</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered" cellspacing="0" width="100%" ng-table = "summaryTable" id = "summaryTable" >
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="x in dataSum">
                            <td>{{ x.itemName }}</td>
                            <td>{{ x.qty }}</td>
                            <td>{{ x.unitName }}</td>
                            <td>{{ x.desc }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </script> 
       
        <script type="text/ng-template" id=" nothing.html">
            <div class="modal-header">
                <h3>Nothing To View Here</h3>
            </div>
        </script>

        <script type="text/ng-template" id="viewDelSummary.html">
            <div class="modal-header">
                <div class="col-lg-12">
                    <div class="col-sm-3">
                        <div class="panel panel-default" align="center">
                            <label>Receipt Number</label>
                            <p class="input-group">
                                {{ rctNo }}
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="panel panel-default" align="center">
                            <label>Supplier</label>
                            <p class="input-group">
                                {{ supplier }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-sm-2">
                        <div class="panel panel-default" align="center">
                            <label>Receiver</label>
                            <p class="input-group">
                                {{ checker }}
                            </p>
                        </div>
                    </div>
    
                    <div class="col-sm-3">
                        <div class="panel panel-default" align="center">
                            <label>Time & Date Received</label>
                            <p class="input-group">
                                {{ tAD }}
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-1">
                        <p class="input-group">
                            <label></label>
                            <h4 ng-click='x()'>x</h4>
                        </p>
                    </div>
                </div>
            </div>

            <div class="modal-body">
                <table class="table table-striped table-bordered" cellspacing="0" width="100%" ng-table = "summaryTable" id = "summaryTable" >
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="x in dataSum">
                            <td>{{ x.itemName }}</td>
                            <td>{{ x.qty }}</td>
                            <td>{{ x.unitName }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </script>  
        <script type="text/ng-template" id="viewGRSummary.html">
            <div class="modal-header">
                <div class="col-lg-12">
                    <div class="col-sm-3">
                        <div class="panel panel-default" align="center">
                            <label>Receipt Number</label>
                            <p class="input-group">
                                {{ rctNo }}
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="panel panel-default" align="center">
                            <label>Supplier</label>
                            <p class="input-group">
                                {{ supplier }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-sm-2">
                        <div class="panel panel-default" align="center">
                            <label>Issuer</label>
                            <p class="input-group">
                                {{ checker }}
                            </p>
                        </div>
                    </div>
    
                    <div class="col-sm-3">
                        <div class="panel panel-default" align="center">
                            <label>Time & Date Received</label>
                            <p class="input-group">
                                {{ tAD }}
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-1">
                        <p class="input-group">
                            <label></label>
                            <h4 ng-click='x()'>x</h4>
                        </p>
                    </div>
                </div>
            </div>

            <div class="modal-body">
                <table class="table table-striped table-bordered" cellspacing="0" width="100%" ng-table = "summaryTable" id = "summaryTable" >
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="x in dataSum">
                            <td>{{ x.itemName }}</td>
                            <td>{{ x.qty }}</td>
                            <td>{{ x.unitName }}</td>
                            <td>{{ x.desc }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </script> 
    </div>

    <?php include('includes/footer-script.php'); ?>
    <?php include('includes/modals.php'); ?>

    <script src="<?php echo base_url();?>/js/activtyLogs.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            "responsive": true
        });
    });
    </script>
<footer align="center">
            <p><?php echo date("M/d/Y"); ?></p>
            <p>LIGHTHOUSE <?php echo date('Y'); ?>. All Rights Reserved</p>
        </footer>
</body>
</body>

</html>
