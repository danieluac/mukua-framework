<?php
namespace MukuaKernel\Database\Capsula;
use PDO;
use PDOException;
/**
 * Capsula description
 * Capsula class is the main class for the database connection
 * @author Daniel-U-AC
 */
class Capsula
{
    /**
     * save the database connection
     * @var object $conn;
     */
    private static $conn;
    /**
     * store argument for the database connection
     * @var array $param
     */
    private static  $param = array();
    /**
     * return the database connection
     * @param void
     * @return object $conn
     */
    final public static function get_stamp()
    {
        self::Stamped();
        return self::$conn;
    }
    /**
     * update argument for the database connection
     * @param array $parametros
     * @return void
     */
    final public static function Stamp(array $argument)
    {
        self::$param = $argument;
    }
    /**
     * Conecta com o banco de dados
     * @param type void
     * @return type void
     */
    final private static  function Stamped ()
    {
        if(!self::$conn)
        {
            try
                {
                self::$conn = new PDO
                (
                    self::$param['DRIVER'].
                    ":host=".self::$param['HOSTNAME'].
                    ";dbname=".self::$param['DATABASE'].
                    ";charset=".self::$param['CHARSET'].
                    ";",self::$param['USERNAME']
                    ,self::$param['PASSWORD']
                );
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                } catch (PDOException $e)
                {
                  print "***********<br/><h3>Data server doesn't respond see your internal network connection!.</h3><br/>";
                   die("****************************");
                }
        }
    }
}
