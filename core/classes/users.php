<?php
	class Users{
		
		private $db;

		public function __construct($database) {
			$this->db = $database;
		}	
		
		//Insert a new user
		public function insert_user($username,$email,$password,$usertype)
		{
			global $db;

			$query = $this->$db->prepare("	INSERT INTO 'users' (`username`,`email`,`password`,`usertype`) 
											VALUES 		(?,?,?,?)");
			
			$query->bindValue(1, $username);
			$query->bindValue(2, $email);
			$query->bindValue(3, $password);
			$query->bindValue(4, $usertype);

			try{
				$query->execute();
			}catch(PDOException $e){
				die($e->getMessage());
			}	

		}

		//update an existing users info
		public function update_user($user_id,$username,$email,$password)
		{

			$query = $this->db->prepare("UPDATE `users` SET
										`username`	= ?,
										`email`		= ?,
										`password`	= ?
										
										WHERE `user_id` 		= ?");

			$query->bindValue(1, $username);
			$query->bindValue(2, $email);
			$query->bindValue(3, $password);
			$query->bindValue(4, $user_id);
			
			try{
				$query->execute();
			}catch(PDOException $e){
				die($e->getMessage());
			}	
		}

		//check if username exists when registering new user 
		public function user_exists($username) {
		
			$query = $this->db->prepare("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = ?");
			$query->bindValue(1, $username);
		
			try{

				$query->execute();
				$rows = $query->fetchColumn();

				if($rows == 1){
					return true;
				}else{
					return false;
				}

			} catch (PDOException $e){
				die($e->getMessage());
			}

		}
		
		//check if email exists when registering new user
		public function email_exists($email) {

			$query = $this->db->prepare("SELECT COUNT(`user_id`) FROM `users` WHERE `email`= ?");
			$query->bindValue(1, $email);
		
			try{

				$query->execute();
				$rows = $query->fetchColumn();

				if($rows == 1){
					return true;
				}else{
					return false;
				}

			} catch (PDOException $e){
				die($e->getMessage());
			}

		}

		//function for registering a user
		public function register($password, $email){

			global $bcrypt; // making the $bcrypt variable global so we can use here

			$date 		= date("y-m-d");
			
			$password   = $bcrypt->genHash($password);

			$query 	= $this->db->prepare("INSERT INTO `users` (`username`,`email`,`password`,`usertype`, `date`) 
											VALUES (?, ?, ?, ?, ?) ");

			$query->bindValue(1, $username);
			$query->bindValue(2, $email);
			$query->bindValue(3, $password);
			$query->bindValue(4, $usertype);
			$query->bindValue(5, $date);

			try{
				$query->execute();

			}catch(PDOException $e){
				die($e->getMessage());
			}	
		}

		//function for login in
		public function login($email, $password) {

			global $bcrypt;  // Again make get the bcrypt variable, which is defined in init.php, which is included in login.php where this function is called

			$query = $this->db->prepare("SELECT `password`, `id` FROM `users` WHERE `email` = ?");
			$query->bindValue(1, $email);

			try{
				
				$query->execute();
				$data 				= $query->fetch();
				$stored_password 	= $data['password']; // stored hashed password
				$user_id   				= $data['user_id']; // id of the user to be returned if the password is verified, below.
				
				if($bcrypt->verify($password, $stored_password) === true){ // using the verify method to compare the password with the stored hashed password.
					return $user_id;	// returning the user's id.
				}else{
					return false;	
				}

			}catch(PDOException $e){
				die($e->getMessage());
			}
		
		}

		//Get specific user information
		public function userdata($user_id) {

			$query = $this->db->prepare("SELECT * FROM `users` WHERE `user_id`= ?");
			$query->bindValue(1, $user_id);

			try{

				$query->execute();

				return $query->fetch();

			} catch(PDOException $e){

				die($e->getMessage());
			}

		}
		
		//get all users information
		public function get_users() {

			$query = $this->db->prepare("SELECT * FROM `users` ORDER BY `user_id`");
			
			try{
				$query->execute();
			}catch(PDOException $e){
				die($e->getMessage());
			}

			return $query->fetchAll();

		}	
	}

?>