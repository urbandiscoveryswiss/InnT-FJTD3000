<?php

include_once('Controller.php');
include_once('vendor/phpmailer/PHPMailerAutoload.php');
require 'lib/Model/User.php';

class UserController extends Controller {

    private $apiInstance;
    public function __construct(){
        parent::__construct();
        $this->apiInstance = new Swagger\Client\Api\UserApi(
            new GuzzleHttp\Client()
        );
    }

    public function index(){
        $this->view('User/index');
    }

    public function login(){
        $this->error = array();
        $input_data = array();

        $email = isset($_POST['email'])? $_POST['email'] :"";
        $password = isset($_POST['password'])? $_POST['password'] :"";

        $input_data['email'] = $email;

        $error_message = "Diese Anmeldeinformationen stimmen nicht mit unseren Datensätzen überein.";
        if($email == ''){
            $this->error['email'] = $error_message;
        }else if($password == ''){
            $this->error['email'] = $error_message;
        }else{
            try {
                $user = $this->apiInstance->loginUser($email, $password);
            } catch (Exception $e) {
                $error_message = "Fehler bei der Anmeldung. Versuchen Sie es später noch einmal.";
                $user = false;
            }
            if(!$user){
                $this->error['email'] = $error_message;
            }
        }

        if(count($this->error)>0){
            $this->error["message"] = "Fehler bei der Anmeldung";
            $this->redirect('/', ["input_data"=>$input_data, "error" =>$this->error]);
        }else{
            session_regenerate_id();
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['fullname'] = $user->getFirstname()." ".$user->getName();

            $this->redirect('/', ["success" => "Login war erfolgreich"]);
        }

    }

    public function register(){
        $this->view('User/register');
    }


    public function create(){
        $this->error = array();
        $this->input_data = array();

        $username = isset($_POST['username'])? $_POST['username'] :"";
        $firstname = isset($_POST['firstname'])? $_POST['firstname'] :"";
        $name = isset($_POST['name'])? $_POST['name'] :"";
        $address = isset($_POST['address'])? $_POST['address'] :"";
        $zip = isset($_POST['zip'])? $_POST['zip'] :"";
        $city = isset($_POST['city'])? $_POST['city'] :"";
        $phone = isset($_POST['phone'])? $_POST['phone'] :"";
        $email = isset($_POST['email'])? $_POST['email'] :"";
        $coordinates = isset($_POST['coordinates'])? $_POST['coordinates'] :"";
        $password = isset($_POST['password'])? $_POST['password'] :"";
        $password_confirm = isset($_POST['password_confirm'])? $_POST['password_confirm'] :"";


        if($username == ''){
            $this->error['username']="Bitte Benutzername eingeben.";
        }
        $this->input_data['username'] = $username;

        if($firstname == ''){
            $this->error['firstname']="Bitte Vornamen eingeben.";
        }
        $this->input_data['firstname'] = $firstname;

        if($name == ''){
            $this->error['name']="Bitte Nachnamen eingeben.";
        }
        $this->input_data['name'] = $name;

        $this->input_data['address'] = $address;
        $this->input_data['zip'] = $zip;
        $this->input_data['city'] = $city;
        $this->input_data['phone'] = $phone;

        if($email == ''){
            $this->error['email']="Bitte gültige E-Mail Adresse eingeben.";
        }
        $this->input_data['coordinates'] = $coordinates;

        if($password == ''){
            $this->error['password']="Bitte Passwort eingeben.";
        }else if (strlen($password) < 6){
            $this->error['password']="Das Passwort muss mindestes 6 Zeichen enthalten.";
        }else if( strcmp($password, $password_confirm) !== 0){
            $this->error['password']="Passwörter stimmen nicht überein.";
        }else{
            $this->input_data['password'] = $password;
            $this->input_data['password_confirm'] = $password_confirm;
        }


        if(count($this->error)>0){
            $this->error["message"] = "Fehler bei der Registrierung";
            $this->redirect('/user/register', ["input_data"=>$this->input_data, "error" =>$this->error]);
        }else{
            $user = new \Swagger\Client\Model\User([
                    'username'=>$username,
                    'firstname'=>$firstname,
                    'name'=>$name,
                    'address'=>$address,
                    'zip'=>$zip,
                    'city'=>$city,
                    'phone'=>$phone,
                    'email'=>$email,
                    'coordinates'=>$coordinates,
                    'password'=>$password
                ]
            );
            $this->store($user);
        }

    }

    private function store(\Swagger\Client\Model\User $user){
        try {
            $this->apiInstance->createUser($user);
            $this->redirect('/', ["success" => "Registrierung war erfolgreich"]);
        } catch (Exception $e) {

            $this->error["message"] = "Registrierung fehlgeschlagen";
            $this->redirect('/user/register', ["input_data"=>$this->input_data, "error" =>$this->error]);
        }
    }

