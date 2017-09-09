<?php

class describeModel extends Model {

	public function __construct() {

		parent::__construct();
	}

	public function getArtefactDetails($id){
		
		$db = $this->db->useDB();
		$collection = $this->db->selectCollection($db, ARTEFACT_COLLECTION);

		$result = $collection->findOne(['id' => $id ]);
		$result = $this->unsetControlParams($result);

		return $result;
	}

	public function getArtefactImages($id){
		
		$artefactPath = PHY_DATA_URL . $id . '/thumbs/*' . PHOTO_FILE_EXT;
		$images = [];
		$images = glob($artefactPath);
		
		array_walk($images, function(&$value, &$key) {
		    $value = str_replace(PHY_DATA_URL, DATA_URL, $value);
		});

		return $images;
	}

	public function getNeighbourhood($details, $filter) {

		$id = $details['id'];
		$type = $details['Type'];
		$sortKey = $this->getPrecastKey($type, 'sortKey');

		$db = $this->db->useDB();
		$collection = $this->db->selectCollection($db, ARTEFACT_COLLECTION);

		$matchFilter = $this->preProcessQueryFilter($filter);
		
		$match = [ 'DataExists' => $this->dataShowFilter, 'Type' => $type] + $matchFilter;
		$iterator = $collection->aggregate(
				 [
					[ '$match' => $match ],
					[ 
						'$project' => [
							'id' => 1,
							$sortKey => 1,
							'sortKeyExists' => [ '$cond' => [ '$' . $sortKey, '1', '0' ]]
						]
					],
					[
						'$sort' => [
							'sortKeyExists' => -1,
							$sortKey => 1
						]
					]
				]
			);

		$idList = [];
		foreach ($iterator as $row) {
		
			array_push($idList, $row['id']);
		}

		$match = array_search($id, $idList);

		if(!($match === False)) {
			
			$data['prevID'] = (isset($idList[$match - 1])) ? $idList[$match - 1] : '';
			$data['nextID'] = (isset($idList[$match + 1])) ? $idList[$match + 1] : '';

			$data['prevID'] = str_replace('/', '_', $data['prevID']);
			$data['nextID'] = str_replace('/', '_', $data['nextID']);

			return $data;
		}	
		else{

			return False;
		}
	}
}
?>
