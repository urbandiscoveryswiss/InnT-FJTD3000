<?php
/**
 * Created by IntelliJ IDEA.
 * User: Thomas
 * Date: 29.12.17
 * Time: 09:28
 */

class Access{

    protected $public = [
        "User" => ['index','register','login','create']
    ];

    protected $resticted = [
        "User" => ['show','edit','update','logout','destroy'],
        "Offer" => ['add','create','listAll','show','destroy'],
    ];



    function checkPublic($controller, $action){
        if(array_key_exists($controller, $this->public)){
            if(in_array($action, $this->public[$controller])){
                return true;
            }
        }

        return false;
    }

    function checkRestricted($controller, $action){
        if(array_key_exists($controller, $this->resticted)){
            if(in_array($action, $this->resticted[$controller])){
                return true;
            }
        }
        return false;
    }


}