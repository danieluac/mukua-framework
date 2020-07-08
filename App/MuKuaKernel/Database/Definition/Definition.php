<?php
namespace MukuaKernel\Database\Definition;
use MukuaKernel\Database\Definition\SelectRule;
/**
 *  definition, main class define a table and its atribute
 * that will be used when any model it is started
 * @author Daniel-U-AC
 *
 * @abstract Definition
 */
abstract class Definition extends SelectRule
{
    protected  $sql;
    /**
     * In this array are table atribute and their value in use
     * @var array $AtributeValue
     */
    protected $AtributeValue;
    /**
     * there is name of database table
     * @var string $Table
     */
    protected $Table = null;
    /**
     *There is primary key of table
     * @var string
     */
    protected $PrimaryKey = null;
    /**
     * magic method, set the anonymous property of a model class and its value
     * @param string $atribute
     * @param string $value
     * @return void
     */
    final public function __set($atribute, $value)
    {
      $this->AtributeValue[$atribute] = $value;
    }
    /**
     * magic method get the anonymous property of a model class
     * @param string $atribute
     * @return string $AtributeValue[$atribute]
     */
     public function __get($atribute)
    {
        return $this->AtributeValue[$atribute];
    }

    /**
     * create a new data for a specific model that will be add in table of this model
     * @param array atribute
     * @return object $this
     */
    final public function Create (array $atribute)
   {
      $this->AtributeValue = (array) $atribute;
      return $this;
   }
    /**
     * get the name of model class that will be used like reference of a table
     * @param void
     * @return void
     */
    final protected function getTable()
    {
       for($a=1;$a<=count($get= explode("\\",get_class($this)));$a +=1)
       {
            if($a === count($get))
            {
                if($this->Table === null)
                    $this->Table = $get[$a-1];
                if($this->PrimaryKey === null)
                    $this->PrimaryKey = "Id".$this->Table;
            }
       }
    }
}
