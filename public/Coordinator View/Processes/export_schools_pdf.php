<?php 
// Load the database configuration file 
include_once 'db_conn_high_school.php'; 
require_once '../../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
extract($_POST);

if (isset($_POST["exportPDF"])) {

    $selectschools = "SELECT * FROM high_schools ORDER BY school_id DESC";
    $selectschoolsquery = mysqli_query($conn,$selectschools);
    $highschools = mysqli_fetch_all($selectschoolsquery, MYSQLI_ASSOC);

    mysqli_free_result($selectschoolsquery);

    date_default_timezone_set("Asia/Manila");
    $html = '';
    $html .= '
    <h3>School Data</h3>
    <p>Issued: '. date("d/m/Y") . ' at ' . date("h:i:sa").'</p>
    <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
        <thead>
            <tr>
                <th style="width: 25%; border: 1px solid black;">School Name</th>
                <th style="width: 10%; border: 1px solid black;">School ID</th>
                <th style="width: 10%; border: 1px solid black;">Division</th>
                <th style="width: 10%; border: 1px solid black;">School Type</th>
                <th style="width: 10%; border: 1px solid black;">Contact Person</th>
                <th style="width: 10%; border: 1px solid black;">Contact No.</th>
                <th style="width: 10%; border: 1px solid black;">Email</th>
                <th style="width: 10%; border: 1px solid black;">School District</th>
                <th style="width: 10%; border: 1px solid black;">Date Added</th>
            </tr>
        </thead>
        <tbody>
    ';

    foreach ($highschools as $school) {
        $html .= '
        <tr>
            <td style="border: 1px solid black;">'. htmlspecialchars($school["school_name"]) .'</td>
            <td style="border: 1px solid black;">'. htmlspecialchars($school["school_id"]) .'</td>
            <td style="border: 1px solid black;">'. htmlspecialchars($school["school_division"]) .'</td>
            <td style="border: 1px solid black;">'. htmlspecialchars($school["school_type"]) .'</td>
            <td style="border: 1px solid black;">'. htmlspecialchars($school["school_contact"]) .'</td>
            <td style="border: 1px solid black;">'. htmlspecialchars($school["school_contact_no"]) .'</td>
            <td style="border: 1px solid black;">'. htmlspecialchars($school["school_email"]) .'</td>
            <td style="border: 1px solid black;">'. htmlspecialchars($school["school_district"]) .'</td>
            <td style="border: 1px solid black;">'. htmlspecialchars($school["school_added"]) .'</td>
        </tr>
        ';
    }

    $html .= '</tbody></table>';
    $schoolpdf = new DOMPDF();
    $schoolpdf->loadHtml($html);
    $schoolpdf->setPaper("legal", "landscape");
    $schoolpdf->render();
    $schoolpdf->stream("sdo_val_school_data_" . date('Y-m-d') . ".pdf");

}
?>
