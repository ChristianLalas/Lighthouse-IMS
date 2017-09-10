<?php include('includes/meta.php'); ?>
<?php include('includes/header-script.php'); ?>
<body ng-app = 'endingBalance' ng-controller= 'endingBalanceCtrl'>
     <div id="wrapper">
        <!-- Navigation -->
        <?php include('includes/main-nav.php');?>

	<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header wsub" align="center">INVENTORY COUNTING</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div align="center">
                    <input type="button" class="btn btn-default" onclick="location.href='<?php echo site_url('Ending_Balance');?>';" value="ALL"/>
                    <?php if($itemType != null){
                        foreach($itemType as $row):?>
                        <input type="button" class="btn btn-default" onclick="location.href='<?php echo site_url('Ending_Balance/itemType/').$row->itemTypeID;?>'" value="<?php echo $row->itemTypeName; ?>"/>
                    <?php endforeach; }?>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel-body">
                        <div class="col-lg-2">
                            Number of Items In The Table
                        </div>
                        <div class="col-lg-2">
                            <input type="number" class="form-control" id="arrayCount" value="<?php echo count($items)?>" disabled/>
                        </div>
                        <table width="100%" class="table table-striped table-bordered table-hover" id="endBalTable" border="1">        
                                <thead>
                                    <tr>
                                        <th><center>Item Name</th>
                                        <th><center>Item Type</th>
                                        <th><center>Logical Count</th>
                                        <th><center>Physical Count</th>
                                        <th><center>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($items == null){?>
                                        <tr>
                                            <td>NO DATA FOUND</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    <?php } else if($items == "TRUE"){?>
                                        <tr>
                                            <td>Ending Balance Has Been Done For The Day</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    <?php } else { 
                                        $i = 0; 
                                        foreach($items as $row):?>
                                        <tr>
                                            <td><?php echo html_escape($row->itemName); ?></td>
                                            <td><?php echo html_escape($row->itemTypeName); ?></td>
                                            <td><?php if($row->unitName === $row->convUnitName){
                                                 echo $row->baseQty." ".$row->unitName;
                                            } else if($row->unitName !== $row->convUnitName){
                                                if( $row->convQty == 0){
                                                    echo $row->baseQty." ".$row->unitName;
                                                } else {
                                                    echo $row->baseQty." ".$row->unitName." and ".$row->convQty." ".$row->convUnitName;
                                                }
                                            }?>
                                                
                                            </td>
                                            <input type="hidden" id="logCnt<?php echo $i;?>" value="<?php echo $row->itemQty; ?>" />
                                            <input type="hidden" id="itemCode<?php echo $i;?>" value="<?php echo $row->itemCode; ?>"/>
                                            <input type="hidden" id="bCValue<?php echo $i;?>" value="<?php echo $row->bCValue; ?>"/>
                                            <td>
                                                <input type="number" class="form-control" style="padding:0!important;width:80px;" id="physCntBaseQty<?php echo $i;?>" ng-change="checkInputs(<?php echo $i;?>)" ng-change="clearArray()" name ="phyCnt<?php echo $i;?>" ng-model='physCntBaseQty<?php echo $i;?>'  min='0'/ >
                                                <?php echo $row->unitName?>
                                            <?php if($row->unitName === $row->convUnitName){;?>
                                                <input type="hidden" class="form-control" style="padding:0!important;width:80px;" id="physCntCovQty<?php echo $i;?>" ng-change="checkInputs(<?php echo $i;?>)" ng-change="clearArray()" name ="physCntCovQty<?php echo $i;?>" ng-model='physCnt<?php echo $i;?>' value="0"  min='0'/>
                                            <?php } else if($row->unitName !== $row->convUnitName){ ?>
                                                and<?php if( $row->convQty == 0){?>
                                                    <input type="number" class="form-control" style="padding:0!important;width:80px;" id="physCntCovQty<?php echo $i;?>" ng-change="checkInputs(<?php echo $i;?>)" ng-change="clearArray()" name ="phyCnt<?php echo $i;?>" ng-model='physCntCovQty<?php echo $i;?>' ng-init="physCntCovQty<?php echo $i;?>=0" min='0'/>
                                                    <?php echo $row->convUnitName?>
                                               <?php } else {?>
                                                    <input type="number" class="form-control" style="padding:0!important;width:80px;" id="physCntCovQty<?php echo $i;?>" ng-change="checkInputs(<?php echo $i;?>)" ng-change="clearArray()" name ="phyCnt<?php echo $i;?>" ng-model='physCntCovQty<?php echo $i;?>'  min='0'/>
                                                    <?php echo $row->convUnitName?>
                                                <?php } }?>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="desc<?php echo $i;?>" ng-model="desc<?php echo $i;?>" minlength ="5" maxlength="150" ng-change="clearArray()" disabled />
                                            </td>
                                        </tr>
                                    <?php  $i++; endforeach;}?>
                                </tbody>
                            </table>
                        <!-- /.panel-body -->
                        <input type="button" value="Save" ng-click="save()"  class="btn btn-default"/>
                        <input type="button" value="Print" ng-click="print('endBalTable')"  class="btn btn-default"/>
                    </div>
                    <!-- /.panel -->
                </div>
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

	</div>
    <?php include('includes/footer-script.php'); ?>
    <?php include('includes/modals.php'); ?>

    <script src="<?php echo base_url();?>/js/endingBalance.js"></script>

 <footer align="center">
            <p><?php echo date("M/d/Y"); ?></p>
            <p>Danes Bakeshop <?php echo date('Y'); ?>. All Rights Reserved</p>
        </footer>
</body>

</html>
