<?php
    class Products{

        private $db;

        public function __construct($database){
            $this->db = $database;
        }

        public function insert_product($product_name,$product_interest,$product_date){

            global $db;

			$query = $this->db->prepare("	INSERT INTO 'products' (`product_name`,
                                                                    `product_interest`,
                                                                    `product_date`)
											VALUES 		(?,?,?)");
			
			$query->bindValue(1, $product_name);
			$query->bindValue(2, $product_interest);
            $query->bindValue(3, $product_date);

			try{
				$query->execute();
			}catch(PDOException $e){
				die($e->getMessage());
			}
        }

        //get specific product info
        public function product_info($product_name){

            $query = $this->db->prepare("SELECT * FROM `products` WHERE `product_name` = ?");

            $query->bindValue(1, $product_name);

            try{
                $query->execute();
            }catch(PDOException $e){
                die($e->getMessage());
            }

            return $query->fetchAll();
        }

        //get all products
        public function all_products(){

            $query = $this->db->prepare("SELECT * FROM `prodcucts` ORDER BY `product_date` DESC");
		
            try{
                $query->execute();
            }catch(PDOException $e){
                die($e->getMessage());
            }
    
            return $query->fetchAll();

        }

        public function get_products()
        {
            $query = $this->db->prepare("SELECT `product_name` FROM `products`");

            try{
                $query->execute();
                return $query->fetchColumn();   
            } catch(PDOException $e){    
                die($e->getMessage());
            }
        } 

    }



?>