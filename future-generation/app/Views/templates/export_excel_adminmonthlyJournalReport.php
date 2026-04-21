<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();

// Set document properties
$spreadsheet->getProperties()->setCreator("Akal")
    ->setLastModifiedBy("AKAL")
    ->setTitle("Office 2007 XLS Test Document")
    ->setSubject("Office 2007 XLS Test Document")
    ->setDescription("Description for Test Document")
    ->setKeywords("phpexcel office codeigniter php")
    ->setCategory("AKAL");

// Create a first sheet
$spreadsheet->setActiveSheetIndex(0);

$stil = [
    'borders' => [
        'allBorders' => [
            'style' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
    ]
];

$stil_center = [
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
    ]
];

// Title
$spreadsheet->getActiveSheet()->mergeCells('A1:G2');
$spreadsheet->getActiveSheet()->setCellValue('A1', "Monthly Journal Report");
$spreadsheet->getActiveSheet()->getStyle('A1:G2')->applyFromArray($stil);
$spreadsheet->getActiveSheet()->getStyle('A1:G2')->getFont()->setBold(true);

// Heading
$i = 5;

$spreadsheet->getActiveSheet()->setCellValue('A'.$i, "Begin Date")
    ->setCellValue('B'.$i, date('m/d/Y', strtotime($begin_date)));
$spreadsheet->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);

$spreadsheet->getActiveSheet()->setCellValue('C'.$i, "End Date")
    ->setCellValue('D'.$i, date('m/d/Y', strtotime($end_date)));
$spreadsheet->getActiveSheet()->getStyle('C'.$i)->getFont()->setBold(true);

$i++;

$spreadsheet->getActiveSheet()->setCellValue('A'.$i, "Employee Name")
    ->setCellValue('B'.$i, "Date")
    ->setCellValue('C'.$i, "Office")
    ->setCellValue('D'.$i, "Category")
    ->setCellValue('E'.$i, "Hours Worked")
    ->setCellValue('F'.$i, "Hourly Rate")
    ->setCellValue('G'.$i, "Journal Entry");

$spreadsheet->getActiveSheet()->getStyle('A'.$i.':G'.$i)->getFont()->setBold(true);
$i++;

// Variables
$cat = '';
$total_hour = 0;
$t_h_rate = 0;
$grand_sum = 0;
$em_id = '';
$grand_total = 0;
$curr_hour = 0;
$check_zero = false;
$curr_tot_hr = 0;
$grand_tot_hr = 0;

foreach ($records as $rec) {
    if ($cat == '') { 
        $curr_hour = 0;
        $cat = $rec['cat_id'];
        $t_h_rate = number_format((float)$rec['daily_rate'], 2, '.', ''); 
        $check_zero = false;
        $curr_tot_hr = 0;
    }
    if ($em_id == '') {
        $curr_hour = 0;
        $em_id = $rec['ID']; 
        $check_zero = false;
        $curr_tot_hr = 0;
    }
    if ($cat != $rec['cat_id'] || $em_id != $rec['ID']) {
        $totol_hours1 = get_category_total_emp($em_id, $cat, $begin_date, $end_date);
        $em_id = $rec['ID'];

        $spreadsheet->getActiveSheet()->mergeCells('A'.$i.':D'.$i);
        $spreadsheet->getActiveSheet()->setCellValue('A'.$i, "Total");
        $spreadsheet->getActiveSheet()->getStyle('A'.$i.':D'.$i)->applyFromArray($stil);
        $spreadsheet->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);

        $grand_tot_hr += number_format((float)$curr_tot_hr, 2, '.', '');
        $current_total = number_format((float)$curr_tot_hr, 2, '.', '');
        $spreadsheet->getActiveSheet()->setCellValue('E'.$i, $current_total);

        $spreadsheet->getActiveSheet()->mergeCells('F'.$i.':G'.$i);
        $grand_sum += number_format((float)($t_h_rate * $current_total), 2, '.', '');
        $curr_check_status = '';
        if ($check_zero) {
            $curr_check_status = "(Daily hour rates missing for selected dates)";
        }
        $mm_msg = $curr_check_status != '' ? "Partial Cost : " : "Total Cost : ";
        $grand_total += number_format((float)$curr_hour, 2, '.', '');
        $spreadsheet->getActiveSheet()->setCellValue('F'.$i, $mm_msg . number_format((float)$curr_hour, 2, '.', '') . $curr_check_status);

        $spreadsheet->getActiveSheet()->getStyle('E'.$i)->applyFromArray($stil);
        $spreadsheet->getActiveSheet()->getStyle('F'.$i.':G'.$i)->applyFromArray($stil);
        $spreadsheet->getActiveSheet()->getStyle('E'.$i)->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle('F'.$i)->getFont()->setBold(true);

        $i++;
        $cat = $rec['cat_id'];
        $t_h_rate = number_format((float)$rec['daily_rate'], 2, '.', '');
        $curr_hour = 0;
        $curr_tot_hr = 0;
        $check_zero = false;
    }

    $ttt = str_replace("00:00:00", "", $rec['transaction_date']);
    $spreadsheet->getActiveSheet()->setCellValue('A'.$i, $rec['FirstName']." ".$rec['LastName']);
    $spreadsheet->getActiveSheet()->setCellValue('B'.$i, date('m/d/Y', strtotime($ttt)));
    $spreadsheet->getActiveSheet()->setCellValue('C'.$i, ($rec['office_status']=='1') ? '✓' : "");
    $spreadsheet->getActiveSheet()->getStyle('C'.$i)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->setCellValue('D'.$i, $rec['catagory_name']);

    $curr_hour += number_format((float)$rec['daily_rate'], 2, '.', '') * hourmintodecFormating($rec['hours']);
    if (!$check_zero && number_format((float)$rec['daily_rate'], 2, '.', '') == '0.00') {
        $check_zero = true;
    }
    $curr_tot_hr += hourmintodecFormating($rec['hours']);
    $spreadsheet->getActiveSheet()->setCellValue('E'.$i, hourmintodecFormating($rec['hours']));
    $spreadsheet->getActiveSheet()->setCellValue('F'.$i, number_format((float)$rec['daily_rate'], 2, '.', ''));
    $spreadsheet->getActiveSheet()->setCellValue('G'.$i, $rec['journal']);

    $i++;
    $last_emp = $rec['ID'];
}

