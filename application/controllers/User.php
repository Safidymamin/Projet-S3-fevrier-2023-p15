<?php

class User extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_logged'])) {
            $this->session->set_flashdata("error","Please login first to view this page");
            redirect("auth/login");
        }
    }

    public function myArticle(){
        $this->load->model('article_model');
        $data['datas'] = $this->article_model->getAllPriorityy($_SESSION['idUtilisateur']);
        $this->load->view('head');
        $this->load->view('mes_articles',$data);
    }
    public function historique(){
        $this->load->model('function_model');
        $data['datas'] = $this->function_model->get_all_records('v_proprietaire');
        $this->load->view('head');
        $this->load->view('historique',$data);
    }
    public function recherche(){
        $idCategorie = $this->input->post('idCategorie');
        $recherche = $this->input->post('recherche');
        $this->load->model('function_model');
        $data['datas'] = $this->function_model->get_all_records('categorie');
        $this->load->model('user_model');
        $data['datass'] = $this->user_model->recherche($recherche,$idCategorie);
        $this->load->view('head');
        $this->load->view('recherche_result',$data);
    }
    public function chercher(){
        $this->load->model('function_model');
        $data['datas'] = $this->function_model->get_all_records('categorie');
         $this->load->view('head');
        $this->load->view('recherche_result',$data);
    }
    public function confirmer(){
        $this->load->model('echange_model');
        $idDemandeEchange = $this->input->post('idDemandeEchange');
        $idUtilisateur1 = $this->input->post('idUtilisateur1');
        $idUtilisateur2 = $this->input->post('idUtilisateur2');
        $idArticle1 = $this->input->post('idArticle1');
        $idArticle2 = $this->input->post('idArticle2');
        $this->echange_model->accepte($idDemandeEchange,$idUtilisateur1,$idUtilisateur2,$idArticle1,$idArticle2);
        redirect('user/profile');
    }
    public function decliner(){
        $this->load->model('echange_model');
        $idDemandeEchange = $this->input->post('idDemandeEchange');
        $this->echange_model->decline($idDemandeEchange);
        redirect('user/profile');
    }
    public function demande_list(){
        $this->load->model('echange_model');
        $data['datas'] = $this->echange_model->getAllDemande($_SESSION['idUtilisateur']);
        $this->load->view('head');
        $this->load->view('demande_list',$data);
    }
    public function demande(){
        $this->load->model('echange_model');
        $idArticle1 = $this->input->post('idArticle1');
        $idArticle2 = $this->input->post('idArticle2');
        echo $idArticle1;
        echo $idArticle2;
        $this->echange_model->demande($idArticle2,$idArticle1);
        redirect('user/profile');
    }
    public function profile(){
        $this->load->model('article_model');
        $data['datas'] = $this->article_model->getAllarticle($_SESSION['idUtilisateur']);
        $this->load->view('head');
        $this->load->view('profile',$data);
    }
    public function toEchange(){
        $this->load->model('article_model');
        $data['datas'] = $this->article_model->getAllPriority($_SESSION['idUtilisateur']);
        $data['idArticle2'] = $this->input->post('idArticle');
        $this->load->view('head');
        $this->load->view('echange',$data);
    }
        public function newObject(){
        if (isset($_POST['ajout'])) {
            $this->load->model('user_model');
            $this->user_model->insert($_SESSION['idUtilisateur'],$_POST['idCategorie'],$_POST['titre'],$_POST['description'],$_POST['prix']);
            $this->user_model->insertHistory($_SESSION['idUtilisateur'],$_POST['idCategorie'],$_POST['titre'],$_POST['description'],$_POST['prix']);
            $this->load->model('function_model');
            $valeur = $this->function_model->last_insert_id() ;
            $idUtilisateur = $_SESSION['idUtilisateur'];
            $sql = "INSERT INTO Proprietaire VALUES('$idUtilisateur','$valeur',now())";
            $this->db->query($sql);
            
            $files['files'] = $_FILES["files"];
            $idArticle = $this->function_model->last_insert_id();
            $this->user_model->uploadImg($files);
            $this->user_model->setArticleImage($idArticle,$files);
            

            $this->session->set_flashdata("success","Votre article a ete mis en ligne.");
            // redirect("user/profile","refresh");    
        }
        $this->load->model('function_model');
        $data['datas'] = $this->function_model->get_all_records('categorie');
        $this->load->view('head');
        $this->load->view('newObject',$data);
    }
}

?>