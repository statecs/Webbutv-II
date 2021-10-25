<?php
/* SMPTP anslutning, med portnummer */
$host = '{'.$_POST['mailserver_host'].':'. $_POST['mailserver_port'] . '/imap/ssl/
	novalidate-cert/norsh}INBOX';
	
/* Dina inloggningsuppgifter */
$user = $_POST['username'];
$password =  $_POST['password'];

/* Upprätta en IMAP-anslutning */
$conn = imap_open($host, $user, $password) 
 or die('Det gick inte att ansluta:' . imap_last_error());

/* Sök e-postmeddelanden från gmail inbox*/
$mails = imap_search($conn, 'SUBJECT "Comment"');

/* Loopa dig igenom varje e-post-ID om det finns e-postmeddelanden. */
if ($mails) {

/* Start av utdatavariabel */
$mailOutput = '';
$mailOutput.= '<table><tr><th>Ämne </th><th> Från  </th> 
		   <th> Datum Tid </th> <th> Innehåll </th></tr>';

/* rsort används för att visa de senaste e-postmeddelandena högst upp */
rsort($mails);

/* för varje epostmeddelande */
foreach ($mails as $email_number) {

	/* Hämta specifik e-postinformation */
	$headers = imap_fetch_overview($conn, $email_number, 0);

	/*  Returnerar en del av body */
	$message = imap_fetchbody($conn, $email_number, '1');
	$subMessage = substr($message, 0, 150);
	$finalMessage = trim(quoted_printable_decode($subMessage));

	$mailOutput.= '<div class="row">';

	/* Gmail MAILS header information */                   
	$mailOutput.= '<td><span class="columnClass">' .
				$headers[0]->subject . '</span></td> ';
	$mailOutput.= '<td><span class="columnClass">' . 
				$headers[0]->from . '</span></td>';
	$mailOutput.= '<td><span class="columnClass">' .
				 $headers[0]->date . '</span></td>';
	$mailOutput.= '</div>';

	/* Mail body returneras */
	$mailOutput.= '<td><span class="column">' . 
	$finalMessage . '</span></td></tr></div>';
}// slut på foreach

$mailOutput.= '</table>';
echo $mailOutput;
}//endif 

/* imap connection är stängd */
imap_close($conn);

?>
