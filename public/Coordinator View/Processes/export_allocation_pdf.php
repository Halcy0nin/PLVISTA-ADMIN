<?php
// Load the database configuration file
include_once 'db_conn_high_school.php';
require_once '../../dompdf/autoload.inc.php';
use Dompdf\Dompdf;

// Check if the form was submitted for PDF export
if (isset($_POST["exportPDF"])) {
    // Fetch data from the database
    $selectallocation = "SELECT high_schools.school_name, school_inventory.item_code, school_inventory.item_article, school_inventory.item_status, school_inventory.item_date_acquired
    FROM school_inventory 
    JOIN high_schools ON school_inventory.school_id = high_schools.school_id
    WHERE (school_inventory.item_status = 'Need Repair' OR school_inventory.item_status = 'Condemned')";
    $selectallocationquery = mysqli_query($conn,$selectallocation);
    $reports = mysqli_fetch_all($selectallocationquery, MYSQLI_ASSOC);

    // Free the result memory
    mysqli_free_result($selectallocationquery);

    // Set timezone
    date_default_timezone_set("Asia/Manila");

    // Start building HTML content
    $html = '
    <h3>Resource Allocation Data</h3>
    <p>Issued: '. date("d/m/Y") . ' at ' . date("h:i:sa").'</p>
    <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
        <thead>
            <tr>
                <th style="text-align: left; border: 1px solid black;">School</th>
                <th style="text-align: left; border: 1px solid black;">Item Code</th>
                <th style="text-align: left; border: 1px solid black;">Item Article</th>
                <th style="text-align: left; border: 1px solid black;">Status</th>
                <th style="text-align: left; border: 1px solid black;">Date Acquired</th>
            </tr>
        </thead>
        <tbody>
    ';

    // Loop through the fetched data and generate table rows
    foreach ($reports as $report) {
        $html .= '
            <tr>
                <td style="border: 1px solid black;">' . htmlspecialchars($report["school_name"]) . '</td>
                <td style="border: 1px solid black;">SDOVAL-' . htmlspecialchars($report["item_code"]) . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($report["item_article"]) . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($report["item_status"]) . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($report["item_date_acquired"]) . '</td>
            </tr>
        ';
    }

    // Close the table and HTML content
    $html .= '
        </tbody>
    </table>';

    // Generate PDF
    $schoolpdf = new Dompdf();
    $schoolpdf->loadHtml($html);
    $schoolpdf->setPaper("legal", "landscape");
    $schoolpdf->render();
    
    // Output PDF to browser
    $schoolpdf->stream("sdo_val_resource_allocation_data_" . date('Y-m-d') . ".pdf");
}
?>
