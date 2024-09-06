<?php

namespace App\Ctrl;

use App\Model\ModelJo;
use App\View\ViewJo;

class CtrlJo
{
    private $vue;
    private $model;

    public function __construct($a = "", $a2 = "")
    {
        $this->vue = new ViewJo();
        $this->model = new ModelJo();

        $this->index($a, $a2);
    }

    public function index($a = "", $a2 = "")
    {
        if (isset($_POST['_method'])) {
            if ($_POST['_method'] == "POST") {
                $this->insert($_POST);
            }
            if ($_POST['_method'] == "PUT") {
                $this->update($_POST, $a);
            }
            if ($_POST['_method'] == "DELETE") {
                $this->delete($a);
            }
        } else {
            if ($a == "form") {
                $this->afficherForm();
            } else {
                if ($a2 == "edit") {
                    $this->afficherEdit($a);
                } else {
                    $this->findAll();
                }
            }
        }
    }

    public function findAll()
    {
        $athletes = $this->model->findAll();
        if (!$athletes) {
            $this->vue->afficherMessage("Erreur serveur");
        } else {
            $this->vue->afficherAthletes($athletes);
        }
    }

    public function insert($data)
    {
        $r = $this->model->insert($data);
        if ($r == 1) {
            $this->vue->afficherMessage("Ajout réussi");
        } else {
            $this->vue->afficherMessage("Erreur d'ajout");
        }
    }

    public function update($data, $id)
    {
        if($_SESSION['id_update'] == $id){
            $r = $this->model->update($data, $id);
            if ($r == 1) {
                $this->vue->afficherMessage("Modification réussie");
            } else {
                $this->vue->afficherMessage("Erreur de modification");
            }
        }
        else{
            unset($_SESSION['id_update']);
            $this->vue->afficherMessage("Erreur id");
        }
    }

    public function delete($id)
    {
        $r = $this->model->delete($id);
        if ($r == 1) {
            $this->vue->afficherMessage("Suppression réussie");
        } else {
            $this->vue->afficherMessage("Erreur de suppression");
        }
    }

    public function afficherForm()
    {
        $this->vue->afficherForm();
    }

    public function afficherEdit($id)
    {
        $_SESSION['id_update'] = $id;
        $athlete = $this->model->find($id);
        $this->vue->afficherForm($athlete);
    }
}
