<?php
include("../initialize.php");
includeCore();
$Barangays = getBarangays();
$Cities = getCities();
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <?php
        includeHead("PSRMS - Evacuation Centers");
        includeDataTables();
        ?>

    </head>

    <body>

        <div id="wrapper">
            <?php includeNav(); ?>
            <div id="page-wrapper">
                <div class="row">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Evacuation Centers</li>
                    </ol>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="header">
                        <h3 class="title">&nbsp;Evacuation Centers <a href="/pages/forms.add.evacuation.php" class="btn btn-success btn-xs">Add Evacuation Center</a></h3>
                    
                    </div>
                    <div class="panel-body">
                        
                    </div>
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <table width="100%" class="table table-bordered table-hover" id="table-evac-list">
                                    <thead>
                                        <tr>
                                            <th>Evacuation Center No.</th>
                                            <th>Evacuation Center Name</th>
                                            <th>Evacuation Center Address</th>
                                            <th>Evacuation Center Type</th>
                                            <th>Evacuation Center Manager</th>
                                            <th>Evacuation Center Contact</th>
                                            <th>Evacuation Center Specific Address</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <?php includeCommonJS(); ?>

    </body>
    <script>
        $(document).ready(function() {
            var dataTable = $('#table-evac-list').DataTable( {
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "order":[],
                "ajax":{
                    url :"/includes/actions/evac.generate.list.php",
                    method: "POST",
                },
                "columnDefs":[
                    {
                        "targets": [5],
                        "orderable":false
                    },
                ]
            } );
        } );
    </script>

</html>