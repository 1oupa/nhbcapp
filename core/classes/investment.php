<?php
    class Investments{

        private $db;

        public function __construct($database){
            $this->db = $database;
        }

        public function insert_investment($capital, $start_date, $product_type){

            global $db;

			$query = $this->$db->prepare("	INSERT INTO `investments` (`capital`,`start_date`,`product_type`) 
											VALUES 		(?,?,?)");

			$query->bindValue(1, $capital);
            $query->bindValue(2, $start_date);
            $query->bindValue(3, $product_type);

			try{
				$query->execute();
			}catch(PDOException $e){
				die($e->getMessage());
			}	

        }

        public function update_investment($investment_id, $capital, $start_date, $product_type){
            
            $query = $this->db->prepare("UPDATE `investments` SET
                                         `capital`              = ?,
                                         `start_date`           = ?,
                                         `product_type`         = ?
                                         
                                         WHERE `investor_id`    = ?");

            $query->bindValue(1, $capital);
            $query->bindValue(2, $start_date);
            $query->bindValue(3, $product_type);
            $query->bindValue(4, $investment_id);

            try{
                $query->execute();
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }

        public function delete_investment($investment_id){

            $query = $this->db->prepare("DELETE FROM `investments` WHERE `investment_id` = ?");

            $query->bindValue(1, $investment_id);

            try{
                $query->execute();
            }catch(PDOException $e){
                die($e->getMessage());
            }

        }

        public function investment_data($investment_id){

			$query = $this->db->prepare("SELECT * FROM `investments` WHERE `investment_id` = ?");
			$query->bindValue(1, $investment_id);

			try{

				$query->execute();

				return $query->fetch();

			} catch(PDOException $e){

				die($e->getMessage());
			}
        }

        public function get_investments(){

            $query = $this->db->prepare("SELECT * FROM `investments` ORDER BY `start_date`");
			
			try{
				$query->execute();
			}catch(PDOException $e){
				die($e->getMessage());
			}

			return $query->fetchAll();

        }

        public function get_total_investments(){

            $query = $this->db->prepare("SELECT SUM(`capital`) FROM `investments`");

            try{
				$query->execute();
				return $query->fetchColumn();
			} catch(PDOException $e){
				die($e->getMessage());
            }
            
            return $query->fetchColumn();
        }

    }
?>