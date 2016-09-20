<?php

//Databbase Connection Information 
$accountname = "CMS_GEM_APPUSER_R";
$password = "GEM_Reader_2015";
$servername = "int2r1-v.cern.ch:10121/int2r.cern.ch";
  

        
/*
 * Name: get_kinds_set_globals
 * Description: Get list of manufacturers
 * return: Array of kind of parts NAME - ID
 * Useage: set globals with Kind of parts IDs as it will change when db change to Production 
 * Autor: Ola Aboamer [o.aboamer@cern.ch]
 */
function get_kinds_set_globals($accountname,$password,$servername) {
    //load oci8 library if not load automatically
    if (!extension_loaded('oci8')) {
        dl("php_oci8.dll");
    }
    //connect to database     
    $conn = oci_connect($accountname, $password, $servername);
    if (!$conn) {
        $e = oci_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        print_r($e);
    } 
    $sql = "SELECT KIND_OF_PART_ID,DISPLAY_NAME FROM CMS_GEM_CORE_CONSTRUCT.KINDS_OF_PARTS WHERE IS_RECORD_DELETED = 'F'"; 
    $query = oci_parse($conn, $sql);
    //Oci_bind_by_name($query,':bind_name',$bind_para); //if needed
    $arr = oci_execute($query);
    $result = array();
    $item = array();
    while ($row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
        //echo '<a href="#" >' . $row['DISPLAY_NAME'] ."<=>".  $row['KIND_OF_PART_ID']. '</a><br>';
        $result [$row['DISPLAY_NAME']] = $row['KIND_OF_PART_ID'];
    }
    return $result;
}

$resultArr = get_kinds_set_globals($accountname,$password,$servername);
/*
 *  Usage: Contains all the global values , that will be commonly used in the application.
 *  Author: Ola Aboamer [o.aboamer@cern.ch]
*/

/* Kind of parts Constants */
/*
 * GEM Detector ROOT
 * GEM Foil
 * GEM Readout PCB
 * GEM VFAT2
 * Generic GEM part
 * Generic GEM parent part
 * CAEN N1145 Scalar
 * ORTEC 935 CFD Discriminator
 * Lecroy 623A Discriminator
 * ORTEC 474 Timing Filter Amp
 * ORTEC 142PC Preamplifier
 * CAEN A422A Charge Sensitive Preamp
 * GEM HV Circuit
 * GEM Drift PCB
 * GEM Chamber
 * GEM Super Chamber
 * GEM Opto Hybrid
 * GEM AMC Gigabit Link Interface Board
 * GEM AMC13 Board
 * GEM Main Carrier HUB
 * GEM Micro TCA Crate
 * GEM Electronics Board  
 */
// 1st IDs
//Kind of part id for Chambers
//$CHAMBER_KIND_OF_PART_ID = "10000000000001719";
$CHAMBER_KIND_OF_PART_ID = $resultArr['GEM Chamber'];
//Kind of part id for Drift boards
//$DRIFT_KIND_OF_PART_ID = "10000000000001599";
$DRIFT_KIND_OF_PART_ID = $resultArr['GEM Drift PCB'];
//Kind of part id for GEM Foils
//$FOIL_KIND_OF_PART_ID = "10000000000001659";
$FOIL_KIND_OF_PART_ID = $resultArr['GEM Foil'];
//Kind of part id for Readout boards
//$READOUT_KIND_OF_PART_ID = "10000000000001679";
$READOUT_KIND_OF_PART_ID = $resultArr['GEM Readout PCB'];
//Kind of part id for VFAT chips
//$VFAT_KIND_OF_PART_ID = "10000000000001699";
$VFAT_KIND_OF_PART_ID = $resultArr['GEM VFAT2'];
//Kind of part id for Optohybrids
//$OPTOHYBRID_KIND_OF_PART_ID = "10000000000002399";
$OPTOHYBRID_KIND_OF_PART_ID = $resultArr['GEM Opto Hybrid'];
//Kind of part id for AMCs
//$AMC_KIND_OF_PART_ID = "10000000000002419";
$AMC_KIND_OF_PART_ID = $resultArr['GEM AMC Gigabit Link Interface Board'];
//Kind of part id for AMC13
//$AMC13_KIND_OF_PART_ID = "10000000000002439";
$AMC13_KIND_OF_PART_ID = $resultArr['GEM AMC13 Board'];
//Kind of part id for HUBs
//$HUB_KIND_OF_PART_ID = "10000000000002459";
$HUB_KIND_OF_PART_ID = $resultArr['GEM Main Carrier HUB'];
//Kind of part id for MicroTCAs
//$MICROTCA_KIND_OF_PART_ID = "10000000000002479";
$MICROTCA_KIND_OF_PART_ID = $resultArr['GEM Micro TCA Crate'];
//Kind of part id for GEBs
//$GEB_KIND_OF_PART_ID = "10000000000002799"; 
$GEB_KIND_OF_PART_ID = $resultArr['GEM Electronics Board'];
 
