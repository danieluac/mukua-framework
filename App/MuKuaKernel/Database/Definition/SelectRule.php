<?php
namespace MukuaKernel\Database\Definition;

/**
 * CriterioSelecao, class que estabelece o critério para selecionar,
 * atualizar e deletar atráves da claúsula where
 *
 * @author Daniel-U-AC
 *
 * @abstract CriterioSelecao
 */
abstract class SelectRule
{
    /**
     * contém o criterio de busca de dados na estrutura sql
     * @var string $criterio
     */
    protected $criterio;
    /**
     * contém os atributo e registos da entidade
     * @var array $filtroValor
     */
    protected $filtroValor;
     /**
     * ordena os dados do banco de dados
     * @var string $extraSql
     */
    protected $extraSql;
    protected static $cont = 1;
    /**
     * organize selection rule in database table 
     * @param string $atributo eg: name, id or another
     * @param string $filtro eg: =, >, <=, >= !=
     * @param string $valor is the value to compare
     * @param string $operador filter operator eg: and, or
     * @return object $this
     */
   final public function where($atributo, $filtro = "=", $valor, $operador = "AND")
   {
      // static $cont =1;
       if(isset($this->criterio))
       {
            $this->filtroValor[$atributo.self::$cont] =$this->transforma($valor);
            // Junta  o criterio de seleçao
            $this->criterio .=" ".$operador." ". $atributo." ".$filtro." (:".$atributo.self::$cont.")";
       }
       else
       {
            $this->filtroValor[$atributo.self::$cont] =$this->transforma($valor);
            // Junta  o criterio de seleçao
            $this->criterio =" ". $atributo." ".$filtro." (:".$atributo.self::$cont.")" ;
       }
       self::$cont++;
       return $this;
   }
   public function HasMany($class,$selector)
   {
       
   }
   public function HasOne($class,$selector)
   {
       
   }
   public function BelongsTo($class,$selector)
   {
       
   }
   /**
   * Other instruction in sql way
   *@param string $extraSql
   * @return object $this
   **/
   final public function Extra($extraSql)
   {
     $this->extraSql = $extraSql;
     return $this;
   }
   /**
     * transform the value by like its type
     * @param indeterminate $value indeterminate
     * @return indeterminate
     */
   final private function transforma($value)
    {
        if(is_array($value))
        {
            foreach ($value as $v)
            {
                //if was int
                if(is_integer($v))
                    $data [] = $v;
               //se for string
                elseif (is_string($v))
                {
                  //  $data[] =  "'$v'";
                    $data[] =  $v;
                }
            }
            $result = '('.implode(",", $data). ')';
        }elseif (is_string($value))
            // adiciona aspas
            $result = $value;
        elseif(is_null($value))
            $result = 'NULL';
        elseif(is_bool($value))
            $result =$value? 'TRUE' : 'FALSE';
        else
            $result = $value;
        // retorno do resultado
        return $result;
    }
}
