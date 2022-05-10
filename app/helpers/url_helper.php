<?php 
    /**
     * A simple redirect function.
     *
     * @param String $page - The location of the page to locate to.
     * @return void
     */
    function redirect($page){
        header('location: ' . URLROOT . $page);
    }