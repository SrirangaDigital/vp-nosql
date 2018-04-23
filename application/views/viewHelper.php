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

	public function displayArticles($articles, $level){

		if(preg_match('/1|2/', $level)){

			foreach ($articles as $article) {

				if($article['articleType'] == $level){

					echo '<div class="row">';
					echo '	<div col-md-12>';
					echo '		<a href="' . BASE_URL . 'article/text/' . $article['volume'] . '/' . $article['issue'] . '/#page=' . $article['relativePageNumber'] . '" target="_blank">';
					echo '	      <img class="img-fluid" src="' . DATA_URL . $article['volume'] . '/' . $article['issue'] . '/' . $article['page'] . '.jpg">';
					echo '	      <p class="title">' . $article['title'] . '</p>';

					if(isset($article['text']))
						echo '	      <p class="content">' . $article['text'] . '</p>';

					if(isset($article['author'])){

						if(isset($article['author'])){
							foreach ($article['author'] as $author) {
								echo '<span><a class="author by" href="' . BASE_URL . 'articles/author/' . $author['name'] . '">' . $author['name'] . '</a></span>';
							}
						}
					}
					echo '		</a>';
					echo '	</div>';
					echo '</div>';
				}
			}
		}
		elseif (preg_match('/3/', $level)) {

			foreach ($articles as $article) {

				if($article['articleType'] == $level){

					echo '<div class="cards-wrapper">';
					echo '		<a href="' . BASE_URL . 'article/text/' . $article['volume'] . '/' . $article['issue'] . '/#page=' . $article['relativePageNumber'] . '" target="_blank">';
					echo '	      <img class="img-fluid" src="' . DATA_URL . $article['volume'] . '/' . $article['issue'] . '/' . $article['page'] . '.jpg">';
					echo '            <p class="title">' . $article['title'] . '</p>';

					if(isset($article['text']))
						echo '	      <p class="content">' . $article['text'] . '</p>';

					if(isset($article['author'])){

						if(isset($article['author'])){
							foreach ($article['author'] as $author) {
								echo '<span><a class="author by" href="' . BASE_URL . 'articles/author/' . $author['name'] . '">' . $author['name'] . '</a></span>';
							}
						}
					}
					echo '		</a>';
					echo '</div>';
				}
			}
		}
	}
}

?>
