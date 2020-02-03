<?php
class Database
{
    private static $hote = 'localhost' ;
    private static $bdd = 'modula';
    private static $dbUser = 'bengi';
    private static $mdpBdd = 'Rugbyman47' ;

    private static $pdo = null;

    public static function connect()
    {
        try
        {
            self::$pdo = new PDO('mysql:host=' . self::$hote. ';dbname=' . self::$bdd,self::$dbUser,self::$mdpBdd);
        }
        catch (PDOException $e)
        {
            die($e-> getMessage());
            exit();
        }
        return self::$pdo;
    }

    public static function disconnect()
    {
        self::$pdo = null;
    }
}

?>
