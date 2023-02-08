<?php
class Auth extends CI_Controller{
    
    public function logout(){
        unset($_SESSION);
        session_destroy();
        redirect("auth/login","refresh");
    }
    public function login(){
        if(isset($_SESSION['email'])){
            redirect("user/profile","refresh");
        }
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('password','Mot de passe','required');
        if ($this->form_validation->run() == TRUE ) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            //check user in database
            $this->db->select("*");
            $this->db->from("utilisateur");
            $this->db->where(array('email'=> $email, 'motDePasse' => $password));
            $query = $this->db->get();

            $user = $query -> row();

            // if user exist
            if (sizeof($user)!=0 ) {
                
                //temporary message
                $this->session->set_flashdata("success","You are logged in");

                // set session variables
                $_SESSION['user_logged'] = TRUE;
                $_SESSION['idUtilisateur'] = $user->idUtilisateur;
                $_SESSION['email'] = $user->email;
                $_SESSION['nom'] = $user->nom;
                $_SESSION['prenom'] = $user->prenom;
                $_SESSION['estAdmin'] = $user->estAdmin;

                //redirect to profil page

                redirect("user/profile","refresh");
            } else{
                $this->session->set_flashdata("error","NO such account exists in database");
                // redirect("auth/login","refresh");
            }
        }
        $this->load->view('login');
    }

    public function register(){

        if (isset($_POST['register'])) {
            $this->form_validation->set_rules('nom','Nom','required');
            $this->form_validation->set_rules('email','Email','required');
            $this->form_validation->set_rules('password','Mot de passe','required|min_length[5]');
            $this->form_validation->set_rules('password2','Confirm Password','required|matches[password]');
            
            if ($this->form_validation->run() == TRUE) {

                date_default_timezone_set('Europe/London');
                // add user in database 
                $data = array(
                    'nom'=>$_POST['nom'],
                    'prenom'=>$_POST['prenom'],
                    'email'=>$_POST['email'],
                    'motDePasse'=>$_POST['password'],
                    'estAdmin'=>0
                );
                $this->db->insert('utilisateur',$data);

                $this->session->set_flashdata("success","Your account has been registered. You can login now");
                redirect("auth/register","refresh");    
            }
        }
        $this->load->view('register');
    }
}

?>