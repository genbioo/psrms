<?php
include("../../initialize.php");
includeCore();

$post = $_POST;
$EvacName = $post['EvacName'];
$Barangay = $post['Barangay'];
$EvacType = $post['EvacType'];
$EvacManager = $post['EvacManager'];
$EvacContact =  $post['EvacContact'];
$SpecificAdd = $post['SpecificAdd'];


$db_handle = new DBController();

$db_handle->prepareStatement("INSERT INTO `evacuation_centers` (`EvacName`, `EvacAddress`, `EvacType`, `EvacManager`, `EvacManagerContact`, `SpecificAddress`) VALUES (:EvacName, :Barangay, :EvacType, :EvacManager, :EvacContact, :SpecificAdd)");
$db_handle->bindVar(':EvacName', $EvacName, PDO::PARAM_STR,0);
$db_handle->bindVar(':Barangay', $Barangay, PDO::PARAM_STR,0);
$db_handle->bindVar(':EvacType', $EvacType, PDO::PARAM_INT,0);
$db_handle->bindVar(':EvacManager', $EvacManager, PDO::PARAM_STR,0);
$db_handle->bindVar(':EvacContact', $EvacContact, PDO::PARAM_STR,0);
$db_handle->bindVar(':SpecificAdd', $SpecificAdd, PDO::PARAM_INT,0);
$db_handle->runUpdate();
header("location: /pages/evac.manage.centers.php?status=formsuccess");


?>