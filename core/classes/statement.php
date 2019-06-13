<?php
    class Statements{

        private $db;

        public function __construct($database){
            $this->db = $database;
        }

        public function insert_statement($investor_id, $opening_balance, $ob_date, $interest_accrued, 
                                            $withdrawal_amount, $withdrawal_date, $closing_balance,
                                            $cb_date){

            global $db;

			$query = $this->db->prepare("	INSERT INTO 'statements' (`investor_id`,`opening_balance`,
                                                                      `ob_date`,`interest_accrued`,
                                                                      `withdrawal_amount`,`withdrawal_date`
                                                                      `closing_balance`,`cb_date`)
											VALUES 		(?,?,?,?,?,?,?,?)");
			
			$query->bindValue(1, $investor_id);
			$query->bindValue(2, $opening_balance);
            $query->bindValue(3, $ob_date);
            $query->bindValue(4, $interest_accrued);
            $query->bindValue(5, $withdrawal_amount);
            $query->bindValue(6, $withdrawal_date);
            $query->bindValue(7, $closing_balance);
            $query->bindValue(8, $cb_date);

			try{
				$query->execute();
			}catch(PDOException $e){
				die($e->getMessage());
			}

        }

        //Get one specific statement
        public function statement_info($statement_id,$investor_id){

            $query = $this->db->prepare("SELECT * FROM `statements` WHERE `statement_id` = ? AND `investor_id` = ?");

            $query->bindValue(1, $statement_id);
            $query->bindValue(2, $investor_id);

            try{
                $query->execute();
            }catch(PDOException $e){
                die($e->getMessage());
            }

        }

        public function get_statements(){

			$query = $this->db->prepare("SELECT * FROM `statements` ORDER BY `statement_id`");
			
			try{
				$query->execute();
			}catch(PDOException $e){
				die($e->getMessage());
			}

			return $query->fetchAll();
        }

        //get total of all withdrawals
        public function get_total_withdrawals(){

            $query = $this->db->prepare("SELECT SUM(`withdrawal_amount` FROM `statements`");

			try{

				$query->execute();

				return $query->fetchColumn();

			} catch(PDOException $e){

				die($e->getMessage());
			}

        }



    }
?>