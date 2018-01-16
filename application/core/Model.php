<?php

class Model {

	public function __construct() {

		$this->db = new Database();
	}
	
	public function getPostData() {

		if (isset($_POST['submit'])) {

			unset($_POST['submit']);	
		}

		if(!array_filter($_POST)) {
		
			return false;
		}
		else {

			return array_filter(filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS));
		}
	}

	public function filterSpecialChars($string){

		$string = str_replace('/', '_', $string);
		$string = urlencode($string);

		return $string;
	}

	public function preProcessQueryFilter($filter){

		foreach ($filter as $key => $value) {
			
			if($value == 'notExists')
				$filter{$key} = ['$exists' => false];
		}

		return $filter;
	}

	public function filterArrayToString($filter){

		$urlFilterArray = [];
		foreach ($filter as $key => $value) {
			
			array_push($urlFilterArray, $key . '=' . $this->filterSpecialChars($value));
		}
		$urlFilter = implode('&', $urlFilterArray);

		return $urlFilter;
	}

	public function preProcessURLQuery($filter){

		foreach ($filter as $key => $value) {
			
			$filter{$key} = str_replace('_', '/', $filter{$key});
		}

		return $filter;
	}

	public function getDataFromApi($url){

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, True);

		$result = curl_exec($curl);
		curl_close($curl);

		return $result;
	}

	public function getAlphabiticalList($field) {

		$url = BASE_URL . 'api/distinct/' . $field;
		$result = json_decode($this->getDataFromApi($url), true);

		$alphabetList = [];

		foreach ($result['values'] as $row) {
				
			array_push($alphabetList,preg_replace('/(^.).*/u', '$1', $row['item']));	
		}

		sort($alphabetList);
		$alphabetList = (sizeof($alphabetList) > 0) ? array_unique($alphabetList) : '';

		return $alphabetList;
	}

	public function rlZero($term) {

		return preg_replace('/^0+|\-0+/', '', $term);
	}

}

?>