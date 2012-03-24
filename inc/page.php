<? 

class page {
		
	public $nextPageNum;
	public $prevPageNum;
	public $curPageNum;
		
	public function is_valid_page($page) {
		$this->curPageNum = $page;						
		if ($this->curPageNum = NULL) {			
			return false;
							
		} elseif(is_numeric($this->curPageNum)) {			
			return true;
								
	  }
	}
	
	public function nextPage($page) {
		$this->curPageNum = $page;
		$this->nextPageNum = $this->curPageNum+1;
		
		if ($this->is_valid_page($this->curPageNum)) {
			return $this->nextPageNum;
			print $this->nextPageNum;	
		}
			return $this->nextPageNum;
			print $this->nextPageNum;	
	}
	
	public function prevPage($page) {
		$this->curPageNum = $_GET['page'];
		
	  if ($this->is_valid_page($this->curPageNum)) {
			$this->prevPageNum = $this->curPageNum-1;
			return $this->prevPageNum;
		}
	}
			
} $page = new page;

?>