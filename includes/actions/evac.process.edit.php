<?php
include("../../initialize.php");
includeCore();

if(!isset($_POST['Barangay'])) header("location: /pages/evac.manage.centers.php?status=error2");

$post = $_POST;
$evacID = $_GET['evacid'];
$EvacName = $post['EvacName'];
$Barangay = $post['Barangay'];
$EvacManager = $post['EvacManager'];
$EvacContact =  $post['EvacContact'];
$SpecificAdd = $post['SpecificAddress'];


$db_handle = new DBController();

$db_handle->prepareStatement("UPDATE `evacuation_centers` SET `EvacName` = :EvacName, `EvacAddress` = :Barangay, `EvacManager` = :EvacManager, `EvacManagerContact` = :EvacContact, `SpecificAddress` = :SpecificAddress WHERE `evacuation_centers`.`EvacuationCentersID` = :evacID");

$db_handle->bindVar(':evacID', $evacID, PDO::PARAM_INT, 0);
if(isset($EvacName) && $EvacName != '')$db_handle->bindVar(':EvacName', $EvacName, PDO::PARAM_STR,0); else $db_handle->bindNull(':EvacName');
if(isset($Barangay) && $Barangay != '')$db_handle->bindVar(':Barangay', $Barangay, PDO::PARAM_INT,0); else $db_handle->bindNull(':Barangay');
if(isset($EvacManager) && $EvacManager != '')$db_handle->bindVar(':EvacManager', $EvacManager, PDO::PARAM_STR,0); else $db_handle->bindNull(':EvacManager');
if(isset($EvacContact) && $EvacContact != '')$db_handle->bindVar(':EvacContact', $EvacContact, PDO::PARAM_STR,0); else $db_handle->bindNull(':EvacContact');
if(isset($SpecificAdd) && $SpecificAdd != '')$db_handle->bindVar(':SpecificAddress', $SpecificAdd, PDO::PARAM_STR,0); else $db_handle->bindNull(':SpecificAddress');

$db_handle->runUpdate();

header("location: /pages/evac.manage.centers.php?status=editsuccess");
?>