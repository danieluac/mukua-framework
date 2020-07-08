<?php
namespace MukuaKernel\Database\Definition\dml;
use MukuaKernel\Database\Capsula\Capsula;
/**
 * Description of Update
 *
 * @author Daniel-U-AC
 */
class Update extends Read
{
    /**
     * monta a estrutura SQL para o UPDATE dado no Banco
     * @param void
     * @return string da estrutura sql montada
     */
    private function InstrucaoUpdate()
    {
         $this->sql = " UPDATE ".$this->Table;//strtoupper($this->Table);
         // adiciona os atributos da Table, que são os valores do array
        // This->Column deve ser declarado em cada model para identificar os atributos na Table
        // Também adiciona os criterios de segurança do PDO
         for($a =0; $a< count($this->Column);$a++):
            if(array_key_exists($this->Column[$a], $this->AtributeValue)):
               isset($atributoTable) ? $atributoTable .= ", ".$this->Column[$a]."=:".$this->Column[$a]
                                      : $atributoTable = " SET ".$this->Column[$a]."=:".$this->Column[$a];
            endif;
        endfor;
        isset($atributoTable) ? $this->sql .=$atributoTable : "";
        //Adiciona a(as) claúsula(as) para o Update
        $this->sql .=" WHERE ( ".$this->criterio." )";
       // retorna a estrutura sql para update montada
        return $this->sql;
    }
    /**
     * atualiza a informação na Table do banco de dados
     * @param void
     * @return  bool true or false
     */
    final public function Update ()
    {
        if((!$this->AtributeValue OR !$this->Column))
            return ;

        $add = Capsula::get_stamp()->prepare(" ".$this->InstrucaoUpdate()." ");
        // Adiciona os bindValue de cada atributo montado na estrutura
        for($a =0; $a< count($this->Column);$a++):
              if(array_key_exists($this->Column[$a], $this->AtributeValue)):
                $add->BindValue(":{$this->Column[$a]}",$this->AtributeValue[$this->Column[$a]]);
              endif;
        endfor;
         // cria um array contendo os indeces do array $filtroValor
         $this->filtroValor ? $filtro = array_keys($this->filtroValor) : "";
        for($a =0; $a< count($this->filtroValor);$a++):
              $add->BindValue(":{$filtro[$a]}", $this->filtroValor[$filtro[$a]]);
        endfor;
        return $add->execute();
    }
}
