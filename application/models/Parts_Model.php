<?php

class Parts_Model extends CI_Model {

    function __construct() {
        parent::__construct(); // construct the Model class
    }

    public function get_all_department(){
        
        $query = $this->db->get("department");
        
        return $query->result();
    }
   

}
