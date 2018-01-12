<?php

class listingModel extends Model {


	public function __construct() {

		parent::__construct();
	}

	public function getCurrentIssueDetails(){

		$db = $this->db->useDB();
		$collection = $this->db->selectCollection($db, ARTEFACT_COLLECTION);
		
		$aggregatePipeline = [
				[ '$group' => [ '_id' => [ 'volume' => '$volume','issue' =>'$issue','month' => '$month','year' => '$year' ]]],
				[ '$sort' => [ '_id' => -1 ] ],
				[ '$skip' => NO_SKIP ],
				[ '$limit' => 1 ]
			];

		$iterator = $collection->aggregate($aggregatePipeline);
	
		$values = [];
		foreach ($iterator as $row) {
			
			$value['volume'] = $row['_id']['volume'];
			$value['issue'] = $row['_id']['issue'];
			$value['month'] = $row['_id']['month'];
			$value['year'] = $row['_id']['year'];
			array_push($values, $value);
		}

		$data = ['values' => $values];

		return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
	}
}

?>
