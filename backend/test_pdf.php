<?php
	header('Access-Control-Allow-Origin: *');
	
	require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
	require_once(dirname(__FILE__).'/phpmailer/class.phpmailer.php');
	require_once(dirname(__FILE__).'/sigtoimage/signature-to-image.php');
	
		
	$content = file_get_contents(dirname(__FILE__).'/form_templates/purchase.html');
			
	//echo $content;
	//exit;
	try
	{
        $html2pdf = new HTML2PDF('P', 'A3', 'en', true, 'UTF-8', array(15, 5, 15, 5));
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content);
		$pdfContent = $html2pdf->Output('exemple02.pdf');
		//$docname = './signed_docs/'. $formType.$timestamp . '.pdf';
		//$fhandle = fopen($docname,'w+');
		//fwrite($fhandle,$pdfContent);
		
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
		
	
	
	
	
	
	
	
	
	
	
	
	
