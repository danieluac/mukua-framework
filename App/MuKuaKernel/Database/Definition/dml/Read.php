<?php
namespace MukuaKernel\Database\Definition\dml;
use MukuaKernel\Database\Capsula\Capsula;
use MukuaKernel\Database\Definition\dml\Create;
/**
 * Description of Select
 *
 * @author Daniel-U-AC
 */
class Read extends Create
{
    /**
     * monta a estrutura SQL para o SELECT
     * @return string da estrutura sql montada
     */
     private function InstrucaoSelect()
    {
        $this->getTable();
         $this->sql = " SELECT ";
         // adiciona os atributos da tabela, que são os valores do array
        // This->Column deve ser declarado em cada model para identificar os atributos na tabela
        // Também adiciona os criterios de segurança do PDO
         $this->sql .=$this->PrimaryKey.", ". implode(", ", $this->Column);
            $this->sql .= " FROM ".$this->Table;//.strtoupper($this->tabela);
        //Adiciona a(as) claúsula(as) para o Update
            if($this->criterio)
            {
                 $this->sql .=" WHERE ( ".$this->criterio." )";
            }
       // retorna a estrutura sql para update montada
        return $this->sql;
    }
    /**
     * permite buscar registro no banco de dados atraves da chave primaria
     * @param int $find é a chave a ser procurado na tabela do banco
     * @param string $filtro é o filtro de consulta ex: id>1 ou id=1
     * @return Objecto da consulta
     */
    final public  function Find($find, $filtro = "=")
    {
       if(!empty($find) and $this->Column)
       {
            $this->criterio = null;
            self::$cont = 1;
            $this->filtroValor = [];

            $this->where($this->PrimaryKey, $filtro, $find);
            if(!empty($this->extraSql))
                $add = Capsula::get_stamp()->prepare(" ".$this->InstrucaoSelect()." ".$this->extraSql);
            else 
                $add = Capsula::get_stamp()->prepare(" ".$this->InstrucaoSelect());
            // cria um array contendo os indeces do array $filtroValor
            $this->filtroValor ? $filtro = array_keys($this->filtroValor) : "";
            for($a =0; $a< count($this->filtroValor);$a++):
                  $add->BindValue(":{$filtro[$a]}", $this->filtroValor[$filtro[$a]]);
            endfor;
            
            $this->criterio = null;
            self::$cont = 1;
            $this->filtroValor = [];

            $add->execute();
            $dataArray = $add->fetchAll();
            // retona um obejecto com os dados do usuario;
            if(isset($dataArray[0]))
            {
                $this->where($this->PrimaryKey,'=',$dataArray[0]->id);
                return $dataArray[0];
            }
            else 
                return $dataArray;
       }
       else
           return ;
    }
    /**
     * busca todos os registros na tabela, excepto se existir um criterio de busca ira apenas trazer de acoro
     * com o critério
     * @param void
     * @return array com todos os registos da tabela no caso de não existir um critério de busca
     */
    final public function All ()
    {
        if($this->Column):
           $this->criterio = null;
            self::$cont = 1;
            $this->filtroValor = [];

        if(!empty($this->extraSql))
            $add = Capsula::get_stamp()->prepare(" ".$this->InstrucaoSelect()." ".$this->extraSql);
        else 
            $add = Capsula::get_stamp()->prepare(" ".$this->InstrucaoSelect());
            // cria um array contendo os indeces do array $filtroValor
        $this->filtroValor ? $filtro = array_keys($this->filtroValor) : "";
        for($a =0; $a< count($this->filtroValor);$a++):
            $add->BindValue(":{$filtro[$a]}", $this->filtroValor[$filtro[$a]]);
        endfor;

        $add->execute();
            // retona um obejecto com os dados do usuario;
        return $add->fetchAll();
    endif;
    }
}
