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

    $html = '';
    $html .= '
    <h3>School Data</h3>
    <p>Issued: '. date('M-Y-D') .'</p>
    <table style="width: 1000px; margin-left: auto; margin-right: auto; border-collapse: collapse;">
    <thead class="thead-light"></thead>
        <tr class="text-center">
            <th style="margin: right 50px; border: 1px solid black;" scope="col">School Name</th>
            <th style="width: 10%; border: 1px solid black;" scope="col">School ID</th>
            <th style="width: 10%; border: 1px solid black;" scope="col">Division</th>
            <th style="width: 10%; border: 1px solid black;" scope="col">School Type</th>
            <th style="width: 10%; border: 1px solid black;" scope="col">Contact Person</th>
            <th style="width: 10%; border: 1px solid black;" scope="col">Contact No.</th>
            <th style="width: 10%; border: 1px solid black;" scope="col">Email</th>
            <th style="width: 10%; border: 1px solid black;" scope="col">School District</th>
            <th style="width: 10%; border: 1px solid black;" scope="col">Date Added</th>
        </tr>
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
        ';
    }

    $html .= '</table>';
    $schoolpdf = new DOMPDF();
    $schoolpdf->loadHtml($html);
    $schoolpdf->setPaper("legal", "landscape");
    $schoolpdf->render();
    $schoolpdf->stream("sdo_val_school_data_" . date('Y-m-d') . ".pdf");

}
?>
