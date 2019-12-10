<?php

	require_once dirname(__FILE__).'/vendor/autoload.php';

	use Spipu\Html2Pdf\Html2Pdf;
	use Spipu\Html2Pdf\Exception\Html2PdfException;
	use Spipu\Html2Pdf\Exception\ExceptionFormatter;

	try {
	    ob_start();
	    include dirname(__FILE__).'\vendor\spipu\html2pdf\examples\res\balloon.php';
	    $content = ob_get_clean();

	    $html2pdf = new Html2Pdf('P', 'A4', 'fr');
	    $html2pdf->writeHTML($content);
	    $html2pdf->output('baloon.pdf');
	} catch (Html2PdfException $e) {
	    $html2pdf->clean();

	    $formatter = new ExceptionFormatter($e);
	    echo $formatter->getHtmlMessage();
	}
?>