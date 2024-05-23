<?php 
// Load the database configuration file 
include '../../Coordinator View/Processes/db_conn_high_school.php';
require_once '../../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
extract($_POST);

if (isset($_POST["exportPDF"])) {
    $schoolidtomatch = $_POST["schoolid"];
    $schoolname = $_POST["schoolname"];

    $selectinventory = "SELECT *
    FROM school_inventory 
    JOIN high_schools ON school_inventory.school_id = high_schools.school_id
    WHERE high_schools.school_id = $schoolidtomatch";
    $selectinventoryquery = mysqli_query($conn,$selectinventory);
    $inventory = mysqli_fetch_all($selectinventoryquery, MYSQLI_ASSOC);

    mysqli_free_result($selectinventoryquery);

    date_default_timezone_set("Asia/Manila");

    $html = '
    <h3>Resource Allocation Data for ' . htmlspecialchars($schoolname) . '</h3>
    <p>Issued: '. date("d/m/Y") . ' at ' . date("h:i:sa").'</p>
    <table style="width: 100%; border-collapse: collapse;">
    <thead class="thead-light">
    <tr>
    <th scope="col">Item Code</th>
    <th scope="col">Item Article</th>
    <th scope="col">Description</th>
    <th scope="col">Date Acquired</th>
    <th scope="col">Unit Value</th>
    <th scope="col">Quantity</th>
    <th scope="col">Total Value</th>
    <th scope="col">Source of Funds</th>
    <th scope="col">Last Updated</th>
    <th scope="col">Status</th>
    </tr>
    </thead>
    <tbody>';

    foreach ($inventory as $item) {
         //multiplies quantity to unit value to get total value
         $qty = $item["item_quantity"] * $item["item_unit_value"];
         //formats the answer above to a decimal
         $itemtotalvalue = number_format($qty, 2);
        $html .= '
        <tr>
            <td>' . "SDOVAL-" . htmlspecialchars($item["item_code"]) . '</td>
            <td>' . htmlspecialchars($item["item_article"]) . '</td>
            <td>' . htmlspecialchars($item["item_desc"]) . '</td>
            <td>' . htmlspecialchars($item["item_date_acquired"]) . '</td>
            <td>' . "PHP " . htmlspecialchars($item["item_unit_value"]) . '</td>
            <td>' . htmlspecialchars($item["item_quantity"]) . '</td>
            <td>' . "PHP " . htmlspecialchars($item["item_quantity"] * $item["item_unit_value"]) . '</td>
            <td>' . htmlspecialchars($item["item_funds_source"]) . '</td>
            <td>' . htmlspecialchars($item["item_date_input"]) . '</td>
            <td>' . htmlspecialchars($item["item_status"]) . '</td>
            <td><!-- Action button here --></td>
        </tr>';
        
    }
    
    $html .= '</tbody></table>';

    $schoolpdf = new DOMPDF();
    $schoolpdf->loadHtml($html);
    $schoolpdf->setPaper("legal", "landscape");
    $schoolpdf->render();
    $schoolpdf->stream("sdo_val_".$schoolname."_inventory_data_" . date('Y-m-d') . ".pdf");

}
?>
