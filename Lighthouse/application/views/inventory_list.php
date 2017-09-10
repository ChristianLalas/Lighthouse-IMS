<?php include('includes/meta.php');?>
<?php include('includes/header-script.php'); ?>
<body>

     <div id="wrapper" >
        <!-- Navigation -->
        <?php include('includes/main-nav.php'); ?>
        <!--Content-->
        <div id="page-wrapper" style="  background-image:linear-gradient(to right, #63B8FF, #FF69B4);">

            <!-- /.row -->
            <div class="row">
               
            </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    
    <?php include('includes/footer-script.php'); ?>
    <?php include('includes/modals.php'); ?>

    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
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
