<?php
class User_model extends CI_Model{

    public function uploadImg($_FILES){
        $file_count = count($_FILES['files']['name']);
        $img_string = "";
        for ($i = 0; $i < $file_count; $i++) {
            $filename = $_FILES['files']['name'][$i];
            if (in_array(strchr($filename, "."), array('.png', '.jpg', '.jpeg', '.PNG', '.JPG', '.JPEG'))) {
                move_uploaded_file($_FILES['files']['tmp_name'][$i], ('assets/img/'.$filename));
                $img_string .= $filename;

                if ($i < $file_count - 1) {
                    $img_string .= ",";
                }
            }
        }
    }
    public function setArticleImage($idArticle,$FILES){
        $file_count = count($_FILES['files']['name']);
        $img_string = "";
        for ($i = 0; $i < $file_count; $i++) {
            $filename = $_FILES['files']['name'][$i];
            $sql = "INSERT INTO article_photo VALUES(null,'$idArticle','$filename')";
            $this->db->query($sql);
        }
    }

    public function recherche($motCle,$idCategorie){
        $sql = "select * from (select * from article where idCategorie = $idCategorie) as test where description like '%$motCle%' or titre like '%$motCle%'";
        $query = $this->db->query($sql);
        return $query->result();
    }



    public function insert($idUtilisateur='',$idCategorie='',$titre='',$description='',$prix=''){
        $data = array(
            'idUtilisateur'=>$idUtilisateur,
            'idCategorie'=>$idCategorie,
            'titre'=>$titre,
            'description'=>$description,
            'prix'=>$prix
        );
        $this->db->insert('Article',$data);
    }
    public function insertHistory($idUtilisateur='',$idCategorie='',$titre='',$description='',$prix=''){
        $data = array(
            'idUtilisateur'=>$idUtilisateur,
            'idCategorie'=>$idCategorie,
            'titre'=>$titre,
            'description'=>$description,
            'prix'=>$prix
        );
        $this->db->insert('Article_history',$data);
    }
}

?>