<?php
include '../../../../connection.php';
include '../../../../check.php';
if(count($_POST)>0){
	 if($_POST['type']==1){
		$company_=$_POST['client'];
		$date_=$_POST['date'];
		$lead_=$_POST['lead'];
		$leadtype_=$_POST['leadtype'];
		$requirement_=$_POST['requirement'];
		$estimatesv_=$_POST['estimatesv'];
		$lostlead_=$_POST['lostlead'];
		$perliminary_=$_POST['perliminary'];
		$email_=$_POST['email'];
		$shedule_=$_POST['shedule'];
		$chemistry_=$_POST['chemistry'];
		$proposal_=$_POST['proposal'];
		$estimate_=$_POST['estimate'];
		$confirmation_=$_POST['confirmation'];
		$cof_=$_POST['cof']; 
		$po_=$_POST['po'];
		$invoice_=$_POST['invoice'];
		$payment_=$_POST['payment'];
		$programs_=$_POST['program'];
		$post_=$_POST['post'];
		$protofolio_=$_POST['protofolio'];
		$meeting_=$_POST['meeting'];
		$completion_=10;
		$notes=$_POST['notes'];
		$followup=$_POST['followup'];
 
		$sql_check_leads_list = "SELECT COUNT(*) AS count FROM `leads` WHERE `company` = '$company_'";
		$result_check_leads_list = mysqli_query($conn, $sql_check_leads_list);
		$row_check_leads_list = mysqli_fetch_assoc($result_check_leads_list);

				if ($row_check_leads_list['count'] > 0) {
						echo json_encode(array("statusCode" => 400, "message" => "Lead already exists."));
						return;
				}
				if (strlen($company_)>0){ 

					$sql = "INSERT INTO `leads`(`company`,`date`,`lead`,`leadType`,`requirement`,`estimateSalesValue`,`lostLeadDate`,`preliminaryBrochures`,`emailClient`,`sheduleCM`,`chemMeeting`,`proposal`,`estimate`,`confirmation`,`cof`,`po`,`invoice`,`payment`,`program`,`postSalesFollowUp`,`protofolioEmail`,`newBusinessMeeting`,`completionStatus`,`notes`,`followup`) 
					VALUES ('$company_','$date_','$lead_','$leadtype_','$requirement_','$estimatesv_','$lostlead_','$perliminary_','$email_','$shedule_','$chemistry_','$proposal_','$estimate_','$confirmation_','$cof_','$po_','$invoice_','$payment_','$programs_','$post_','$protofolio_','$meeting_','$completion_','$notes','$followup')";
					
					if (mysqli_query($conn, $sql)) {
						echo json_encode(array("statusCode" => 200));
					} else {
						echo json_encode(array("statusCode" => 400, "message" => "Error: " . $sql . "<br>" . mysqli_error($conn)));
					}
				
					mysqli_close($conn);
				} else {
					echo json_encode(array("statusCode" => 400, "message" => "Client Name is required."));
				}
			}
}

 //if(count($_POST)>0){
 //if($_POST['type']==2){
 		//$lid_=$_POST['id'];
 		//$client_=$_POST['client'];
 		//$date_=$_POST['date'];
 		//$lead_=$_POST['lead'];
 		//$leadtype_=$_POST['leadtype'];
 		//$requirement_=$_POST['requirement'];
 		//$sales_=$_POST['sales'];
		//$lost_=$_POST['lost'];
 		//$perliminary_=$_POST['perliminary'];
 		//$email_=$_POST['email'];
 		//$shedulechm_=$_POST['shedulecm'];
		//$chemmeeting_=$_POST['chemmeeting'];
 		//$proposal_=$_POST['proposal'];
 		//$estimate_=$_POST['estimate'];
 		//$confirmation_=$_POST['confirmation'];
		//$cof_=$_POST['cof'];
 		//$po_=$_POST['po'];
 		//$invoice_=$_POST['invoice'];
 		//$payment_=$_POST['payment'];
 		//$program_=$_POST['program'];
 		//$folowup_=$_POST['followup'];
 		//$protofolio_=$_POST['protofolio'];
		//$business_=$_POST['business'];
 		//$completion_=$_POST['completion'];
 		//$notes_=$_POST['notes'];
 		//$action_=$_POST['action'];

		//validate if lead already exists
		//$sql_check_leads = "SELECT COUNT(*) AS count FROM `leads` WHERE `company`='$client_' AND 'clientID' NOT IN($lid_)";
		//$result_check_leads = mysqli_query($conn, $sql_check_leads);
		//$row_check_leads = mysqli_fetch_assoc($result_check_leads);
		//if ($row_check_leads['count'] > 0) {
			//echo json_encode(array("statusCode" => 400, "message" => "Lead already exists."));
			//return;
		//}else{
			//if (strlen($company_u_)>0){

				//$sql = "UPDATE `leads` SET `company`='$client_',`date`='$date_',`lead`='$lead_',`leadType`='$leadtype_',`requirement`='$requirement_',`estimateSalesValue`='$sales_',`lostLeadDate`='$lost_',`preliminaryBrochures`='$perliminary_',`emailClient`='$email_',`sheduleCM`='$shedulechm_',`chemMeeting`='$chemmeeting_',`proposal`='$proposal_',`estimate`='$estimate_',`confirmation`='$confirmation_',`cof`='$cof_',`po`='$po_',`invoice`='$invoice_',`payment`='$payment_',`program`='$program_',`postSalesFollowUp`='$folowup_',`protofolioEmail`='$protofolio_',`newBusinessMeeting`='$business_',`completionStatus`='$completion_',`notes`='$notes_',`followUp`='$action_' WHERE `clientID`='$lid_'";
 		//if (mysqli_query($conn, $sql)) {
 		   // echo json_encode(array("statusCode"=>200));
 		//} 
 		//else {
 			//echo json_encode(array("statusCode" => 400, "message" => "Error: " . $sql . "<br>" . mysqli_error($conn)));
 			//return;
 		//}
 		//mysqli_close($conn);

			//}else{
				//echo json_encode(array("statusCode" => 400, "message" => "Company name is required"));
				//return;
			//}
		//}
	//}			
//}
 
 //if(count($_POST)>0){
 	//if($_POST['type']==3){
 		//$cid_=$_POST['clientID'];
 		//$sql = "DELETE FROM `leads` WHERE `clientID`=$lid_";
 		//if (mysqli_query($conn, $sql)) {
			//echo $lid_
 			//echo json_encode(array("statusCode"=>200));
		//} 
 		//else {
 			//echo json_encode(array("statusCode" => 400, "message" => "Error: " . $sql . "<br>" . mysqli_error($conn)));
 			//return;
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
 		//}
 		//mysqli_close($conn);
 	//}
 //}

	//if(count($_POST)>0){
 	//if($_POST['type']==4){
 		//$cid_=$_POST['clientID'];
 		//$sql = "DELETE FROM `leads` WHERE clientID in ($lid_)";
 		//if (mysqli_query($conn, $sql)) {
 			//echo json_encode(array("statusCode"=>200));
 		//} 
 		//else {
 			//echo json_encode(array("statusCode" => 400, "message" => "Error: " . $sql . "<br>" . mysqli_error($conn)));
 			//return;
 		//}
 		//mysqli_close($conn);
 	//}
//}
?>