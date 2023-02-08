<?php
class Function_model extends CI_Model{
    public function last_insert_id(){
        $this->load->database();
        $query = $this->db->query("select LAST_INSERT_ID() as last_insert_id");
        $row = $query->row();
    
        $last_insert_id = $row->last_insert_id;
        return $last_insert_id;
    }
    public function get_all_records($table_name){
        $query = $this->db->get($table_name);
        return $query->result();
    }
}

?>