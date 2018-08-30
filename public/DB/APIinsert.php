<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "GM2";

$Site_ID                = $_GET['Site_ID'];
$Comm_v                 = $_GET['Comm_v'];
$Model_t                = $_GET['Model_t'];
$SerialNo               = $_GET['SerialNo'];
$Program_v              = $_GET['Program_v'];
$Pcs_status             = $_GET['Pcs_status'];
$Reg_mode               = $_GET['Reg_mode'];
$Insp_test              = $_GET['Insp_test'];
$Errorcode              = $_GET['Errorcode'];
$RT_powerout_Buf        = $_GET['RT_powerout'];
$RT_poweraccum_Buf      = $_GET['RT_poweraccum'];
$Statuspowerfactor      = $_GET['Statuspowerfactor'];
$Input_Vstr1            = $_GET['Input_Vstr1'];
$Input_Cstr1_Buf        = $_GET['Input_Cstr1'];
$Acvoltage_str1	        = $_GET['Acvoltage_str1'];
$Input_Vstr2            = $_GET['Input_Vstr2'];
$Input_Cstr2_Buf        = $_GET['Input_Cstr2'];
$Accurrent_Buf          = $_GET['Accurrent'];
$Input_Vstr3            = $_GET['Input_Vstr3'];
$Input_Cstr3_Buf        = $_GET['Input_Cstr3'];
$Frequency_Buf          = $_GET['Frequency'];
$RT_powerfactor_Buf     = $_GET['RT_powerfactor'];

// management convert type parameter

$RT_powerout = $RT_powerout_Buf / 1000;   
$RT_poweraccum =  $RT_poweraccum_Buf / 1000; 
$Input_Cstr1 = $Input_Cstr1_Buf / 10;
$Input_Cstr2 = $Input_Cstr2_Buf / 10;
$Input_Cstr3 = $Input_Cstr3_Buf / 10;
$Accurrent = $Accurrent_Buf / 10;
$Frequency = $Frequency_Buf /10;
$RT_powerfactor  = $RT_powerfactor_Buf / 1000;

// management convert type parameter

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


