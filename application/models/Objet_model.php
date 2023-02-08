<?php
class Objet_model extends CI_Model{
    
    public function insertArticle($utilisateur='',$idCategorie='',$titre='',$description='',$prix=''){
        $sql = "INSERT INTO Article VALUES(null,'%s','%s','%s','%s','%s')";
        $sql = sprintf($sql,$this->db->escape($utilisateur),$this->db->escape($idCategorie),$this->db->escape($titre),$this->db->escape($description),$this->db->escape($prix));
        $this->db->query($sql);
    }
    public function insertArticle_history($utilisateur='',$idCategorie='',$titre='',$description='',$prix=''){
        $sql = "INSERT INTO Article_history VALUES(null,'%s','%s','%s','%s','%s')";
        $sql = sprintf($sql,$this->db->escape($utilisateur),$this->db->escape($idCategorie),$this->db->escape($titre),$this->db->escape($description),$this->db->escape($prix));
        $this->db->query($sql);
    }
    public function upload(){
        $config['upload_path'] = FCPATH . 'assets/img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 100;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;

        $this->load->library('upload',$config);
        if (! $this->upload->do_upload('avatar')) {
            $error = array('error' => $this->upload->display_errors());
        } else{
            $data = array('upload_data' => $this->upload->data());
        }
    }
    public function setUpload($file){

        if(isset($file))
        {
            $dossier =  FCPATH . 'assets\img';
            $fichier = basename($file['name']);
            $taille_maxi = 100000;
            $taille = filesize($file['tmp_name']);
            $extensions = array('.png', '.gif', '.jpg', '.jpeg','.JPG','.PNG');
            $extension = strrchr($file['name'], '.');
            //Début des vérifications de sécurité...
            if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
            {
                $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc';
            }
            if($taille>$taille_maxi)
            {
                $erreur = 'Le fichier est trop gros...';
            }
            if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
            {
            //On formate le nom du fichier ici...
                $fichier = strtr($fichier,
                'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
            if(move_uploaded_file($file['tmp_name'], $dossier . $fichier)) //Si
            {
                echo 'Upload effectué avec succès !';
            }
            else //Sinon (la fonction renvoie FALSE).
            {
                echo 'Echec de l\'upload !';
            }
            }
            else
            {
                echo $erreur;
            }
        }
    }
    public function insertArticle_Photo1($nom){
        $this->load->model('function_model');
        $last_insert_id = $this->function_model->last_insert_id();
        $sql = "INSERT INTO Article_Photo VALUES(null,'%s','%s')";
        $sql = sprintf($sql,$this->db->escape($last_insert_id),$this->db->escape($nom));
        $this->db->query($sql);
    }
    public function insertArticle_Photo2($idArticle,$nom){
        $this->load->model('function_model');
        $sql = "INSERT INTO Article_Photo VALUES(null,'%s','%s')";
        $sql = sprintf($sql,$this->db->escape($idArticle),$this->db->escape($nom));
        $this->db->query($sql);
    }
}

?>