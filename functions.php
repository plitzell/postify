<?php

	function connect() {
		$mysqli = new mysqli("localhost", "root", "", "postify");
		if ($mysqli->connect_errno) {
			echo "Connect failed: ".$mysqli->connect_error;
			exit();
		} 
		return $mysqli;
	}
	
	function registerUser($email,$password) {
		$registration = false;
		$salt = sha1($email);
		$hashpass = sha1($password.$salt);

		$mysqli = connect();
		
		if ($stmt = $mysqli->prepare("INSERT INTO users (email,password) VALUES (?,?)")) {
			if ($stmt->bind_param('ss', $email, $hashpass)) {
				if ($stmt->execute()) {
					$registration = true;
				}
			}
		}
		$mysqli->close();
		return $registration;
	}
	
	function checkLogin($email,$password) {
		$mysqli = connect();
		$validlogin = false;
		$salt = sha1($email);
		$hashpass = sha1($password.$salt);
		$stmt = $mysqli->prepare("SELECT `id` FROM `users` WHERE `email` = ? AND `password` = ? LIMIT 1");
		$stmt->bind_param('ss', $email,$hashpass);
		$stmt->execute();
		$stmt->store_result();
		
		if ( ($stmt->num_rows)>0) {
			$stmt->bind_result($resultid);
			while ($stmt->fetch()) {
				$userid = $resultid;
			}
			$validlogin = true;	
			$stmt = $mysqli->prepare("INSERT INTO `logins` (userid) VALUES (?)");
			$stmt->bind_param('i', $userid);
			$stmt->execute();
		}
		
		$mysqli->close();
		return $validlogin;
	}
	
	function lastLogins($email) {
		$mysqli = connect();

		$query = $mysqli->prepare("SELECT `timestamp` FROM `logins`,`users` WHERE `users`.`id` =  `logins`.`userid` AND `users`.`email` LIKE ? ORDER BY timestamp DESC LIMIT 5");
		$query->bind_param('s', $email);
		$query->execute();

		$query->bind_result($returned_time);
		while($query->fetch()){
			echo "Inloggning: ".$returned_time . '<br />';
		}
	
		$mysqli->close();
	}
?>