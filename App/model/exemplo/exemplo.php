<?php 
namespace app\model\exemplo;
use app\model\model;

class exemplo extends model
{
    protected $colunas =  
    [
        "nome",
        "texto",
        "data"
    ];

    public function __construct ()
    {
        parent::__construct();
        $this->chavePrimaria = "id";
    }

    public function getJson ()
    {

    }
}