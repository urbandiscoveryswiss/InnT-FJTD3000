<?php

class Controller{
    protected $base_url;
    protected $user_roles;
    protected $lang = [];
    public $error = [];
    protected $input_data;


    function __construct(){
        $this->base_url = BASE_URL;
        if(isset($_SESSION['user_roles'])){
            $this->user_roles = $_SESSION['user_roles'];
        }
    }

    public function setLang($lang, $iso){
        $this->lang = $lang;
        $this->base_url = BASE_URL.$iso;
    }

    public function view($view, $data = array()){
        if(isset($_SESSION['data'])){
            $data = array_merge($data, $_SESSION['data']);
            $_SESSION['data'] = array();
        }
        require_once 'Resources/Private/Templates/'.$view.'.php';
    }

    public function redirect($url, $data=[]){
        ob_end_clean( );
        $_SESSION['data']=$data;
        header('Location: ' . $this->base_url.$url, true);
        die();
    }
}