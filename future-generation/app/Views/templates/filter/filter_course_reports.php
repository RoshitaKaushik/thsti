<table id="course_report" class="table datatable_th table-striped table-bordered">
	<thead>
		<tr>
			<th data-name="<?= encryptor('encrypt', 'Course') ?>">Course Code</th>
			<th data-name="<?= encryptor('encrypt', 'CourseTitle') ?>">Course Title</th>
			<th data-name="<?= encryptor('encrypt', 'Class') ?>Class">Year</th>
			<th data-name="<?= encryptor('encrypt', 'Semester') ?>">Semester</th>
			<th data-name="<?= encryptor('encrypt', 'Professor') ?>">Faculty</th>
			<th data-name="<?= encryptor('encrypt', 'start_date') ?>">Start Date</th>
			<th data-name="<?= encryptor('encrypt', 'end_date') ?>">End Date</th>
			<th data-name="<?= encryptor('encrypt', 'student_count') ?>">No. Of Student</th>  										
		</tr>
	</thead>
    <tbody> 
      <?php
       foreach($records as $rec)
       {
           ?>
           <tr>
               <td><?= $rec['Course'] ?></td>
               <td><?= $rec['CourseTitle'] ?></td>
               <td class="text-center"><?= $rec['Class'] ?></td>
               <td class="text-center"><?= $rec['Semester'] ?></td>
               <td><?= $rec['Professor'] ?></td>
               <td class="text-center">
                   <?php
                   if($rec['start_date'])
                   {
                       echo date('m/d/Y',strtotime($rec['start_date']));
                   }
                   ?>
               </td>
               <td class="text-center">
                   <?php
                   if($rec['end_date'])
                   {
                       echo date('m/d/Y',strtotime($rec['end_date']));
                   }
                   ?>
               </td class="text-center">
               <td class="text-center"><?= $rec['student_count']; ?></td>
           </tr>
           <?php
       }
      ?>
    </tbody>
</table>