<?php
class Admin_model extends CI_Model{
    public function insertCategorie($categorie=''){
        $sql = "INSERT INTO Categorie values(null,%s)";
        $sql = sprintf($sql,$this->db->escape($categorie));
        $this->db->query($sql);
    }
    public function utilisateurInscrits(){
        $this->db->select('COUNT(idUtilisateur) as nombre');
        $this->db->from('utilisateur');
        $query = $this->db->get();
        $results = $query->result();
        $value = 0;
        foreach($results as $row){
            $value = $row->nombre;
        }
        return $value;
    }
    public function echangeEffectue(){
        $this->db->select('COUNT(idEchange) as nombre');
        $this->db->from('echange');
        $query = $this->db->get();
        $results = $query->result();
        $value = 0;
        foreach($results as $row){
            $value = $row->nombre;
        }
        return $value;
    }
    
}
?>