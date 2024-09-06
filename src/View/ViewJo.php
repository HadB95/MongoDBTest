<?php 
namespace App\View;
use MongoDB\BSON\ObjectId;

class ViewJo {

    public function __construct()
    {
        
    }
    public function afficherAthletes($athletes){
        $contenu="src/Templates/athletes.html";
        include "src/Templates/template.html";
    }
    

    public function afficherForm($data=false){
        $contenu="src/Templates/form.html";
        include "src/Templates/template.html";
    }

    public function afficherMessage($message){
        $contenu="src/Templates/message.html";
        include "src/Templates/template.html";
    }

}