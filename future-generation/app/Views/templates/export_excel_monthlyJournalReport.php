<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

// Create spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set document properties
$spreadsheet->getProperties()
    ->setCreator("Akal")
    ->setLastModifiedBy("AKAL")
    ->setTitle("Office 2007 XLS Test Document")
    ->setSubject("Office 2007 XLS Test Document")
    ->setDescription("Description for Test Document")
    ->setKeywords("phpexcel office codeigniter php")
    ->setCategory("AKAL");

// Styles
$stil = [
    'borders' => [
        'allBorders' => [
            'style' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER
    ]
];

$stil_center = [
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER
    ]
];

// Title
$sheet->mergeCells('A1:E2');
$sheet->setCellValue('A1', "Monthly Journal Report");
$sheet->getStyle('A1:E2')->applyFromArray($stil);
$sheet->getStyle('A1:E2')->getFont()->setBold(true);

// Heading
$i = 5;
$sheet->setCellValue('A'.$i, "Begin Date")
      ->setCellValue('B'.$i, date('m/d/Y', strtotime($begin_date)));
$sheet->getStyle('A'.$i)->getFont()->setBold(true);

$sheet->setCellValue('C'.$i, "End Date")
      ->setCellValue('D'.$i, date('m/d/Y', strtotime($end_date)));
$sheet->getStyle('C'.$i)->getFont()->setBold(true);

$i++;

// Table header
$sheet->setCellValue('A'.$i, "Date")
      ->setCellValue('B'.$i, "Office")
      ->setCellValue('C'.$i, "Category")
      ->setCellValue('D'.$i, "Hours Worked")
      ->setCellValue('E'.$i, "Journal Entry");

$sheet->getStyle('A'.$i.':E'.$i)->getFont()->setBold(true);

$i++;

// Data rows
foreach ($records as $rec) {
    $ttt = str_replace("00:00:00", "", $rec['transaction_date']);

    $sheet->setCellValue('A'.$i, date('m/d/Y', strtotime($ttt)));
    $sheet->setCellValue('B'.$i, ($rec['office_status'] == '1') ? '✓' : "");
    $sheet->setCellValue('C'.$i, $rec['catagory_name']);
    $sheet->setCellValue('D'.$i, $rec['hours']);
    $sheet->setCellValue('E'.$i, $rec['journal']);

    $i++;
}

// Total hours row
$sheet->mergeCells('A'.$i.':B'.$i);
$sheet->setCellValue('A'.$i, "Total hours");
$sheet->getStyle('A'.$i.':C'.$i)->applyFromArray($stil);
$sheet->getStyle('A'.$i.':C'.$i)->getFont()->setBold(true);

$sheet->setCellValue('D'.$i, hourdecFormating(
    $total_hours_data[0]['t_hours'],
    $total_hours_data[0]['t_minutes']
));

// Output to browser
$filename = "monthlyjournalreport.xls";
ob_end_clean();
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="' . $filename . '"');

$writer = new Xls($spreadsheet);
$writer->save('php://output');
exit;
?>
