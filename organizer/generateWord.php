<?php

include('../include/db_conn.php');

require_once './php-word/vendor/autoload.php'; // Include the autoload.php file from phpoffice/phpword
// Create a new Word document
$phpWord = new \PhpOffice\PhpWord\PhpWord();

// Add a section to the document
$section = $phpWord->addSection();

$festName = $_GET['festName'];
$eventId = $_GET['id'];
if ($festName) {
    $query = "SELECT * FROM `$festName` WHERE `id` = '$eventId'";
    $eventResult = mysqli_query($conn, $query);
    if (mysqli_num_rows($eventResult) > 0) {
        $eventRow = mysqli_fetch_assoc($eventResult);
        // Add some text to the section
        $section->addText('' . $festName . '', ['bold' => true, 'size' => 28]);
        $section->addText('EventID:' . $eventRow['eventId'] . '');
        $section->addText('EventName:' . $eventRow['eventName'] . '');
        $section->addText('EventFaculty:' . $eventRow['eventFaculty'] . '');
        $section->addText('EventMembers:' . $eventRow['eventMembers'] . '');
        $section->addText('EventDescription: ' . $eventRow['eventDescription'] . '');
        // Save the document as a Word file
        $filename = $eventRow['eventName'].".docx";
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('php://output');
        exit();
    }
} else {
    header('Location: organizer.php?error=Something went wrong.F');
}
