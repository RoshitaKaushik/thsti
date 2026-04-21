<?php

/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 |
 | This defines the default Namespace that is used throughout
 | CodeIgniter to refer to the Application directory. Change
 | this constant to change the namespace that all application
 | classes should use.
 |
 | NOTE: changing this will require manually modifying the
 | existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
 | --------------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2_592_000);
defined('YEAR')   || define('YEAR', 31_536_000);
defined('DECADE') || define('DECADE', 315_360_000);

/*
 | --------------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------------
 |
 | Used to indicate the conditions under which the script is exit()ing.
 | While there is no universal standard for error codes, there are some
 | broad conventions.  Three such conventions are mentioned below, for
 | those who wish to make use of them.  The CodeIgniter defaults were
 | chosen for the least overlap with these conventions, while still
 | leaving room for others to be defined in future versions and user
 | applications.
 |
 | The three main conventions used for determining exit status codes
 | are as follows:
 |
 |    Standard C/C++ Library (stdlibc):
 |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 |       (This link also contains other GNU-specific conventions)
 |    BSD sysexits.h:
 |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 |    Bash scripting:
 |       http://tldp.org/LDP/abs/html/exitcodes.html
 |
 */
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0);        // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1);          // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3);         // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4);   // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5);  // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7);     // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8);       // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9);      // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125);    // highest automatically-assigned error code

//API Constants

define('NO_RECORD_CODE', '204'); 
define('SUCCESS_CODE', '200'); 
define('BAD_REQUEST_CODE', '400'); 
define('EXCEPTION_CODE', '500'); 
define('ATTEMPT_COUNT', TRUE); 

define('doc_url', $_SERVER['DOCUMENT_ROOT'].'/');  
$current_year=date('Y');

define('FIX_PASSWORD', '1234567891'); 
define('viewKheloIndia', ''); 
define('viewNSF', ''); 
define('viewHRDS', 'frontend/hrds_list'); 
define('viewDhyanChandAward', ''); 
define('viewDronacharyaAward', ''); 
define('viewSAI', ''); 
define('viewNWF', ''); 
define('viewNSDF', ''); 
define('viewSpecialAward', ''); 
define('viewPension', ''); 
define('viewArjunaAwards ', ''); 
define('viewRGKRA', ''); 
define('viewRKPP', ''); 
define('viewLNIPE', '');
 
define('NSDF_SCHEME_ID', 7); 
define('NSDF_COMPONENT_ID', 9); //get from mst_scheme_component
define('SPECIAL_AWARD_SCHEME_ID', 10); 
define('SPECIAL_AWARD_COMPONENT_ID', 7);
define('HRDS_SCHEME_ID', 3); 
define('HRDS_COMPONENT_FELLOWSHIP_ID', 1); 
define('PENSION_SCHEME_ID', 11); 
define('PENSION_COMPONENT_ID', 8);
define('HRDS_PARTICIPATION_OVERSEAS_SCHEME_ID',3);
define('HRDS_COMPONENT_PARTICIPATION_OVERSEAS_ID',2);
define('HRDS_PARTICIPATION_SEMINAR_INDIA_SCHEME_ID',3);
define('HRDS_PARTICIPATION_SEMINAR_INDIA_COMPONENT_ID',57);
define('ARJUN_AWARD_SCHEME_ID',12);
define('ARJUN_AWARD_COMPONENT_ID',15);
define('NWF_SCHEME_ID',8);
define('NWF_COMPONENT_ID',12);


define('DHYAN_CHAND_AWARD_SCHEME_ID',4);
define('DHYAN_CHAND_AWARD_COMPONENT_ID',14);
define('RAJIV_GANDHI_KHEL_RATNA_AWARD_SCHEME_ID',13);
define('RAJIV_GANDHI_KHEL_RATNA_AWARD_COMPONENT_ID',11);
define('DOBYEAR',7);  // define for show date of birth value from 7 year minus from given date.
define('DRONACHARYA_AWARD_SCHEME_ID',5);
define('DRONACHARYA_AWARD_COMPONENT_ID',13);
define('ACHIEVEMENTSTARTYEAR',1940);  //used for achievemnt year start with and less current year
define('CURRENTYEAR',$current_year); // used for get current year value for string.
define('ACHIEVEMENTYEAR',7);         //achievent year shold be 7 year plus from date of birth.
define('LAST_DIGIT_COUNT',4); // used for format string and show last four digit
define('FORMAT_TYPE','X');   // used for show format of account number like as XXXXXXXXXX6543
define('HRDS_HOLDING_COUNTRY_SCHEME_ID',3);
define('HRDS_HOLDING_COUNTRY_COMPONENT_ID',55);
define('HRDS_PUBLICATION_SCHEME_ID',3);
define('HRDS_PUBLICATION_COMPONENT_ID',4);
define('HRDS_ASSISTANCE_SUPPORTING_PERSONNEL_SCEME_ID',3);
define('HRDS_ASSISTANCE_SUPPORTING_PERSONNEL_COMPONENT_ID',6);
define('HRDS_RESEARCH_SCHEME_ID',3);
define('HRDS_RESEARCH_COMPONENT_ID',3);
define('LNIPE_SCHEME_ID',15);
define('LNIPE_SCHEME_COMPONENT_ID',40);
define('ANNEXURE_MSG','Download annexure for upload file');

define('parent_form_field_id1',5); // 5 for heading 
define('PDF_NOTES',"All documents must be in PDF, document size not exceed 5MB");
define('USER_IMAGE_NOTES',"Image should be in JPEG/PNG/JPG & size not exceed 250 KB");
define('USER_SIGNATURE_NOTES',"Signature should be in JPEG/PNG/JPG & size not exceed 250 KB");


// PFMS CONSTANTS 
define('SSID','0045'); // Source System ID
define('BENEFICIARY_LOCATION_UPLOAD',"/var/www/html/sports.1akal.in/public_html/CPSMS/".SSID."/BeneficiaryData/ToCPSMS");
define('BENEFICIARY_LOCATION_DOWNLOAD',"/var/www/html/sports.1akal.in/public_html/CPSMS/".SSID."/BeneficiaryData/FromCPSMS");
define('BEN_PAYMENT_LOCATION_UPLOAD',"/var/www/html/sports.1akal.in/public_html/CPSMS/".SSID."/PaymentData/ToCPSMS");
define('BEN_PAYMENT_LOCATION_DOWNLOAD',"/var/www/html/sports.1akal.in/public_html/CPSMS/".SSID."/PaymentData/FromCPSMS");
