<div class="table-responsive">
    <table id="alldataTable1" class="table datatable_th table-striped table-bordered " >
            <thead>
                <tr>
                    <th data-name="<?= encryptor('encrypt', 'Course') ?>" style="text-align:left;">Sno</th>
                    <th data-name="<?= encryptor('encrypt', 'FirstName') ?>" style="text-align:left;">Name</th>
                    <th data-name="<?= encryptor('encrypt', 'Class') ?>">Class</th>
                    <th data-name="<?= encryptor('encrypt', 'RegionProgram') ?>">Region</th>
                    <th data-name="<?= encryptor('encrypt', 'Ethnicity') ?>">Ethnicity</th>
                    <th data-name="<?= encryptor('encrypt', 'citizenship') ?>">Citizenship</th>
                    <th data-name="<?= encryptor('encrypt', 'Birthdate') ?>">Birthdate</th>
                    <th data-name="<?= encryptor('encrypt', 'Countries') ?>">Country</th>
                    <th data-name="<?= encryptor('encrypt', 'Special_Program_Name') ?>">Market Name</th>
                </tr>
            </thead>
            <tbody> 
                <?php
                    $i=1;
                  foreach($student_details as $sd)
                  {
                      ?>
                      <tr>
                          <td style="text-align:left;"><?= $i++; ?></td>
                          <td style="text-align:left;"><?= $sd['FirstName']." ".$sd['LastName']; ?></td>
                          <td><?= $sd['Class']; ?></td>
                          <td><?= $sd['RegionProgram']; ?></td>
                          <td><?= $sd['Ethnicity']; ?></td>
                          <td><?= $sd['citizenship']; ?></td>
                          <td><?= $sd['Birthdate']; ?></td>
                          <td><?= $sd['Countries']; ?></td>
                          <td><?= $sd['Special_Program_Name']; ?></td>
                      </tr>
                      <?php
                  }
                ?>
            </tbody>
    </table> 
</div>