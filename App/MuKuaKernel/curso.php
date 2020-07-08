<?php 
namespace  MukuaKernel;
use MukuaKernel\Database\Definition\ddl;

class curso extends ddl
{
   protected $Column = ["nome"];
   protected $Table = "curso";
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

