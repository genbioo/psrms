<?php
include("../../initialize.php");
includeCore();

$db_handle = new DBController();
$id = $_GET['id'];

$idpDetails = getIDPDetails($id);
$provinces = getProvinces();
$cities = getCities();
$barangays = getBarangays();
$evac_centers = getEvacuationCenters();

includeHead('');
?>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content" id="displayDetails">
            <div class="modal-header">
                <h4>IDP Details:</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="Fname">First Name:</label>
                            <input type="text" class="form-control" id="Fname" value="<?php echo($idpDetails[0]['Fname']); ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="Mname">Middle Name:</label>
                            <input type="text" class="form-control" id="Mname" value="<?php echo($idpDetails[0]['Mname']); ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="Lname">Last Name:</label>
                            <input type="text" class="form-control" id="Lname" value="<?php echo($idpDetails[0]['Lname']); ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="Bdate">Birth Date:</label>
                            <input type="text" id="Bdate" class="form-control" value="<?php echo(date('M d, Y', strtotime($idpDetails[0]['Bdate']))); ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="Age">Age:</label>
                            <input class="form-control" id="Age" type="number" min="0" value="<?php echo($idpDetails[0]['Age']); ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="Gender">Gender:</label>
                            <input class="form-control" id="Gender" type="text" value="<?php
                                    if($idpDetails[0]['Gender'] == '1')
                                    {
                                        echo("Male");
                                    } else if($idpDetails[0]['Gender'] == '2')
                                    {
                                        echo("Female");
                                    } else {
                                        echo("");
                                    }
                                 ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="MaritalStatus">Marital Status:</label>
                            <input class="form-control" id="MaritalStatus" type="text" value="<?php
                                    if($idpDetails[0]['MaritalStatus'] == '1')
                                    {
                                        echo("Single");
                                    } else if($idpDetails[0]['MaritalStatus'] == '2')
                                    {
                                        echo("Married");
                                    } else if($idpDetails[0]['MaritalStatus'] == '3')
                                    {
                                        echo("Annuled");
                                    } else if($idpDetails[0]['MaritalStatus'] == '4')
                                    {
                                        echo("Widowed");
                                    } else {
                                        echo("");
                                    }
                                 ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="PhoneNum">Phone Number:</label>
                            <input type="text" class="form-control" id="PhoneNum" value="<?php echo($idpDetails[0]['PhoneNum']); ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="Email">Email:</label>
                            <input type="text" class="form-control" id="Email" value="<?php echo($idpDetails[0]['Email']); ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="Address">Address:</label>
                            <input type="text" class="form-control" id="Address" value="<?php echo(getFullAddress($idpDetails[0]['Origin_Barangay'], $idpDetails[0]['IDP_ID'])[0]['Address']); ?>" disabled>
                        </div>
                    </div>
                    <?php
                    if(isset($idpDetails[0]['EvacuationCenters_EvacuationCentersID']))
                    {
                    ?>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="Evac">Evacuation Center:</label>
                            <input type="text" class="form-control" id="Evac" value="<?php echo(getEvacDetails($idpDetails[0]['EvacuationCenters_EvacuationCentersID'])[0]['EvacAndAddress']); ?>" disabled>
                        </div>
                    </div>
                    <?php
                    } else
                    {
                    ?>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="Evac">Evacuation Center:</label>
                            <input type="text" class="form-control" id="Evac" value="Home based" disabled>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="form-group col-md-12">
                        <button type="button" id="editButton" class="btn btn-default" onclick="showEditInterface()" style="float:right">Edit Details</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
        
        <div class="modal-content" id="editDetails" style="display:none">
            <div class="modal-header">
                <h4>IDP Details:</h4>
            </div>
            <div class="modal-body">
                <form action="/includes/actions/idp.process.edit.php?id=<?php echo($id); ?>" method="post">
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="Fname">First Name:</label>
                            <input type="text" class="form-control" id="Fname" name="Fname" value="<?php echo($idpDetails[0]['Fname']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="Mname">Middle Name:</label>
                            <input type="text" class="form-control" id="Mname" name="Mname" value="<?php echo($idpDetails[0]['Mname']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="Lname">Last Name:</label>
                            <input type="text" class="form-control" id="Lname" name="Lname" value="<?php echo($idpDetails[0]['Lname']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="Bdate">Birth Date:</label>
                            <input type="date" id="Bdate" class="form-control" value="<?php echo($idpDetails[0]['Bdate']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="Age">Age:</label>
                            <input class="form-control" id="Age" name="Age" type="number" min="0" value="<?php echo($idpDetails[0]['Age']); ?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="Gender">Gender:</label>
                            <select name="Gender" class="form-control">
                                <option value='1' <?php if($idpDetails[0]['Gender'] == '1') echo("selected='selected'") ?>>Male</option>
                                <option value='2' <?php if($idpDetails[0]['Gender'] == '2') echo("selected='selected'") ?>>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="MaritalStatus">Marital Status:</label>
                            <input class="form-control" id="MaritalStatus" name="MaritalStatus" type="text" value="<?php
                                    if($idpDetails[0]['MaritalStatus'] == '1')
                                    {
                                        echo("Single");
                                    } else if($idpDetails[0]['MaritalStatus'] == '2')
                                    {
                                        echo("Married");
                                    } else if($idpDetails[0]['MaritalStatus'] == '3')
                                    {
                                        echo("Annuled");
                                    } else if($idpDetails[0]['MaritalStatus'] == '4')
                                    {
                                        echo("Widowed");
                                    } else {
                                        echo("");
                                    }
                                 ?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="PhoneNum">Phone Number:</label>
                            <input type="text" class="form-control" id="PhoneNum" name="PhoneNum" value="<?php echo($idpDetails[0]['PhoneNum']); ?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="Email">Email:</label>
                            <input type="text" class="form-control" id="Email" name="Email" value="<?php echo($idpDetails[0]['Email']); ?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="Address">Address:</label>
                            <input type="text" class="form-control" id="Address" name="Address" value="<?php echo(getFullAddress($idpDetails[0]['Origin_Barangay'], $idpDetails[0]['IDP_ID'])[0]['Address']); ?>" >
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="EvacType">Relocation Type</label>
                        <select class="form-control" id="EvacType" name="EvacType" id="EvacType">
                            <option value="1">Evacuation Center</option>
                            <option value="2">Home-based</option>
                        </select> 
                    </div> 

                    <div id="EvacName" class="form-group col-md-6">
                        <label for="EvacCenter">Evacuation Center</label>
                        <select id="EvacCenter" name="EvacName" class="form-control">
                            <?php
                            foreach ($evac_centers as $result) {
                            ?>
                            <option value="<?php echo($result['EvacuationCentersID']); ?>"><?= $result['EvacName']; ?></option>
                            <?php } ?>
                        </select> 
                    </div>

                    <div id = "home_based_div" style="display:none">

                        <div class="form-group col-md-6">
                            <label for="province2">Province</label>
                            <select name='province2' id='province2' class="form-control">
                                <?php
                                foreach ($provinces as $result) {
                                ?>
                                <option value="<?php echo($result['ProvinceID']); ?>"><?= $result['ProvinceName']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="city_mun2" id="city_mun2Label">City</label>
                            <select name="city_mun2" id="city_mun2" class="form-control" style="display:none">
                                <?php
                                foreach ($cities as $result) {
                                ?>
                                <option value="<?php echo($result['City_Mun_ID']); ?>" name="province2-<?php echo($result['ProvinceID']); ?>"><?php echo($result['City_Mun_Name']); ?></option>
                                <?php } ?>
                            </select>  
                        </div>

                        <div class="form-group col-md-6">
                            <label for="barangay2" id="barangay2Label">Evacuation Center</label>
                            <select name="barangay2" id="barangay2" class="form-control" style="display:none">
                                <?php
                                foreach ($barangays as $result) {
                                ?>
                                <option value="<?php echo($result['BarangayID']); ?>" name="city2-<?php echo($result['City_CityID']) ?>"><?php echo($result['BarangayName']); ?></option>
                                <?php } ?>
                            </select> 
                        </div>

                        <div class="form-group col-md-6">
                            <label for="specAdd2" id="specAdd2Label">Evacuation Center</label>
                            <input id="specAdd2" class="form-control" name="SpecificAddress2" placeholder="Specific address (optional)" type="textbox" style="display:none"/>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <button type="Submit" class="btn btn-default" style="float:right">Submit</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>

    </div>
</div><!-- Modal end -->
<script type="text/javascript">
    function showEditInterface()
    {
        $('#displayDetails').hide();
        $('#editDetails').show();
    }
    
    $('#EvacType').change(function(){
        if ($(this).val() == '1') {
            $('#EvacName').show();
            $('#home_based_div').hide();
        } else if ($(this).val() == '2') {
            $('#EvacName').hide();
            $('#home_based_div').show();
            $("#city_mun2Label").hide();
            $("#barangay2Label").hide();
            $("#specAdd2Label").hide();
        }
    });
    $('#province2').change(function(){
        $("#city_mun2").show();
        $("#city_mun2Label").show();
        $("#city_mun2 option[name*='province2-']").hide();
        $("#city_mun2 option[name='province2-"+$(this).val()+"']").show();
    });
    $('#city_mun2').change(function(){
        $("#barangay2").show();
        $("#barangay2Label").show();
        $("#barangay2 option[name*='city2-']").hide();
        $("#barangay2 option[name='city2-"+$(this).val()+"']").show();
        $("#specAdd2").show();
        $("#specAdd2Label").show();
    });
</script>