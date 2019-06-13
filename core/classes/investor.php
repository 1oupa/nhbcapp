<?php
    class Investors{

        private $db;

        public function __construct($database){
            $this->db = $database;
        }

        public function insert_investor($first_name,$last_name,$cell,$organisation,
                                            $addr1,$addr2,$addr3,$addr4){
            global $db;
            
            $query 	= $this->db->prepare("INSERT INTO `investors` (`first_name`,`last_name`, `contact`, 
                                                                  `organisation`, `addr1`,`addr2`, 
                                                                  `addr3`, `addr4`) 
                                          VALUES                  (?, ?, ?, ?, ?, ?, ?, ?) ");

            $query->bindValue(1, $first_name);
            $query->bindValue(2, $last_name);
            $query->bindValue(3, $contact);	
            $query->bindValue(4, $organisation);	
            $query->bindValue(5, $addr1);
            $query->bindValue(6, $addr2);
            $query->bindValue(7, $addr3);	
            $query->bindValue(8, $addr4);	
        

            try{
                $query->execute();
            }catch(PDOException $e){
                die($e->getMessage());
            }	
		
        }


        public function update_investor($first_name, $last_name, $contact, 
                                        $organisation, $addr1, $addr2, $addr3, $addr4){

            $query = $this->db->prepare("UPDATE `investors` SET
                                        `first_name`		= ?,
                                        `last_name`			= ?,
                                        `contact`			= ?,
                                        `organisation`		= ?,
                                        `addr1`				= ?,
                                        `addr2`				= ?,
                                        `addr3`				= ?,
                                        `addr4`				= ? ");

            $query->bindValue(1, $first_name);
            $query->bindValue(2, $last_name);
            $query->bindValue(3, $contact);
            $query->bindValue(4, $organisation);
            $query->bindValue(5, $addr1);
            $query->bindValue(6, $addr2);
            $query->bindValue(7, $addr3);	
            $query->bindValue(8, $addr4);;
            
            try{
                $query->execute();
            }catch(PDOException $e){
                die($e->getMessage());
            }	
        }

        public function delete_investor($investor_id){
        
            $query = $this->prepare("DELETE FROM `investors` WHERE `investor_id` = ?");
		    $query->bindValue(1, $investor_id);
		
			try
			{
				$query->execute();
			}
			catch(PDOException $e)
			{
				die($e->getMessage());
			}	
		
        }

        public function investor_data($investor_id){

            $query = $this->db->prepare("SELECT * FROM `investors` WHERE `investor_id`= ?");
            $query->bindValue(1, $investor_id);

            try{
                $query->execute();
                return $query->fetchAll();
            } catch(PDOException $e){
                die($e->getMessage());
            }
        }

        public function get_investors(){

			$query = $this->db->prepare("SELECT * FROM `investors` ORDER BY `investor_id`");
			
			try{
				$query->execute();
			}catch(PDOException $e){
				die($e->getMessage());
			}

			return $query->fetchAll();
        }

        public function get_investors_num(){

            $query = $this->db->prepare("SELECT COUNT(`investor_id`) FROM `investors`");

            try{
                $query->execute();
				return $query->fetchColumn();
			} catch(PDOException $e){
				die($e->getMessage());
			}
        }

        //get total amount invested by all investors since since
        public function get_total_capital(){

            $query = $this->db->prepare("SELECT SUM(`capital`) FROM `investors`)");

            try{
                $query->execute();
                return $query->fetchColumn();
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }

    }
?>