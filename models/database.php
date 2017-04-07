<?php
/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 5.4.17
 * Time: 21:11
 */
class Database
{
     
    private $host     = "localhost";
    private $db_name  = "czsuprweb";
    private $username = "czsuprweb";
    private $password = "Lesnek95";

    /** @var PDO $conn **/
    static private $conn = null;

    public function __construct()
    {
        $this->dbConnect();
    }

    public function dbConnect()
	{
        try
		{
		    if (!self::$conn instanceof PDO) {
                self::$conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        }
		catch(PDOException $exception)
		{
            echo "Chyba databáze: " . $exception->getMessage();
        }
    }

    public function getLastId()
    {
        $sql = 'SELECT LAST_INSERT_ID()';

        $stmt = self::$conn->prepare($sql);
        $stmt->execute();

        $dbResult = $stmt->fetch(PDO::FETCH_ASSOC);
        $dbResult = array_values($dbResult);
        $result = (int) $dbResult[0];

        return $result;
    }

    public function insert($table, $data)
    {
        $cols = implode(', ' , array_keys($data));
        $vals  = ':val_' . implode(', :val_' , array_keys($data));
        $sql = 'INSERT INTO ' . $table . ' (' . $cols . ') VALUES (' . $vals . ');';

        $stmt = self::$conn->prepare($sql);

        foreach ($data as $key => $value)
        {
            $stmt->bindValue(":val_" . $key, $value);
        }
        $stmt->execute();
        return $stmt;
    }

    public function getByProperty($table, $columns, $propertyColumn, $propertyValue)
    {
        $result = null;

        $sql = 'SELECT ' . implode(',', $columns) . ' FROM ' . $table . ' WHERE ' . $propertyColumn . '=:val_' . $propertyColumn;

        $stmt = self::$conn->prepare($sql);
        $stmt->bindparam(':val_' . $propertyColumn, $propertyValue);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}