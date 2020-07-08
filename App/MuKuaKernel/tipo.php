<?php 
namespace  MukuaKernel;
use \MukuaKernel\Definition\ddl;

class tipo extends ddl
{
   protected $Column = ["nome","estado","senha","perfil","foto"];
   protected $Table = "usuario";
   protected $PrimaryKey = "id";
   function __construct()
   {
       
   }

   public function Item ()
   {
       return $this->hasOne("Namespace","column");
   }
   public function Item1 ()
   {
       return $this->hasMany();
   }
   public function Item2 ()
   {
       return $this->belongto();
   }
}

