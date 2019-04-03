<?php 
class User
{
    private $db;
    public function __construct(){
        $this->db = new Connexion();
    }
    /**
     * trouvé un user via son mail
     */
    public function findUserByMail($email)
    {
        $this->db->prepared('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->single();

        //voir si le mail existe

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * trouvé un user via son code d'acces
     */
    public function findUserByAcessCode($code)
    {
        $this->db->prepared('SELECT * FROM users WHERE code = :code');
        $this->db->bind(':code', $code);
        $row = $this->db->single();

        //voir si le mail existe
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Trouvé un user via son passsword 
     */
    public function findUserByPass($password)
    {
        $this->db->prepared('SELECT * FROM users WHERE password = :password');
        $this->db->bind(':password', $password);
        $row = $this->db->single();
        //voir si le mail existe
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * methode de model pour pouvoir s'authentifier.
     */
    public function login($email,  $code)
    {
        $this->db->prepared('SELECT * FROM users WHERE email=:email AND code=:code');
        $this->db->bind(':email', $email);
        $this->db->bind(':code', $code);
        $row = $this->db->single();
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {

            return false;
        }
      
    }
	
	  public function select($id)
    {
        $this->db->prepared("SELECT * FROM users_post WHERE id='$id' ");
        return $this->db->resultSet();
    }
	
	  public function updatePost($id,$subject, $content)
    {
        $this->db->prepared("UPDATE users_post SET subject = '$subject', content = '$content', cdate= '".time()."' WHERE id='$id' ");
        $this->db->execute();
    }
	
	
	public function addPost($subject, $content,$id_user ){
		 $this->db->prepared("
				INSERT INTO users_post (subject,content,users_id,cdate)
				VALUES ('".$subject."','".$content."','".$id_user."','".time()."');
			");
		return $this->db->resultSet();
	}
	
	public function displayPost(){
	 $this->db->prepared("SELECT  * FROM users_post");
        $row =$this->db->resultSet();
        return $row;
	}

}
