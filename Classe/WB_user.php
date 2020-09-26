<?php

class user
{


    protected $db_table_name = "user";

    public $db_table_configuration = '(pseudo,mail,password,role,confirmation_token) VALUES(:pseudo,:mail,:password,:role,:confirmation_token)';
    public $db_table_update = 'pseudo = :pseudo,mail = :mail,password = :password, role = :role';

    protected $id, $pseudo, $mail, $password, $role,$confirmation_token,$confirmed_at, $date_post;

    // public function custom_request_data_parameters($q, $data_received)
    // {
    //     $q->bindValue(':article_picture1', $data_received->article_picture1_name);
    //     $q->bindValue(':article_picture2', $data_received->article_picture2_name);
    //     $q->bindValue(':article_picture3', $data_received->article_picture3_name);
    // }



    public function db_table_name()
    {
        return $this->db_table_name;
    }

    public function __construct($pseudo_or_data, $mail = "", $password = "", $role = "",$confirmation_token ="",$confirmed_at="",  $date_post = "",$id = "")
    {
        //Traitement dans le cas de l'hydratation de l'objet manuellement !

        if (is_string($pseudo_or_data)) {
            $this->setPseudo($pseudo_or_data);
            $this->setMail($mail);
            $this->setPassword($password);
            $this->setRole($role);
            $this->setConfirmation_token($confirmation_token);
            $this->setConfirmed_at($confirmed_at);
            $this->setDate_post($date_post);
        }
        //Traitement dans le cas de l'hydratation de l'objet avec un tableau
        elseif (is_array($pseudo_or_data)) {
            $this->setId($pseudo_or_data['id']);
            $this->setPseudo($pseudo_or_data['pseudo']);
            $this->setMail($pseudo_or_data['mail']);
            $this->setPassword($pseudo_or_data['password']);
            $this->setRole($pseudo_or_data['role']);

            $this->setDate_post($pseudo_or_data['date_post']);
        }
    }

    public function getId()
    {
        return $this->id;
    }
    public function getPseudo()
    {
        return $this->pseudo;
    }
    public function getMail()
    {
        return $this->mail;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getRole()
    {
        return $this->role;
    }
    public function getConfirmation_token()
    {
        return $this->confirmation_token;
    }
    public function getConfirmed_at()
    {
        return $this->confirmed_at;
    }
    public function getDate_post()
    {
        return $this->date_post;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }
    public function setMail($mail)
    {
        $this->mail = $mail;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setRole($role)
    {
        $this->role = $role;
    }

    public function setConfirmation_token($confirmation_token){
        $this->confirmation_token = $confirmation_token;
    }
    public function setConfirmed_at($confirmed_at){
        $this->confirmed_at = $confirmed_at;
    }
    public function setDate_post($date_post)
    {
        $this->date_post = $date_post;
    }

    public static function generate_user_register_form()
    {

?>
        <div class="form_container">
            <div class="section_form" id="user_register_form">

                <div class="data_title">
                    <h2>Espace Inscription</h2> <button class=" oi oi-x btn button_erase_form" style="" title="Effacer le formulaire" onclick="erase_register_form()"></button>
                </div>

                <form action="" method="post">

                    <div class="form-group">
                        <label for="pseudo">Nom / Pseudo :</label>
                        <input class="form-control" type="text" value="<?php if (!empty($_POST['user_pseudo'])) {
                                                                            echo $_POST['user_pseudo'];
                                                                        } ?>" name="user_pseudo" id="user_pseudo" placeholder="Votre pseudo">
                    </div>
                    <div class="form-group">
                        <label for="mail">Rentrer votre mail : </label>
                        <input class="form-control" type="mail" value="<?php if (!empty($_POST['user_mail'])) {
                                                                            echo $_POST['user_mail'];
                                                                        } ?>" name="user_mail" id="user_mail" placeholder="Le mail">
                    </div>
                    <div class="form-group">
                        <label for="mail">Votre password : </label>
                        <input class="form-control" type="password" value="<?php if (!empty($_POST['user_password'])) {
                                                                            echo $_POST['user_password'];
                                                                        } ?>" name="user_password" id="user_password" placeholder="Le password">

                    </div>
                    <div class="form-group">
                        <label for="mail">Confirmez votre mot de passe : </label>
                        <input class="form-control" type="password" value="<?php if (!empty($_POST['user_password_confirmation'])) {
                                                                            echo $_POST['user_password_confirmation'];
                                                                        } ?>" name="user_password_confirmation" id="user_password_confirmation" placeholder="Confirmez le mot de passe">
                    </div>



                    <br>
                    <button class="btn btn-success class=" type="submit" value="register">Envoyer! </button>
                </form>


            </div>

        </div>



<?php

        if (!empty($_POST['user_pseudo'])) {
            

            $user_check = new formManager;
            $user_check->checking_integrity("user_pseudo", "Pseudo",1,1,0,0);
            $user_check->checking_integrity("user_mail", "Mail", 0, 1, 1, 0);
            // vérifie si le password corespond au champ password confirmation
            $user_check->checking_integrity("user_password","Passwords",0,1,0,"user_password_confirmation");
            
            // verif si déjà présent dans bdd
            $user_check->checking_integrity("user_password","Passwords",0,0,0,0,0,["user","pseudo"]);
            $user_check->checking_integrity("user_mail","mail",0,0,0,0,0,["user","mail"]);

            $user_check->processing_user_register_form();
        }
    }

    public static function generate_user_login_form(){

    }
}
