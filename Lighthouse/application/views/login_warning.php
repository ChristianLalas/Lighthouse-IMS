
<?php include('includes/meta.php'); ?>
<?php include('includes/header-script.php'); ?>
</head>
    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header" style="background-color: red;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 style="color: white;">Warning</h4>
                </div>
                <div class="modal-body">
                    <center><h3 style="margin: 0 !important;">Invalid Username or Password!</h3></center>
                <hr>   
                   <h5 class="text-justify"><b>NOTE:</b> MADI DYAY ACCOUNT MU I-CHECK MO NGA USTO</h5>
                </div>
            </div>
        </div>
	</div>
  
    <?php include('includes/footer-script.php'); ?>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>/dist/js/sb-admin-2.js"></script>
        <script type="text/javascript">
    $(document).ready(function(){
    $("#myModal").modal('show');
    $('.hide-modal').click(function(){
        $('#myModal').modal('hide');
    }); 
});
</script>
    </body>
    </html>