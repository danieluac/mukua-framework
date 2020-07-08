<?php
namespace MukuaKernel\Database\Definition\dml;
use MukuaKernel\Database\Definition\dml\Update;

use MukuaKernel\Database\Capsula\Capsula;
/**
 * Description of Delete
 *
 * @author Daniel-U-AC
 */
class Delete extends Update
{
    /**
     * monta a estrutura SQL para o DELETE dado no Banco
     * @return string da estrutura sql montada
     */
    private function InstrucaoDelete()
    {
        if(isset($this->criterio))
        {
            $this->sql = " DELETE FROM ".$this->Table;//strtoupper($this->Table);
            isset($atributoTable) ? $this->sql .=$atributoTable : "";
            //Adiciona a(as) claúsula(as) para o Update
            $this->sql .=" WHERE ( ".$this->criterio." )";
        // retorna a estrutura sql para update montada
            return $this->sql;
        }else {
            throw new \Exception("<h1>Mukua Database Error!.</h1>");
        }
        
    }
    /**
     * Apaga dados na Table do bando de dados
     * @return bool verdadeiro ou falso
     */
    final public function delete()
    {
        $add = Capsula::get_stamp()->prepare(" ".$this->InstrucaoDelete()." ");
        // cria um array contendo os indeces do array $filtroValor
         $this->filtroValor ? $filtro = array_keys($this->filtroValor) : "";
        for($a =0; $a< count($this->filtroValor);$a++):
              $add->BindValue(":{$filtro[$a]}", $this->filtroValor[$filtro[$a]]);
        endfor;

        return $add;//->execute();
    }
}
