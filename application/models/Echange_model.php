<?php
class Echange_model extends CI_Model{

    public function getAllDemande($idUtilisateur){
        $this->db->select('*');
        $this->db->from('(SELECT idDemandeEchange, idArticle1, idArticle2, a1.idUtilisateur as idUtilisateur1, a2.idUtilisateur as idUtilisateur2, a1.titre, a1.description, a2.titre as monTitre, a2.description as monDescription FROM DemandeEchange de JOIN article a1 ON de.idArticle1=a1.idArticle JOIN article a2 ON de.idArticle2=a2.idArticle) as v_Demande');
        $this->db->where('idUtilisateur1',$idUtilisateur);
        $query = $this->db->get();
        return $query->result();
        // $sql = "select * from (SELECT ar.idArticle, ar.idUtilisateur, ar.idCategorie, ar.titre, ar.description, ar.prix, ap.nom from Article ar join Article_Photo ap on ar.idArticle=ap.idArticle where idUtilisateur=$idUtilisateur) as vv";
        // $query = $this->db->query($sql);
        // return $query->result();
    }
    


    public function demande($idArticle1,$idArticle2){
        $sql = "INSERT INTO DemandeEchange VALUES(null,%s,%s,now(),'0')";
        $sql = sprintf($sql,$this->db->escape($idArticle1),$this->db->escape($idArticle2));
        $this->db->query($sql);

        $sql = "INSERT INTO DemandeEchange_history VALUES(null,%s,%s,now(),'0')";
        $sql = sprintf($sql,$this->db->escape($idArticle1),$this->db->escape($idArticle2));
        $this->db->query($sql);
    }
    
    public function accepte($idDemandeEchange,$idUtilisateur1,$idUtilisateur2,$idArticle1,$idArticle2){
        $sql = "UPDATE DemandeEchange SET confirmation = 1 WHERE idDemandeEchange = %s";
        $sql = sprintf($sql,$this->db->escape($idDemandeEchange));
        $this->db->query($sql);

        $sql = "INSERT INTO Echange VALUES(null,%s,now())";
        $sql = sprintf($sql,$this->db->escape($idDemandeEchange));
        $this->db->query($sql);

        $sql = "INSERT INTO Echange_history VALUES(null,%s,now())";
        $sql = sprintf($sql,$this->db->escape($idDemandeEchange));
        $this->db->query($sql);

        $sql = "INSERT INTO proprietaire VALUES('$idUtilisateur2','$idArticle1',now())";
        $this->db->query($sql);

        $sql = "INSERT INTO proprietaire VALUES('$idUtilisateur1','$idArticle2',now())";
        $this->db->query($sql);


        $this->db->select('idArticle1');
        $this->db->from('demandeEchange');
        $this->db->where('idDemandeEchange',$idDemandeEchange);
        $query = $this->db->get();
        $results = $query->result();
        $value = 0;
        foreach($results as $row){
            $value = $row->idArticle1;
        }

        $sql = "DELETE FROM DemandeEchange WHERE idArticle1 = %s";
        $sql = sprintf($sql,$this->db->escape($value));
        $this->db->query($sql);

        $sql = "UPDATE Article SET idUtilisateur = %s WHERE idUtilisateur = %s AND idArticle = %s";
        $sql = sprintf($sql,$this->db->escape($idUtilisateur1),$this->db->escape($idUtilisateur2),$this->db->escape($idArticle2));
        $this->db->query($sql);

        $sql = "UPDATE Article SET idUtilisateur = %s WHERE idUtilisateur = %s AND idArticle = %s";
        $sql = sprintf($sql,$this->db->escape($idUtilisateur2),$this->db->escape($idUtilisateur1),$this->db->escape($idArticle1));
        $this->db->query($sql);
    }

    public function decline($idDemandeEchange){
        $sql = "DELETE FROM DemandeEchange WHERE idDemandeEchange = %s";
        $sql = sprintf($sql,$this->db->escape($idDemandeEchange));
        $this->db->query($sql);
    }
}
?>