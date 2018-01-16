<?php

class viewHelper extends View {

    public function __construct() {

    }

    public function displayDate($date){
        
        return strftime("%B, %G",strtotime($date));
    }

    public function kannadaMonth($month) {
    	# code...

		$month = preg_replace('/01/', 'ಜನವರಿ', $month);
		$month = preg_replace('/02/', 'ಫೆಬ್ರವರಿ', $month);
		$month = preg_replace('/03/', 'ಮಾರ್ಚ್', $month);
		$month = preg_replace('/04/', 'ಏಪ್ರಿಲ್', $month);
		$month = preg_replace('/05/', 'ಮೇ', $month);
		$month = preg_replace('/06/', 'ಜೂನ್', $month);
		$month = preg_replace('/07/', 'ಜುಲೈ', $month);
		$month = preg_replace('/08/', 'ಆಗಸ್ಟ್', $month);
		$month = preg_replace('/09/', 'ಸೆಪ್ಟೆಂಬರ್', $month);
		$month = preg_replace('/10/', 'ಅಕ್ಟೋಬರ್', $month);
		$month = preg_replace('/11/', 'ನವೆಂಬರ್', $month);
		$month = preg_replace('/12/', 'ಡಿಸೆಂಬರ್', $month);
	
		return $month;
	}

	public function rlZero($term) {

		return preg_replace('/^0+|\-0+/', '', $term);
	}

	public function getCoverPage($filter){

		$coverURL = PHY_DATA_URL; 
		$coverURL .= (isset($filter['volume'])) ? $filter['volume'] . '/' : '';
		$coverURL .= (isset($filter['issue'])) ? $filter['issue'] . '/' : '01/';
		$coverURL .= 'cover.jpg';
		return (file_exists($coverURL)) ? str_replace(PHY_DATA_URL, DATA_URL, $coverURL) : IMAGE_URL . 'generic-cover.jpg'; 
	}

	public function getDisplayName($filter){

		$displayString = '';

		foreach ($filter as $key => $value) {
				
			$displayString .= constant('ARCHIVE_' . strtoupper($key)) . ' ' . $this->roman2Kannada($this->rlZero($value));
		}

		return $displayString;
	}	

	public function getStructurePageTitle($filter){

		$pageTitle = ARCHIVE . ' > ' . NAV_ARCHIVE_VOLUME;

		foreach ($filter as $key => $value) {
				
			$pageTitle .= ' > ' . constant('ARCHIVE_' . strtoupper($key)) . ' ' . $this->roman2Kannada($this->rlZero($value));
		}

		return $pageTitle;
	}

	public function roman2Kannada($str){

		$str = str_replace('0', '೦', $str);
		$str = str_replace('1', '೧', $str);
		$str = str_replace('2', '೨', $str);
		$str = str_replace('3', '೩', $str);
		$str = str_replace('4', '೪', $str);
		$str = str_replace('5', '೫', $str);
		$str = str_replace('6', '೬', $str);
		$str = str_replace('7', '೭', $str);
		$str = str_replace('8', '೮', $str);
		$str = str_replace('9', '೯', $str);
		return $str;
	}
}

?>
