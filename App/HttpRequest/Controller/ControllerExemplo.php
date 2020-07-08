<?php
namespace App\HttpRequest\Controller;

use App\HttpRequest\Controller\Controller;

class ControllerExemplo extends controller
{

    public function Index ()
    {
    
    }

    public function Sobre ($d = '')
    {
print "ola";
        $model = $this->setModel("exemplo/exemplo");
        
       /* $model->nome = "Sala 2";
        $model->texto = "nothing..."; 

        $model->criar
        ([
            "texto" => " nada...",
            "nome" => "Sala 3"
        ])->inserts(); 

        $model->inserts(); */

       // print_r($model->selects());
        //$this->setTitle( $d);
       // $this->setView("exemplo.home");
    }
}