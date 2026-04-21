<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

// Create a new Spreadsheet object. This replaces the old $objPHPExcel.
$spreadsheet = new Spreadsheet();

// Set document properties
$spreadsheet->getProperties()
    ->setCreator("Akal")
    ->setLastModifiedBy("AKAL")
    ->setTitle("Office 2007 XLS Test Document")
    ->setSubject("Office 2007 XLS Test Document")
    ->setDescription("Description for Test Document")
    ->setKeywords("phpspreadsheet office codeigniter php")
    ->setCategory("AKAL");

$sheet = $spreadsheet->getActiveSheet();

// --- STYLES (Translated from PHPExcel) ---
$stil = [
    'borders' => ['allborders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']]],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
    'font' => ['bold' => true, 'size' => 13, 'name' => 'Arial'],
];

$stil_right = [
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT],
    'borders' => ['allborders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']]],
    'font' => ['size' => 13, 'name' => 'Arial']
];

$styleArray = [
    'font' => ['size' => 13, 'name' => 'Arial'],
    'borders' => ['allborders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']]],
];

// --- LOGIC ---

// Calculate the final column index for merging and ranges
$category_count = count($category);
$end_col_index = 1 + $category_count + 4; // Employees + categories + 4 totals
$highestCol = Coordinate::stringFromColumnIndex($end_col_index);

$i = 1; // Start from row 1

// --- TABLE 1: RAW HOURS ---

// Title
$sheet->mergeCells('B'.$i.':'.$highestCol.$i);
$sheet->setCellValue('B' . $i, 'Future Generation University Timesheet');
$sheet->getRowDimension($i)->setRowHeight(20);
$sheet->getStyle('B' . $i)->applyFromArray($stil);

$i++;

// Subtitle
$sheet->mergeCells('B'.$i.':'.$highestCol.$i);
$sheet->setCellValue('B' . $i, 'Administrative Time Report');
$sheet->getRowDimension($i)->setRowHeight(20);
$sheet->getStyle('B' . $i)->applyFromArray($stil);

$i++;

// Date
$sheet->mergeCells('B'.$i.':'.$highestCol.$i);
$sheet->setCellValue('B' . $i, date("M-Y", strtotime($selected_start_date)));
$sheet->getRowDimension($i)->setRowHeight(20);
$sheet->getStyle('B' . $i)->applyFromArray($stil);

$i++;
$headerRow = $i;
$col = 1; // Start from column 1 ('A')

// Headers for Table 1
$sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $headerRow, "Employees");
foreach ($category as $cat) {
    $sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $headerRow, $cat['catagory_name']);
}
$sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $headerRow, "Total Hours");
$sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $headerRow, "Total Days");
$sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $headerRow, "Hourly Rate");
$sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $headerRow, "Total Grant Hours");

$header_range = 'A'.$headerRow.':'.$highestCol.$headerRow;
$sheet->getStyle('B' . $headerRow . ':' . $highestCol . $headerRow)->getAlignment()->setTextRotation(90);
$sheet->getRowDimension($headerRow)->setRowHeight(120);
$sheet->getStyle($header_range)->applyFromArray($stil);
$sheet->getStyle($header_range)->getAlignment()->setWrapText(true);

// Data arrays needed for both tables
$user_unique_category_sum = [];
$user_unique_category_grantsum = [];
$tota_hours_id = [];
$first_category_wise_total_sum = [];

foreach ($users as $user) {
    $col = 1;
    $i++;
    $row = $i;
    $sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $row, $user['FirstName'] . " " . $user['LastName']);

    $user_total_hours = 0.00;
    $current_hourly_rate = 0;
    $current_total_grant_hour = 0;

    foreach ($category as $cat) {
        $records = get_time_report_hr_min_user_category_wise($user['ID'], $cat['cat_id'], $selected_start_date, $selected_end_date);
        $cellCoordinate = Coordinate::stringFromColumnIndex($col) . $row;

        if (!empty($records)) {
            $current_total_hours = $records[0]['hours1'] + minuteToHours($records[0]['minute1']);
            $current_total_hours = (float)preg_replace('/\.(\d{2}).*/', '.$1', $current_total_hours);

            $sheet->setCellValue($cellCoordinate, $current_total_hours);
            $sheet->getStyle($cellCoordinate)->getNumberFormat()->setFormatCode('0.00');
            
            $user_total_hours += $current_total_hours;
            $current_hourly_rate = $records[0]['daily_rate'];
            if ($cat['grant_type'] == 'Yes') {
                $current_total_grant_hour += $current_total_hours;
            }
            $user_unique_category_sum[$user['ID'] . "_" . $cat['cat_id']] = $current_total_hours;
            $first_category_wise_total_sum[$cat['cat_id']] = ($first_category_wise_total_sum[$cat['cat_id']] ?? 0) + $current_total_hours;
        } else {
            $sheet->setCellValue($cellCoordinate, '');
        }
        $col++;
    }
    
    $sheet->getStyle('A'.$row.':'.$highestCol.$row)->applyFromArray($styleArray);

    $tota_hours_id[$user['ID']] = (float)$user_total_hours;
    $user_unique_category_grantsum[$user['ID']] = (float)$current_total_grant_hour;
    $first_category_wise_total_sum['total_hours'] = ($first_category_wise_total_sum['total_hours'] ?? 0) + $user_total_hours;

    $sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $row, number_format($user_total_hours, 2, '.', ''));
    $sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $row, number_format($user_total_hours / 8, 2, '.', ''));
    $sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $row, number_format((float)$current_hourly_rate, 3, '.', ''));
    $sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $row, number_format($current_total_grant_hour, 2, '.', ''));
}

