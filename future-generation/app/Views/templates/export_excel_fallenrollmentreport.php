<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

// Initialize Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set document properties
$spreadsheet->getProperties()
    ->setCreator("Akal")
    ->setLastModifiedBy("AKAL")
    ->setTitle("Office 2007 XLS Test Document")
    ->setSubject("Office 2007 XLS Test Document")
    ->setDescription("Description for Test Document")
    ->setKeywords("phpspreadsheet office codeigniter php")
    ->setCategory("AKAL");

// Define styles
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000'],
        ],
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
    ],
];

$styleCenter = [
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
    ],
];

// Set title
$title = 'Fall Semester Report';
$sheet->mergeCells('A1:L2');
$sheet->setCellValue('A1', $title);
$sheet->getStyle('A1:L2')->applyFromArray($styleArray);
$sheet->getStyle('A1:L2')->getFont()->setBold(true);

// Helper function to merge cells by column and row
function cellsToMergeByColsRow($start = -1, $end = -1, $row = -1)
{
    $merge = 'A1:A1';
    if ($start >= 0 && $end >= 0 && $row >= 0) {
        $start = Coordinate::stringFromColumnIndex($start + 1);
        $end = Coordinate::stringFromColumnIndex($end + 1);
        $merge = "$start{$row}:$end{$row}";
    }
    return $merge;
}

// Bold header rows
$sheet->getStyle('A1:L2')->getFont()->setBold(true);

$i = 3;
$row = $i;
$col = 0;

// Headers
$sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, "Name"); $col++;
$sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, "Email"); $col++;
$sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, "Gender"); $col++;
$sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, "Age"); $col++;
$sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, "Country"); $col++;
$sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, "State"); $col++;
$sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, "Ethnicity"); $col++;

// Dynamic Course Headers
if (!empty($unique_types)) {
    foreach ($unique_types as $unique_type) {
        $coursedet = getCorse_details_by_ID($unique_type);
        $sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, $coursedet['CourseTitle'] . " (" . $coursedet['Course'] . ")");
        $col++;
    }
}

// Final Column
$sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, "Total Credits"); $col++;
$sheet->getStyle('A' . $row . ':CZ' . $row)->getFont()->setBold(true);
$sheet->getColumnDimension('A')->setAutoSize(true);
$sheet->getColumnDimension('B')->setAutoSize(true);

$i++;
$row = $i;
$col = 0;
$sheet->setCellValue('A' . $row, "Women");
$sheet->getStyle('A' . $row . ':A' . $row)->getFont()->setBold(true);
$i++;

// Initialize counters for Women
$w_non_resident_alien = $w_hispanic = $w_native_american = $w_asian = $w_black = $w_hawaiian = $w_white = $w_two = $w_unknown = 0;
$w_plus_non_resident_alien = $w_plus_hispanic = $w_plus_native_american = $w_plus_asian = $w_plus_black = $w_plus_hawaiian = $w_plus_white = $w_plus_two = $w_plus_unknown = 0;
$w_minus_non_resident_alien = $w_minus_hispanic = $w_minus_native_american = $w_minus_asian = $w_minus_black = $w_minus_hawaiian = $w_minus_white = $w_minus_two = $w_minus_unknown = 0;

