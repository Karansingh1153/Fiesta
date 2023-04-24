<?php
include('../include/db_conn.php');

require './phpoffice/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

// Retrieve data from the registrations table
$query_registrations = "SELECT * FROM registrations";
$result_registrations = mysqli_query($conn, $query_registrations);

// Create a new Spreadsheet instance
$spreadsheet = new Spreadsheet();

// Set active sheet to Sheet 1
$spreadsheet->setActiveSheetIndex(0);
$worksheet = $spreadsheet->getActiveSheet();

// Set the column headers for the report
$worksheet->setCellValue('A1', 'id');
$worksheet->setCellValue('B1', 'UserId');
$worksheet->setCellValue('C1', 'EventId');
$worksheet->setCellValue('D1', 'FestName');
$worksheet->setCellValue('E1', 'EventName');
$worksheet->setCellValue('F1', 'Name');
$worksheet->setCellValue('G1', 'Enrollment');
$worksheet->setCellValue('H1', 'Mobile');
$worksheet->setCellValue('I1', 'DOB');
$worksheet->setCellValue('J1', 'Department');

// Loop through the data retrieved from the registrations table and populate the report
$i = 2; // Set initial row number
while ($row = mysqli_fetch_assoc($result_registrations)) {
    $worksheet->setCellValue('A' . $i, $row['id']);
    $worksheet->setCellValue('B' . $i, $row['userId']);
    $worksheet->setCellValue('C' . $i, $row['eventId']);
    $worksheet->setCellValue('D' . $i, $row['festName']);
    $worksheet->setCellValue('E' . $i, $row['eventName']);
    $worksheet->setCellValue('F' . $i, $row['name']);
    $worksheet->setCellValue('G' . $i, $row['enrollment']);
    $worksheet->setCellValue('H' . $i, $row['mobile']);
    $worksheet->setCellValue('I' . $i, $row['dob']);
    $worksheet->setCellValue('J' . $i, $row['department']);
    $i++; // Increment row number
}

// Save the report as an Excel file
$writer = new Xlsx($spreadsheet);
$filename = 'event_registration_report.xlsx';
$writer->save($filename);

// Download the file
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="event_registration_report.xlsx"');
header('Cache-Control: max-age=0');
readfile($filename);
unlink($filename);
?>
<script>
    window.location.href = "http://localhost/organizer/organizer.php";
    setTimeout(function() {
        location.reload();
    }, 2000);
</script>