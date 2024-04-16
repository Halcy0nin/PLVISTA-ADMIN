<?php 
// Load the database configuration file 
include_once 'db_conn_high_school.php'; 
require_once '../../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
extract($_POST);

if (isset($_POST["exportPDF"])) {

    $selectallocation = "SELECT high_schools.school_name, school_inventory.item_code, school_inventory.item_article, school_inventory.item_status, school_inventory.item_date_acquired
    FROM school_inventory 
    JOIN high_schools ON school_inventory.school_id = high_schools.school_id
    WHERE (school_inventory.item_status = 'Need Repair' OR school_inventory.item_status = 'Condemned')";
    $selectallocationquery = mysqli_query($conn,$selectallocation);
    $reports = mysqli_fetch_all($selectallocationquery, MYSQLI_ASSOC);

    mysqli_free_result($selectallocationquery);

    date_default_timezone_set("Asia/Manila");
    $html = '';
    $html .= '
    <h3>Resoure Allocation Data</h3>
    <p>Issued: '. date("d/m/Y") . ' at ' . date("h:i:sa").'</p>
    <table style="width: 1000px; margin-left: auto; margin-right: auto; border-collapse: collapse;">
    <thead class="thead-light"></thead>
        <tr class="text-center">
        <th scope="col">School</th>
        <th scope="col">Item Code</th>
        <th scope="col">Item Article</th>
        <th scope="col">Status</th>
        <th scope="col">Date Acquired</th>
        </tr>
    ';

    foreach ($reports as $report) {
        $html .= '
        <tr>
        <td scope="col">' . htmlspecialchars($report["school_name"]) . '</td>
        <td scope="col">SDOVAL-' . htmlspecialchars($report["item_code"]) . '</td>
        <td scope="col">' . htmlspecialchars($report["item_article"]) . '</td>
        <td scope="col">' . htmlspecialchars($report["item_status"]) . '</td>
        <td scope="col">' . htmlspecialchars($report["item_date_acquired"]) . '</td>
        ';
    }
    

    $html .= '</table>';
    $schoolpdf = new DOMPDF();
    $schoolpdf->loadHtml($html);
    $schoolpdf->setPaper("legal", "landscape");
    $schoolpdf->render();
    $schoolpdf->stream("sdo_val_resource_allocation_data_" . date('Y-m-d') . ".pdf");

}
?>
