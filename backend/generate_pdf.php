<?php
	header('Access-Control-Allow-Origin: *');
	
	require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
	require_once(dirname(__FILE__).'/phpmailer/class.phpmailer.php');
	require_once(dirname(__FILE__).'/sigtoimage/signature-to-image.php');
	
	$params = json_decode($_REQUEST['params']);
	$formType = $_REQUEST['formType'];
	
	$content = file_get_contents(dirname(__FILE__).'/form_templates/'.$formType.'.html');
	//$content = file_get_contents(dirname(__FILE__).'/form_templates/buyer.html');
	//print_r( $params);
	//exit;
	$emailSubject='';
	$additionalEmail1='';
	$additionalEmail2='';
	$imgJson;
	$timestamp = date("Y-m-dTH-i-s");
	
	//echo $formType;
	
	if($formType == 'buyer')
	{
		
		foreach($params as $obj)
		{
			foreach($obj as $name => $value)
			{
			
				if($name == 'email_subject')
					$emailSubject = $value;
				else if($name == 'additional_email1')
					$additionalEmail1 = $value;
				else if($name == 'additional_email2')
					$additionalEmail2 = $value;
				else if($name == 'output1')
				{
					$imgJson = $value;
					$img = sigJsonToImage($imgJson);
					
					$sigName = 'sig1-' . $timestamp . '.png';
					imagepng($img, './signs/' . $sigName);
					$content = str_replace("%sign_path1%",'./signs/' . $sigName,$content);	
				}
				else if($name == 'output2')
				{
					$imgJson = $value;
					$img = sigJsonToImage($imgJson);
					
					$sigName = 'sig2-' . $timestamp . '.png';
					imagepng($img, './signs/' . $sigName);
					$content = str_replace("%sign_path2%",'./signs/' . $sigName,$content);	
				}
					
				//echo $name . '=' . $value. '<br/>';
				$content = str_replace("%".$name."%",$value,$content);
			}
		}
	}
	else if( $formType == 'seller')
	{
		foreach($params as $obj)
		{
			foreach($obj as $name => $value)
			{
				if($name == 'se_marital_status')
				{
					$content = str_replace('%'.$value.'%','<b>#</b>',$content);	
					
				}
				else if($name == 'se_spouse_status')
				{
					$content = str_replace('%'.$value.'%','<b>#</b>',$content);	
					
				}else if($name == 'email_subject')
					$emailSubject = $value;
				else if($name == 'additional_email1')
					$additionalEmail1 = $value;
				else if($name == 'additional_email2')
					$additionalEmail2 = $value;
				else if($name == 'output1')
				{
					$imgJson = $value;
					$img = sigJsonToImage($imgJson);
					
					$sigName = 'sig1-' . $timestamp . '.png';
					imagepng($img, './signs/' . $sigName);
					$content = str_replace("%sign_path1%",'./signs/' . $sigName,$content);	
				}
				else if($name == 'output2')
				{
					$imgJson = $value;
					$img = sigJsonToImage($imgJson);
					
					$sigName = 'sig2-' . $timestamp . '.png';
					imagepng($img, './signs/' . $sigName);
					$content = str_replace("%sign_path2%",'./signs/' . $sigName,$content);	
				}
					
				//echo $name . '=' . $value. '<br/>';
				$content = str_replace("%".$name."%",$value,$content);
			}
		}
		
		$content = str_replace('%se_marital_county%','_________________',$content);	
		$content = str_replace('%se_marital_state%','_________________',$content);	
		$content = str_replace('%se_spouse_county%','_________________',$content);	
		$content = str_replace('%se_spouse_state%','_________________',$content);	
		$content = str_replace('%se_spouse_status1%','',$content);	
		$content = str_replace('%se_spouse_status2%','',$content);	
		$content = str_replace('%se_marital_status1%','',$content);	
		$content = str_replace('%se_marital_status2%','',$content);	
		$content = str_replace('%se_marital_status3%','',$content);	
		$content = str_replace('%se_marital_status4%','',$content);	
		$content = str_replace('%se_marital_status5%','',$content);	
		$content = str_replace('%se_marital_status6%','',$content);	
	
	}
	else if( $formType == 'showingcondition')
	{
		
		
		foreach($params as $obj)
		{
	
			foreach($obj as $name => $value)
			{
		
				if($name == 'sc_check')
				{
					$sc_check = "[ ]Vacant [ ]Tenant Occupied [ ]Owner Occupied";
					
					if($value == 'vacant')
						$sc_check = "[<b>#</b>]Vacant [ ]Tenant Occupied [ ]Owner Occupied";
					else if($value == 'tenant')
						$sc_check = "[ ]Vacant [<b>#</b>]Tenant Occupied [ ]Owner Occupied";
					else if($value == 'owner')
						$sc_check = "[ ]Vacant [ ]Tenant Occupied [<b>#</b>]Owner Occupied";
				
					$content = str_replace('%sc_check%',$sc_check,$content);	
				}
				else if($name == 'sc_check_lockbox')
				{
					$sc_lockbox = "[ ]Yes [ ]No";
					if($value == 'yes')
						$sc_lockbox = "[<b>#</b>]Yes [ ]No";
					else if($value == 'no')
						$sc_lockbox = "[<b>#</b>]Yes [ ]No";
						
					$content = str_replace('%sc_check_lockbox%',$sc_lockbox,$content);	
				}
				else if($name == 'sc_roof')
				{
											
					$content = str_replace('%sc_roof_status%',checkResult($value),$content);	
				}
				else if($name == 'sc_foundation')
				{
					
						
					$content = str_replace('%sc_foundation_status%',checkResult($value),$content);	
				}
				else if($name == 'sc_roof')
				{
					
						
					$content = str_replace('%sc_roof_status%',checkResult($value),$content);	
				}
				else if($name == 'sc_hvac')
				{
					
						
					$content = str_replace('%sc_hvac_status%',checkResult($value),$content);	
				}
				else if($name == 'sc_heater')
				{
					
						
					$content = str_replace('%sc_heater_status%',checkResult($value),$content);	
				}
				else if($name == 'sc_panel')
				{
					
						
					$content = str_replace('%sc_panel_status%',checkResult($value),$content);	
				}
				else if($name == 'sc_flooring')
				{
					
						
					$content = str_replace('%sc_flooring_status%',checkResult($value),$content);	
				}
				else if($name == 'sc_bathrooms')
				{
					
						
					$content = str_replace('%sc_bathrooms_status%',checkResult($value),$content);	
				}
				else if($name == 'sc_kitchen')
				{
					
						
					$content = str_replace('%sc_kitchen_status%',checkResult($value),$content);	
				}
				else if($name == 'sc_appliances')
				{
					
						
					$content = str_replace('%sc_appliances_status%',checkResult($value),$content);	
				}
				else if($name == 'sc_windows')
				{
					
						
					$content = str_replace('%sc_windows_status%',checkResult($value),$content);	
				}
				else if($name == 'sc_pool')
				{
					
						
					$content = str_replace('%sc_pool_status%',checkResult($value),$content);	
				}
				else if($name == 'sc_check_garage')
				{	
					$content = str_replace('%sc_garage_status%',checkResult($value),$content);	
				}
				else if($name == 'sc_landscaping')
				{
						
					$content = str_replace('%sc_landscaping_status%',checkResult($value),$content);	
				}
				else if($name == 'sc_fence')
				{
					$content = str_replace('%sc_fence_status%',checkResult($value),$content);	
				}
				else if($name == 'email_subject')
					$emailSubject = $value;
				else if($name == 'additional_email1')
					$additionalEmail1 = $value;
				else if($name == 'additional_email2')
					$additionalEmail2 = $value;
				else
					$content = str_replace("%".$name."%",$value,$content);
			}
		}
	}else if( $formType == 'checklist')
	{
		foreach($params as $obj)
		{
			foreach($obj as $name => $value)
			{
				if($name == 'cl_copyof_contract' || $name == 'cl_seller_info' || $name == 'cl_condition_report' || $name == 'cl_pictures_dropbox' || $name == 'cl_tenant_agreement' || $name == 'cl_hoa_info' || $name == 'cl_survey' || $name == 'cl_seller_disclosure' || $name == 'cl_lead_addendom')
				{
					$content = str_replace('%'.$name.'%',onOffResult($value),$content);	
				}else if($name == 'email_subject')
					$emailSubject = $value;
				else if($name == 'additional_email1')
					$additionalEmail1 = $value;
				else if($name == 'additional_email2')
					$additionalEmail2 = $value;
				else if($name == 'output')
				{
					$imgJson = $value;
					$img = sigJsonToImage($imgJson);
					
					$sigName = 'sig-' . $timestamp . '.png';
					imagepng($img, './signs/' . $sigName);
					$content = str_replace("%sign_path%",'./signs/' . $sigName,$content);	
				}
				else
					$content = str_replace("%".$name."%",$value,$content);
					
				//echo $name . '=' . $value. '<br/>';
			
			}
		}
		$content = str_replace('%cl_copyof_contract%',"",$content);	
		$content = str_replace('%cl_seller_info%',"",$content);	
		$content = str_replace('%cl_condition_report%',"",$content);	
		$content = str_replace('%cl_pictures_dropbox%',"",$content);	
		$content = str_replace('%cl_tenant_agreement%',"",$content);	
		$content = str_replace('%cl_hoa_info%',"",$content);	
		$content = str_replace('%cl_survey%',"",$content);	
		$content = str_replace('%cl_seller_disclosure%',"",$content);	
		$content = str_replace('%cl_lead_addendom%',"",$content);	
		
	}else if( $formType == 'leadbased')
	{
		foreach($params as $obj)
		{
			foreach($obj as $name => $value)
			{
				if($name == 'lb_check_presence')
				{
					if($value == 'lb_check_presence1')
					{
						$checkimg1 = '<img src="imgs/checked.png" align="left" />';
						$checkimg2 = '<img src="imgs/default.png" align="left" />';
					}
					else
					{
						$checkimg2 = '<img src="imgs/checked.png" align="left" />';
						$checkimg1 = '<img src="imgs/default.png" align="left" />';
					}
					
					$content = str_replace('%lb_check_presence1%',$checkimg1,$content);	
					$content = str_replace('%lb_check_presence2%',$checkimg2,$content);	
					
				}
				else if($name == 'lb_check_records')
				{
					if($value == 'lb_check_records1')
					{
						$checkimg1 = '<img src="imgs/checked.png" align="left" />';
						$checkimg2 = '<img src="imgs/default.png" align="left" />';
					}
					else{
						$checkimg2 = '<img src="imgs/checked.png" align="left" />';
						$checkimg1 = '<img src="imgs/default.png" align="left" />';
					}
					
					
					$content = str_replace('%lb_check_records1%',$checkimg1,$content);	
					$content = str_replace('%lb_check_records2%',$checkimg2,$content);	
					
				}
				else if($name == 'lb_check_buyer_rights')
				{
					if($value == 'lb_check_buyer_rights1')
					{
						$checkimg1 = '<img src="imgs/checked.png" align="left" />';
						$checkimg2 = '<img src="imgs/default.png" align="left" />';
					}
					else{
						$checkimg2 = '<img src="imgs/checked.png" align="left" />';
						$checkimg1 = '<img src="imgs/default.png" align="left" />';
					}
					
					
					$content = str_replace('%lb_check_buyer_rights1%',$checkimg1,$content);	
					$content = str_replace('%lb_check_buyer_rights2%',$checkimg2,$content);	
					
				}
				else if($name == 'lb_check_buyer_acks1')
				{
					if($value == 'on')
					{
						$checkimg1 = '<img src="imgs/checked.png" align="left" />';
						
					}
					else{
						$checkimg1 = '<img src="imgs/default.png" align="left" />';
					}
					$content = str_replace('%lb_check_buyer_acks1%',$checkimg1,$content);	
				}
				else if($name == 'lb_check_buyer_acks2')
				{
					if($value == 'on')
					{
						$checkimg1 = '<img src="imgs/checked.png" align="left" />';
						
					}
					else{
						$checkimg1 = '<img src="imgs/default.png" align="left" />';
					}
					$content = str_replace('%lb_check_buyer_acks2%',$checkimg1,$content);	
				}
				else if($name == 'output_buyer_1')
				{
					$imgJson = $value;
					$img = sigJsonToImage($imgJson);
					
					$sigName = 'sig-buyer1' . $timestamp . '.png';
					imagepng($img, './signs/' . $sigName);
					$content = str_replace("%sign_buyer1%",'./signs/' . $sigName,$content);	
				}
				else if($name == 'output_buyer_2')
				{
					$imgJson = $value;
					$img = sigJsonToImage($imgJson);
					
					$sigName = 'sig-buyer2' . $timestamp . '.png';
					imagepng($img, './signs/' . $sigName);
					$content = str_replace("%sign_buyer2%",'./signs/' . $sigName,$content);	
				}
				else if($name == 'output_seller_1')
				{
					$imgJson = $value;
					$img = sigJsonToImage($imgJson);
					
					$sigName = 'sig-seller1' . $timestamp . '.png';
					imagepng($img, './signs/' . $sigName);
					$content = str_replace("%sign_seller1%",'./signs/' . $sigName,$content);	
				}
				else if($name == 'output_seller_2')
				{
					$imgJson = $value;
					$img = sigJsonToImage($imgJson);
					
					$sigName = 'sig-seller2' . $timestamp . '.png';
					imagepng($img, './signs/' . $sigName);
					$content = str_replace("%sign_seller2%",'./signs/' . $sigName,$content);	
				}else if($name == 'output_broker_1')
				{
					$imgJson = $value;
					$img = sigJsonToImage($imgJson);
					
					$sigName = 'sig-broker1' . $timestamp . '.png';
					imagepng($img, './signs/' . $sigName);
					$content = str_replace("%sign_other_broker%",'./signs/' . $sigName,$content);	
				}else if($name == 'output_broker_2')
				{
					$imgJson = $value;
					$img = sigJsonToImage($imgJson);
					
					$sigName = 'sig-broker2' . $timestamp . '.png';
					imagepng($img, './signs/' . $sigName);
					$content = str_replace("%sign_listing_broker%",'./signs/' . $sigName,$content);	
				}else if($name == 'email_subject')
					$emailSubject = $value;
				else if($name == 'additional_email1')
					$additionalEmail1 = $value;
				else if($name == 'additional_email2')
					$additionalEmail2 = $value;
					
				//echo $name . '=' . $value. '<br/>';
				$content = str_replace("%".$name."%",$value,$content);
			}
		}
		
	
	} else if($formType == 'purchase')
    {
        foreach($params as $obj)
        {
            foreach($obj as $name => $value)
            {
				if($name == 'email_subject')
					$emailSubject = $value;
                else if($name == 'additional_email1')
                    $additionalEmail1 = $value;
                else if($name == 'additional_email2')
                    $additionalEmail2 = $value;
                else if($name == 'pa_disput_willsubmit')
                {

                    if($value == "pa_disput_will_submit")
                    {
                        $content = str_replace("%pa_disput_will_submit%","X",$content);
                        $content = str_replace("%pa_disput_willnot_submit%","",$content);
                    }
                    else{
                        $content = str_replace("%pa_disput_will_submit%","",$content);
                        $content = str_replace("%pa_disput_willnot_submit%","X",$content);
                    }
                } else if($name == 'pa_property_is')
                {

                    if($value == "pa_property_is")
                    {
                        $content = str_replace("%pa_property_is%","X",$content);
                        $content = str_replace("%pa_property_isnot%","",$content);
                    }
                    else{
                        $content = str_replace("%pa_property_is%","",$content);
                        $content = str_replace("%pa_property_isnot%","X",$content);
                    }
                }
                else if($name == 'output_seller_1')
                {
                    $imgJson = $value;
                    $img = sigJsonToImage($imgJson);

                    $sigName = 'sig_seller1-' . $timestamp . '.png';
                    imagepng($img, './signs/' . $sigName);
                    $content = str_replace("%sign_seller_path1%",'./signs/' . $sigName,$content);
                }
				else if($name == 'output_seller_2')
                {
                    $imgJson = $value;
                    $img = sigJsonToImage($imgJson);

                    $sigName = 'sig_seller2-' . $timestamp . '.png';
                    imagepng($img, './signs/' . $sigName);
                    $content = str_replace("%sign_seller_path2%",'./signs/' . $sigName,$content);
                }
				 else if($name == 'output_buyer_1')
                {
                    $imgJson = $value;
                    $img = sigJsonToImage($imgJson);

                    $sigName = 'sig_buyer1-' . $timestamp . '.png';
                    imagepng($img, './signs/' . $sigName);
                    $content = str_replace("%sign_buyer_path1%",'./signs/' . $sigName,$content);
                }

                //echo $name . '=' . $value. '<br/>';
                $content = str_replace("%".$name."%",$value,$content);
            }
        }
    }
	
	//echo $content;
	//exit;
	
	
	try
	{
	
	
        $html2pdf = new HTML2PDF('P', 'A3', 'en', true, 'UTF-8', array(15, 5, 15, 5));
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content);
		$pdfContent = $html2pdf->Output('exemple02.pdf','S');
		$docname = './signed_docs/'. $formType.$timestamp . '.pdf';
		$fhandle = fopen($docname,'w+');
		fwrite($fhandle,$pdfContent);
		
		if( send_mail($emailSubject,$docname,$additionalEmail1,$additionalEmail1))
		{
			echo "Email Sent Successfully";
		}
		else
		{
			echo "Error Occured While Sending Email.";
		}
		
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
	
	function send_mail($subject,$file_to_attach, $additional1='',$additional2='')
	{
		$email = new PHPMailer();
		$email->From      = 'you@example.com';
		$email->FromName  = 'North Forest Financial, LLC (aka COSA Investments, LTD)';
		$email->Subject   = $subject != '' ? $subject : 'Signed Contract';
		$email->Body = "Here's Signed Contract From";
		
		$email->AddAddress( 'cosacompany@gmail.com', 'Person One' );
		
		if($additional1 != '')
		{
			$email->AddCC($additional1, 'Additional Person One');
		}
		if($additional2 != '')
		{
			$email->AddCC($additional2, 'Additional Person Two');
		}
					
		//$file_to_attach = 'PATH_OF_YOUR_FILE_HERE';
		$email->AddAttachment( $file_to_attach , 'Signed Contract.pdf' );
		return $email->Send();
	}
	
	function checkResult($value=''){
	
		$sc_lockbox = "[ ] New [ ]Good [ ]Repair [ ]Replace";
		if($value == 'new')
			$sc_lockbox = "[<b>#</b>] New [ ]Good [ ]Repair [ ]Replace";
		else if($value == 'good')
			$sc_lockbox = "[ ] New [<b>#</b>]Good [ ]Repair [ ]Replace";
		else if($value == 'repair')
			$sc_lockbox = "[ ] New [ ]Good [<b>#</b>]Repair [ ]Replace";
		else if($value == 'replace')
			$sc_lockbox = "[ ] New [ ]Good [ ]Repair [<b>#</b>]Replace";
			
		return $sc_lockbox;
	}
	
	function onOffResult($value="off")
	{
		if($value == "on")
			return "<b>#</b>";
		else
			return "";
			
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
