        <!-- MODAL -->
        <div id = 'modals'>
            <script type="text/ng-template" id="warning.html">
                <div class="uibModal-body">
                    <h3 class="text-danger">Error: {{ErrorMsg}}</h3>
                </div>
            </script>

            <script type="text/ng-template" id= "success.html">
                <div class="uibModal-body">
                    <h3>{{msg}}</h3>
                </div>
            </script>
        
            <script type="text/ng-template" id="confirmation.html">
                <div class="modal-header">
                    <h3>{{confMsg}}</h3>
                </div>  
                <div class="modal-footer">
                    <input type="button" value="Yes" ng-click="yes()"  class="btn btn-default"/>
                    <input type="button" value = "Cancel" ng-click="cancel()" class="btn btn-default"/>
                </div>
            </script>  
        </div>