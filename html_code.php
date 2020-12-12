<?php
session_start();
 include 'db_connection.php'; 
include 'model.php';
// get the method name sent in ajax and call it for relevanat data
$html_generate = new html_generate(); 
$method_name = $_POST['method_name'];


if(isset($_POST['course_id']) && $_POST['course_id'] !=''){
  $course_id = $_POST['course_id']; 
  $html_generate->$method_name($course_id,$model_obj);
}else{
   
    $html_generate->$method_name($model_obj);
}


//create object 
class html_generate{

function get_time_slots($course_id,$model_obj){
    $timeslot_btn="";
    $trial_date = $_POST['trial_date'];
    $course_id = $_POST['course_id'];
	
	/*student booking slots */
	$studentslot= array();
	$studentslots = $model_obj->get_booking_trial_slot($course_id);

    if(!empty($studentslots)){
		while($studentrowslot = $studentslots->fetch_assoc()){
				$studentslot[]=$studentrowslot['time_slot'];   
		}
	}
    $result= $model_obj->get_trial_time_slots($course_id,$trial_date);
    $timeslot_btn.='<div class="booking-slots">';
	
    if (!empty($result)){
        while($row = $result->fetch_assoc()) { 
		
            $id=$row['trial_time_slot_id'];
            $timeslots_for_this_date =unserialize($row['trial_time_slots']);
            
            if($timeslots_for_this_date['slotone_start'] !='' && $timeslots_for_this_date['slotone_end'] != ''){
                
                $slot1="'PST ".$timeslots_for_this_date['slotone_start'].' - PST '.$timeslots_for_this_date['slotone_end']."'";
				if(! in_array($slot1,$studentslot)){
					 $timeslot_btn.='<button class="site-btn time_slot_btn" onclick="fetch_form('.$course_id.','.$id.','.$slot1.')">'.trim($slot1,"'").'</button>';
				}
                
            }
            
            
            if($timeslots_for_this_date['slottwo_start'] !='' && $timeslots_for_this_date['slottwo_end'] != ''){
                
                $slot2="'PST ".$timeslots_for_this_date['slottwo_start'].' - PST '.$timeslots_for_this_date['slottwo_end']."'";
				if(! in_array($slot2,$studentslot)){
					$timeslot_btn.='<button class="site-btn time_slot_btn" onclick="fetch_form('.$course_id.','.$id.','.$slot2.')">'.trim($slot2,"'").'</button>';
				}
            }
            
            
            if($timeslots_for_this_date['slotthree_start'] !='' && $timeslots_for_this_date['slotthree_end'] != ''){
                
                $slot3="'PST ".$timeslots_for_this_date['slotthree_start'].' - PST '.$timeslots_for_this_date['slotthree_end']."'";
				if(! in_array($slot3,$studentslot)){
					$timeslot_btn.='<button class="site-btn time_slot_btn" onclick="fetch_form('.$course_id.','.$id.','.$slot3.')">'.trim($slot3,"'").'</button>';
				}
            }
            
            
            if($timeslots_for_this_date['slotfour_start'] !='' && $timeslots_for_this_date['slotfour_end'] != ''){
                
                $slot4="'PST ".$timeslots_for_this_date['slotfour_start'].' - PST '.$timeslots_for_this_date['slotfour_end']."'";
				if(! in_array($slot4,$studentslot)){
					$timeslot_btn.='<button class="site-btn time_slot_btn" onclick="fetch_form('.$course_id.','.$id.','.$slot4.')">'.trim($slot4,"'").'</button>';
				}
            }
            
            
            if($timeslots_for_this_date['slotfive_start'] !='' && $timeslots_for_this_date['slotfive_end'] != ''){
                
                $slot5="'PST ".$timeslots_for_this_date['slotfive_start'].' - PST '.$timeslots_for_this_date['slotfive_end']."'";
				if(! in_array($slot5,$studentslot)){
					$timeslot_btn.='<button class="site-btn time_slot_btn" onclick="fetch_form('.$course_id.','.$id.','.$slot5.')">'.trim($slot5,"'").'</button>';
				}
            }
            
            
        }
    }
    
     $timeslot_btn.='</div><div class="tncchk"><input type="checkbox" id="tnc_chk" name="tnc" required >I agree to the <a href="terms_and_conditions.php">Terms and Conditions </a> and <a href="privacy_policy.php"> Privacy Policy </a>.</div><span id="tnc_err"></span>';
     $timeslot_btn.='<br><button type="button" id="trial_submit" class="contact-btn btn ct-proceed" >Submit</button>';
    echo $timeslot_btn;
}

function create_form($course_id,$model_obj){
   
    
      $time_slot_id = $_POST['time_slot_id'];
      $time_slot = $_POST['time_slot'];
      $res= $model_obj->insert_trial_data($course_id,$time_slot_id,$time_slot);
      if($res == true){
      $result= $model_obj->get_trial_details($time_slot_id);
      
      if (!empty($result)){
        $row = $result->fetch_assoc();
      $course= $row['course_name']; 
       $trial_date= $row['trial_date']; 
       $new_date=date("d M, Y", strtotime($trial_date));
       $day=date("d", strtotime($trial_date));
       $month=date("M", strtotime($trial_date));
       $year=date("Y", strtotime($trial_date));
      $bookinform='';
      $bookinform.='<div class="booking-slip" style="background: #fff;padding:30px;"><div class="slip-content"><span><strong style="color:#0BC560;">Hi.. '.$_SESSION['lms_name'].'</strong></span>';
      $bookinform.='<p>Congratulations! Your registration is confirmed!</p>';
      $bookinform.='<p>You’ve successfully completed registration for <strong style="color:#0BC560;">Free Trial</strong> for '.$course.'.</p>';
      $bookinform.='<p>Date: '.$new_date.'</p>';
      $bookinform.='<p>Timing: '.$time_slot.'</p>';
      $bookinform.='<p>Thanks</p>';
      $bookinform.='<p><br><a href="courses.php" class="btn btn-white">View Our More Categories</a></p>';
      $bookinform.='</div>';
      
	  $bookinform.='</div>';
      echo $bookinform;
      
      } 
      
        
      $to_student = $_SESSION['lms_email'];
      $subject_student = "Welcome To Excellence Academy of Indian Music.";
    
    //   $message = file_get_contents("email_templates/email_template.php"); 

    //   echo $message; exit;
    //   $message_student =  $bookinform;

      $emailtmp='';
      $emailtmp.='<!doctype html><html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head> <!--[if gte mso 15]> <xml> <o:OfficeDocumentSettings> <o:AllowPNG/> <o:PixelsPerInch>96</o:PixelsPerInch> </o:OfficeDocumentSettings> </xml> <![endif]--><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><title>*|MC:SUBJECT|*</title><style type="text/css">p{margin:10px 0;padding:0}table{border-collapse:collapse}h1,h2,h3,h4,h5,h6{display:block;margin:0;padding:0}img,a img{border:0;height:auto;outline:none;text-decoration:none}body,#bodyTable,#bodyCell{height:100%;margin:0;padding:0;width:100%}.mcnPreviewText{display:none !important}#outlook a{padding:0}img{-ms-interpolation-mode:bicubic}table{mso-table-lspace:0pt;mso-table-rspace:0pt}.ReadMsgBody{width:100%}.ExternalClass{width:100%}p,a,li,td,blockquote{mso-line-height-rule:exactly}a[href^=tel],a[href^=sms]{color:inherit;cursor:default;text-decoration:none}p,a,li,td,body,table,blockquote{-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}.ExternalClass,.ExternalClass p,.ExternalClass td,.ExternalClass div,.ExternalClass span,.ExternalClass font{line-height:100%}a[x-apple-data-detectors]{color:inherit !important;text-decoration:none !important;font-size:inherit !important;font-family:inherit !important;font-weight:inherit !important;line-height:inherit !important}#bodyCell{padding:10px}.templateContainer{max-width:600px !important}a.mcnButton{display:block}.mcnImage,.mcnRetinaImage{vertical-align:bottom}.mcnTextContent{word-break:break-word}.mcnTextContent img{height:auto !important}.mcnDividerBlock{table-layout:fixed !important}body,#bodyTable{background-color:#da3a3a}#bodyCell{border-top:0}.templateContainer{border:5px solid #FFF}h1{color:#B2B2B2;font-family:Helvetica;font-size:30px;font-style:normal;font-weight:bold;line-height:100%;letter-spacing:normal;text-align:left}h2{color:#303030;font-family:Helvetica;font-size:22px;font-style:normal;font-weight:bold;line-height:125%;letter-spacing:normal;text-align:left}h3{color:#303030;font-family:Helvetica;font-size:16px;font-style:normal;font-weight:bold;line-height:125%;letter-spacing:normal;text-align:left}h4{color:#505050;font-family:Helvetica;font-size:14px;font-style:normal;font-weight:bold;line-height:125%;letter-spacing:normal;text-align:left}#templateUpperHeader{padding-top:30px;padding-right:15px}.templateHeader{background-color:#eee;border-top:0;border-bottom:0;padding-bottom:10px}.templateHeader .mcnTextContent,.templateHeader .mcnTextContent p{color:#202020;font-family:Helvetica;font-size:16px;line-height:150%;text-align:left}.templateHeader .mcnTextContent a,.templateHeader .mcnTextContent p a{color:#2BAADF;font-weight:normal;text-decoration:underline}#templateSidebar{border-top:0;border-bottom:0;padding-top:9px;padding-bottom:9px}#calendarContainer{background-color:#FFF;border:5px solid #FFF}#monthContainer{background-color:#EFEFEF;color:#303030;font-family:Helvetica;font-size:14px;font-weight:bold;line-height:150%}#dayContainer{background-color:#FFF;color:#303030;font-family:Helvetica;font-size:72px;font-weight:bold;line-height:100%}#templateSidebar .mcnTextContent,#templateSidebar .mcnTextContent p{color:#505050;font-family:Helvetica;font-size:12px;line-height:150%;text-align:left}#templateSidebar .mcnTextContent a,#templateSidebar .mcnTextContent p a{color:#6ACC3B;font-weight:normal;text-decoration:underline}#templateBody,#templateColumns{background-color:#EFEFEF;border-top:0;border-bottom:0;padding-top:0;padding-bottom:9px}#templateBody .mcnTextContent,#templateBody .mcnTextContent p{color:#505050;font-family:Helvetica;font-size:16px;line-height:150%;text-align:left}#templateBody .mcnTextContent a,#templateBody .mcnTextContent p a{color:#6ACC3B;font-weight:normal;text-decoration:underline}#templateLowerBody{background-color:#EFEFEF;border-top:0;border-bottom:0;padding-top:0;padding-bottom:0}#templateLowerBody .mcnTextContent,#templateLowerBody .mcnTextContent p{color:#505050;font-family:Helvetica;font-size:16px;line-height:150%;text-align:left}#templateLowerBody .mcnTextContent a,#templateLowerBody .mcnTextContent p a{color:#6ACC3B;font-weight:normal;text-decoration:underline}#templateFooter{background-color:#EFEFEF;border-top:5px solid #FFF;border-bottom:0;padding-top:9px;padding-bottom:9px}#templateFooter .mcnTextContent,#templateFooter .mcnTextContent p{color:#505050;font-family:Helvetica;font-size:12px;line-height:150%;text-align:center}#templateFooter .mcnTextContent a,#templateFooter .mcnTextContent p a{color:#6ACC3B;font-weight:normal;text-decoration:underline}@media only screen and (min-width:768px){.templateContainer{width:600px !important}}@media only screen and (max-width: 480px){body,table,td,p,a,li,blockquote{-webkit-text-size-adjust:none !important}}@media only screen and (max-width: 480px){body{width:100% !important;min-width:100% !important}}@media only screen and (max-width: 480px){#bodyCell{padding-top:10px !important}}@media only screen and (max-width: 480px){#templateSidebar,#templateBody{max-width:100% !important;width:100% !important}}@media only screen and (max-width: 480px){.mcnRetinaImage{max-width:100% !important}}@media only screen and (max-width: 480px){.mcnImage{width:100% !important}}@media only screen and (max-width: 480px){.mcnCartContainer,.mcnCaptionTopContent,.mcnRecContentContainer,.mcnCaptionBottomContent,.mcnTextContentContainer,.mcnBoxedTextContentContainer,.mcnImageGroupContentContainer,.mcnCaptionLeftTextContentContainer,.mcnCaptionRightTextContentContainer,.mcnCaptionLeftImageContentContainer,.mcnCaptionRightImageContentContainer,.mcnImageCardLeftTextContentContainer,.mcnImageCardRightTextContentContainer,.mcnImageCardLeftImageContentContainer,.mcnImageCardRightImageContentContainer{max-width:100% !important;width:100% !important}}@media only screen and (max-width: 480px){.mcnBoxedTextContentContainer{min-width:100% !important}}@media only screen and (max-width: 480px){.mcnImageGroupContent{padding:9px !important}}@media only screen and (max-width: 480px){.mcnCaptionLeftContentOuter .mcnTextContent,.mcnCaptionRightContentOuter .mcnTextContent{padding-top:9px !important}}@media only screen and (max-width: 480px){.mcnImageCardTopImageContent,.mcnCaptionBottomContent:last-child .mcnCaptionBottomImageContent,.mcnCaptionBlockInner .mcnCaptionTopContent:last-child .mcnTextContent{padding-top:18px !important}}@media only screen and (max-width: 480px){.mcnImageCardBottomImageContent{padding-bottom:9px !important}}@media only screen and (max-width: 480px){.mcnImageGroupBlockInner{padding-top:0 !important;padding-bottom:0 !important}}@media only screen and (max-width: 480px){.mcnImageGroupBlockOuter{padding-top:9px !important;padding-bottom:9px !important}}@media only screen and (max-width: 480px){.mcnTextContent,.mcnBoxedTextContentColumn{padding-right:18px !important;padding-left:18px !important}}@media only screen and (max-width: 480px){.mcnImageCardLeftImageContent,.mcnImageCardRightImageContent{padding-right:18px !important;padding-bottom:0 !important;padding-left:18px !important}}@media only screen and (max-width: 480px){.mcpreview-image-uploader{display:none !important;width:100% !important}}@media only screen and (max-width: 480px){h1{font-size:22px !important;line-height:125% !important}}@media only screen and (max-width: 480px){h2{font-size:20px !important;line-height:125% !important}}@media only screen and (max-width: 480px){h3{font-size:18px !important;line-height:125% !important}}@media only screen and (max-width: 480px){h4{font-size:16px !important;line-height:150% !important}}@media only screen and (max-width: 480px){.mcnBoxedTextContentContainer .mcnTextContent,.mcnBoxedTextContentContainer .mcnTextContent p{font-size:14px !important;line-height:150% !important}}@media only screen and (max-width: 480px){.templateHeader .mcnTextContent,.templateHeader .mcnTextContent p{font-size:16px !important;line-height:150% !important}}@media only screen and (max-width: 480px){#templateSidebar .mcnTextContent,#templateSidebar .mcnTextContent p{font-size:16px !important;line-height:150% !important}}@media only screen and (max-width: 480px){#templateBody .mcnTextContent,#templateBody .mcnTextContent p{font-size:16px !important;line-height:150% !important}}@media only screen and (max-width: 480px){#templateLowerBody .mcnTextContent,#templateLowerBody .mcnTextContent p{font-size:16px !important;line-height:150% !important}}@media only screen and (max-width: 480px){#templateFooter .mcnTextContent,#templateFooter .mcnTextContent p{font-size:14px !important;line-height:150% !important}}</style></head>';
      $emailtmp.='<body> <!--[if !gte mso 9]><!----><span class="mcnPreviewText" style="display:none; font-size:0px; line-height:0px; max-height:0px; max-width:0px; opacity:0; overflow:hidden; visibility:hidden; mso-hide:all;">*|MC_PREVIEW_TEXT|*</span><!--<![endif]--><center><table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="height:100%;margin:0;padding:0;width:100%;background-color:#da3a3a;"><tr><td align="center" valign="top" id="bodyCell" style="padding:10px;"> <!--[if gte mso 9]><table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;"><tr><td align="center" valign="top" width="600" style="width:600px;"> <![endif]--><table border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer" style="max-width:600px;width:100%;border:5px solid #FFF;"><tr><td valign="top" id="templateUpperHeader" class="templateHeader" style="background-color:#eee;border-top:0;border-bottom:0;padding-bottom:10px;"><table align="left" cellpadding="0" cellspacing="0" width="100%"><tr><td align="left" valign="middle"> <img src="https://cdn-images.mailchimp.com/template_images/gallery/47662b23-df38-45d4-8005-9b2f50193f4b.png" height="30" width="15" style="boder:0; display:block;"></td><td align="left" valign="middle" width="100%"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width:100%;"><tbody class="mcnTextBlockOuter"><tr><td valign="top" class="mcnTextBlockInner" style="padding-top:9px;"> <!--[if mso]><table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;"><tr> <![endif]--> <!--[if mso]><td valign="top" width="560" style="width:560px;"> <![endif]--><table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%; min-width:100%;" width="100%" class="mcnTextContentContainer"><tbody><tr><td valign="top" class="mcnTextContent" style="padding-top:0; padding-right:18px; padding-bottom:9px; padding-left:18px;"><h1><span style="color:#000000">Excellence Academy of Indian Music</span></h1><h3><span style="color:#008080">Booking Confirmation</span></h3></td></tr></tbody></table> <!--[if mso]></td> <![endif]--> <!--[if mso]></tr></table> <![endif]--></td></tr></tbody></table></td></tr></table></td></tr><tr><td valign="top" class="templateHeader" style="background-color:#eee;border-top:0;border-bottom:0;padding-bottom:10px;"><table align="left" cellpadding="0" cellspacing="0" width="100%"><tr><td align="left" valign="middle" width="100%"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width:100%;"><tbody class="mcnImageBlockOuter"><tr><td valign="top" style="padding:0px" class="mcnImageBlockInner"><table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width:100%;"><tbody><tr><td class="mcnImageContent" valign="top" style="padding-right: 0px; padding-left: 0px; padding-top: 0; padding-bottom: 0; text-align:center;"> <img align="center" alt="" src="https://mcusercontent.com/1890b626c2e393298df3882ee/images/ea7fd239-f822-4063-bb60-1566a7c450e0.png" width="590" style="max-width:1903px; padding-bottom: 0; display: inline !important; vertical-align: bottom;" class="mcnImage"></td></tr></tbody></table></td></tr></tbody></table></td></tr></table></td></tr><tr><td valign="top" id="templateColumns" style="background-color:#EFEFEF;border-top:0;border-bottom:0;padding-top:0;padding-bottom:9px">';
      $emailtmp.='<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td valign="top"> <!--[if gte mso 9]><table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;"><tr><td align="center" valign="top" width="400" style="width:400px;"> <![endif]--><table align="left" border="0" cellpadding="0" cellspacing="0" width="380" id="templateBody" style="background-color:#EFEFEF;border-top:0;border-bottom:0;padding-top:0;padding-bottom:9px"><tr><td><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width:100%;"><tbody class="mcnTextBlockOuter"><tr><td valign="top" class="mcnTextBlockInner" style="padding-top:9px;"> <!--[if mso]><table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;"><tr> <![endif]--> <!--[if mso]><td valign="top" width="380" style="width:380px;"> <![endif]--><table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%; min-width:100%;" width="100%" class="mcnTextContentContainer"><tbody><tr><td valign="top" class="mcnTextContent" style="padding-top:0; padding-right:18px; padding-bottom:9px; padding-left:18px;"> Dear '.$_SESSION["lms_name"].'<br> <br> Thank you for booking a Trial Class of '.$course.' at Excellence Academy of Indian Music. We are very happy and pleased to have you on board.<br> <br> The Details you provided are as follows:<br> 1. Name: '.$_SESSION["lms_name"].'<br> 2. Phone: '.$_SESSION["lms_student_phone"].'<br> 3. Email: '.$_SESSION["lms_email"].'<br> 4. Course: '.$course.'</td></tr></tbody></table> <!--[if mso]></td> <![endif]--> <!--[if mso]></tr></table> <![endif]--></td></tr></tbody></table></td></tr></table> <!--[if gte mso 9]></td><td align="center" valign="top" width="200" style="width:200px;"> <![endif]--><table align="left" border="0" cellpadding="0" cellspacing="0" width="186" id="templateSidebar"><tr><td align="center" valign="top" style="padding-top:9px; padding-bottom:9px;"><table border="0" cellpadding="5" cellspacing="5" width="150" id="calendarContainer" style="background-color:#FFF;border:5px solid #FFF"><tr><td align="center" bgcolor="#EFEFEF" valign="top" id="monthContainer" style="background-color:#EFEFEF;color:#303030;font-family:Helvetica;font-size:14px;font-weight:bold;line-height:150%"><div mc:edit="month"> '.$month.' '.$year.'</div></td></tr><tr><td align="center" valign="top" id="dayContainer" style="background-color:#FFF;color:#303030;font-family:Helvetica;font-size:72px;font-weight:bold;line-height:100%"><div mc:edit="day"> '.$day.'</div></td></tr></table></td></tr><tr><td valign="top"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width:100%;"><tbody class="mcnTextBlockOuter"><tr><td valign="top" class="mcnTextBlockInner" style="padding-top:9px;"> <!--[if mso]><table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;"><tr> <![endif]--> <!--[if mso]><td valign="top" width="186" style="width:186px;"> <![endif]--><table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%; min-width:100%;" width="100%" class="mcnTextContentContainer"><tbody><tr><td valign="top" class="mcnTextContent" style="padding-top:0; padding-right:18px; padding-bottom:9px; padding-left:18px;"><div style="text-align: center;">Time: '.$time_slot.'</div></td></tr></tbody></table> <!--[if mso]></td> <![endif]--> <!--[if mso]></tr></table> <![endif]--></td></tr></tbody></table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonBlock" style="min-width:100%;"><tbody class="mcnButtonBlockOuter"><tr><td style="padding-top:0; padding-right:18px; padding-bottom:18px; padding-left:18px;" valign="top" align="center" class="mcnButtonBlockInner"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonContentContainer" style="border-collapse: separate !important;border: 5px solid #FFFFFF;background-color: #60CA2E;"><tbody><tr><td align="center" valign="middle" class="mcnButtonContent" style="font-family: Helvetica; font-size: 14px; padding: 15px;"> <a class="mcnButton " title="Home Page" href="https://nextraitsolutions.com/" target="_self" style="font-weight: bold;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;">Home Page</a></td></tr></tbody></table></td></tr></tbody></table></td></tr></table> <!--[if gte mso 9]></td></tr></table> <![endif]--></td><td align="right" valign="top" style="padding-top:18px;"> <img src="https://cdn-images.mailchimp.com/template_images/gallery/03c9e5d8-4a2f-471e-b646-37327134c2b0.png" height="30" width="15" style="boder:0; display:block;"></td></tr></table></td></tr><tr><td valign="top" id="templateLowerBody"><table align="left" cellpadding="0" cellspacing="0" width="100%"><tr><td align="left" valign="middle"> <img src="https://cdn-images.mailchimp.com/template_images/gallery/47662b23-df38-45d4-8005-9b2f50193f4b.png" height="30" width="15" style="boder:0; display:block;"></td><td align="left" valign="middle" width="100%"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowBlock" style="min-width:100%;"><tbody class="mcnFollowBlockOuter"><tr><td align="center" valign="top" style="padding:9px" class="mcnFollowBlockInner"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentContainer" style="min-width:100%;"><tbody><tr><td align="center" style="padding-left:9px;padding-right:9px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;" class="mcnFollowContent"><tbody><tr><td align="center" valign="top" style="padding-top:9px; padding-right:9px; padding-left:9px;"><table width="100%" align="center" border="0" cellpadding="0" cellspacing="0"><tbody><tr><td align="center" valign="top"> <!--[if mso]><table align="center" border="0" cellspacing="0" cellpadding="0"><tr> <![endif]--> <!--[if mso]><td align="center" valign="top"> <![endif]--><table align="left" border="0" cellpadding="0" width="100%" cellspacing="0" style="display:inline;"><tbody><tr><td valign="top" style="padding-right:10px; padding-bottom:9px;" class="mcnFollowContentItemContainer"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem"><tbody><tr><td align="left" valign="middle" style="padding-top:5px; padding-right:10px; padding-bottom:5px; padding-left:9px;"></td></tr></tbody></table></td></tr></tbody></table> <!--[if mso]></td> <![endif]--> <!--[if mso]><td align="center" valign="top"> <![endif]--><table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tbody><tr><td valign="top" style="padding-right:10px; padding-bottom:9px;" class="mcnFollowContentItemContainer"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem"><tbody><tr><td align="left" valign="middle" style="padding-top:5px; padding-right:10px; padding-bottom:5px; padding-left:9px;"><table align="left" border="0" cellpadding="0" cellspacing="0" width=""><tbody><tr><td align="center" valign="middle" width="24" class="mcnFollowIconContent"> <a href="https://nextraitsolutions.com/" target="_blank"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/light-instagram-48.png" alt="Instagram" style="display:block;" height="24" width="24" class=""></a></td><td align="left" valign="middle" class="mcnFollowTextContent" style="padding-left:5px;"> <a href="https://nextraitsolutions.com/" target="" style="font-family: Helvetica;font-size: 11px;text-decoration: none;color: #505050;font-weight: bold;text-align: center;">Instagram</a></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table> <!--[if mso]></td> <![endif]--> <!--[if mso]><td align="center" valign="top"> <![endif]--><table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tbody><tr><td valign="top" style="padding-right:0; padding-bottom:9px;" class="mcnFollowContentItemContainer"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem"><tbody><tr><td align="left" valign="middle" style="padding-top:5px; padding-right:10px; padding-bottom:5px; padding-left:9px;"><table align="left" border="0" cellpadding="0" cellspacing="0" width=""><tbody><tr><td align="center" valign="middle" width="24" class="mcnFollowIconContent"> <a href="https://nextraitsolutions.com/" target="_blank"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/light-link-48.png" alt="Website" style="display:block;" height="24" width="24" class=""></a></td><td align="left" valign="middle" class="mcnFollowTextContent" style="padding-left:5px;"> <a href="https://nextraitsolutions.com/" target="" style="font-family: Helvetica;font-size: 11px;text-decoration: none;color: #505050;font-weight: bold;text-align: center;">Website</a></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table> <!--[if mso]></td> <![endif]--> <!--[if mso]></tr></table> <![endif]--></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></table></td></tr><tr><td valign="top" id="templateFooter" style="background-color:#EFEFEF;border-top:5px solid #FFF;border-bottom:0;padding-top:9px;padding-bottom:9px"></td></tr></table> <!--[if gte mso 9]></td></tr></table> <![endif]--></td></tr></table></center></body></html>';
      



      // Always set content-type when sending HTML email
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
      // More headers
    //   $headers .= 'From: <noreply@excellenceacademyofmusic.com>' . "\r\n";  
      
      $headers .= 'From: <sree03m@gmail.com>' . "\r\n"; 
      //$headers .= 'From: <info@excellenceacademyofmusic.com>' . "\r\n"; 
      
	  if(mail($to_student,$subject_student,$emailtmp,$headers)){
	  }
      }
      else{ 
         $bookinform='';
      $bookinform.='<div class="booking-slip" style="background: #fff;padding:30px;"><div class="slip-content"><span><strong>Hi.. '.$_SESSION['lms_name'].'</strong></span>';
      $bookinform.='<p>Congratulations! Your registration cannot be confirmed now ! Please contact us ...</p>';
      $bookinform.='<p>Thanks</p>';
      $bookinform.='<p><br><a href="courses.php" class="btn btn-white">View Our More Categories</a></p>';
      $bookinform.='</div>'; 
	  
	  
      echo $bookinform;
	  
      }
}


function get_follow_time_slots($course_id,$model_obj){
    $timeslot_btn="";
    $follow_date = $_POST['follow_date'];
    $result= $model_obj->get_follow_time_slots($course_id,$follow_date);
    $timeslot_btn.='<div class="booking-slots">';
    if (!empty($result)){
        while($row = $result->fetch_assoc()) {  
            $id=$row['follow_time_slot_id'];
            $timeslots_for_this_date =unserialize($row['follow_time_slots']);
            
            if($timeslots_for_this_date['slotone_start'] !='' && $timeslots_for_this_date['slotone_end'] != ''){
                
                $slot1="'".$timeslots_for_this_date['slotone_start'].' - '.$timeslots_for_this_date['slotone_end']."'";
                 $timeslot_btn.='<button class="site-btn time_slot_btn" onclick="fetch_form('.$course_id.','.$id.','.$slot1.')">'.trim($slot1,"'").'</button>';
            }
            
            
            if($timeslots_for_this_date['slottwo_start'] !='' && $timeslots_for_this_date['slottwo_end'] != ''){
                
                $slot2="'".$timeslots_for_this_date['slottwo_start'].' - '.$timeslots_for_this_date['slottwo_end']."'";
                 $timeslot_btn.='<button class="site-btn time_slot_btn" onclick="fetch_form('.$course_id.','.$id.','.$slot2.')">'.trim($slot2,"'").'</button>';
            }
            
            
            if($timeslots_for_this_date['slotthree_start'] !='' && $timeslots_for_this_date['slotthree_end'] != ''){
                
                $slot3="'".$timeslots_for_this_date['slotthree_start'].' - '.$timeslots_for_this_date['slotthree_end']."'";
                 $timeslot_btn.='<button class="site-btn time_slot_btn" onclick="fetch_form('.$course_id.','.$id.','.$slot3.')">'.trim($slot3,"'").'</button>';
            }
            
            
            if($timeslots_for_this_date['slotfour_start'] !='' && $timeslots_for_this_date['slotfour_end'] != ''){
                
                $slot4="'".$timeslots_for_this_date['slotfour_start'].' - '.$timeslots_for_this_date['slotfour_end']."'";
                 $timeslot_btn.='<button class="site-btn time_slot_btn" onclick="fetch_form('.$course_id.','.$id.','.$slot4.')">'.trim($slot4,"'").'</button>';
            }
            
            
            if($timeslots_for_this_date['slotfive_start'] !='' && $timeslots_for_this_date['slotfive_end'] != ''){
                
                $slot5=$timeslots_for_this_date['slotfive_start'].' - '.$timeslots_for_this_date['slotfive_end'];
                  $timeslot_btn.='<button class="site-btn time_slot_btn" onclick="fetch_form('.$course_id.','.$id.','.$slot5.')">'.$slot5.'</button>';
            }
            
            
        }
    }
    
     $timeslot_btn.='</div>';
    echo $timeslot_btn;
}
function create_follow_form($course_id,$model_obj){
   
    
      $time_slot_id = $_POST['time_slot_id'];
      $time_slot = $_POST['time_slot'];
      $res= $model_obj->insert_follow_data($course_id,$time_slot_id,$time_slot);
      if($res == true){
      $result= $model_obj->get_follow_date($course_id);
      if (!empty($result)){
        $row = $result->fetch_assoc();
      $course= $row['course_name']; 
       $follow_date= $row['follow_date']; 
      $bookinform='';
      $bookinform.='<div class="booking-slip" style="background: #fff;padding:30px;"><div class="slip-content"><span><strong style="color:#0BC560;">Hi.. '.$_SESSION['lms_name'].'</strong></span>';
      $bookinform.='<p>Congratulations! Your registration is confirmed!</p>';
      $bookinform.='<p>You’ve successfully completed registration for <strong style="color:#0BC560;">Follow Class</strong> for '.$course.'.</p>';
      $bookinform.='<p>Date: '.$follow_date.'</p>';
      $bookinform.='<p>Timing: '.$time_slot.'</p>';
      $bookinform.='<p>Thanks</p>';
      $bookinform.='<p><br><a href="courses.php" class="btn btn-white">View Our More Categories</a></p>';
      $bookinform.='</div>';
      
	  $bookinform.='</div>';
	  $to_student = $_SESSION['lms_email'];
      $subject_student = "Welcome To Excellence Academy of Indian Music.";
            
      $message_student =  $bookinform;
      // Always set content-type when sending HTML email
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
      // More headers
      $headers .= 'From: <noreply@excellenceacademyofmusic.com>' . "\r\n";      
      
	  mail($to_student,$subject_student,$message_student,$headers);
        
      echo $bookinform;
      } 
      }
      else{
         $bookinform='';
      $bookinform.='<div class="booking-slip" style="background: #fff;padding:30px;"><div class="slip-content"><span><strong>Hi.. '.$_SESSION['lms_name'].'</strong></span>';
      $bookinform.='<p>Congratulations! Your registration cannot be confirmed now ! Please contact us ...</p>';
      $bookinform.='<p>Thanks</p>';
      $bookinform.='<p><br><a href="http://excellenceacademyofmusic.com/courses.php" class="btn btn-white">View Our More Categories</a></p>';
      $bookinform.='</div>'; 
	 
      echo $bookinform;
      }
}

// function email_template(){
//     $emtmplt="";
//     $emtmplt.='';

// }

function account_logout(){
    session_start();
    session_destroy();
}

}
