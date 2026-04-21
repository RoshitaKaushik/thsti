 <!--div class="filter-sub-menu-outer-box">
<li class="dropdown hidden-xs tag_li">


<ul class="dropdown-menu dropdown-menu-lg tag_ul">
    <li class="text-center notifi-title">Tags</li>
    <li class="list-group">
        <div class="col-sm-12 filter_category"> 
                
        <div class="checkbox checkbox-success checknox-list Foundation_div" <?php if(isset($group[0]['Foundation']) && $group[0]['Foundation']==1) echo 'style="display:none;"' ?>>
		    <button class="themeBtn_new Foundation_button_modal" rel_name="Foundation">Grantmaker Affiliate</button>
            
		</div> 
		
		<div class="checkbox checkbox-success checknox-list Media_div" <?php if(isset($group[0]['Media']) && $group[0]['Media']==1) echo 'style="display:none"' ?>>
			<button class="themeBtn_new Media_button_modal" rel_name="Media">Media</button>
            
		</div> 	
    		
    	<div class="checkbox checkbox-success checknox-list Appalachian_div" <?php if(isset($group[0]['Appalachian']) && $group[0]['Appalachian']==1) echo 'style="display:none"' ?>>
			<button class="themeBtn_new Appalachian_button_modal" rel_name="Appalachian">Appalachian Program </button>
            
		</div> 
		
		<div class="checkbox checkbox-success checknox-list BoardMember_div" <?php if(isset($group[0]['BoardMember']) && $group[0]['BoardMember']==1) echo 'style="display:none"' ?>>
			<button class="themeBtn_new BoardMember_button_modal" rel_name="BoardMember">Past & Present Board Members</button>
		</div> 
		
		<div class="checkbox checkbox-success checknox-list FacultyStaff_div" <?php if((isset($group[0]['FacultyStaff']) && $group[0]['FacultyStaff']==1)) echo 'style="display:none"' ?>>
			<button class="themeBtn_new FacultyStaff_button_modal" rel_name="FacultyStaff">Past & Present Faculty & Staff</button>
		</div> 
		
		<div class="checkbox checkbox-success checknox-list StudentFamily_div" <?php if(isset($group[0]['StudentFamily']) && $group[0]['StudentFamily']==1) echo 'style="display:none"' ?>>
			<button class="themeBtn_new StudentFamily_button_modal" rel_name="StudentFamily">Past & Present Student Family</button>
		</div> 
    	
    	<div class="checkbox checkbox-success checknox-list AnnualReport_div" <?php if(isset($group[0]['AnnualReport']) && $group[0]['AnnualReport']==1) echo 'style="display:none"' ?>>
        	<button class="themeBtn_new AnnualReport_button_modal" rel_name="AnnualReport">Receives Printed Annual Report</button>
        </div> 
		
		<div class="checkbox checkbox-success checknox-list DanielVIP_div" <?php if(isset($group[0]['DanielVIP']) && $group[0]['DanielVIP']==1) echo 'style="display:none"' ?>>
        	<button class="themeBtn_new DanielVIP_button_modal" rel_name="DanielVIP">VIP</button>
        </div>
		
        <div class="checkbox checkbox-success checknox-list FriendofDaniel_div" <?php if(isset($group[0]['FriendofDaniel']) && $group[0]['FriendofDaniel']==1) echo 'style="display:none"' ?>>	
        	<button class="themeBtn_new FriendofDaniel_button_modal" rel_name="FriendofDaniel">Friend of Daniel/ Not VIP</button>
        </div> 
		
		
		<div class="checkbox checkbox-success checknox-list DanielPermissionNeeded_div" <?php if(isset($group[0]['DanielPermissionNeeded']) && $group[0]['DanielPermissionNeeded']==1) echo 'style="display:none"' ?>>
			<button class="themeBtn_new DanielPermissionNeeded_button_modal" rel_name="DanielPermissionNeeded">Need Daniel Permission to Contact</button>
		</div> 

		<div class="checkbox checkbox-success checknox-list GraduationInvite_div" <?php if(isset($group[0]['GraduationInvite']) && $group[0]['GraduationInvite']==1) echo 'style="display:none"' ?>>
			<button class="themeBtn_new GraduationInvite_button_modal" rel_name="GraduationInvite">Send Graduation Invitation</button>
		</div>

		<div class="checkbox checkbox-success checknox-list QuarterCenturyReport_div" <?php if(isset($_SESSION['role']) && $_SESSION['role'] != '1'){ echo "style='background: #d9d8d8;'"; }  if(isset($group[0]['QuarterCenturyReport']) && $group[0]['QuarterCenturyReport']==1) echo 'style="display:none"' ?> >
			<button class="themeBtn_new QuarterCenturyReport_button_modal" rel_name="QuarterCenturyReport">Received Quarter Century Report</button>
		</div> 

		

		<div class="checkbox checkbox-success checknox-list Deceased_div" <?php if(isset($student_information['Deceased']) && $student_information['Deceased']==1) echo 'style="display:none"' ?> >
			<button class="themeBtn_new Deceased_button_modal" rel_name="Deceased">Deceased</button>
		</div> 
		
		<div class="checkbox checkbox-success checknox-list Vista_div" <?php  if(isset($group[0]['Vista']) && $group[0]['Vista']==1) echo 'style="display:none"' ?> >
			<button class="themeBtn_new Vista_button_modal" rel_name="Vista">Vista</button>
		</div>
		
	
                              
        </div> 
    </li>
