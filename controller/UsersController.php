<?php 

class UsersController extends Controller
{
	
    public function __construct()
    {
		
        // chargé le mode ici dans le controller
        $this->userModel = $this->loadModel('User');    
    }

    public function home(){
		  
        $data = "";
        $this->loadView('users/homeView', $data);
    }
    public function MonCompte(){
		$data ="";
        $this->loadView('users/homeUser', $data);
    }
    public function FAQAction(){
        $data = "";
        $this->loadView('users/FAQView', $data);
    }
	
	public function displayPosts(){
		$data = $this->userModel->displayPost();
		echo json_encode($data);
	}
	public function updatePosts(){
        if(isset($_POST['update_id'])){
             $data =$this->userModel->select($_POST['update_id']);
            
        }
		else if(isset($_POST['update_post'])){
          $this->userModel->updatePost($_POST['idToUpdate'],$_POST['subject_post'],$_POST['content_post'] );
          $data = "";
        }
        echo json_encode($data);
        
  
		
	 }
    public function addPosts(){
		extract($_POST);
		if(isset($hidden_add_post) && $hidden_add_post == 1){
			$data["subject_error"] ="";
            $data["content_error"] ="";
			if(empty($_POST['subject_post'])){
				$data["subject_error"] ="Le champs Sujet est obligatoire";
			}
				if(empty($_POST['content_post'])){
				$data["content_error"] ="Le champs de contenu est obligatoire";
			}
			
			if($data['subject_error'] == "" &&  $data['content_error'] == ""){
				  $this->userModel->addPost($_POST['subject_post'], $_POST['content_post'], 1); 
				  $data['subject'] = $_POST['subject_post'];
                  $data['content'] = $_POST['content_post'];
                  $data['date'] = time();
			}
			echo json_encode($data);
		}
		
	}

    public function login()
    {  
		 $data ="";
         $this->loadView('users/loginView', $data);        
    } 

	
	public function loginTrait(){
	
		  if ($_POST['form_login_sended'] == 1) 
        {          
            
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    if ($_POST['email'] == "") {
                        $data['email'] = 'Svp introduire votre mail';
                    }else if ($this->userModel->findUserByMail($_POST['email']) != true) {
						$data['email'] = 'Aucun utilisateur avec le mail introduie';
                    }
                    else {
						$data[' email'] = "";
					}
                    if ($_POST['code'] == "") {
                        $data['code'] = 'Svp introduire votre code daccès';
                    }else if ($this->userModel->findUserByAcessCode($_POST['code']) != true) { 
						$data['code'] = 'Aucun utilisateur avec le code introduie';
					}else{

						$data['code'] = "";
					} 
                    if ( empty($data['code']) && empty($data['email'])    )
					{
                        // essai de se connecter
                        $connect = $this->userModel->login( $_POST['email'], $_POST['code']);
                        if ($connect) 
						{
						// session_start();
                         $data['salut '] = createUserSession($connect);
						// header('Location: https://scolnet.000webhostapp.com/users/MonCompte');
						//$this->loadView('users/homeUser', $data);
                         }
                    }
					echo json_encode($data);
         }


	}
    

}
