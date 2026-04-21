<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

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
        $start = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($start + 1);
        $end = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($end + 1);
        $merge = "$start{$row}:$end{$row}";
    }
    return $merge;
}

// Set semester headers
$i = 3;
$col = 6;
$row = $i;

foreach ($enrolled_semester as $es) {
    $get_size = get_size_of_semester($es['Class'], $es['Semester'], $unique_types);
    $next_col = $col + count($get_size) - 1;
    $sheet->mergeCells(cellsToMergeByColsRow($col, $next_col, $row));
    $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, $es['Class'] . " " . $es['Semester']);
    $col = $next_col + 1;
}

$i++;
$row = $i;
$col = 0;

// Set column headers
$sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, "Name"); $col++;
$sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, "Email"); $col++;
$sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, "Gender"); $col++;
$sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, "Country"); $col++;
$sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, "State"); $col++;
$sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, "Ethnicity"); $col++;

$abc = [];
if (!empty($unique_types)) {
    foreach ($unique_types as $unique_type) {
        $coursedet = getCorse_details_by_ID($unique_type);
        $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, $coursedet['CourseTitle'] . "(" . $coursedet['Course'] . ")");
        $abc['course' . $coursedet['CourseID']] = 0;
        $col++;
    }
}

$sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, "Total Credits"); $col++;
$sheet->getStyle('A' . $row . ':CZ' . $row)->getFont()->setBold(true);
$sheet->getColumnDimension('A')->setAutoSize(true);
$sheet->getColumnDimension('B')->setAutoSize(true);

$i++;
$row = $i;
$col = 0;
$sheet->setCellValue('A' . $row, "Women");
$sheet->getStyle('A' . $row . ':A' . $row)->getFont()->setBold(true);
$i++;

// Initialize counters
$w_non_resient_alien = $w_hispanic = $w_native_american = $w_asian = $w_black = $w_hawaiian = $w_white = $w_two = $w_unknown = 0;
$plus_w_non_resient_alien = $plus_w_hispanic = $plus_w_native_american = $plus_w_asian = $plus_w_black = $plus_w_hawaiian = $plus_w_white = $plus_w_two = $plus_w_unknown = 0;
$minus_w_non_resient_alien = $minus_w_hispanic = $minus_w_native_american = $minus_w_asian = $minus_w_black = $minus_w_hawaiian = $minus_w_white = $minus_w_two = $minus_w_unknown = 0;
$grand_credit = 0;

if (!empty($recordss)) {
    foreach ($recordss as $rec) {
        $col = 0;
        $row = $i;

        $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, $rec['firstname'] . "  " . $rec['lastname']); $col++;

        $email = getEmaill($rec['StudentID']);
        $user_email = '';
        foreach ($email as $e) {
            if (substr($e['Email'], strpos($e['Email'], "@") + 1) == 'future.edu') {
                $user_email = $e['Email'];
            }
        }
        $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, $user_email ?: ($email[0]['Email'] ?? '')); $col++;
        $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, $rec['Sex']); $col++;

        $user_address = get_user_address($rec['ID']);
        $user_country = array_column($user_address, 'CountryName');
        $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, implode(",", $user_country)); $col++;

        $user_country_id = array_column($user_address, 'Country');
        if (in_array("USA", $user_country_id)) {
            $state_list = get_us_state_by_state_id($rec['ID'], 'USA');
            $user_country = array_column($state_list, 'StateName');
            $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, implode(",", $user_country));
        }
        $col++;

        $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, $rec['Ethnicity']); $col++;

        $credit = 0;
        $CR = getFallSemesterCourseByStudent_ID($rec['StudentID'], $selected_program_start, $start_program_date, $selected_program_end, $end_program_date, $selected_semester);
        foreach ($CR as $valuee) {
            $credit += $valuee['credits'];
        }

        foreach ($unique_types as $value) {
            if (!empty($records)) {
                foreach ($records as $recc) {
                    if ($recc['firstname'] == $rec['firstname'] && $recc['lastname'] == $rec['lastname'] && $recc['course_row_id'] == $value) {
                        $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, $recc['credits']);
                        $abc['course' . $recc['course_row_id']] += $recc['credits'];
                    }
                }
            }
            $col++;
        }

        $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, $credit); $col++;
        $grand_credit += $credit;

        // Update ethnicity counters
        $ethnicity = $rec['Ethnicity'] ?: 'Unknown';
        switch ($ethnicity) {
            case 'Unknown':
                $w_unknown++;
                $credit < 6 ? $minus_w_unknown++ : $plus_w_unknown++;
                break;
            case 'White':
                $w_white++;
                $credit < 6 ? $minus_w_white++ : $plus_w_white++;
                break;
            case 'Asian':
                $w_asian++;
                $credit < 6 ? $minus_w_asian++ : $plus_w_asian++;
                break;
            case 'Black/African American':
                $w_black++;
                $credit < 6 ? $minus_w_black++ : $plus_w_black++;
                break;
            case 'Hispanic/Latino':
                $w_hispanic++;
                $credit < 6 ? $minus_w_hispanic++ : $plus_w_hispanic++;
                break;
            case 'American Indian':
                $w_native_american++;
                $credit < 6 ? $minus_w_native_american++ : $plus_w_native_american++;
                break;
            case 'Non-Resident Alien':
                $w_non_resient_alien++;
                $credit < 6 ? $minus_w_non_resient_alien++ : $plus_w_non_resient_alien++;
                break;
            case 'Native Hawaiian/Pacific Islander':
                $w_hawaiian++;
                $credit < 6 ? $minus_w_hawaiian++ : $plus_w_hawaiian++;
                break;
            case 'Two or more races':
                $w_two++;
                $credit < 6 ? $minus_w_two++ : $plus_w_two++;
                break;
        }
        $i++;
    }
}

