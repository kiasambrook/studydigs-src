<?php
    /*
    * PDO Database Class
    * Connect to database
    * Create prepared statements 
    * Bind values 
    * Return rows and results
    */
    class Database{
        private $host = DB_HOST;
        private $user = DB_USER;
        private $pass = DB_PASS;
        private $dbname = DB_NAME;

        // database handler
        private $dbh;
        private $stmt;
        private $error;

        /**
         * On construction, a PDO instance is created and connected to the database.
         */
        public function __construct(){
            // Set DSN
            $dsn = 'mysql:host=' . $this->host . ';dbname='. $this->dbname;
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                'enableParamLogging' =>true,
            );

            // Create PDO instance
            try{
                $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
            }catch(PDOException $e){
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        /**
         * Start a transaction
         */
        public function beginTransaction(){
            $this->dbh->beginTransaction();
        }

        /**
         * Commit a transaction
         */
        public function commitTransaction(){
            $this->dbh->commit();
        }

        /**
         * Get the last inserted id.
         *
         * @return void
         */
        public function getLastId(){
            return $this->dbh->lastInsertId();
        }

        /**
         * Perpare statemnet with query.
         *
         * @param String $sql - The string to query the database with.
         * @return void
         */
        public function query($sql){
            $this->stmt = $this->dbh->prepare($sql);
        }

        /**
         * Bind a value to the prepared statement.
         *
         * @param $param - The parameter is bind
         * @param $value - The value to bind to.
         * @param $type - The type of the parameter.
         * @return void
         */
        public function bind($param, $value, $type = null){
            // set type
            if(is_null($type)){
                switch(true){
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                
                }
            }

            $this->stmt->bindValue($param, $value, $type);
        }

        /**
         * Execute the prepared statement.
         *
         * @return void
         */
        public function execute(){
            return $this->stmt->execute();
        }

        /**
         * Get multiple rows of results as objects.
         *
         * @return void
         */
        public function resultSet(){
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        /**
         * Get a single row result as a result.
         *
         * @return void
         */
        public function single(){
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        /**
         * Get multiple rows of results as array list.
         *
         * @return void
         */
        public function resultSetArray(){
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        /**
         * Count the number of return rows.
         *
         * @return void
         */
        public function rowCount(){
            $this->execute();
            
            return $this->stmt->rowCount();
        }
    }