if (!empty($recordss)) {
    foreach ($recordss as $rec) {
        $col = 0;
        $row = $i;

        $credit = 0;
        $start_program_date = '15-07-';
        $CR = getFall2SemesterCourseByStudent_ID($rec['StudentID'], $selected_program_start, 'Fall');
        foreach ($CR as $valuee) {
            $credit += $valuee['credits'];
            $withdrawn = $valuee['withdrawn'] ?? '';
        }
        $corse = array_column($CR, 'course_row_id');

        if ($credit != 0) {
            $sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, $rec['firstname'] . "  " . $rec['lastname']); $col++;

            $email = getEmaill($rec['StudentID']);
            $user_email = '';
            foreach ($email as $e) {
                if (substr($e['Email'], strpos($e['Email'], "@") + 1) == 'future.edu') {
                    $user_email = $e['Email'];
                }
            }
            $sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, $user_email ?: ($email[0]['Email'] ?? '')); $col++;

            $sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, $rec['Sex']); $col++;

            if (!empty($rec['Birthdate'])) {
                $birth = date('d-m-Y', strtotime($rec['Birthdate']));
                $current = date('d-m-Y');
                $diff = abs(strtotime($current) - strtotime($birth));
                $years = floor($diff / (365 * 60 * 60 * 24));
                $sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, $years);
            } else {
                $sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, '');
            }
            $col++;

            $user_address = get_user_address($rec['ID']);
            $user_country = array_column($user_address, 'CountryName');
            $sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, implode(",", $user_country)); $col++;

            $user_country_id = array_column($user_address, 'Country');
            if (in_array("USA", $user_country_id)) {
                $state_list = get_us_state_by_state_id($rec['ID'], 'USA');
                $user_country = array_column($state_list, 'StateName');
                $sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, implode(",", $user_country));
            } else {
                $sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, '');
            }
            $col++;

            $sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, $rec['Ethnicity']); $col++;

            foreach ($unique_types as $value) {
                if (!empty($records)) {
                    foreach ($records as $recc) {
                        if ($recc['firstname'] == $rec['firstname'] && $recc['lastname'] == $rec['lastname'] && $recc['course_row_id'] == $value) {
                            $sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, $recc['credits']);
                        }
                    }
                }
                $col++;
            }

            $sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, $credit); $col++;

            // Update ethnicity counters
            $ethnicity = $rec['Ethnicity'] ?: 'Unknown';
            switch ($ethnicity) {
                case 'Unknown':
                case '':
                    $w_unknown++;
                    $credit < 9 ? $w_minus_unknown++ : $w_plus_unknown++;
                    break;
                case 'White':
                    $w_white++;
                    $credit < 9 ? $w_minus_white++ : $w_plus_white++;
                    break;
                case 'Asian':
                    $w_asian++;
                    $credit < 9 ? $w_minus_asian++ : $w_plus_asian++;
                    break;
                case 'Black/African American':
                    $w_black++;
                    $credit < 9 ? $w_minus_black++ : $w_plus_black++;
                    break;
                case 'Hispanic/Latino':
                    $w_hispanic++;
                    $credit < 9 ? $w_minus_hispanic++ : $w_plus_hispanic++;
                    break;
                case 'American Indian':
                    $w_native_american++;
                    $credit < 9 ? $w_minus_native_american++ : $w_plus_native_american++;
                    break;
                case 'Non-Resident Alien':
                    $w_non_resident_alien++;
                    $credit < 9 ? $w_minus_non_resident_alien++ : $w_plus_non_resident_alien++;
                    break;
                case 'Native Hawaiian/Pacific Islander':
                    $w_hawaiian++;
                    $credit < 9 ? $w_minus_hawaiian++ : $w_plus_hawaiian++;
                    break;
                case 'Two or more races':
                    $w_two++;
                    $credit < 9 ? $w_minus_two++ : $w_plus_two++;
                    break;
            }
            $i++;
        }
    }
}

// Women Ethnicity Summary Headers
$i++;
$row = $i;
$col = 0;
$sheet->setCellValue('A' . $row, '');
$sheet->setCellValue('B' . $row, 'Total');
$sheet->setCellValue('C' . $row, 'Full Time (9+ ch)');
$sheet->setCellValue('D' . $row, 'Part Time (< 9 ch)');
$sheet->getStyle('A' . $row . ':D' . $row)->getFont()->setBold(true);

// Women Ethnicity Summary
$ethnicities = [
    'Unknown' => ['total' => $w_unknown, 'full' => $w_plus_unknown, 'part' => $w_minus_unknown],
    'White' => ['total' => $w_white, 'full' => $w_plus_white, 'part' => $w_minus_white],
    'Asian' => ['total' => $w_asian, 'full' => $w_plus_asian, 'part' => $w_minus_asian],
    'Black/African American' => ['total' => $w_black, 'full' => $w_plus_black, 'part' => $w_minus_black],
    'Hispanic/Latino' => ['total' => $w_hispanic, 'full' => $w_plus_hispanic, 'part' => $w_minus_hispanic],
    'American Indian' => ['total' => $w_native_american, 'full' => $w_plus_native_american, 'part' => $w_minus_native_american],
    'Non-Resident Alien' => ['total' => $w_non_resident_alien, 'full' => $w_plus_non_resident_alien, 'part' => $w_minus_non_resident_alien],
    'Native Hawaiian/Pacific Islander' => ['total' => $w_hawaiian, 'full' => $w_plus_hawaiian, 'part' => $w_minus_hawaiian],
    'Two or more races' => ['total' => $w_two, 'full' => $w_plus_two, 'part' => $w_minus_two],
];

