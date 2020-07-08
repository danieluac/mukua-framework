<?php
namespace MukuaKernel\Database\Definition\dml;
use MukuaKernel\Database\Definition\Definition;
use MukuaKernel\Database\Capsula\Capsula;
/**
 * Description of Table
 *
 * @author Daniel-U-AC
 */
class Create extends Definition
{
    /**
     * monta a estrutura SQL para o INSERT dado no Banco
     * @return string da estrutura sql montada
     */
    private function InstrucaoInsert()
    {
        $this->sql = " INSERT INTO ".$this->Table;
        // adiciona os atributos da Table, que são os valores do array
        // This->Column deve ser declarado em cada model para identificar os atributos na Table
        for($a =0; $a< count($this->Column);$a++):
            if(array_key_exists($this->Column[$a], $this->AtributeValue)):
               isset($atributoTable) ? $atributoTable .= ", ".$this->Column[$a]
                                      : $atributoTable = " ( ".$this->Column[$a];
            endif;
        endfor;
        isset($atributoTable) ? $this->sql .=$atributoTable. " )" : "";
         // estrutura de segurança PDO
        for($a =0; $a< count($this->Column);$a++):
            if(array_key_exists($this->Column[$a], $this->AtributeValue)):
               isset($AtributeValue) ? $AtributeValue .= ", :".$this->Column[$a]
                                     : $AtributeValue = "VALUES ( :".$this->Column[$a];
            endif;
        endfor;
        isset($AtributeValue) ? $this->sql .= $AtributeValue." )" : "";
         //retorna a estrutura sql para o insert montada
        return $this->sql;
    }
    /**
     * Insere os dados na Table do banco de dados
     * @return bool true false
     */
    final public function save ()
    {
        if(!$this->AtributeValue OR !$this->Column)
            return ;
        $add = Capsula::get_stamp()->prepare($this->InstrucaoInsert());
        // Adiciona os bindValue de cada atributo montado na estrutura
        for($a =0; $a< count($this->Column);$a++):
              if(array_key_exists($this->Column[$a], $this->AtributeValue)):
                $add->BindValue(":{$this->Column[$a]}",$this->AtributeValue[$this->Column[$a]]);
              endif;
        endfor;
        return $add->execute();
    }
}
