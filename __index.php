<?php 
//require_once "autoloados.php";
require_once __DIR__."/vendor/autoload.php";

use MukuaKernel\Database\Capsula\Capsula;

Capsula::Stamp(
    [
        "DRIVER" => "mysql",
        "HOSTNAME" => "localhost",
        "DATABASE" => "querobukar",
        "USERNAME" => "root",
        "PASSWORD" => "",
        "CHARSET" => "Utf8"
    ]
    );
use MukuaKernel\curso as tipo;

$tipo = new tipo;

//$tipo->where("id","=",2)->delete();
//$tipo->nome = "Informática e Sistemas e Multimedia";

print_r($tipo->find(4));
return 1;
try{
    print_r($tipo->delete());
}catch(Exception $e)
{
    print $e->getMessage();
}