foreach ($ethnicities as $label => $counts) {
    $i++;
    $row = $i;
    $col = 0;
    $sheet->setCellValue('A' . $row, $label);
    $sheet->setCellValue('B' . $row, $counts['total']);
    $sheet->setCellValue('C' . $row, $counts['full']);
    $sheet->setCellValue('D' . $row, $counts['part']);
    $sheet->getStyle('A' . $row . ':A' . $row)->getFont()->setBold(true);
}

// Total Women
$i++;
$row = $i;
$col = 0;
$sheet->setCellValue('A' . $row, 'Total Women');
$sheet->setCellValue('B' . $row, array_sum(array_column($ethnicities, 'total')));
$sheet->setCellValue('C' . $row, array_sum(array_column($ethnicities, 'full')));
$sheet->setCellValue('D' . $row, array_sum(array_column($ethnicities, 'part')));
$sheet->getStyle('A' . $row . ':A' . $row)->getFont()->setBold(true);

// Men Section
$i += 2;
$row = $i;
$col = 0;
$sheet->setCellValue('A' . $row, "Men");
$sheet->getStyle('A' . $row . ':A' . $row)->getFont()->setBold(true);
$i++;

// Initialize counters for Men
$m_non_resident_alien = $m_hispanic = $m_native_american = $m_asian = $m_black = $m_hawaiian = $m_white = $m_two = $m_unknown = 0;
$m_plus_non_resident_alien = $m_plus_hispanic = $m_plus_native_american = $m_plus_asian = $m_plus_black = $m_plus_hawaiian = $m_plus_white = $m_plus_two = $m_plus_unknown = 0;
$m_minus_non_resident_alien = $m_minus_hispanic = $m_minus_native_american = $m_minus_asian = $m_minus_black = $m_minus_hawaiian = $m_minus_white = $m_minus_two = $m_minus_unknown = 0;

if (!empty($m_recordss)) {
    foreach ($m_recordss as $rec) {
        $col = 0;
        $row = $i;

        $credit = 0;
        $start_program_date = '01-07-';
        $CR = getFall2SemesterCourseByStudent_ID($rec['StudentID'], $selected_program_start, 'Fall');
        foreach ($CR as $valuee) {
            $credit += $valuee['credits'];
            $withdrawn = $valuee['withdrawn'] ?? '';
        }
        $corse = array_column($CR, 'course_row_id');

        if ($credit != 0) {
            $sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, $rec['firstname'] . "  " . $rec['lastname']); $col++;

            $email = getEmaill($rec['StudentID']);
            $user_email = '';
            foreach ($email as $e) {
                if (substr($e['Email'], strpos($e['Email'], "@") + 1) == 'future.edu') {
                    $user_email = $e['Email'];
                }
            }
            $sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, $user_email ?: ($email[0]['Email'] ?? '')); $col++;

            $sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, $rec['Sex']); $col++;

            if (!empty($rec['Birthdate'])) {
                $birth = date('d-m-Y', strtotime($rec['Birthdate']));
                $current = date('d-m-Y');
                $diff = abs(strtotime($current) - strtotime($birth));
                $years = floor($diff / (365 * 60 * 60 * 24));
                $sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, $years);
            } else {
                $sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, '');
            }
            $col++;

            $user_address = get_user_address($rec['ID']);
            $user_country = array_column($user_address, 'CountryName');
            $sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, implode(",", $user_country)); $col++;

            $user_country_id = array_column($user_address, 'Country');
            if (in_array("USA", $user_country_id)) {
                $state_list = get_us_state_by_state_id($rec['ID'], 'USA');
                $user_country = array_column($state_list, 'StateName');
                $sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, implode(",", $user_country));
            } else {
                $sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, '');
            }
            $col++;

            $sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, $rec['Ethnicity']); $col++;

            foreach ($m_unique_types as $value) {
                if (!empty($m_records)) {
                    foreach ($m_records as $recc) {
                        if ($recc['firstname'] == $rec['firstname'] && $recc['lastname'] == $rec['lastname'] && $recc['course_row_id'] == $value) {
                            $sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, $recc['credits']);
                        }
                    }
                }
                $col++;
            }

            $sheet->setCellValue(Coordinate::stringFromColumnIndex($col + 1) . $row, $credit); $col++;

            // Update ethnicity counters
            $ethnicity = $rec['Ethnicity'] ?: 'Unused';
            switch ($ethnicity) {
                case 'Unknown':
                case '':
                    $m_unknown++;
                    $credit < 9 ? $m_minus_unknown++ : $m_plus_unknown++;
                    break;
                case 'White':
                    $m_white++;
                    $credit < 9 ? $m_minus_white++ : $m_plus_white++;
                    break;
                case 'Asian':
                    $m_asian++;
                    $credit < 9 ? $m_minus_asian++ : $m_plus_asian++;
                    break;
                case 'Black/African American':
                    $m_black++;
                    $credit < 9 ? $m_minus_black++ : $m_plus_black++;
                    break;
                case 'Hispanic/Latino':
                    $m_hispanic++;
                    $credit < 9 ? $m_minus_hispanic++ : $m_plus_hispanic++;
                    break;
                case 'American Indian':
                    $m_native_american++;
                    $credit < 9 ? $m_minus_native_american++ : $m_plus_native_american++;
                    break;
                case 'Non-Resident Alien':
                    $m_non_resident_alien++;
                    $credit < 9 ? $m_minus_non_resident_alien++ : $m_plus_non_resident_alien++;
                    break;
                case 'Native Hawaiian/Pacific Islander':
                    $m_hawaiian++;
                    $credit < 9 ? $m_minus_hawaiian++ : $m_plus_hawaiian++;
                    break;
                case 'Two or more races':
                    $m_two++;
                    $credit < 9 ? $m_minus_two++ : $m_plus_two++;
                    break;
            }
            $i++;
        }
    }
}