//START management Errorcode to Suppress or Recover
if( $Pcs_status == 'G' || $Pcs_status == 'C'){

    // $api->Errorcode = $Errorcode;
    $sql = "INSERT INTO z50pcs_info (Site_ID, Comm_v,Model_t,SerialNo,Program_v,Pcs_status,
                    Reg_mode,Insp_test,Errorcode,RT_powerout,
                    RT_poweraccum,Statuspowerfactor,Input_Vstr1,Input_Cstr1,Acvoltage_str1,
                    Input_Vstr2,Input_Cstr2,Accurrent,Input_Vstr3,Input_Cstr3,Frequency,RT_powerfactor)

            VALUES  ('$Site_ID','$Comm_v','$Model_t','$SerialNo','$Program_v','$Pcs_status','$Reg_mode','$Insp_test',
                    '$Errorcode','$RT_powerout','$RT_poweraccum','$Statuspowerfactor','$Input_Vstr1','$Input_Cstr1',
                    '$Acvoltage_str1','$Input_Vstr2','$Input_Cstr2','$Accurrent','$Input_Vstr3','$Input_Cstr3',
                    '$Frequency','$RT_powerfactor')";

    }elseif($Pcs_status == 'B'){

    // $api->Suppression = $Errorcode;
    $sql = "INSERT INTO z50pcs_info (Site_ID, Comm_v,Model_t,SerialNo,Program_v,Pcs_status,
                    Reg_mode,Insp_test,Suppression,RT_powerout,
                    RT_poweraccum,Statuspowerfactor,Input_Vstr1,Input_Cstr1,Acvoltage_str1,
                    Input_Vstr2,Input_Cstr2,Accurrent,Input_Vstr3,Input_Cstr3,Frequency,RT_powerfactor)

            VALUES  ('$Site_ID','$Comm_v','$Model_t','$SerialNo','$Program_v','$Pcs_status','$Reg_mode','$Insp_test',
                    '$Errorcode','$RT_powerout','$RT_poweraccum','$Statuspowerfactor','$Input_Vstr1','$Input_Cstr1',
                    '$Acvoltage_str1','$Input_Vstr2','$Input_Cstr2','$Accurrent','$Input_Vstr3','$Input_Cstr3',
                    '$Frequency','$RT_powerfactor')";


    }elseif($Pcs_status == 'A'){

    // $api->Recoverytime = $Errorcode;
    
    $sql = "INSERT INTO z50pcs_info (Site_ID, Comm_v,Model_t,SerialNo,Program_v,Pcs_status,
                    Reg_mode,Insp_test,Recoverytime,RT_powerout,
                    RT_poweraccum,Statuspowerfactor,Input_Vstr1,Input_Cstr1,Acvoltage_str1,
                    Input_Vstr2,Input_Cstr2,Accurrent,Input_Vstr3,Input_Cstr3,Frequency,RT_powerfactor)

            VALUES  ('$Site_ID','$Comm_v','$Model_t','$SerialNo','$Program_v','$Pcs_status','$Reg_mode','$Insp_test',
                    '$Errorcode','$RT_powerout','$RT_poweraccum','$Statuspowerfactor','$Input_Vstr1','$Input_Cstr1',
                    '$Acvoltage_str1','$Input_Vstr2','$Input_Cstr2','$Accurrent','$Input_Vstr3','$Input_Cstr3',
                    '$Frequency','$RT_powerfactor')";
    
    }else{
    // $api->Errorcode = $Errorcode;
    $sql = "INSERT INTO z50pcs_info (Site_ID, Comm_v,Model_t,SerialNo,Program_v,Pcs_status,
    Reg_mode,Insp_test,Errorcode,RT_powerout,
    RT_poweraccum,Statuspowerfactor,Input_Vstr1,Input_Cstr1,Acvoltage_str1,
    Input_Vstr2,Input_Cstr2,Accurrent,Input_Vstr3,Input_Cstr3,Frequency,RT_powerfactor)

            VALUES  ('$Site_ID','$Comm_v','$Model_t','$SerialNo','$Program_v','$Pcs_status','$Reg_mode','$Insp_test',
                    '$Errorcode','$RT_powerout','$RT_poweraccum','$Statuspowerfactor','$Input_Vstr1','$Input_Cstr1',
                    '$Acvoltage_str1','$Input_Vstr2','$Input_Cstr2','$Accurrent','$Input_Vstr3','$Input_Cstr3',
                    '$Frequency','$RT_powerfactor')";
    }
//STOP management Errorcode to Suppress or Recover

// SQL Defalse
// $sql = "INSERT INTO z50pcs_info (Site_ID, Comm_v,Model_t,SerialNo,Program_v,Pcs_status,
//                     Reg_mode,Insp_test,Errorcode,Suppression,Recoverytime,RT_powerout,
//                     RT_poweraccum,Statuspowerfactor,Input_Vstr1,Input_Cstr1,Acvoltage_str1,
//                     Input_Vstr2,Input_Cstr2,Accurrent,Input_Vstr3,Input_Cstr3,Frequency,RT_powerfactor)

//             VALUES  ('$Site_ID','$Comm_v','$Model_t','$SerialNo','$Program_v','$Pcs_status','$Reg_mode','$Insp_test',
//                     '$Errorcode','$RT_powerout','$RT_poweraccum','$Statuspowerfactor','$Input_Vstr1','$Input_Cstr1',
//                     '$Acvoltage_str1','$Input_Vstr2','$Input_Cstr2','$Accurrent','$Input_Vstr3','$Input_Cstr3',
//                     '$Frequency','$RT_powerfactor')";


// Inser data into database.

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>