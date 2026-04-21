<style>
    th {
        font-weight: bold;
        text-align: center;
        font-family: "Times New Roman", Times, serif;
    }

    td {
        font-family: "Times New Roman", Times, serif;
    }
</style>
<br /><br />
<table style='width:100%;'>
    <tbody>
        <tr>
            <th>
                <?= isset($title) ? $title : '' ?>
                <?= !empty($type) ? '(' . $type . ')' : '' ?>
            </th>

        </tr>

    </tbody>
</table>

<br /><br />


<?php
if (isset($selected_course_detail)) {
?>
    <table style='width:100%;' border="1">
        <tbody>
            <tr>
                <th>Course Title</th>
                <td>&nbsp;&nbsp;<?= $selected_course_detail['CourseTitle']; ?></td>
            </tr>
            <tr>
                <th>Professor</th>
                <td>&nbsp;&nbsp;<?= $selected_course_detail['Professor']; ?></td>
            </tr>
            <tr>
                <th>Semester</th>
                <td>&nbsp;&nbsp;<?= $selected_course_detail['Semester']; ?></td>
            </tr>
            <tr>
                <th colspan="2"></th>
            </tr>
        </tbody>
    </table>
    <br />
    <br>

<?php
}
?>




<style>
    .col {
        border: 1px solid #ccc;
    }
</style>

<table id="SemesterListing" class="table table-striped table-bordered col">

    <thead>
        <tr>
            <th style="border:1px solid #ccc;width:22%;">Student Name</th>
            <th style="border:1px solid #ccc;width:20%;">Student Email</th>
            <th style="border:1px solid #ccc;width:32%;">Course Name</th>
            <th style="border:1px solid #ccc;width:8%;">Credit</th>
            <th style="border:1px solid #ccc;width:8%;">Year</th>
            <th style="border:1px solid #ccc;width:10%;">Semester</th>

        </tr>

        <?php


        if (!empty($recordss)) {
            foreach ($recordss as $rec) {
        ?>
                <tr>
                    <td style="border:1px solid #ccc;"><?= $rec['firstname'] . "  " . $rec['lastname'] ?></td>
            <?php

                $email = getEmaill($rec['StudentID']);
                $user_email = '';
                foreach ($email as $e) {
                    $whatIWant = substr($e['Email'], strpos($e['Email'], "@") + 1);
                    if ($whatIWant == 'future.edu') {
                        $user_email = $e['Email'];
                    }
                }
                echo '<td style="border:1px solid #ccc;">';
                if ($user_email != '') {
                    echo $user_email;
                } else {
                    if (isset($email[0]['Email'])) {
                        echo $email[0]['Email'];
                    }
                }
                echo "</td>";

                // get enrolled class and semester by filter
                $courses = get_semester_report_class_course($rec['StudentID'], $selectedclass, $selectedSemester, $selectedcourse);



                if (!empty($courses)) {
                    echo '<td style="border:1px solid #ccc;">';
                    echo $courses[0]['CourseTitle'] . " (" . $courses[0]['Course'] . ")";
                    echo "</td>";


                    echo '<td style="border:1px solid #ccc;">';
                    echo $courses[0]['credits'];
                    echo "</td>";
                    echo '<td style="border:1px solid #ccc;">';
                    echo $courses[0]['Class'];
                    echo "</td>";

                    echo '<td style="border:1px solid #ccc;">';
                    echo $courses[0]['Semester'];
                    echo "</td>";

                    echo "</tr>";
                    for ($j = 1; $j < sizeof($courses); $j++) {

                        echo '<tr>';
                        echo '<td colspan="2">';

                        echo '</td>';
                        echo '<td style="border:1px solid #ccc;">';
                        echo $courses[$j]['CourseTitle'] . " (" . $courses[$j]['Course'] . ")";
                        echo '</td>';


                        echo '<td style="border:1px solid #ccc;">' . $courses[$j]['credits'] . '</td>';
                        echo '<td style="border:1px solid #ccc;">' . $courses[$j]['Class'] . '</td>';
                        echo '<td style="border:1px solid #ccc;">' . $courses[$j]['Semester'] . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo "<td>";
                    echo "</td>";
                    echo "</tr>";
                }
            }
        }



            ?>


            </tbody>
</table>