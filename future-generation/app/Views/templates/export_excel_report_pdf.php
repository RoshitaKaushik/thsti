<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

// Create Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set document properties
$spreadsheet->getProperties()->setCreator("Akal")
    ->setLastModifiedBy("AKAL")
    ->setTitle("Office 2007 XLS Test Document")
    ->setSubject("Office 2007 XLS Test Document")
    ->setDescription("Description for Test Document")
    ->setKeywords("phpspreadsheet office codeigniter php")
    ->setCategory("AKAL");

// Set active sheet
$spreadsheet->setActiveSheetIndex(0);

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

// Title setup
// $title = $this->request->getPost('title');
// if ($type != '') {
//     $title = $this->request->getPost('title') . "(" . $type . ")";
// }

$sheet->mergeCells('A1:G2');
$sheet->setCellValue('A1', $title);
$sheet->getStyle('A1:G2')->applyFromArray($stil);
$sheet->getStyle('A1:G2')->getFont()->setBold(true);

$i = 3;
$k = $i;

// Headers
$sheet->setCellValue('A' . $i, "Student Name")->getStyle('A' . $i)->getFont()->setBold(true);
$sheet->setCellValue('B' . $i, "Student Email")->getStyle('B' . $i)->getFont()->setBold(true);
$sheet->setCellValue('C' . $i, "Course Name")->getStyle('C' . $i)->getFont()->setBold(true);
$sheet->setCellValue('D' . $i, "Status")->getStyle('D' . $i)->getFont()->setBold(true);
$sheet->setCellValue('E' . $i, "Earn Credit")->getStyle('E' . $i)->getFont()->setBold(true);
$sheet->setCellValue('F' . $i, "Year")->getStyle('F' . $i)->getFont()->setBold(true);
$sheet->setCellValue('G' . $i, "Semester")->getStyle('G' . $i)->getFont()->setBold(true);

$i = $i + 1;

// Data rows
if (!empty($recordss)) {
    foreach ($recordss as $rec) {
        $sheet->setCellValue('A' . $i, $rec['firstname'] . " " . $rec['lastname']);
        $email = getEmaill($rec['StudentID']);
        $user_email = '';
        foreach ($email as $e) {
            $whatIWant = substr($e['Email'], strpos($e['Email'], "@") + 1);
            if ($whatIWant == 'future.edu') {
                $user_email = $e['Email'];
            }
        }
        if ($user_email != '') {
            $sheet->setCellValue('B' . $i, $user_email);
        } else {
            if (isset($email[0]['Email'])) {
                $sheet->setCellValue('B' . $i, $email[0]['Email']);
            }
        }

        $courses = get_enrolled_course_filter_wise($rec['StudentID'], $selectedclass, $selectedclassto, $selected_semester, $selected_course);

        foreach ($courses as $c) {
            $sheet->setCellValue('C' . $i, $c['CourseTitle'] . " (" . $c['Course'] . ")");

            if ($c['Grade'] == 'W' || $c['Grade'] == 'AUDIT' || $c['Grade'] == 'SCH') {
                $grade = $c['Grade'];
            } elseif ($c['Grade'] == 'I') {
                $grade = 'Incomplete';
            } else {
                $grade = 'Complete';
            }

            $sheet->setCellValue('D' . $i, $grade);
            $sheet->setCellValue('E' . $i, $c['CreditEarned']);
            $sheet->setCellValue('F' . $i, $c['Class']);
            $sheet->setCellValue('G' . $i, $c['Semester']);

            $i = $i + 1;
        }
        if (empty($courses)) {
            $i = $i + 1;
        }

        $credit = 0;
        $CR = getSemesterCourseByStudent_ID($rec['StudentID'], $selectedclass, isset($selectedSemester));

        foreach ($CR as $valuee) {
            $credit = $credit + $valuee['credits'];
        }

        $corse = array_column($CR, 'course_row_id');

        foreach ($unique_types as $value) {
            $show_year = '';
            $sem = '';
            $grade = '';
            $earn_credit = '';

            if (!empty($records)) {
                foreach ($records as $recc) {
                    if (
                        $recc['firstname'] == $rec['firstname'] &&
                        $recc['lastname'] == $rec['lastname'] &&
                        $recc['course_row_id'] == $value
                    ) {
                        if ($recc['Grade'] == 'W' || $recc['Grade'] == 'AUDIT' || $recc['Grade'] == 'SCH') {
                            $grade = $recc['Grade'];
                        } elseif ($recc['Grade'] == 'I') {
                            $grade = 'Incomplete';
                        } else {
                            $grade = 'Complete';
                        }
                        $show_year = $recc['Class'];
                        $sem = $recc['Semester'];
                        $earn_credit = $recc['CreditEarned'];
                    }
                }
            }
        }
    }
}

// Output Excel
$filename = "course_report.xls";

// Clear output buffer before sending headers
ob_end_clean();
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$objWriter = IOFactory::createWriter($spreadsheet, 'Xls');
$objWriter->save('php://output');
exit;
