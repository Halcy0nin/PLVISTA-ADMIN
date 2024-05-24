<?php 
// Load the database configuration file 
include '../../Coordinator View/Processes/db_conn_high_school.php';
if (isset($_POST["exportExcel"])) {
    $schoolidtomatch = $_POST["schoolid"];
    $schoolname = $_POST["schoolname"];
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
$fileName = "sdo_val_" . $schoolname. "_inventory_data_" . date('Y-m-d') . ".xls"; 
 
// Column names 
$inventorylist = array('Item Code','Item Article', 'Description', 'Date Acquired', 'Unit Value', 'Quantity', 'Total Value', 'Source of Funds', 'Last Updated', 'Status'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($inventorylist)) . "\n"; 
 
// Fetch records from database 
$query = $conn->query("SELECT *
FROM school_inventory 
JOIN high_schools ON school_inventory.school_id = high_schools.school_id
WHERE high_schools.school_id = $schoolidtomatch"); 
if($query->num_rows > 0){ 
    // Output each row of the data 
    while($row = $query->fetch_assoc()){ 
        $lineData = array( 'SDOVAL-'. $row['item_code'], $row['item_article'], $row['item_desc'], $row['item_date_acquired'], $row['item_unit_value'], $row['item_quantity'], $row['item_total_value'], $row['item_funds_source'], $row['item_date_input'], $row['item_status']); 
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