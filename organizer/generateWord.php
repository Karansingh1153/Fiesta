<?php
require_once './php-word/vendor/autoload.php'; // Include the autoload.php file from phpoffice/phpword
// Create a new Word document
$phpWord = new \PhpOffice\PhpWord\PhpWord();

// Add a section to the document
$section = $phpWord->addSection();

// Add some text to the section
$section->addText('Event Details:', ['bold' => true, 'size' => 16]);
$section->addText('Name: John Doe');
$section->addText('ID: 123456');
$section->addText('Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit.');

// Save the document as a Word file
$filename = 'event_details.docx';
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment;filename="'. $filename .'"');
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('php://output');
exit();
