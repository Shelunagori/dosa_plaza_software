<?php //pr($quotation->employee->signature); exit;
use Cake\Mailer\Email;

require_once(ROOT . DS  .'vendor' . DS  . 'dompdf' . DS . 'autoload.inc.php');
use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('defaultFont', 'Lato-Hairline');
$dompdf = new Dompdf($options);

$dompdf = new Dompdf();


$html = '
<html>
	<head>
		<style>
		table.qwerty3>thead>tr>th, table.qwerty3>tbody>tr>th, table.qwerty3>tfoot>tr>th, table.qwerty3>thead>tr>td, table.qwerty3>tbody>tr>td, table.qwerty3>tfoot>tr>td{
			border:solid 1px; border-collapse: collapse; padding:2px;
		}
		</style>
		
	</head>
	<body>
	  	<div id="header">
	  		';

	  		$html.=$excel_box;

	 		$html.='
		</div>
	</body>
</html>';

//echo $html; exit;



$name='Quotation-'.h(($quotation->qt1.'_QO'.str_pad($quotation->qt2, 3, '0', STR_PAD_LEFT).'_'.$quotation->qt3.'_'.$quotation->qt4));
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

if($send_email=='true'){
	$to=$emailRecord->send_to;
	$send_to_array=explode(',',$to);
	$to_emails=[];
	foreach($send_to_array as $data){
		$to_emails[$data]='q';
	}
	
	$subject=$emailRecord->subject;
	$message=$emailRecord->message;
	
	$output = $dompdf->output();
	file_put_contents($name, $output);


	$email = new Email();
	$email->transport('SendGrid');

	try {
		$res = $email->from(['ashishbohara1008@gmail.com' => 'ashish'])
			  ->to($to_emails)
			  ->subject($subject)
			  ->attachments([
			$name.'.pdf' => [
				'file' => $name
			]
		])
		->send($message);
			  
	} catch (Exception $e) {

		echo 'Exception : ',  $e->getMessage(), "\n";

	}
}




$dompdf->stream($name,array('Attachment'=>0));
exit(0);

?>