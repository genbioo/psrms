<?php
include("../initialize.php");
includeCore();

$_SESSION['loc'] = $_SERVER['PHP_SELF'];

$Barangays = getBarangays();
$Cities = getCities();
$provinces = getProvinces();
$cities = getCities();
$barangays = getBarangays();
$evac_centers = getEvacuationCenters();
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <?php includeHead("PSRMS - Add Assessment Tool"); ?>

    </head>

    <body>

        <div id="wrapper">

            <?php includeNav(); ?>

            <div id="page-wrapper">
                <div class="row">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/pages/evac.manage.centers.php">Evacuation Centers</a></li>
                        <li class="breadcrumb-item active">Add Evacuation Center</li>
                    </ol>
                </div>
                <div class="row">
                    <div class="header">
                        <h3 class="title">&nbsp;Add Evacuation Center</h3>
                    </div>
                </div>

                <div class="row">


                <form method="POST" action="/includes/actions/forms.process.add.evacuation.php">
                            <div  id = "personal_info_div" class="col-lg-12">
                                <div class="panel">
                                    
                                        
                                        <div class="form-group col-md-6">
                                            <input type="EvacName" class="form-control" id="EvacName" name="EvacName" placeholder="Evacuation Center Name">
                                        </div>
 
                                        <div class="form-group col-md-6">
                                            <select id="EvacType" name='EvacType' class="form-control" required>
                                                <option selected disabled>Evacuation Type</option>
                                                <option value="1">Evacuation Center</option>
                                                <option value="2">Home-based Evacuation</option>

                                            </select>             
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            <input type="EvacManager" class="form-control" id='EvacManager' name='EvacManager' placeholder="Evacuation Manager">
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            <input type="EvacContact" class="form-control" id="EvacContact" name="EvacContact" placeholder="Evacuation Center Contact No">
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            <input type="SpecificAdd" class="form-control" id="SpecificAdd" name="SpecificAdd" placeholder="Specific Address">
                                        </div>
                                        

                                        <div class="form-group col-md-6">
                                                    <select name='province2' id='province2' class="form-control">
                                                        <option selected disabled>Province</option>
                                                        <?php
                                                        foreach ($provinces as $result) {
                                                        ?>
                                                        <option value="<?php echo($result['ProvinceID']); ?>"><?= $result['ProvinceName']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <select name="city_mun2" id="city_mun2" class="form-control" style="display:none">
                                                        <option selected disabled>City/Municipality</option>
                                                        <?php
                                                        foreach ($cities as $result) {
                                                        ?>
                                                        <option value="<?php echo($result['City_Mun_ID']); ?>" name="province2-<?php echo($result['ProvinceID']); ?>"><?php echo($result['City_Mun_Name']); ?></option>
                                                        <?php } ?>
                                                    </select>  
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <select name="Barangay" id="Barangay" class="form-control" style="display:none">
                                                        <option selected disabled>Barangay</option>
                                                        <?php
                                                        foreach ($barangays as $result) {
                                                        ?>
                                                        <option value="<?php echo($result['BarangayID']); ?>" name="city2-<?php echo($result['City_CityID']) ?>"><?php echo($result['BarangayName']); ?></option>
                                                        <?php } ?>
                                                    </select> 
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <input id="specAdd2" class="form-control" name="SpecificAddress2" placeholder="Specific address (optional)" type="textbox" style="display:none"/>
                                                </div>
                                        
                                        <div class="form-group col-md-12">
                                            <input type="submit" class="btn btn-info btn-fill btn-sm">
                                        </div>
                                        
                                    </div>
                                </div>
                           
                        </form>
                        </div>
            </div>

        </div>

        <?php includeCommonJS(); ?>

    </body>

    <script type='text/javascript'>
        $(document).ready(function(){
           
            $('#province').change(function(){
                $("#city_mun").show();
                $("#city_mun option[name*='province-']").hide();
                $("#city_mun option[name='province-"+$(this).val()+"']").show();
            });
            $('#city_mun').change(function(){
                $("#barangay1").show();
                $("#barangay1 option[name*='city-']").hide();
                $("#barangay1 option[name='city-"+$(this).val()+"']").show();
                $("#specAdd").show();
            });
            $('#province2').change(function(){
                $("#city_mun2").show();
                $("#city_mun2 option[name*='province2-']").hide();
                $("#city_mun2 option[name='province2-"+$(this).val()+"']").show();
            });
            $('#city_mun2').change(function(){
                $("#Barangay").show();
                $("#Barangay option[name*='city2-']").hide();
                $("#Barangay option[name='city2-"+$(this).val()+"']").show();
                $("#specAdd2").show();
            });
        });
    </script>
    
    </html>