// Subtotal for Women
$i++;
$row = $i;
$col = 0;
$sheet->setCellValue('A' . $row, 'Subtotal');
$col = 6;
foreach ($abc as $val) {
    $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, $val);
    $col++;
}
$sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, $grand_credit);

// Ethnicity summary for Women
$ethnicities = [
    'Unknown' => $w_unknown,
    'White' => $w_white,
    'Asian' => $w_asian,
    'Black/African American' => $w_black,
    'Hispanic/Latino' => $w_hispanic,
    'American Indian' => $w_native_american,
    'Non-Resident Alien' => $w_non_resient_alien,
    'Native Hawaiian/Pacific Islander' => $w_hawaiian,
    'Two or more races' => $w_two,
];

foreach ($ethnicities as $label => $count) {
    $i++;
    $row = $i;
    $col = 0;
    $sheet->setCellValue('A' . $row, $label);
    $sheet->setCellValue('B' . $row, $count);
    $sheet->getStyle('A' . $row . ':A' . $row)->getFont()->setBold(true);
}

$i++;
$row = $i;
$col = 0;
$sheet->setCellValue('A' . $row, 'Total Women');
$sheet->setCellValue('B' . $row, array_sum($ethnicities));
$sheet->getStyle('A' . $row . ':A' . $row)->getFont()->setBold(true);

// Men Section
$i += 2;
$row = $i;
$col = 0;
$sheet->setCellValue('A' . $row, "Men");
$sheet->getStyle('A' . $row . ':A' . $row)->getFont()->setBold(true);
$i++;

// Initialize counters for Men
$non_resient_alien = $hispanic = $native_american = $asian = $black = $hawaiian = $white = $two = $unknown = 0;
$plus_non_resient_alien = $plus_hispanic = $plus_native_american = $plus_asian = $plus_black = $plus_hawaiian = $plus_white = $plus_two = $plus_unknown = 0;
$minus_non_resient_alien = $minus_hispanic = $minus_native_american = $minus_asian = $minus_black = $minus_hawaiian = $minus_white = $minus_two = $minus_unknown = 0;
$m_grand_credit = 0;
$m_abc = [];
$total_abc = [];

if (!empty($m_unique_types)) {
    foreach ($m_unique_types as $unique_type) {
        $coursedet = getCorse_details_by_ID($unique_type);
        $m_abc['course' . $coursedet['CourseID']] = 0;
    }
}

if (!empty($m_recordss)) {
    foreach ($m_recordss as $rec) {
        $col = 0;
        $row = $i;

        $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, $rec['firstname'] . "  " . $rec['lastname']); $col++;

        $email = getEmaill($rec['StudentID']);
        $user_email = '';
        foreach ($email as $e) {
            if (substr($e['Email'], strpos($e['Email'], "@") + 1) == 'future.edu') {
                $user_email = $e['Email'];
            }
        }
        $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, $user_email ?: ($email[0]['Email'] ?? '')); $col++;
        $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, $rec['Sex']); $col++;

        $user_address = get_user_address($rec['ID']);
        $user_country = array_column($user_address, 'CountryName');
        $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, implode(",", $user_country)); $col++;

        $user_country_id = array_column($user_address, 'Country');
        if (in_array("USA", $user_country_id)) {
            $state_list = get_us_state_by_state_id($rec['ID'], 'USA');
            $user_country = array_column($state_list, 'StateName');
            $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, implode(",", $user_country));
        }
        $col++;

        $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, $rec['Ethnicity']); $col++;

        $credit = 0;
        $CR = getFallSemesterCourseByStudent_ID($rec['StudentID'], $selected_program_start, $start_program_date, $selected_program_end, $end_program_date, $selected_semester);
        foreach ($CR as $valuee) {
            $credit += $valuee['credits'];
        }

        foreach ($m_unique_types as $value) {
            if (!empty($m_records)) {
                foreach ($m_records as $recc) {
                    if ($recc['firstname'] == $rec['firstname'] && $recc['lastname'] == $rec['lastname'] && $recc['course_row_id'] == $value) {
                        $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, $recc['credits']);
                        $m_abc['course' . $recc['course_row_id']] += $recc['credits'];
                    }
                }
            }
            $col++;
        }

        $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, $credit); $col++;
        $m_grand_credit += $credit;

        // Update ethnicity counters for Men
        $ethnicity = $rec['Ethnicity'] ?: 'Unknown';
        switch ($ethnicity) {
            case 'Unknown':
                $unknown++;
                $credit < 6 ? $minus_unknown++ : $plus_unknown++;
                break;
            case 'White':
                $white++;
                $credit < 6 ? $minus_white++ : $plus_white++;
                break;
            case 'Asian':
                $asian++;
                $credit < 6 ? $minus_asian++ : $plus_asian++;
                break;
            case 'Black/African American':
                $black++;
                $credit < 6 ? $minus_black++ : $plus_black++;
                break;
            case 'Hispanic/Latino':
                $hispanic++;
                $credit < 6 ? $minus_hispanic++ : $plus_hispanic++;
                break;
            case 'American Indian':
                $native_american++;
                $credit < 6 ? $minus_native_american++ : $plus_native_american++;
                break;
            case 'Non-Resident Alien':
                $non_resient_alien++;
                $credit < 6 ? $minus_non_resient_alien++ : $plus_non_resient_alien++;
                break;
            case 'Native Hawaiian/Pacific Islander':
                $hawaiian++;
                $credit < 6 ? $minus_hawaiian++ : $plus_hawaiian++;
                break;
            case 'Two or more races':
                $two++;
                $credit < 6 ? $minus_two++ : $plus_two++;
                break;
        }
        $i++;
    }
}