if (!empty($last_emp)) {
    $totol_hours1 = get_category_total_emp($last_emp, $cat, $begin_date, $end_date);
    $em_id = $last_emp;
    $spreadsheet->getActiveSheet()->mergeCells('A'.$i.':D'.$i);
    $spreadsheet->getActiveSheet()->setCellValue('A'.$i, "Total");
    $spreadsheet->getActiveSheet()->getStyle('A'.$i.':D'.$i)->applyFromArray($stil);
    $spreadsheet->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);

    $grand_tot_hr += number_format((float)$curr_tot_hr, 2, '.', '');
    $current_total = number_format((float)$curr_tot_hr, 2, '.', '');
    $spreadsheet->getActiveSheet()->setCellValue('E'.$i, $current_total);

    $grand_sum += number_format((float)($t_h_rate * $current_total), 2, '.', '');
    $spreadsheet->getActiveSheet()->mergeCells('F'.$i.':G'.$i);
    $cur_msg = $check_zero ? "(Daily hour rates missing for selected dates)" : "";
    $mm_msg = $cur_msg != '' ? "Partial Cost : " : "Total Cost : ";
    $grand_total += number_format((float)$curr_hour, 2, '.', '');
    $spreadsheet->getActiveSheet()->setCellValue('F'.$i, $mm_msg . number_format((float)$curr_hour, 2, '.', '') . $cur_msg);

    $spreadsheet->getActiveSheet()->getStyle('E'.$i)->applyFromArray($stil);
    $spreadsheet->getActiveSheet()->getStyle('F'.$i.':G'.$i)->applyFromArray($stil);
    $spreadsheet->getActiveSheet()->getStyle('E'.$i)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('F'.$i)->getFont()->setBold(true);
    $i++;
}

$spreadsheet->getActiveSheet()->mergeCells('A'.$i.':D'.$i);
$spreadsheet->getActiveSheet()->setCellValue('A'.$i, "Grand Total hours");
$spreadsheet->getActiveSheet()->getStyle('A'.$i.':D'.$i)->applyFromArray($stil);
$spreadsheet->getActiveSheet()->getStyle('A'.$i.':D'.$i)->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->setCellValue('E'.$i, number_format((float)$grand_tot_hr, 2, '.', ''));
$spreadsheet->getActiveSheet()->mergeCells('F'.$i.':G'.$i);
$spreadsheet->getActiveSheet()->setCellValue('F'.$i, "Grand Total Cost : " . number_format((float)$grand_total, 2, '.', ''));
$spreadsheet->getActiveSheet()->getStyle('F'.$i.':G'.$i)->applyFromArray($stil);
$spreadsheet->getActiveSheet()->getStyle('E'.$i)->applyFromArray($stil);
$spreadsheet->getActiveSheet()->getStyle('A'.$i.':D'.$i)->applyFromArray($stil);
$spreadsheet->getActiveSheet()->getStyle('E'.$i)->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle('F'.$i.':G'.$i)->getFont()->setBold(true);

// Output Excel file
$filename = "adminmonthlyjournalreport.xls";
$writer = IOFactory::createWriter($spreadsheet, 'Xls');
ob_end_clean();
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="'.$filename.'"');
$writer->save('php://output');
exit;
?>
