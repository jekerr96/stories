<?
namespace local;

use PDO;

class DBConnect {
    private static $user = "root";
    private static $pass = "";
    private static $db_name = "story";
    private static $host = "localhost";
    private static $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    private static $dbh;

    /**
     * @return mixed
     */
    public static function getConnect() {
        if (!static::$dbh) {
            static::$dbh = new PDO("mysql:host=".static::$host.";dbname=".static::$db_name, static::$user, static::$pass, static::$opt);
        }

        return static::$dbh;
    }
}