</ul>
</li>
</div-->





<span class='help' data-keyboard="false" data-backdrop="static">
	<p><a><i class="fa fa-plus"></i></a></p>
	   <div class='pop'>
		   <div class='close close_pop_out'><a>X</a></div>
		      <p>      
   <div class="col-sm-12">  		
	      		
		<!--div class="checkbox checkbox-success checknox-list Donor_div" <?php if((isset($group[0]['Donor']) && $group[0]['Donor']==1) || ! $donor_status ) echo 'style="display:none;"' ?>>
		
			<button class="themeBtn_new Donor_button_modal" rel_name="Donor" >Donor</button>
		</div--> 
		
		<div class="checkbox checkbox-success checknox-list Foundation_div" <?php if(isset($group[0]['Foundation']) && $group[0]['Foundation']==1) echo 'style="display:none;"' ?>>
			<!--input class="role_check" value="1" type="checkbox" name="Foundation" >
			<label> Grantmaker Affiliate </label-->
		    <button class="themeBtn_new Foundation_button_modal" rel_name="Foundation">Grantmaker Affiliate</button>
            
		</div> 
		
		<div class="checkbox checkbox-success checknox-list Media_div" <?php if(isset($group[0]['Media']) && $group[0]['Media']==1) echo 'style="display:none"' ?>>
			<!--input class="role_check" value="1" type="checkbox" name="Media" <?php if(isset($group[0]['Media']) && $group[0]['Media']==1) echo 'checked' ?> >
			<label> Media </label-->
			<button class="themeBtn_new Media_button_modal" rel_name="Media">Media</button>
            
		</div> 	
    		
    	<div class="checkbox checkbox-success checknox-list Appalachian_div" <?php if(isset($group[0]['Appalachian']) && $group[0]['Appalachian']==1) echo 'style="display:none"' ?>>
			<!--input class="role_check" value="1" type="checkbox" name="Appalachian" <?php if(isset($group[0]['Appalachian']) && $group[0]['Appalachian']==1) echo 'checked' ?> >
			<label> Appalachian Program </label-->
			<button class="themeBtn_new Appalachian_button_modal" rel_name="Appalachian">Appalachian Program </button>
            
		</div> 
		
		<div class="checkbox checkbox-success checknox-list BoardMember_div" <?php if(isset($group[0]['BoardMember']) && $group[0]['BoardMember']==1) echo 'style="display:none"' ?>>
			<!--input class="checked_on role_check" val$ref_countue="1" type="checkbox" name="BoardMember" <?php if(isset($group[0]['BoardMember']) && $group[0]['BoardMember']==1) echo 'checked' ?> >
			<label> Past & Present Board Members </label-->
			<button class="themeBtn_new BoardMember_button_modal" rel_name="BoardMember">Past & Present Board Members</button>
		</div> 
		
		<div class="checkbox checkbox-success checknox-list FacultyStaff_div" <?php if((isset($group[0]['FacultyStaff']) && $group[0]['FacultyStaff']==1) || ! $fac_status) echo 'style="display:none"' ?>>
			<!--input class="checked_on role_check" value="1" type="checkbox" name="FacultyStaff" <?php if(isset($group[0]['FacultyStaff']) && $group[0]['FacultyStaff']==1) echo 'checked' ?> >
			<label> Past & Present Faculty & Staff </label-->
			<button class="themeBtn_new FacultyStaff_button_modal" rel_name="FacultyStaff">Past & Present Faculty & Staff</button>
		</div> 
		
		<div class="checkbox checkbox-success checknox-list StudentFamily_div" <?php if(isset($group[0]['StudentFamily']) && $group[0]['StudentFamily']==1) echo 'style="display:none"' ?>>
			<!--input class="role_check" value=div"1" type="checkbox" name="StudentFamily" <?php if(isset($group[0]['StudentFamily']) && $group[0]['StudentFamily']==1) echo 'checked' ?> >
			<label>  Past & Present Student Family</label-->
			<button class="themeBtn_new StudentFamily_button_modal" rel_name="StudentFamily">Past & Present Student Family</button>
            
		</div> 
    	
    	<div class="checkbox checkbox-success checknox-list AnnualReport_div" <?php if(isset($group[0]['AnnualReport']) && $group[0]['AnnualReport']==1) echo 'style="display:none"' ?>>
        			<!--input class="role_check" value="1" type="checkbox" name="AnnualReport" <?php if(isset($group[0]['AnnualReport']) && $group[0]['AnnualReport']==1) echo 'checked' ?> >
        			<label> Receives Printed Annual Report </label-->
        			<!--<button class="themeBtn_new AnnualReport_button_modal" rel_name="AnnualReport">Receives Printed Annual Report</button>-->
            
        		</div> 
		
		<div class="checkbox checkbox-success checknox-list DanielVIP_div" <?php if(isset($group[0]['DanielVIP']) && $group[0]['DanielVIP']==1) echo 'style="display:none"' ?>>
        			<!--input class="role_check" value="1" type="checkbox" name="DanielVIP" <?php if(isset($group[0]['DanielVIP']) && $group[0]['DanielVIP']==1) echo 'checked' ?> >
        			<label> Daniel / VIP </label-->
        			<button class="themeBtn_new DanielVIP_button_modal" rel_name="DanielVIP">VIP</button>
            
        		</div>
		
        <div class="checkbox checkbox-success checknox-list FriendofDaniel_div" <?php if(isset($group[0]['FriendofDaniel']) && $group[0]['FriendofDaniel']==1) echo 'style="display:none"' ?>>
        			<!--input class="role_check" value="1" type="checkbox" name="FriendofDaniel" <?php if(isset($group[0]['FriendofDaniel']) && $group[0]['FriendofDaniel']==1) echo 'checked' ?> >
        			<label> Friend of Daniel/ Not VIP </label-->
        			 <button class="themeBtn_new FriendofDaniel_button_modal" rel_name="FriendofDaniel">Friend of Daniel/ Not VIP</button>
        		</div> 
		
		
		<!--div class="checkbox checkbox-success checknox-list DanielPermissionNeeded_div" <?php if(isset($group[0]['DanielPermissionNeeded']) && $group[0]['DanielPermissionNeeded']==1) echo 'style="display:none"' ?>>
			<input class="role_check" value="1" type="checkbox" name="DanielPermissionNeeded" <?php if(isset($group[0]['DanielPermissionNeeded']) && $group[0]['DanielPermissionNeeded']==1) echo 'checked' ?> >
			<label> Need Daniel's Permission to Contact </label>
			<button class="themeBtn_new DanielPermissionNeeded_button_modal" rel_name="DanielPermissionNeeded">Need Daniel Permission to Contact</button>>
    
		</div--> 

		<!--div class="checkbox checkbox-success checknox-list GraduationInvite_div" <?php if(isset($group[0]['GraduationInvite']) && $group[0]['GraduationInvite']==1) echo 'style="display:none"' ?>>
			<input class="role_check" value="1" type="checkbox" name="GraduationInvite" <?php if(isset($group[0]['GraduationInvite']) && $group[0]['GraduationInvite']==1) echo 'checked' ?> >
			<label> Send Graduation Invitation </label>
			<button class="themeBtn_new GraduationInvite_button_modal" rel_name="GraduationInvite">Send Graduation Invitation</button>
		</div -->

		<!--div class="checkbox checkbox-success checknox-list QuarterCenturyReport_div" <?php if(isset($_SESSION['role']) && $_SESSION['role'] != '1'){ echo "style='background: #d9d8d8;'"; }  if(isset($group[0]['QuarterCenturyReport']) && $group[0]['QuarterCenturyReport']==1) echo 'style="display:none"' ?> >
			<input class="checked_on role_check" <?php if( isset($_SESSION['role']) && $_SESSION['role'] != '1'){ echo "style='pointer-events:none;'"; } ?> value="1" type="checkbox" name="QuarterCenturyReport" <?php if(isset($group[0]['QuarterCenturyReport']) && $group[0]['QuarterCenturyReport']==1) echo 'checked' ?> >
			<label>  Received Quarter Century Report </label>
			<button class="themeBtn_new QuarterCenturyReport_button_modal" rel_name="QuarterCenturyReport">Received Quarter Century Report</button>
		</div --> 

		<!--div class="checkbox checkbox-success checknox-list Unsubscribed_div" <?php if(isset($group[0]['Unsubscribed']) && $group[0]['Unsubscribed']==1) echo 'style="display:none"' ?>>
			<input class="role_check" value="1" type="checkbox" name="Unsubscribed" <?php if(isset($group[0]['Unsubscribed']) && $group[0]['Unsubscribed']==1) echo 'checked' ?> >
			<label> Do Not Email </label>
			<button class="themeBtn_new Unsubscribed_button_modal" rel_name="Unsubscribed">Do Not Email</button>
    
		</div--> 

		<div class="checkbox checkbox-success checknox-list Deceased_div" <?php if(isset($student_information['Deceased']) && $student_information['Deceased']==1) echo 'style="display:none"' ?> >
			<!--input class="role_check" value="1" type="checkbox" name="Deceased" <?php if(isset($infos['Deceased']) && $infos['Deceased']==1) echo 'checked' ?> >
			<label> Deceased </label-->
			<button class="themeBtn_new Deceased_button_modal" rel_name="Deceased">Deceased</button>
		</div> 
		
		<div class="checkbox checkbox-success checknox-list Vista_div" <?php  if(isset($group[0]['Vista']) && $group[0]['Vista']==1) echo 'style="display:none"' ?> >
			<!--input class="checked_on role_check" <?php if(isset($_SESSION['role']) && $_SESSION['role'] != '1'){ echo "style='pointer-events:none;'"; } ?> value="1" type="checkbox" name="QuarterCenturyReport" <?php if(isset($group[0]['QuarterCenturyReport']) && $group[0]['QuarterCenturyReport']==1) echo 'checked' ?> >
			<label>  Received Quarter Century Report </label-->
			<button class="themeBtn_new Vista_button_modal" rel_name="Vista">Vista</button>
		</div> 
		
		 <!--start FW: Mailchimp Audience Export Complete-->
		<div class="checkbox checkbox-success checknox-list ProspectiveStudent_div" <?php  if(isset($group[0]['ProspectiveStudent']) && $group[0]['ProspectiveStudent']==1) echo 'style="display:none"' ?> >
			<button class="themeBtn_new ProspectiveStudent_button_modal" rel_name="ProspectiveStudent">Potential Student</button>
		</div> 
		
		<div class="checkbox checkbox-success checknox-list ProspectiveDonor_div" <?php  if(isset($group[0]['prospective_donor']) && $group[0]['prospective_donor']==1) echo 'style="display:none"' ?> >
			<button class="themeBtn_new ProspectiveDonor_button_modal" rel_name="prospective_donor">Potential Donor</button>
		</div> 
		<!--End FW: Mailchimp Audience Export Complete-->
		
		<!-- Start Add New tag Fwd: Priority Item - Need some new tags 08-Feb-2024 -->
		
        <div class="checkbox checkbox-success checknox-list TribalCollege_div" <?php if(isset($group[0]['tribal_college']) && $group[0]['tribal_college']==1) echo 'style="display:none"' ?>>
        	 <button class="themeBtn_new TribalCollege_button_modal" rel_name="tribal_college">Tribal College</button>
        </div> 
		<div class="checkbox checkbox-success checknox-list HBCU_div" <?php if(isset($group[0]['hbcu']) && $group[0]['hbcu']==1) echo 'style="display:none"' ?>>
        	 <button class="themeBtn_new HBCU_button_modal" rel_name="hbcu">HBCU</button>
        </div> 
        <div class="checkbox checkbox-success checknox-list WVCollege_div" <?php if(isset($group[0]['wv_college']) && $group[0]['wv_college']==1) echo 'style="display:none"' ?>>
        	 <button class="themeBtn_new WVCollege_button_modal" rel_name="wv_college">WV College</button>
        </div> 
        <div class="checkbox checkbox-success checknox-list AppalachiaCollege_div" <?php if(isset($group[0]['appalachia_college']) && $group[0]['appalachia_college']==1) echo 'style="display:none"' ?>>
        	 <button class="themeBtn_new AppalachiaCollege_button_modal" rel_name="appalachia_college">Appalachia College</button>
        </div> 
        <div class="checkbox checkbox-success checknox-list USCollege_div" <?php if(isset($group[0]['us_college']) && $group[0]['us_college']==1) echo 'style="display:none"' ?>>
        	 <button class="themeBtn_new USCollege_button_modal" rel_name="us_college">US College</button>
        </div>
        <div class="checkbox checkbox-success checknox-list AmeriCorps_div" <?php if(isset($group[0]['americorps']) && $group[0]['americorps']==1) echo 'style="display:none"' ?>>
        	 <button class="themeBtn_new AmeriCorps_button_modal" rel_name="americorps">AmeriCorps</button>
        </div>
        
        <div class="checkbox checkbox-success checknox-list PeaceCorps_div" <?php if(isset($group[0]['peacecorps']) && $group[0]['peacecorps']==1) echo 'style="display:none"' ?>>
        	 <button class="themeBtn_new PeaceCorps_button_modal" rel_name="peacecorps">Peace Corps</button>
        </div>
        
		<!-- End Add New tag Fwd: Priority Item - Need some new tags 08-Feb-2024 -->
		
		<!-- Start  Fwd: Database question 08-Feb-2024 -->
		<div class="checkbox checkbox-success checknox-list AcctHold_div" <?php if(isset($group[0]['accthold']) && $group[0]['accthold']==1) echo 'style="display:none"' ?>>
        	 <button class="themeBtn_new AcctHold_button_modal" rel_name="accthold">Acct Hold</button>
        </div>
		<!-- End  Fwd: Database question 08-Feb-2024 -->
	`
	       	
	   
	<div class="clearfix"></div>
</div>     
 </p>
</div>     
</span>
        