// Men Ethnicity Summary Headers
$i++;
$row = $i;
$col = 0;
$sheet->setCellValue('A' . $row, '');
$sheet->setCellValue('B' . $row, 'Total');
$sheet->setCellValue('C' . $row, 'Full Time (9+ ch)');
$sheet->setCellValue('D' . $row, 'Part Time (< 9 ch)');
$sheet->getStyle('A' . $row . ':D' . $row)->getFont()->setBold(true);

// Men Ethnicity Summary
$men_ethnicities = [
    'Unknown' => ['total' => $m_unknown, 'full' => $m_plus_unknown, 'part' => $m_minus_unknown],
    'White' => ['total' => $m_white, 'full' => $m_plus_white, 'part' => $m_minus_white],
    'Asian' => ['total' => $m_asian, 'full' => $m_plus_asian, 'part' => $m_minus_asian],
    'Black/African American' => ['total' => $m_black, 'full' => $m_plus_black, 'part' => $m_minus_black],
    'Hispanic/Latino' => ['total' => $m_hispanic, 'full' => $m_plus_hispanic, 'part' => $m_minus_hispanic],
    'American Indian' => ['total' => $m_native_american, 'full' => $m_plus_native_american, 'part' => $m_minus_native_american],
    'Non-Resident Alien' => ['total' => $m_non_resident_alien, 'full' => $m_plus_non_resident_alien, 'part' => $m_minus_non_resident_alien],
    'Native Hawaiian/Pacific Islander' => ['total' => $m_hawaiian, 'full' => $m_plus_hawaiian, 'part' => $m_minus_hawaiian],
    'Two or more races' => ['total' => $m_two, 'full' => $m_plus_two, 'part' => $m_minus_two],
];

foreach ($men_ethnicities as $label => $counts) {
    $i++;
    $row = $i;
    $col = 0;
    $sheet->setCellValue('A' . $row, $label);
    $sheet->setCellValue('B' . $row, $counts['total']);
    $sheet->setCellValue('C' . $row, $counts['full']);
    $sheet->setCellValue('D' . $row, $counts['part']);
    $sheet->getStyle('A' . $row . ':A' . $row)->getFont()->setBold(true);
}

// Total Men
$i++;
$row = $i;
$col = 0;
$sheet->setCellValue('A' . $row, 'Total Men');
$sheet->setCellValue('B' . $row, array_sum(array_column($men_ethnicities, 'total')));
$sheet->setCellValue('C' . $row, array_sum(array_column($men_ethnicities, 'full')));
$sheet->setCellValue('D' . $row, array_sum(array_column($men_ethnicities, 'part')));
$sheet->getStyle('A' . $row . ':A' . $row)->getFont()->setBold(true);

// Output Excel file
$filename = "fall_semester_report_" . date('m-d-Y') . ".xls";
$writer = new Xls($spreadsheet);
ob_end_clean();
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
$writer->save('php://output');
exit;