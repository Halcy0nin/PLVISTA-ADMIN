<?php 
// Load the database configuration file 
include_once 'db_conn_high_school.php'; 
if (isset($_POST["exportExcel"])) {
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
$fileName = "sdo_val_school_data_" . date('Y-m-d') . ".xls"; 
 
// Column names 
$schoollist = array('School ID', 'School Name', 'Division', 'School Type', 'Contact Person', 'Contact No.', 'Email', 'School District'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($schoollist)) . "\n"; 
 
// Fetch records from database 
$query = $conn->query("SELECT * FROM high_schools ORDER BY school_id DESC"); 
if($query->num_rows > 0){ 
    // Output each row of the data 
    while($row = $query->fetch_assoc()){ 
        $lineData = array($row['school_id'], $row['school_name'], $row['school_division'], $row['school_type'], $row['school_contact'], $row['school_contact_no'], $row['school_email'], $row['school_district']); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 
 
// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 
 
exit;
}
?>