<?php

include_once('Controller.php');
include_once('vendor/phpmailer/PHPMailerAutoload.php');
require 'lib/Model/Offer.php';


class OfferController extends Controller {

    private $apiInstance;

    public function __construct(){
        parent::__construct();
        $this->apiInstance = new Swagger\Client\Api\OfferApi(
            new GuzzleHttp\Client()
        );
    }

    public function add(){
        $this->view('Offer/add');
    }


    public function create(){
        $this->error = array();
        $this->input_data = array();

        $user_id = $_SESSION['user_id'];

        $title = isset($_POST['title'])? $_POST['title'] :"";
        $this->input_data['title'] = $title;
        if($title == ''){
            $this->error['title']="Es wurde keine Titel gewählt";
        }

        $description = isset($_POST['description'])? $_POST['description'] :"";
        $condition = isset($_POST['condition'])? $_POST['condition'] :"";

        $start = isset($_POST['start'])? $_POST['start'] :"";
        $end = isset($_POST['end'])? $_POST['end'] :"";

        $this->input_data['description'] = $description;
        $this->input_data['condition'] = $condition;
        $this->input_data['start'] = $start;
        $this->input_data['end'] = $end;

        if(count($this->error)>0){
            $this->error["message"] = "Angebot erstellen fehlgeschlagen";
            $this->redirect('/offer/add', ["input_data"=>$this->input_data, "error" =>$this->error]);


        }else{
            $offer = new \Swagger\Client\Model\offer([
                    'userid'=>$user_id,
                    'title'=>$title,
                    'description'=>$description,
                    'condition'=>$condition,
                    'start'=>$start,
                    'end'=>$end,
                ]
            );
            $this->store($offer);
        }
    }

    private function store(\Swagger\Client\Model\Offer $offer){
        try {
            $this->apiInstance->addOffer($offer);
            $this->redirect('/offer/add', ["success" => "Angebot erfolgreich erstellt"]);
        } catch (Exception $e) {
            $this->error["message"] = "Fehlgeschlagen";
            $this->redirect('/offer/add', ["input_data"=>$this->input_data, "error" =>$this->error]);
        }
    }

    public function listAll(){
        try {
            $offers = $this->apiInstance->findOffersByUser($_SESSION['user_id']);
            $this->view('Offer/listAll', ['offers' => $offers]);
        } catch (Exception $e) {
            $this->redirect('/offer/add');
        }
    }

    public function show($offer_id = null){

        if($offer_id != null){
            try {
                $offer = $this->apiInstance->getOfferById($offer_id);
                $this->view('Offer/show', ['offer' => $offer]);
            } catch (Exception $e) {
                $this->view('Offer/listAll');
            }
        }else{
            $this->view('Offer/listAll');
        }

    }

    public function destroy($offer_id = null){
        if($offer_id) {
            try {
                $this->apiInstance->deleteOffer($offer_id);
                $this->redirect('/offer/add', ["success" => "Erfolgreich gelöscht"]);
            } catch (Exception $e) {
                $this->error["message"] = "Löschen fehlgeschlagen";
                $this->redirect('/offer/show', ["offer_id" =>$offer_id]);
            }
        }
    }





}