    public function show(){

        if(isset($_SESSION['username'])){
            try {
                $user = $this->apiInstance->getUserByName($_SESSION['username']);
            } catch (Exception $e) {
                $error_message = "Es ist ein Fehler aufgetreten.";
            }
            $editable = true;
            $this->view('User/show', ['user' => $user, 'editable' => $editable] );
        }
    }

    public function edit(){
        if(isset($_SESSION['username'])){
            try {
                $user = $this->apiInstance->getUserByName($_SESSION['username']);
            } catch (Exception $e) {
                $error_message = "Es ist ein Fehler aufgetreten.";
            }
            $this->view('User/edit', ['input_data' => $user] );
        }
    }


    public function update(){
        $this->error = array();
        $this->input_data = array();


        if(isset($_SESSION['username'])){
            try {
                $user = $this->apiInstance->getUserByName($_SESSION['username']);
            } catch (Exception $e) {
                $this->error["message"] = "Es ist ein Fehler aufgetreten";
            }

        }else{
            $this->error["message"] = "Es ist ein Fehler aufgetreten";
        }

        $id = $_SESSION['user_id'];
        $username = isset($_POST['username'])? $_POST['username'] :"";
        $firstname = isset($_POST['firstname'])? $_POST['firstname'] :"";
        $name = isset($_POST['name'])? $_POST['name'] :"";
        $address = isset($_POST['address'])? $_POST['address'] :"";
        $zip = isset($_POST['zip'])? $_POST['zip'] :"";
        $city = isset($_POST['city'])? $_POST['city'] :"";
        $phone = isset($_POST['phone'])? $_POST['phone'] :"";
        $email = $user->getEmail();
        $coordinates = isset($_POST['coordinates'])? $_POST['coordinates'] :"";
        $password = isset($_POST['password']) && $_POST['password'] != ''? $_POST['password'] :$user->getPassword();
        $password_confirm = isset($_POST['password_confirm']) && $_POST['password_confirm'] != ''? $_POST['password_confirm'] :$user->getPassword();

        if($username == ''){
            $this->error['username']="Bitte Benutzername eingeben.";
        }
        $this->input_data['username'] = $username;

        if($firstname == ''){
            $this->error['firstname']="Bitte Vornamen eingeben.";
        }
        $this->input_data['firstname'] = $firstname;

        if($name == ''){
            $this->error['name']="Bitte Nachnamen eingeben.";
        }
        $this->input_data['name'] = $name;

        $this->input_data['address'] = $address;
        $this->input_data['zip'] = $zip;
        $this->input_data['city'] = $city;
        $this->input_data['phone'] = $phone;
        $this->input_data['email'] = $email;
        $this->input_data['coordinates'] = $coordinates;

        if($password != ''){
            if (strlen($password) < 6){
                $this->error['password']="Das Passwort muss mindestes 6 Zeichen enthalten.";
            }else if( strcmp($password, $password_confirm) !== 0){
                $this->error['password']="Passwörter stimmen nicht überein.";
            }else{
                $this->input_data['password'] = $password;
                $this->input_data['password_confirm'] = $password_confirm;
            }
        }


        if(count($this->error)>0){
            $this->error["message"] = "Bearbeiten fehlgeschlagen";
            $this->redirect('/user/edit', ["input_data"=>$this->input_data, "error" =>$this->error]);
        }else{
            $user = new \Swagger\Client\Model\User([
                    'id' => $id,
                    'username'=>$username,
                    'firstname'=>$firstname,
                    'name'=>$name,
                    'address'=>$address,
                    'zip'=>$zip,
                    'city'=>$city,
                    'phone'=>$phone,
                    'email'=>$email,
                    'coordinates'=>$coordinates,
                    'password'=>$password
                ]
            );

            try {
                $this->apiInstance->updateUser($_SESSION['username'], $user);
                session_regenerate_id();
                $this->redirect('/user/show', ["success" => "Daten erfolgreich aktualisiert"]);
            } catch (Exception $e) {
                $this->error["message"] = "Bearbeiten fehlgeschlagen";
                $this->redirect('/user/edit', ["input_data"=>$this->input_data, "error" =>$this->error]);
            }
        }
    }

    public function logout(){
        $_SESSION = array();

        if (isset($_COOKIE['rememberMe']) || isset($_COOKIE['rememberMeToken'])) {
            unset($_COOKIE['rememberMe']);
            unset($_COOKIE['rememberMeToken']);
            setcookie('rememberMe', null, -1, '/');
            setcookie('rememberMeToken', null, -1, '/');
        }


        session_destroy();
        session_start();
        $this->redirect('/', ["success" => "Erfolgreich abgemeldet"]);
    }

    public function destroy(){
        if(isset($_SESSION['username'])) {
            try {
                $this->apiInstance->deleteUser($_SESSION['username']);
                $this->redirect('/user/logout', ["success" => "Erfolgreich gelöscht"]);
            } catch (Exception $e) {
                $this->error["message"] = "Löschen fehlgeschlagen";
                $this->redirect('/user/show', ["error" =>$this->error]);
            }
        }
    }

}

?>