<?php
include('../include/db_conn.php');

require './phpoffice/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

// Retrieve data from the volunteers table
$query_volunteers = "SELECT * FROM volunteers";
$result_volunteers = mysqli_query($conn, $query_volunteers);

// Create a new Spreadsheet instance
$spreadsheet = new Spreadsheet();

// Set active sheet to Sheet 1
$spreadsheet->setActiveSheetIndex(0);
$worksheet = $spreadsheet->getActiveSheet();

// Set the column headers for the report
$worksheet->setCellValue('A1', 'id');
$worksheet->setCellValue('B1', 'UserId');
$worksheet->setCellValue('C1', 'EventId');
$worksheet->setCellValue('D1', 'VolunteerId');
$worksheet->setCellValue('E1', 'FestName');
$worksheet->setCellValue('F1', 'EventName');
$worksheet->setCellValue('G1', 'Name');
$worksheet->setCellValue('H1', 'Enrollment');
$worksheet->setCellValue('I1', 'Mobile');
$worksheet->setCellValue('J1', 'DOB');
$worksheet->setCellValue('K1', 'Department');

// Loop through the data retrieved from the registrations table and populate the report
$i = 2; // Set initial row number
while ($row = mysqli_fetch_assoc($result_volunteers)) {
    $worksheet->setCellValue('A' . $i, $row['id']);
    $worksheet->setCellValue('B' . $i, $row['userId']);
    $worksheet->setCellValue('C' . $i, $row['eventId']);
    $worksheet->setCellValue('D' . $i, $row['volunteerId']);
    $worksheet->setCellValue('E' . $i, $row['festName']);
    $worksheet->setCellValue('F' . $i, $row['eventName']);
    $worksheet->setCellValue('G' . $i, $row['name']);
    $worksheet->setCellValue('H' . $i, $row['enrollment']);
    $worksheet->setCellValue('I' . $i, $row['mobile']);
    $worksheet->setCellValue('J' . $i, $row['dob']);
    $worksheet->setCellValue('K' . $i, $row['department']);
    $i++; // Increment row number
}

// Save the report as an Excel file
$writer = new Xlsx($spreadsheet);
$filename = 'event_volunteer_report.xlsx';
$writer->save($filename);

// Download the file
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="event_volunteer_report.xlsx"');
header('Cache-Control: max-age=0');
readfile($filename);
unlink($filename);
header("refresh:2;url=organizer.php");