// Subtotal for Men
$i++;
$row = $i;
$col = 0;
$sheet->setCellValue('A' . $row, 'Subtotal');
$col = 6;
foreach ($m_abc as $key => $val) {
    $total_abc[$key] = ($abc[$key] ?? 0) + $val;
    $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, $val);
    $col++;
}
$sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, $m_grand_credit);

// Ethnicity summary for Men
$men_ethnicities = [
    'Unknown' => $unknown,
    'White' => $white,
    'Asian' => $asian,
    'Black/African American' => $black,
    'Hispanic/Latino' => $hispanic,
    'American Indian' => $native_american,
    'Non-Resident Alien' => $non_resient_alien,
    'Native Hawaiian/Pacific Islander' => $hawaiian,
    'Two or more races' => $two,
];

foreach ($men_ethnicities as $label => $count) {
    $i++;
    $row = $i;
    $col = 0;
    $sheet->setCellValue('A' . $row, $label);
    $sheet->setCellValue('B' . $row, $count);
    $sheet->getStyle('A' . $row . ':A' . $row)->getFont()->setBold(true);
}

$i++;
$row = $i;
$col = 0;
$sheet->setCellValue('A' . $row, 'Total Men');
$sheet->setCellValue('B' . $row, array_sum($men_ethnicities));
$sheet->getStyle('A' . $row . ':A' . $row)->getFont()->setBold(true);

// Total Credits
$i += 2;
$row = $i;
$col = 0;
$sheet->setCellValue('A' . $row, 'Total Credits');
$sheet->getStyle('A' . $row . ':A' . $row)->getFont()->setBold(true);
$col = 6;
foreach ($total_abc as $val) {
    $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, $val);
    $col++;
}
$sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row, $m_grand_credit + $grand_credit);

// Total Ethnicity Summary
$total_ethnicities = [
    'Unknown' => $w_unknown + $unknown,
    'White' => $w_white + $white,
    'Asian' => $w_asian + $asian,
    'Black/African American' => $w_black + $black,
    'Hispanic/Latino' => $w_hispanic + $hispanic,
    'American Indian' => $w_native_american + $native_american,
    'Non-Resident Alien' => $w_non_resient_alien + $non_resient_alien,
    'Native Hawaiian/Pacific Islander' => $w_hawaiian + $hawaiian,
    'Two or more races' => $w_two + $two,
];

foreach ($total_ethnicities as $label => $count) {
    $i++;
    $row = $i;
    $col = 0;
    $sheet->setCellValue('A' . $row, $label);
    $sheet->setCellValue('B' . $row, $count);
    $sheet->getStyle('A' . $row . ':A' . $row)->getFont()->setBold(true);
}

$i++;
$row = $i;
$col = 0;
$sheet->setCellValue('A' . $row, 'Total Students');
$sheet->setCellValue('B' . $row, array_sum($total_ethnicities));
$sheet->getStyle('A' . $row . ':A' . $row)->getFont()->setBold(true);

$i++;
$row = $i;
$col = 0;
$sheet->setCellValue('A' . $row, 'Total Credits');
$sheet->setCellValue('B' . $row, $m_grand_credit + $grand_credit);
$sheet->getStyle('A' . $row . ':A' . $row)->getFont()->setBold(true);

$i++;
$row = $i;
$col = 0;
$sheet->setCellValue('A' . $row, 'FTE');
$sheet->setCellValue('B' . $row, ($m_grand_credit + $grand_credit) / 24);
$sheet->getStyle('A' . $row . ':A' . $row)->getFont()->setBold(true);

// Output Excel file
$filename = "enrollment_report_" . date('m-d-Y') . ".xls";
$writer = new Xls($spreadsheet);
ob_end_clean();
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
$writer->save('php://output');
exit;