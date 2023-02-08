<?php
class Article_model extends CI_Model{
    public function getAll($idUtilisateur){
        $this->db->select('*');
        $this->db->from('article');
        $this->db->where('idUtilisateur !=',$idUtilisateur);
        $query = $this->db->get();
        return $query->result();
    }
    public function getAllPriority($idUtilisateur){
        $this->db->select('*');
        $this->db->from('article');
        $this->db->where('idUtilisateur',$idUtilisateur);
        $query = $this->db->get();
        return $query->result();
    }
    public function getAllPriorityy($idUtilisateur){
        $this->db->select('*');
        $this->db->from('liste_article');
        $this->db->where('idUtilisateur',$idUtilisateur);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllarticle($idUtilisateur){
        $this->db->select('*');
        $this->db->from('liste_article');
        $this->db->where('idUtilisateur !=',$idUtilisateur);
        $query = $this->db->get();
        return $query->result();
    }

}
?>