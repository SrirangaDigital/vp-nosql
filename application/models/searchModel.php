<?php

class searchModel extends Model {

	public function __construct() {

		parent::__construct();
	}

	public function getSearchResults($data, $page){
	
		$db = $this->db->useDB();
		$collection = $this->db->selectCollection($db, ARTEFACT_COLLECTION);
	
		$term = $data['term'];
		$term = preg_quote($term, '/');
	
		$skip = ($page - 1) * PER_PAGE;
		$limit = PER_PAGE;
	
		$iterator = $collection->find(
			[	
				'DataExists' => $this->dataShowFilter,
				'$text' => [
					'$search' => $term
				]
			], 
			[
				'projection' => [
					'score' => [
						'$meta' => 'textScore'
					],
				],
				'sort' => [
					'score' => [
						'$meta' => 'textScore'
					]
				],
				'skip' => $skip,
				'limit' => $limit
			]
		);
	
		$data = [];
	
		$result = iterator_to_array($iterator, true);
	
		foreach ($result as $row) {
	
			$row['idURL'] = str_replace('/', '_', $row['id']);
			$row['cardName'] = $this->getMatchingFieldsHTML($row->getArrayCopy(), $term);
			$row['thumbnailPath'] = $this->getThumbnailPath($row['id']);
	
			array_push($data, $row);
		}
	
		if(!empty($data))
			$data['term'] = $term;
		else
			$data = 'noData';
	
		return $data;
	}


	public function getMatchingFieldsHTML($descArray, $searchTerm){

		$searchTerm = $searchTerm;
		$terms = explode(' ', $searchTerm);
		$termsRegex = implode('|', $terms);
		$allWords = array_map('strtolower', $terms);

		$matches = [];
		if(isset($descArray['Type'])) array_push($matches, '<strong>Type</strong> : ' . $descArray['Type']);

		foreach ($terms as $term) {
			
			foreach ($descArray as $key => $value) {
				
				if(preg_match('/' . $term . '/i', $value)){

					$value = preg_replace("/($termsRegex)/i", "<span class=\"highlight\">$1</span>", $value);
					array_push($matches, '<strong>' . $key . '</strong> : ' . $value);
					unset($descArray{$key});
				}
			}			
		}

		$html = implode($matches, '<br />');

		preg_match_all('/<span class="highlight">(.*?)<\/span>/', $html, $matches);
		$removedWords = array_unique(array_map('strtolower', $matches[1]));

		$remainigWords = array_map('ucwords', array_diff($allWords, $removedWords));
		$remainingWordsString = '<span class="term-not-exists">' . implode('</span> <span class="term-not-exists">', $remainigWords) . '</span>';

		return ($remainigWords) ? $html . '<br />' . $remainingWordsString : $html;
	}
}
?>
