
<?php
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
    
    
     
      // Set Font Color, Font Style and Font Alignment
    $stil=array(
        'borders' => array(
          'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '000000')
          )
        ),
        'alignment' => array(
          'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );
    
    $stil_center=array(
        
        'alignment' => array(
          'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );
    
    
    
     
               
    $title = '12 M Completion Report';
    
    	$objPHPExcel->getActiveSheet()->mergeCells('A1:F2');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', $title);
        $objPHPExcel->getActiveSheet()->getStyle('A1:F2')->applyFromArray($stil);
        
         $objPHPExcel->getActiveSheet()->getStyle('A1:F2')->getFont()->setBold(true);  
        
              $i=3;
              
        $k = $i;
       // $objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':A'.$k);
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "First Name");
        $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$k)->getFont()->setBold(true);  
        
        
       // $objPHPExcel->getActiveSheet()->mergeCells('B'.$i.':B'.$k);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, "Last Name");
        $objPHPExcel->getActiveSheet()->getStyle('B'.$i.':B'.$k)->getFont()->setBold(true);
        
        
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, "Email");
        $objPHPExcel->getActiveSheet()->getStyle('C'.$i.':C'.$k)->getFont()->setBold(true);
        
        $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, "Gender");
        $objPHPExcel->getActiveSheet()->getStyle('D'.$i.':D'.$k)->getFont()->setBold(true);
        
        $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, "Age");
        $objPHPExcel->getActiveSheet()->getStyle('E'.$i.':E'.$k)->getFont()->setBold(true);
        
        $objPHPExcel->getActiveSheet()->setCellValue('F'.$i, "Country");
        $objPHPExcel->getActiveSheet()->getStyle('F'.$i.':F'.$k)->getFont()->setBold(true);
        
        $objPHPExcel->getActiveSheet()->setCellValue('G'.$i, "Graduation Date");
        $objPHPExcel->getActiveSheet()->getStyle('G'.$i.':G'.$k)->getFont()->setBold(true);
        
         
       
         $objPHPExcel->getActiveSheet()->setCellValue('H'.$i, "Ethnicity");
        $objPHPExcel->getActiveSheet()->getStyle('H'.$i.':H'.$k)->getFont()->setBold(true);
        
        $objPHPExcel->getActiveSheet()->getColumnDimension('A'.$i)->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B'.$i)->setAutoSize(true);
        
        
      $i = $i+1;   
      
       $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Women");
      
       $i = $i+1;
              if(!empty($records))
              {
                   $non_resient_alien = 0;
                   $hispanic = 0;
                   $native_american = 0;
                   $asian = 0;
                   $black = 0;
                   $hawaiian = 0;
                   $white=0;
                   $two=0 ;
                   $race = 0;
                   $unknown = 0;
                   
                   $age_under_18 = 0;
                   $age_18_24=0;
                   $age_25_39 = 0;
                   $age_above_40 = 0;
                   $age_unknown = 0;
                   
                foreach($records as $rec)
                {
                   if($selected_age == '')
                   {
                       
                        if($rec['Birthdate'] != '')
                        {
                          $date1 = date('Y-m-d',strtotime($rec['Birthdate']));
                          $date2 = date('Y-m-d');
                          if($rec['Graduation'] != '' && $rec['Graduation'] != '0000-00-00'){
                                $date2 =date('Y-m-d',strtotime($rec['Graduation']));
                          }
                          $diff = abs(strtotime($date2) - strtotime($date1));
                           $years = floor($diff / (365*60*60*24));
                           
                           if($years<18 && $years>0)
                           {
                               $age_under_18 = $age_under_18+1;
                           }
                           if($years>17 && $years<25 )
                           {
                               $age_18_24 = $age_18_24+1;
                           }
                           if($years>24 && $years<40)
                           {
                              $age_25_39 = $age_25_39+1; 
                           }
                           if($years>39 )
                           {
                               $age_above_40 = $age_above_40+1;
                           }
                        }
                        else
                        {
                           $age_unknown = $age_unknown+1;
                        }
                       
                     $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $rec['FirstName']);
                     $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $rec['LastName']);
                     $email=report_getEmailByIDD($rec['ID']); 
                     $user_email = '';
                     foreach($email as $e)
                     {
                         $whatIWant = substr($e['Email'], strpos($e['Email'], "@") + 1);    
                         if($whatIWant == 'future.edu')
                         {
                           $user_email = $e['Email']; 
                         }
                     }
                     if($user_email != '')
                     {
                        
                        $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $user_email);
                     }
                     else
                     {
                        if(isset($email[0]['Email']))
                        {
                            $all_email = array_column($email, 'Email');
                            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, implode(",",$all_email));
                            
                        }
                        
                     }
                     $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $rec['Sex']);
                     
                     
                      if($rec['Birthdate'] != '')
                      {
                         $date1 = date('Y-m-d',strtotime($rec['Birthdate']));
                        $date2 = date('Y-m-d'); 
                        if($rec['Graduation'] != '' && $rec['Graduation'] != '0000-00-00'){
                            $date2 =date('Y-m-d',strtotime($rec['Graduation']));
                        }
                          $diff = abs(strtotime($date2) - strtotime($date1));
                           $years = floor($diff / (365*60*60*24));
                          $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $years);
                      }
                      else
                      {
                          $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, '');
                      }
                     
                    $user_address = get_user_address($rec['ID']);
                    $user_country = array_column($user_address, 'CountryName');  
                    
                    $objPHPExcel->getActiveSheet()->setCellValue('F'.$i, implode(",",$user_country));
                    $objPHPExcel->getActiveSheet()->setCellValue('G'.$i, date('m/d/Y',strtotime($rec['Graduation']))); 
                    $objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $rec['Ethnicity']); 
                    
                    if($rec['Ethnicity'] == 'Unknown')
                   {
                      $unknown = $unknown+1; 
                   }
                   if($rec['Ethnicity'] == 'White')
                   {
                      $white = $white+1; 
                   }
                   if($rec['Ethnicity'] == 'Asian')
                   {
                      $asian = $asian+1; 
                   }
                   if($rec['Ethnicity'] == 'Black/African American')
                   {
                      $black = $black+1; 
                   }
                   if($rec['Ethnicity'] == 'Hispanic/Latino')
                   {
                      $hispanic = $hispanic+1; 
                   }
                   if($rec['Ethnicity'] == 'American Indian')
                   {
                      $native_american = $native_american+1; 
                   }
                   if($rec['Ethnicity'] == 'Non-Resident Alien')
                   {
                      $non_resient_alien = $non_resient_alien+1; 
                   }
                   if($rec['Ethnicity'] == 'Native Hawaiian/Pacific Islander')
                   {
                      $hawaiian = $hawaiian+1; 
                   }
                   if($rec['Ethnicity'] == 'Two or more races')
                   {
                      $two = $two+1; 
                   }
                    
                    
                    
                    $i++;
                   }
                   
                    else if($selected_age != '')
                    {
                        $years = '';
                          if($rec['Birthdate'] != '')
                          {
                              $date1 = date('Y-m-d',strtotime($rec['Birthdate']));
                              $date2 = date('Y-m-d');
                              if($rec['Graduation'] != '' && $rec['Graduation'] != '0000-00-00'){
                                $date2 =date('Y-m-d',strtotime($rec['Graduation']));
                              }
                              $diff = abs(strtotime($date2) - strtotime($date1));
                               $years = floor($diff / (365*60*60*24));
                          }
                          if($selected_age =='Under 18')
                          {
                             
                            if($years<18 && $years>0)
                            {
                                $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $rec['FirstName']);
                                 $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $rec['LastName']);
                                 $email=report_getEmailByIDD($rec['ID']); 
                                 $user_email = '';
                                 foreach($email as $e)
                                 {
                                     $whatIWant = substr($e['Email'], strpos($e['Email'], "@") + 1);    
                                     if($whatIWant == 'future.edu')
                                     {
                                       $user_email = $e['Email']; 
                                     }
                                 }
                                 if($user_email != '')
                                 {
                                    
                                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $user_email);
                                 }
                                 else
                                 {
                                    if(isset($email[0]['Email']))
                                    {
                                        $all_email = array_column($email, 'Email');
                                        $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, implode(",",$all_email));
                                        
                                    }
                                    
                                 }
                                 $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $rec['Sex']);
                                 
                                 if($rec['Birthdate'] != '')
                                  {
                                      $date1 = date('Y-m-d',strtotime($rec['Birthdate']));
                                      $date2 = date('Y-m-d');
                                      if($rec['Graduation'] != '' && $rec['Graduation'] != '0000-00-00'){
                                        $date2 =date('Y-m-d',strtotime($rec['Graduation']));
                                      }
                                      $diff = abs(strtotime($date2) - strtotime($date1));
                                       $years = floor($diff / (365*60*60*24));
                                      $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $years);
                                  }
                                  else
                                  {
                                      $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, '');
                                  }
                                 
                                $user_address = get_user_address($rec['ID']);
                                $user_country = array_column($user_address, 'CountryName');                                        
                                $objPHPExcel->getActiveSheet()->setCellValue('F'.$i, implode(",",$user_country));
                                $objPHPExcel->getActiveSheet()->setCellValue('G'.$i, date('m/d/Y',strtotime($rec['Graduation'])));                                   
                                $i++;
                            }
                          }
                          else if($selected_age =='18-24')
                          {
                            
                            if($years>17 && $years<25)
                            {
                                
                                $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $rec['FirstName']);
                                 $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $rec['LastName']);
                                 $email=report_getEmailByIDD($rec['ID']); 
                                 $user_email = '';
                                 foreach($email as $e)
                                 {
                                     $whatIWant = substr($e['Email'], strpos($e['Email'], "@") + 1);    
                                     if($whatIWant == 'future.edu')
                                     {
                                       $user_email = $e['Email']; 
                                     }
                                 }
                                 if($user_email != '')
                                 {
                                    
                                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $user_email);
                                 }
                                 else
                                 {
                                    if(isset($email[0]['Email']))
                                    {
                                        $all_email = array_column($email, 'Email');
                                        $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, implode(",",$all_email));
                                        
                                    }
                                    
                                 }
                                 $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $rec['Sex']);
                                 
                                 if($rec['Birthdate'] != '')
                                  {
                                      $date1 = date('Y-m-d',strtotime($rec['Birthdate']));
                                      $date2 = date('Y-m-d');
                                      if($rec['Graduation'] != '' && $rec['Graduation'] != '0000-00-00'){
                                        $date2 =date('Y-m-d',strtotime($rec['Graduation']));
                                      }
                                      $diff = abs(strtotime($date2) - strtotime($date1));
                                       $years = floor($diff / (365*60*60*24));
                                      $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $years);
                                  }
                                  else
                                  {
                                      $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, '');
                                  }
                                 
                                $user_address = get_user_address($rec['ID']);
                                $user_country = array_column($user_address, 'CountryName');                                        
                                $objPHPExcel->getActiveSheet()->setCellValue('F'.$i, implode(",",$user_country));
                                $objPHPExcel->getActiveSheet()->setCellValue('G'.$i, date('m/d/Y',strtotime($rec['Graduation'])));                                   
                                $i++;
                                
                            }
                          }
                          else if($selected_age =='25-39')
                          {
                            
                            if($years>24 && $years<40)
                            {
                                $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $rec['FirstName']);
                                 $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $rec['LastName']);
                                 $email=report_getEmailByIDD($rec['ID']); 
                                 $user_email = '';
                                 foreach($email as $e)
                                 {
                                     $whatIWant = substr($e['Email'], strpos($e['Email'], "@") + 1);    
                                     if($whatIWant == 'future.edu')
                                     {
                                       $user_email = $e['Email']; 
                                     }
                                 }
                                 if($user_email != '')
                                 {
                                    
                                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $user_email);
                                 }
                                 else
                                 {
                                    if(isset($email[0]['Email']))
                                    {
                                        $all_email = array_column($email, 'Email');
                                        $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, implode(",",$all_email));
                                        
                                    }
                                    
                                 }
                                 $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $rec['Sex']);
                                 
                                 if($rec['Birthdate'] != '')
                                  {
                                      $date1 = date('Y-m-d',strtotime($rec['Birthdate']));
                                      $date2 = date('Y-m-d');
                                      if($rec['Graduation'] != '' && $rec['Graduation'] != '0000-00-00'){
                                        $date2 =date('Y-m-d',strtotime($rec['Graduation']));
                                      }
                                      $diff = abs(strtotime($date2) - strtotime($date1));
                                       $years = floor($diff / (365*60*60*24));
                                      $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $years);
                                  }
                                  else
                                  {
                                      $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, '');
                                  }
                                 
                                $user_address = get_user_address($rec['ID']);
                                $user_country = array_column($user_address, 'CountryName');                                        
                                $objPHPExcel->getActiveSheet()->setCellValue('F'.$i, implode(",",$user_country));
                                $objPHPExcel->getActiveSheet()->setCellValue('G'.$i, date('m/d/Y',strtotime($rec['Graduation'])));                                   
                                $i++;
                            }
                          }
                          else if($selected_age =='40 and Above')
                          {
                            
                            if($years>39)
                            {
                                $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $rec['FirstName']);
                                 $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $rec['LastName']);
                                 $email=report_getEmailByIDD($rec['ID']); 
                                 $user_email = '';
                                 foreach($email as $e)
                                 {
                                     $whatIWant = substr($e['Email'], strpos($e['Email'], "@") + 1);    
                                     if($whatIWant == 'future.edu')
                                     {
                                       $user_email = $e['Email']; 
                                     }
                                 }
                                 if($user_email != '')
                                 {
                                    
                                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $user_email);
                                 }
                                 else
                                 {
                                    if(isset($email[0]['Email']))
                                    {
                                        $all_email = array_column($email, 'Email');
                                        $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, implode(",",$all_email));
                                        
                                    }
                                    
                                 }
                                 $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $rec['Sex']);
                                 
                                 if($rec['Birthdate'] != '')
                                  {
                                      $date1 = date('Y-m-d',strtotime($rec['Birthdate']));
                                      $date2 = date('Y-m-d');
                                      if($rec['Graduation'] != '' && $rec['Graduation'] != '0000-00-00'){
                                        $date2 =date('Y-m-d',strtotime($rec['Graduation']));
                                      }
                                      $diff = abs(strtotime($date2) - strtotime($date1));
                                       $years = floor($diff / (365*60*60*24));
                                      $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $years);
                                  }
                                  else
                                  {
                                      $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, '');
                                  }
                                 
                                $user_address = get_user_address($rec['ID']);
                                $user_country = array_column($user_address, 'CountryName');                                        
                                $objPHPExcel->getActiveSheet()->setCellValue('F'.$i, implode(",",$user_country));
                                $objPHPExcel->getActiveSheet()->setCellValue('G'.$i, date('m/d/Y',strtotime($rec['Graduation'])));                                   
                                $i++;
                            }
                          }
                          else if($years == '')
                          {
                              $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $rec['FirstName']);
                                 $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $rec['LastName']);
                                 $email=report_getEmailByIDD($rec['ID']); 
                                 $user_email = '';
                                 foreach($email as $e)
                                 {
                                     $whatIWant = substr($e['Email'], strpos($e['Email'], "@") + 1);    
                                     if($whatIWant == 'future.edu')
                                     {
                                       $user_email = $e['Email']; 
                                     }
                                 }
                                 if($user_email != '')
                                 {
                                    
                                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $user_email);
                                 }
                                 else
                                 {
                                    if(isset($email[0]['Email']))
                                    {
                                        $all_email = array_column($email, 'Email');
                                        $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, implode(",",$all_email));
                                        
                                    }
                                    
                                 }
                                 $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $rec['Sex']);
                                 
                                 if($rec['Birthdate'] != '')
                                  {
                                      $date1 = date('Y-m-d',strtotime($rec['Birthdate']));
                                      $date2 = date('Y-m-d');
                                      if($rec['Graduation'] != '' && $rec['Graduation'] != '0000-00-00'){
                                        $date2 =date('Y-m-d',strtotime($rec['Graduation']));
                                      }
                                      $diff = abs(strtotime($date2) - strtotime($date1));
                                       $years = floor($diff / (365*60*60*24));
                                      $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $years);
                                  }
                                  else
                                  {
                                      $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, '');
                                  }
                                 
                                $user_address = get_user_address($rec['ID']);
                                $user_country = array_column($user_address, 'CountryName');                                        
                                $objPHPExcel->getActiveSheet()->setCellValue('F'.$i, implode(",",$user_country));
                                $objPHPExcel->getActiveSheet()->setCellValue('G'.$i, date('m/d/Y',strtotime($rec['Graduation'])));                                   
                                $i++;
                          }
                    }
                    
                }
                
                
                
                                              
      
              }
   
        $i++;
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':B'.$i);
       
        
          $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, 'Ethnicity');
          
          $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':B'.$i)->applyFromArray($stil);
          $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
          $i++;
             $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Unknown");
              $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
             $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $unknown);
             $i++;
             
             
             $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "White");
             $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
             $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $white);
             $i++;
             
             $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Asian");
             $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
             $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $asian);
             $i++;
             
             
             $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Black/African American");
             $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
             $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $black);
             $i++;
             
             
             $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Hispanic/Latino");
             $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
             $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $hispanic);
             $i++;
             
             $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "American Indian");
             $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
             $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $native_american);
             $i++;
             
             $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Non-Resident Alien");
             $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
             $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $non_resient_alien);
             $i++;
             
             $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Native Hawaiian/Pacific Islander");
             $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
             $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $hawaiian);
             $i++;
             
             $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Two or more races");
             $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
             $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $two);
             $i++;
             
             $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Total Women");
              $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
             $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $unknown+$white+$asian+$black+$hispanic+$native_american+$non_resient_alien+$hawaiian+$two);
             $i++;
             
                     
        $i++;
         $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Men");
         
          $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
          $i++;
         
          if(!empty($men_records))
              {
                   $non_resient_alien = 0;
                   $hispanic = 0;
                   $native_american = 0;
                   $asian = 0;
                   $black = 0;
                   $hawaiian = 0;
                   $white=0;
                   $two=0 ;
                   $race = 0;
                   $unknown = 0;
                foreach($men_records as $rec)
                {
                   if($selected_age == '')
                   {
                       
                        if($rec['Birthdate'] != '')
                        {
                          $date1 = date('Y-m-d',strtotime($rec['Birthdate']));
                          $date2 = date('Y-m-d');
                          if($rec['Graduation'] != '' && $rec['Graduation'] != '0000-00-00'){
                              $date2 =date('Y-m-d',strtotime($rec['Graduation']));
                          }
                          $diff = abs(strtotime($date2) - strtotime($date1));
                           $years = floor($diff / (365*60*60*24));
                           
                           if($years<18 && $years>0)
                           {
                               $age_under_18 = $age_under_18+1;
                           }
                           if($years>17 && $years<25 )
                           {
                               $age_18_24 = $age_18_24+1;
                           }
                           if($years>24 && $years<40)
                           {
                              $age_25_39 = $age_25_39+1; 
                           }
                           if($years>39 )
                           {
                               $age_above_40 = $age_above_40+1;
                           }
                        }
                        else
                        {
                           $age_unknown = $age_unknown+1;
                        }
                       
                     $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $rec['FirstName']);
                     $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $rec['LastName']);
                     $email=report_getEmailByIDD($rec['ID']); 
                     $user_email = '';
                     foreach($email as $e)
                     {
                         $whatIWant = substr($e['Email'], strpos($e['Email'], "@") + 1);    
                         if($whatIWant == 'future.edu')
                         {
                           $user_email = $e['Email']; 
                         }
                     }
                     if($user_email != '')
                     {
                        
                        $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $user_email);
                     }
                     else
                     {
                        if(isset($email[0]['Email']))
                        {
                            $all_email = array_column($email, 'Email');
                            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, implode(",",$all_email));
                            
                        }
                        
                     }
                     $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $rec['Sex']);
                     
                     
                      if($rec['Birthdate'] != '')
                      { 
                          $date1 = date('Y-m-d',strtotime($rec['Birthdate']));
                          $date2 = date('Y-m-d');
                          if($rec['Graduation'] != '' && $rec['Graduation'] != '0000-00-00'){
                              $date2 =date('Y-m-d',strtotime($rec['Graduation']));
                          }
                          $diff = abs(strtotime($date2) - strtotime($date1));
                           $years = floor($diff / (365*60*60*24));
                          $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $years);
                      }
                      else
                      {
                          $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, '');
                      }
                     
                    $user_address = get_user_address($rec['ID']);
                    $user_country = array_column($user_address, 'CountryName');  
                    
                    $objPHPExcel->getActiveSheet()->setCellValue('F'.$i, implode(",",$user_country));
                    $objPHPExcel->getActiveSheet()->setCellValue('G'.$i, date('m/d/Y',strtotime($rec['Graduation']))); 
                    $objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $rec['Ethnicity']); 
                    
                    if($rec['Ethnicity'] == 'Unknown')
                   {
                      $unknown = $unknown+1; 
                   }
                   if($rec['Ethnicity'] == 'White')
                   {
                      $white = $white+1; 
                   }
                   if($rec['Ethnicity'] == 'Asian')
                   {
                      $asian = $asian+1; 
                   }
                   if($rec['Ethnicity'] == 'Black/African American')
                   {
                      $black = $black+1; 
                   }
                   if($rec['Ethnicity'] == 'Hispanic/Latino')
                   {
                      $hispanic = $hispanic+1; 
                   }
                   if($rec['Ethnicity'] == 'American Indian')
                   {
                      $native_american = $native_american+1; 
                   }
                   if($rec['Ethnicity'] == 'Non-Resident Alien')
                   {
                      $non_resient_alien = $non_resient_alien+1; 
                   }
                   if($rec['Ethnicity'] == 'Native Hawaiian/Pacific Islander')
                   {
                      $hawaiian = $hawaiian+1; 
                   }
                   if($rec['Ethnicity'] == 'Two or more races')
                   {
                      $two = $two+1; 
                   }
                    
                    
                    
                    $i++;
                   }
                   
                    else if($selected_age != '')
                    {
                        $years = '';
                          if($rec['Birthdate'] != '')
                          {
                              $date1 = date('Y-m-d',strtotime($rec['Birthdate']));
                              $date2 = date('Y-m-d');
                              if($rec['Graduation'] != '' && $rec['Graduation'] != '0000-00-00'){
                                $date2 =date('Y-m-d',strtotime($rec['Graduation']));
                              }
                              $diff = abs(strtotime($date2) - strtotime($date1));
                               $years = floor($diff / (365*60*60*24));
                          }
                          if($selected_age =='Under 18')
                          {
                             
                            if($years<18 && $years>0)
                            {
                                $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $rec['FirstName']);
                                 $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $rec['LastName']);
                                 $email=report_getEmailByIDD($rec['ID']); 
                                 $user_email = '';
                                 foreach($email as $e)
                                 {
                                     $whatIWant = substr($e['Email'], strpos($e['Email'], "@") + 1);    
                                     if($whatIWant == 'future.edu')
                                     {
                                       $user_email = $e['Email']; 
                                     }
                                 }
                                 if($user_email != '')
                                 {
                                    
                                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $user_email);
                                 }
                                 else
                                 {
                                    if(isset($email[0]['Email']))
                                    {
                                        $all_email = array_column($email, 'Email');
                                        $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, implode(",",$all_email));
                                        
                                    }
                                    
                                 }
                                 $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $rec['Sex']);
                                 
                                 if($rec['Birthdate'] != '')
                                  {
                                      $date1 = date('Y-m-d',strtotime($rec['Birthdate']));
                                      $date2 = date('Y-m-d');
                                      if($rec['Graduation'] != '' && $rec['Graduation'] != '0000-00-00'){
                                        $date2 =date('Y-m-d',strtotime($rec['Graduation']));
                                      }
                                      $diff = abs(strtotime($date2) - strtotime($date1));
                                       $years = floor($diff / (365*60*60*24));
                                      $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $years);
                                  }
                                  else
                                  {
                                      $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, '');
                                  }
                                 
                                $user_address = get_user_address($rec['ID']);
                                $user_country = array_column($user_address, 'CountryName');                                        
                                $objPHPExcel->getActiveSheet()->setCellValue('F'.$i, implode(",",$user_country));
                                $objPHPExcel->getActiveSheet()->setCellValue('G'.$i, date('m/d/Y',strtotime($rec['Graduation'])));                                   
                                $i++;
                            }
                          }
                          else if($selected_age =='18-24')
                          {
                            
                            if($years>17 && $years<25)
                            {
                                
                                $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $rec['FirstName']);
                                 $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $rec['LastName']);
                                 $email=report_getEmailByIDD($rec['ID']); 
                                 $user_email = '';
                                 foreach($email as $e)
                                 {
                                     $whatIWant = substr($e['Email'], strpos($e['Email'], "@") + 1);    
                                     if($whatIWant == 'future.edu')
                                     {
                                       $user_email = $e['Email']; 
                                     }
                                 }
                                 if($user_email != '')
                                 {
                                    
                                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $user_email);
                                 }
                                 else
                                 {
                                    if(isset($email[0]['Email']))
                                    {
                                        $all_email = array_column($email, 'Email');
                                        $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, implode(",",$all_email));
                                        
                                    }
                                    
                                 }
                                 $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $rec['Sex']);
                                 
                                 if($rec['Birthdate'] != '')
                                  {
                                      $date1 = date('Y-m-d',strtotime($rec['Birthdate']));
                                      $date2 = date('Y-m-d');
                                      if($rec['Graduation'] != '' && $rec['Graduation'] != '0000-00-00'){
                                        $date2 =date('Y-m-d',strtotime($rec['Graduation']));
                                      }
                                      $diff = abs(strtotime($date2) - strtotime($date1));
                                       $years = floor($diff / (365*60*60*24));
                                      $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $years);
                                  }
                                  else
                                  {
                                      $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, '');
                                  }
                                 
                                $user_address = get_user_address($rec['ID']);
                                $user_country = array_column($user_address, 'CountryName');                                        
                                $objPHPExcel->getActiveSheet()->setCellValue('F'.$i, implode(",",$user_country));
                                $objPHPExcel->getActiveSheet()->setCellValue('G'.$i, date('m/d/Y',strtotime($rec['Graduation'])));                                   
                                $i++;
                                
                            }
                          }
                          else if($selected_age =='25-39')
                          {
                            
                            if($years>24 && $years<40)
                            {
                                $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $rec['FirstName']);
                                 $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $rec['LastName']);
                                 $email=report_getEmailByIDD($rec['ID']); 
                                 $user_email = '';
                                 foreach($email as $e)
                                 {
                                     $whatIWant = substr($e['Email'], strpos($e['Email'], "@") + 1);    
                                     if($whatIWant == 'future.edu')
                                     {
                                       $user_email = $e['Email']; 
                                     }
                                 }
                                 if($user_email != '')
                                 {
                                    
                                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $user_email);
                                 }
                                 else
                                 {
                                    if(isset($email[0]['Email']))
                                    {
                                        $all_email = array_column($email, 'Email');
                                        $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, implode(",",$all_email));
                                        
                                    }
                                    
                                 }
                                 $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $rec['Sex']);
                                 
                                 if($rec['Birthdate'] != '')
                                  {
                                      $date1 = date('Y-m-d',strtotime($rec['Birthdate']));
                                      $date2 = date('Y-m-d');
                                      if($rec['Graduation'] != '' && $rec['Graduation'] != '0000-00-00'){
                                        $date2 =date('Y-m-d',strtotime($rec['Graduation']));
                                      }
                                      $diff = abs(strtotime($date2) - strtotime($date1));
                                       $years = floor($diff / (365*60*60*24));
                                      $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $years);
                                  }
                                  else
                                  {
                                      $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, '');
                                  }
                                 
                                $user_address = get_user_address($rec['ID']);
                                $user_country = array_column($user_address, 'CountryName');                                        
                                $objPHPExcel->getActiveSheet()->setCellValue('F'.$i, implode(",",$user_country));
                                $objPHPExcel->getActiveSheet()->setCellValue('G'.$i, date('m/d/Y',strtotime($rec['Graduation'])));                                   
                                $i++;
                            }
                          }
                          else if($selected_age =='40 and Above')
                          {
                            
                            if($years>39)
                            {
                                $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $rec['FirstName']);
                                 $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $rec['LastName']);
                                 $email=report_getEmailByIDD($rec['ID']); 
                                 $user_email = '';
                                 foreach($email as $e)
                                 {
                                     $whatIWant = substr($e['Email'], strpos($e['Email'], "@") + 1);    
                                     if($whatIWant == 'future.edu')
                                     {
                                       $user_email = $e['Email']; 
                                     }
                                 }
                                 if($user_email != '')
                                 {
                                    
                                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $user_email);
                                 }
                                 else
                                 {
                                    if(isset($email[0]['Email']))
                                    {
                                        $all_email = array_column($email, 'Email');
                                        $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, implode(",",$all_email));
                                        
                                    }
                                    
                                 }
                                 $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $rec['Sex']);
                                 
                                 if($rec['Birthdate'] != '')
                                  {
                                      $date1 = date('Y-m-d',strtotime($rec['Birthdate']));
                                      $date2 = date('Y-m-d');
                                      if($rec['Graduation'] != '' && $rec['Graduation'] != '0000-00-00'){
                                        $date2 =date('Y-m-d',strtotime($rec['Graduation']));
                                      }
                                      $diff = abs(strtotime($date2) - strtotime($date1));
                                       $years = floor($diff / (365*60*60*24));
                                      $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $years);
                                  }
                                  else
                                  {
                                      $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, '');
                                  }
                                 
                                $user_address = get_user_address($rec['ID']);
                                $user_country = array_column($user_address, 'CountryName');                                        
                                $objPHPExcel->getActiveSheet()->setCellValue('F'.$i, implode(",",$user_country));
                                $objPHPExcel->getActiveSheet()->setCellValue('G'.$i, date('m/d/Y',strtotime($rec['Graduation'])));                                   
                                $i++;
                            }
                          }
                          else if($years == '')
                          {
                              $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $rec['FirstName']);
                                 $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $rec['LastName']);
                                 $email=report_getEmailByIDD($rec['ID']); 
                                 $user_email = '';
                                 foreach($email as $e)
                                 {
                                     $whatIWant = substr($e['Email'], strpos($e['Email'], "@") + 1);    
                                     if($whatIWant == 'future.edu')
                                     {
                                       $user_email = $e['Email']; 
                                     }
                                 }
                                 if($user_email != '')
                                 {
                                    
                                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $user_email);
                                 }
                                 else
                                 {
                                    if(isset($email[0]['Email']))
                                    {
                                        $all_email = array_column($email, 'Email');
                                        $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, implode(",",$all_email));
                                        
                                    }
                                    
                                 }
                                 $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $rec['Sex']);
                                 
                                 if($rec['Birthdate'] != '')
                                  {
                                      $date1 = date('Y-m-d',strtotime($rec['Birthdate']));
                                      $date2 = date('Y-m-d');
                                      if($rec['Graduation'] != '' && $rec['Graduation'] != '0000-00-00'){
                                        $date2 =date('Y-m-d',strtotime($rec['Graduation']));
                                      }
                                      $diff = abs(strtotime($date2) - strtotime($date1));
                                       $years = floor($diff / (365*60*60*24));
                                      $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $years);
                                  }
                                  else
                                  {
                                      $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, '');
                                  }
                                 
                                $user_address = get_user_address($rec['ID']);
                                $user_country = array_column($user_address, 'CountryName');                                        
                                $objPHPExcel->getActiveSheet()->setCellValue('F'.$i, implode(",",$user_country));
                                $objPHPExcel->getActiveSheet()->setCellValue('G'.$i, date('m/d/Y',strtotime($rec['Graduation'])));                                   
                                $i++;
                          }
                    }
                    
                }
                
                
                
                                              
      
              }
   
        $i++;
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':B'.$i);
       
        
          $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, 'Ethnicity');
          
          $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':B'.$i)->applyFromArray($stil);
          $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
          $i++;
         $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Unknown");
          $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
         $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $unknown);
         $i++;
                 
                 
         $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "White");
         $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
         $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $white);
         $i++;
                 
         $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Asian");
         $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
         $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $asian);
         $i++;
                 
                 
         $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Black/African American");
         $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
         $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $black);
         $i++;
                 
                 
         $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Hispanic/Latino");
         $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
         $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $hispanic);
         $i++;
                 
         $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "American Indian");
         $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
         $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $native_american);
         $i++;
                 
         $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Non-Resident Alien");
         $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
         $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $non_resient_alien);
         $i++;
         
         $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Native Hawaiian/Pacific Islander");
         $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
         $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $hawaiian);
         $i++;
         
         $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Two or more races");
         $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
         $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $two);
         $i++;
         
         $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Total Men");
          $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
         $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $unknown+$white+$asian+$black+$hispanic+$native_american+$non_resient_alien+$hawaiian+$two);
         $i++;
         
         
         
         
         
         	$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':B'.$i);
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, 'Age Group');
             $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':B'.$i)->applyFromArray($stil);
            $i++;
            
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Under 18");
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $age_under_18);
            $i++;
             
             
             $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "18-24");
             $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
             $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $age_18_24);
             $i++;
             
             $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "25-39");
             $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
             $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $age_25_39);
             $i++;
             
             
             $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "40 and above");
             $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
             $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $age_above_40);
             $i++;
             
             
             $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Age Unknown");
             $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
             $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $age_unknown);
             $i++;
             
             $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, "Total");
             $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':A'.$i)->getFont()->setBold(true);
             $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $age_under_18+$age_18_24+$age_25_39+$age_above_40+$age_unknown);
             $i++;
             
                     
        
       
       
        $filename="completion_report".date('m/d/Y').".xls";
       
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$filename);
        $objWriter->save('php://output');
    
    ?>

