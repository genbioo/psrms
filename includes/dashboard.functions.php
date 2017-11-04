<?php

function get_total($str) 
{
    $db_handle = new DBController();
    $db_handle->prepareStatement("SELECT COUNT(*) as total FROM $str");
    $result = $db_handle->runFetch();
      foreach($result as $row) {
        $data = $row['total'];
      }

      return $data;
}

function includeMorrisData()
{
     include($_SERVER['DOCUMENT_ROOT'].ROOT."includes/morris-data.php");
    
}
function includeDashboardModal()
{
     include($_SERVER['DOCUMENT_ROOT'].ROOT."includes/fragments/dashboard.modal.php");
    
}

function getDistinctDate($str)
# author: Cali, Mohammad G.
# Date Created : Oct. 24, 2017

{

     $db_handle = new DBController();
    $db_handle->prepareStatement("SELECT DATE_FORMAT(DATE(`DateTaken`), '%Y-%m-%d') AS dates, count(*) AS total FROM IDP WHERE `EvacuationCenters_EvacuationCentersID` = $str GROUP BY dates");
    $result = $db_handle->runFetch();
     

      return $result;   
}

function getIDPList($str)
{
  $db_handle = new DBController();
  $db_handle->prepareStatement("SELECT * FROM `idp` WHERE `Gender` = $str");
  $array = $db_handle->runFetch();
  $result ="";
          foreach ($array as $idp) {
             $result .=  $idp['Fname']." " . $idp['Mname']. " " . $idp['Lname']. "<br>"; 
              
              }
   return $result; 
}
?>