// Footer for Table 1
$i++;
$row = $i;
$col = 1;
$sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $row, 'Total');
foreach ($category as $cat) {
    $sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $row, number_format((float)($first_category_wise_total_sum[$cat['cat_id']] ?? 0), 2, '.', ''));
}
$sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $row, number_format((float)($first_category_wise_total_sum['total_hours'] ?? 0), 2, '.', ''));

$footer_range = 'A'.$row.':'.$highestCol.$row;
$sheet->getStyle($footer_range)->applyFromArray($styleArray);
$sheet->getStyle($footer_range)->getFont()->setBold(true);

// --- TABLE 2: PERCENTAGE CALCULATIONS ---

$i = $i + 2; // Add a blank row for spacing
$row = $i;

// Title for Table 2
$sheet->mergeCells('A'.$row.':'.$highestCol.$row);
$sheet->setCellValue('A' . $row, 'Percentage of time work calculations');
$sheet->getRowDimension($row)->setRowHeight(30);
$sheet->getStyle('A'.$row.':'.$highestCol.$row)->applyFromArray($styleArray);
$sheet->getStyle('A'.$row)->getFont()->setBold(true);

$i++;
$headerRow = $i;
$col = 1;

// Headers for Table 2
$sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $headerRow, "Employees");
foreach($category as $cat) {
    $sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $headerRow, $cat['catagory_name']);
}
$sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $headerRow, "Total Hours");
$sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $headerRow, "Total Days");
$sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $headerRow, "Hourly Rate");
$sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $headerRow, "Total Grant Hours");

$header_range_2 = 'A'.$headerRow.':'.$highestCol.$headerRow;
$sheet->getStyle('B'.$headerRow.':'.$highestCol.$headerRow)->getAlignment()->setTextRotation(90);
$sheet->getRowDimension($headerRow)->setRowHeight(120);
$sheet->getStyle($header_range_2)->applyFromArray($stil);
$sheet->getStyle($header_range_2)->getAlignment()->setWrapText(true);

$category_wise_total_sum = [];
foreach($users as $user) {
    $i++;
    $row = $i;
    $col = 1;
    $current_row_percentage = 0;
    
    $sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $row, $user['FirstName']." ".$user['LastName']);
    
    foreach($category as $cat) {
        $cellCoordinate = Coordinate::stringFromColumnIndex($col) . $row;
        if($cat['grant_type'] == 'Yes') {
            $sheet->setCellValue($cellCoordinate, 'NA');
        } else if (isset($user_unique_category_sum[$user['ID']."_".$cat['cat_id']])) {
            $non_grant_hours = ($tota_hours_id[$user['ID']] ?? 0) - ($user_unique_category_grantsum[$user['ID']] ?? 0);
            if ($non_grant_hours > 0) {
                 $category_hours = $user_unique_category_sum[$user['ID']."_".$cat['cat_id']];
                 $current_category_percentage = ($category_hours / $non_grant_hours) * 100;
                 $current_category_percentage = number_format((float)$current_category_percentage, 2, '.', '');
                 $current_row_percentage += $current_category_percentage;
                 $sheet->setCellValue($cellCoordinate, $current_category_percentage." %");
                 $category_wise_total_sum[$cat['cat_id']] = ($category_wise_total_sum[$cat['cat_id']] ?? 0) + $current_category_percentage;
            } else {
                 $sheet->setCellValue($cellCoordinate, "0.00%");
            }
        } else {
             $sheet->setCellValue($cellCoordinate, "0.00%");
        }
        $col++;
    }
    
    $sheet->getStyle('A'.$row.':'.$highestCol.$row)->applyFromArray($styleArray);
    $sheet->getStyle('B'.$row.':'.Coordinate::stringFromColumnIndex($col-1).$row)->applyFromArray($stil_right);

    $cur_row_sum = number_format((float)$current_row_percentage, 2, '.', ''); 
    $total_cell_coord = Coordinate::stringFromColumnIndex($col++) . $row;
    if($cur_row_sum > 100 && $cur_row_sum < 101) {
        $sheet->setCellValue($total_cell_coord, "100.00 %");
    } else {
        $sheet->setCellValue($total_cell_coord, $cur_row_sum." %");
    }

    $sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $row, "");
    $sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $row, "");
    $sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $row, "");
}

// Footer for Table 2
$i++;
$row = $i;
$col = 1;
$sheet->setCellValue(Coordinate::stringFromColumnIndex($col++) . $row, "Total");
foreach($category as $cat) {
    $cellCoordinate = Coordinate::stringFromColumnIndex($col) . $row;
    if($cat['grant_type'] == 'Yes') {
        $sheet->setCellValue($cellCoordinate, "0.00");
    } else {
        $total_percentage_sum = $category_wise_total_sum[$cat['cat_id']] ?? 0;
        $cur_row_sum = number_format((float)($total_percentage_sum / 100), 2, '.', ''); 
        $sheet->setCellValue($cellCoordinate, $cur_row_sum);
    }
    $col++;
}
$footer_range_2 = 'A'.$row.':'.$highestCol.$row;
$sheet->getStyle($footer_range_2)->applyFromArray($styleArray);
$sheet->getStyle($footer_range_2)->getFont()->setBold(true);

// --- FINAL FORMATTING ---

// Auto-size all columns for better readability
foreach (range('A', $highestCol) as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Freeze the first column (Employees) and top header row
$sheet->freezePane('B2');

// --- OUTPUT ---
$filename = "time_report_part_one_" . date('Y-m-d') . ".xls";
// Clean any output buffer that might have been started
ob_end_clean();
$writer = new Xls($spreadsheet);
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename=' . $filename);
$writer->save('php://output');
exit;