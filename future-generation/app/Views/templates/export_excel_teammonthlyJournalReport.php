<?php
// Make sure PhpSpreadsheet is loaded via Composer
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

// Create spreadsheet instance
$objPHPExcel = new Spreadsheet();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Akal")
    ->setLastModifiedBy("AKAL")
    ->setTitle("Office 2007 XLS Test Document")
    ->setSubject("Office 2007 XLS Test Document")
    ->setDescription("Description for Test Document")
    ->setKeywords("phpexcel office codeigniter php")
    ->setCategory("AKAL"); 

// Create a first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Style arrays
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
$objPHPExcel->getActiveSheet()->mergeCells('A1:F2');
$objPHPExcel->getActiveSheet()->setCellValue('A1', "Monthly Journal Report");
$objPHPExcel->getActiveSheet()->getStyle('A1:F2')->applyFromArray($stil);
$objPHPExcel->getActiveSheet()->getStyle('A1:F2')->getFont()->setBold(true);  

// Heading
$i = 5;
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Begin Date")
    ->setCellValue('B'.$i, date('d/m/Y', strtotime($begin_date)));
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, "End Date")
    ->setCellValue('D'.$i, date('d/m/Y', strtotime($end_date)));
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setBold(true);
$i++;

$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Employee Name")
    ->setCellValue('B'.$i, "Date")
    ->setCellValue('C'.$i, "Category")
    ->setCellValue('D'.$i, "Hours Worked")
    ->setCellValue('E'.$i, "Hourly Rate")
    ->setCellValue('F'.$i, "Journal Entry");
$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':F'.$i)->getFont()->setBold(true);

$i++;

// Keep your existing loop logic unchanged
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
$last_emp = '';

foreach ($records as $rec) {
    if (in_array($rec['ID'], $team_member)) {
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
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':C'.$i);
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Total");
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':C'.$i)->applyFromArray($stil);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);

            $grand_tot_hr += number_format((float)$curr_tot_hr, 2, '.', '');
            $current_total = number_format((float)$curr_tot_hr, 2, '.', '');
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $current_total);

            $objPHPExcel->getActiveSheet()->mergeCells('E'.$i.':F'.$i);
            $grand_sum += number_format((float)($t_h_rate * $current_total), 2, '.', '');

            $curr_check_status = $check_zero ? "(Daily hour rates missing for selected dates)" : '';
            $mm_msg = $curr_check_status ? "Partial Cost : " : "Total Cost : ";

            $grand_total += number_format((float)$curr_hour, 2, '.', '');
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $mm_msg.number_format((float)$curr_hour, 2, '.', '').$curr_check_status);

            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($stil);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i.':F'.$i)->applyFromArray($stil);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setBold(true);

            $i++;
            $cat = $rec['cat_id'];
            $t_h_rate = number_format((float)$rec['daily_rate'], 2, '.', '');
            $curr_hour = 0;
            $curr_tot_hr = 0;
            $check_zero = false;
        }

        $ttt = str_replace("00:00:00", "", $rec['transaction_date']);
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $rec['FirstName']." ".$rec['LastName']);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, date('d/m/Y', strtotime($ttt)));
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $rec['catagory_name']);

        $curr_hour += (number_format((float)$rec['daily_rate'], 2, '.', '') * hourmintodecFormating($rec['hours']));
        if (!$check_zero && number_format((float)$rec['daily_rate'], 2, '.', '') == '0.00') {
            $check_zero = true;
        }

        $curr_tot_hr += hourmintodecFormating($rec['hours']);
        $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, hourmintodecFormating($rec['hours']));
        $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, number_format((float)$rec['daily_rate'], 2, '.', ''));
        $objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $rec['journal']);

        $i++;
        $last_emp = $rec['ID'];
    }
}

// Final total row
if ($last_emp != '') {
    $totol_hours1 = get_category_total_emp($last_emp, $cat, $begin_date, $end_date);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':C'.$i);
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Total");
    $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':C'.$i)->applyFromArray($stil);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);

    $grand_tot_hr += number_format((float)$curr_tot_hr, 2, '.', '');
    $current_total = number_format((float)$curr_tot_hr, 2, '.', '');
    $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $current_total);

    $grand_sum += number_format((float)($t_h_rate * $current_total), 2, '.', '');
    $objPHPExcel->getActiveSheet()->mergeCells('E'.$i.':F'.$i);

    $cur_msg = $check_zero ? "(Daily hour rates missing for selected dates)" : '';
    $mm_msg = $cur_msg ? "Partial Cost : " : "Total Cost : ";

    $grand_total += number_format((float)$curr_hour, 2, '.', '');
    $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $mm_msg.number_format((float)$curr_hour, 2, '.', '').$cur_msg);

    $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($stil);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$i.':F'.$i)->applyFromArray($stil);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getFont()->setBold(true);
    $i++;
}

// Grand total row
$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':C'.$i);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Grand Total hours");
$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':C'.$i)->applyFromArray($stil);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':C'.$i)->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, number_format((float)$grand_tot_hr, 2, '.', ''));
$objPHPExcel->getActiveSheet()->mergeCells('E'.$i.':F'.$i);
$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, "Grand Total Cost : ".number_format((float)$grand_total, 2, '.', ''));

$objPHPExcel->getActiveSheet()->getStyle('E'.$i.':F'.$i)->applyFromArray($stil);
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($stil);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':C'.$i)->applyFromArray($stil);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':C'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('E'.$i.':F'.$i)->getFont()->setBold(true);

// Output the file
$filename = "adminmonthlyjournalreport.xls";
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="'.$filename.'"');
header('Cache-Control: max-age=0');

$objWriter = new Xls($objPHPExcel);
$objWriter->save('php://output');
exit;
?>
