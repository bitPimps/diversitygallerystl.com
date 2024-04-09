<?php
class UserIdentity {
	private $id;
	private $username;
	private $password;

	public function __construct($recordSetArray) {
		if(!isset($recordSetArray) || $recordSetArray == "") {
			$this->id         	= -1;
			$this->username   	= "";
			$this->password   	= "";
		} else {
			$this->id   		= $recordSetArray["id"];
			$this->username   	= stripslashes($recordSetArray["username"]);
			$this->password   	= stripslashes($recordSetArray["password"]);
		}
	}

	public function save ($dbConn) {
		if(!isset($this->id) || (integer)$this->id == -1 || $this->id == "") {
			$sql =  "INSERT INTO UserIdentities" .
					" (username, password)" .
					" VALUES ('" .
							  addslashes($this->username) . "','" .
							  addslashes($this->password) . "')";
		} else {
			$sql =  "UPDATE UserIdentities SET " .
					" username='" . addslashes($this->username) . "'," .
					" password='" . addslashes($this->password) . "'" .
					" WHERE id=" . $this->id;
		}
		$result = mysqli_query($dbConn, $sql);
		if (!$result) {
			return "Database Error Occurred: " . $sql . "<br>" . htmlspecialchars(mysqli_error($dbConn));
		} else {
			return "";
		}
	}
	// Getters & Setters
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}

	public function getUsername() {
		return $this->username;
	}
	public function setUsername($username) {
		$this->username = $username;
	}

	public function getPassword() {
		return $this->password;
	}
	public function setPassword($password) {
		$this->password = $password;
	}

	public function getUserIdentity($dbConn, $id) {
		$sql = "SELECT * FROM UserIdentities WHERE id=" . $id;
		$recordSetId = mysqli_query($dbConn, $sql);
		if(!$recordSetId) {
			$theSqlError = mysqli_error($dbConn);
			handleDbError($theSqlError);
		}
		$recordSetArray = mysqli_fetch_array($recordSetId);
		$user = new UserIdentity($recordSetArray);
		return $user;
	}

	public function deleteUserIdentity ($dbConn, $id) {
		$sql = "DELETE FROM UserIdentites WHERE id=" . $id;
		$result = mysqli_query($dbConn, $sql);
		if (!$result) {
			return "Database Error Occurred: " . $sql . "<br>" . htmlspecialchars(mysqli_error($dbConn));
		} else {
			return "";
		}
	}
}
?>