<?php

class articleModel extends Model {

	public function __construct() {

		parent::__construct();
	}

	public function generatePDF($volume, $issue, $pageRange) {

		$pdfFile = PHY_DATA_URL . $volume . '/' . $issue . '/index.pdf';
		$articlePdf = $volume . '_' . $issue . '_' . $pageRange;
		$cmd = 'pdftk ' . $pdfFile . ' cat ' . $pageRange . ' output ' . PHY_DOWNLOAD_URL . $articlePdf  . '.pdf';
		exec('find ' . PHY_DOWNLOAD_URL . ' -mmin +10 -type f -name "*.pdf" -exec rm {} \;');
		exec($cmd, $output, $return);

		return $return;
	}
}
?>
