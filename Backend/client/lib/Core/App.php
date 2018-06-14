<?php
/**
 * Created by IntelliJ IDEA.
 * User: Thomas
 * Date: 05.12.17
 * Time: 23:52
 */

include_once('lib/Controller/UserController.php');
include_once('lib/Core/Access.php');

class App{

    protected $controller = "UserController";

    protected $method = "index";

    protected $params = [];

    protected $base_url;

    protected $lang;
    protected $iso = '';

    protected $access;

    public function __construct(){
        $this->base_url = BASE_URL;
        $this->access = new Access();


        if($this->authenticated()){
            $this->controller = "UserController";
            $this->method = "show";
            require_once 'Resources/Private/Layouts/default.php';
        }else{
            require_once 'Resources/Private/Layouts/empty.php';
        }

    }

    public function content(){
        $url = $this->parseUrl();
        $valid_url = false;
        if($this->authenticated()){
            $valid_url = $this->access->checkRestricted(ucfirst($url[0]), $url[1]);

        }else{
            $valid_url = $this->access->checkPublic(ucfirst($url[0]), $url[1]);
        }

        if(!$valid_url && strlen($url[0])>0){
            header('Location: ' . $this->base_url, true);
            exit;
        }

        if(strlen($url[0])>0 && file_exists('lib/Controller/'. ucfirst($url[0]).'Controller.php')){
            $this->controller = ucfirst($url[0]).'Controller';
            unset($url[0]);
        }

        require_once('lib/Controller/' . $this->controller . '.php');

        $this->controller = new $this->controller;

        $this->controller->setLang($this->lang, $this->iso);


        if(isset($url[1])){
            if(method_exists($this->controller, $url[1])){
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);

    }

    public function parseUrl(){
        if(isset($_GET['url'])){
            return $url = explode("/", filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

    public function authenticated(){
        if(isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['fullname'])){
            return true;
        }

        return false;
    }

}