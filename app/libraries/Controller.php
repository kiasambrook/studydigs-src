<?php
    /*
    * Base Controller 
    * Loads the models and views
    */
    class Controller {
        /**
         * Create a database model
         *
         * @param String $model - The name of the model.
         * @return Model - The model that was created.
         */
        public function model($model){
            // require model file
            require_once '../app/models/' . $model . '.php';

            // Instatiate model
            return new $model;
        }

        /**
         * Load the requested view.
         *
         * @param String $view - The name of the view to create.
         * @param Array $data - Pass data to the view.
         * @return void
         */
        public function view($view, $data = []){
            // check for view file
            if(file_exists('../app/views/' . $view . '.php')){
                require_once '../app/views/' . $view . '.php';
            }
            else{
                // view does not exist
                die('View does not exist');
            }
        }
    }