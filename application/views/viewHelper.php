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
}

?>