//Kind of part id for CEAN N1145
$CEANN1145_KIND_OF_PART_ID = $resultArr['CAEN N1145 Scalar'];
//Kind of part id for ORTEC 935
$ORTEC935_KIND_OF_PART_ID = $resultArr['ORTEC 935 CFD Discriminator'];
//Kind of part id for Lecroy 623A
$Lecroy623A_KIND_OF_PART_ID = $resultArr['Lecroy 623A Discriminator'];
//Kind of part id for ORTEC 474
$ORTEC474_KIND_OF_PART_ID = $resultArr['ORTEC 474 Timing Filter Amp'];
//Kind of part id for ORTEC 142PC
$ORTEC142PC_KIND_OF_PART_ID = $resultArr['ORTEC 142PC Preamplifier'];
//Kind of part id for CAEN A422A
$CAENA422A_KIND_OF_PART_ID = $resultArr['CAEN A422A Charge Sensitive Preamp'];


//2nd Names
//Kind of part name for Chambers
$CHAMBER_KIND_OF_PART_NAME = "GEM Chamber";
//Kind of part name for Drift boards
$DRIFT_KIND_OF_PART_NAME = "GEM Drift PCB";
//Kind of part name for GEM Foils
$FOIL_KIND_OF_PART_NAME = "GEM Foil";
//Kind of part name for Readout boards
$READOUT_KIND_OF_PART_NAME = "GEM Readout PCB";
//Kind of part name for VFAT chips
$VFAT_KIND_OF_PART_NAME = "GEM VFAT2";
//Kind of part name for Optohybrids
$OPTOHYBRID_KIND_OF_PART_NAME = "GEM Opto Hybrid";
//Kind of part name for AMCs
$AMC_KIND_OF_PART_NAME = "GEM AMC Gigabit Link Interface Board";
//Kind of part name for AMC13
$AMC13_KIND_OF_PART_NAME = "GEM AMC13 Board";
//Kind of part name for HUBs
$HUB_KIND_OF_PART_NAME = "GEM Main Carrier HUB";
//Kind of part name for MicroTCAs
$MICROTCA_KIND_OF_PART_NAME = "GEM Micro TCA Crate";
//Kind of part name for GEBs
$GEB_KIND_OF_PART_NAME = "GEM Electronics Board"; 

//Kind of part name for CEAN N1145
$CEANN1145_KIND_OF_PART_NAME = 'CAEN N1145 Scalar';
//Kind of part name for ORTEC 935
$ORTEC935_KIND_OF_PART_NAME = 'ORTEC 935 CFD Discriminator';
//Kind of part name for Lecroy 623A
$Lecroy623A_KIND_OF_PART_NAME = 'Lecroy 623A Discriminator';
//Kind of part name for ORTEC 474
$ORTEC474_KIND_OF_PART_NAME = 'ORTEC 474 Timing Filter Amp';
//Kind of part name for ORTEC 142PC
$ORTEC142PC_KIND_OF_PART_NAME = 'ORTEC 142PC Preamplifier';
//Kind of part name for CAEN A422A
$CAENA422A_KIND_OF_PART_NAME = 'CAEN A422A Charge Sensitive Preamp';
 
 
/***********************************************/


// 1st Set of XML tags names Common between all parts
$SERIAL_NUMBER = "SERIAL_NUMBER";
$NAME_LABEL = "NAME_LABEL";
$LOCATION = "LOCATION";
$COMMENT_DESCRIPTION = "COMMENT_DESCRIPTION";
$BARCODE = "BARCODE";
$KIND_OF_PART = "KIND_OF_PART";
$RECORD_INSERTION_USER = "RECORD_INSERTION_USER";
$MANUFACTURER = "MANUFACTURER";

// 2nd Set of XML sub tags names for chamber 


/****SideBar list Tags IDs ****/

// Drift boards
$DRIFT_ID = "GEMDriftPCB";
//Kind of part name for GEM Foils
$FOIL_ID = "GEMFoil";
//Kind of part name for Readout boards
$READOUT_ID = "GEMReadoutPCB";
//Kind of part name for VFAT chips
$VFAT_ID = "GEMVFAT";
//Kind of part name for Optohybrids
$OPTOHYBRID_ID = "GEMOptoHybrid";
//Kind of part name for AMCs
$AMC_ID = "GEMAMCGigabitLinkInterfaceBoard";
//Kind of part name for AMC13
$AMC13_ID = "GEMAMC13Board";
//Kind of part name for HUBs
$HUB_ID = "GEMMainCarrierHUB";
//Kind of part name for MicroTCAs
$MICROTCA_ID = "GEMMicroTCACrate";
//Kind of part name for GEBs
$GEB_ID = "GEMElectronicsBoard";



/***** Part to Part Relationship IDs *****/
$VFAT2_TO_GEB="10000000000005639";
$OPTOHYBRID_TO_GEB="10000000000005239";
$GEB_TO_READOUT="10000000000004839";
$READOUT_TO_CHAMBER="10000000000002000";
$FOIL_TO_CHAMBER="10000000000002001";
$DRIFT_TO_CHAMBER="10000000000002002";



/****** Root part Information *****/
$ROOT_BARCODE= "CMS-GEM-ROOT";
$ROOT_KIND_OF_PART ="GEM Detector ROOT";
$ROOT_SERIAL_NUM="ROOT";


 