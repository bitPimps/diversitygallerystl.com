<?php
class UserIdentitySR {
	private $userIdentitys;
	private $totalNum;
	private $currNum;
	
	/* Constructor */
	public function __construct($dbConn, $lowerBound, $upperBound, $searchCrit, $sortBy) {
		$sql = 	"SELECT COUNT(DISTINCT id) FROM UserIdentities";
		$recordSetId = mysqli_query($dbConn, $sql);
		if(!$recordSetId) {
			$theSqlError = mysqli_error($dbConn);
			handleDbError($theSqlError);
		}
		$recordSet = mysqli_fetch_row($recordSetId);
		$this->totalNum = $recordSet[0];
		
		// Select All
		$sql =	"SELECT id, username, password FROM UserIdentities";
		if($searchCrit != "") {
			$sql = $sql . " WHERE (username LIKE '%" . $searchCrit . "%' OR password LIKE '%" . $searchCrit . "%')";

			if(isset($sortBy) && $sortBy != "") {
				$sql = $sql . " ORDER BY " . $sortBy . " ASC";
			} else {
				$sql = $sql . " ORDER BY username ASC";
			}
			$sql = $sql . " LIMIT " . $lowerBound . "," . $upperBound;
		}
		$recordSetId = mysqli_query($dbConn, $sql);
		if(!$recordSetId) {
			$theSqlError = mysqli_error($dbConn);
			handleDbError($theSqlError);
		}
		$this->currNum = mysqli_num_rows($recordSetId);
		while ($recordSet = mysqli_fetch_array($recordSetId)) {
			$this->userIdentitys[] = new UserIdentity($recordSet);
		}
	}

	public function getCurrNum() {
		return $this->currNum;
	}
	public function getTotalNum() {
		return $this->totalNum;
	}
	public function getUserIdentitys() {
		return $this->userIdentitys;
	}
}
?>