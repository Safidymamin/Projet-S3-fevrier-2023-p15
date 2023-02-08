<?php
class Admin extends CI_Controller{
    public function categorie(){
        $this->load->model('function_model');
        $data['datas'] = $this->function_model->get_all_records('categorie');
        $this->load->view('head');
        // $this->load->view('bar');
        $this->load->view('categorie',$data);
    }
    public function newCategorie(){
        $this->load->model('admin_model');
        $categorie = $this->input->post('categorie');
        $this->admin_model->insertCategorie($categorie);
        redirect(base_url('user/profile'));
    }
    public function statistique(){
        $this->load->model('admin_model');
        $this->load->model('function_model');
        $data['datas'] = $this->function_model->get_all_records('categorie');
        $data['nombreUtilisateur'] = $this->admin_model->utilisateurInscrits();
        $data['nombreEchange'] = $this->admin_model->echangeEffectue();
        $this->load->view('head');
        $this->load->view('statistique',$data);
    }
}
?>