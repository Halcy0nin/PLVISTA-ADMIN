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
$fileName = "sdo_val_resource_allocation_data_" . date('Y-m-d') . ".xls"; 
 
// Column names 
$allocationlist = array('School Name','Item Code', 'Item Article', 'Status', 'Date Acquired'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($allocationlist)) . "\n"; 
 
// Fetch records from database 
$query = $conn->query("SELECT high_schools.school_name, school_inventory.item_code, school_inventory.item_article, school_inventory.item_status, school_inventory.item_date_acquired
FROM school_inventory 
JOIN high_schools ON school_inventory.school_id = high_schools.school_id
WHERE (school_inventory.item_status = 'Need Repair' OR school_inventory.item_status = 'Condemned')"); 
if($query->num_rows > 0){ 
    // Output each row of the data 
    while($row = $query->fetch_assoc()){ 
        $lineData = array('SDOVAL-'.$row['school_name'], $row['item_code'], $row['item_article'], $row['item_status'], $row['item_date_acquired']); 
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