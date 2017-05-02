<?php
/**
 * Created by PhpStorm.
 * User: lesnek
 * Date: 5.4.17
 * Time: 21:11
 */
class Database
{
    private $host;
    private $db_name;
    private $username;
    private $password;

    const CONFIG_FILE = __DIR__ . "/../conf.json";

    /** @var PDO $conn **/
    static private $conn = null;

    public function __construct()
    {
        $this->dbConnect();
    }

    /** Connect to database - trought PDO **/
    public function dbConnect()
	{
        try
		{
		    if (!self::$conn instanceof PDO) {
		        $content = file_get_contents(self::CONFIG_FILE);
		        $json = (array)json_decode($content);

                $this->host = $json["db_server"];
                $this->db_name = $json["db_name"];
                $this->username = $json["db_user"];
                $this->password = $json["db_pass"];

                self::$conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        }
		catch(PDOException $exception)
		{
            echo "Chyba databáze: " . $exception->getMessage();
        }
    }

    /** To get last id from database to create new user - preventing collision **/
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

    /** Registered users counter *
     * @param String $table
     * @return int
     */
    public function tableRowsCount ($table)
    {
        $del = self::$conn->prepare('SELECT * FROM '.$table);
        $del->execute();

        $count = $del->rowCount();
        return $count;
    }

    /** Func to insert data to database **/
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

    /** Update data in databse (set newer data) **/
    public function update($table, $data, $id)
    {
        $dataSet = [];
        foreach ($data as $key => $value)
        {
            $dataSet[] = $key . " = :val_" . $key;
        }

        $sql = 'UPDATE ' . $table . ' SET ' . implode(',', $dataSet) . ' WHERE id = :val_id';
        $stmt = self::$conn->prepare($sql);
        foreach ($data as $key => $value)
        {
            $stmt->bindValue(':val_' . $key, $value);
        }
        $stmt->bindValue(':val_id', $id);
        $stmt->execute();
    }

    /** Getting data from database by any property *
     * @param $table
     * @param $columns
     * @param $propertyColumn
     * @param $propertyValue
     * @return mixed|null
     */
    public function getByPropertyOne($table, $columns, $propertyColumn, $propertyValue)
    {
        $result = null;

        $sql = 'SELECT ' . implode(',', $columns) . ' FROM ' . $table . ' WHERE ' . $propertyColumn . '=:val_' . $propertyColumn;

        $stmt = self::$conn->prepare($sql);
        $stmt->bindparam(':val_' . $propertyColumn, $propertyValue);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    /** Getting data from database by any property **/
    public function getByPropertyAll($table, $columns, $propertyColumn, $propertyValue)
    {
        $result = null;

        $sql = 'SELECT ' . implode(',', $columns) . ' FROM ' . $table . ' WHERE ' . $propertyColumn . '=:val_' . $propertyColumn;

        $stmt = self::$conn->prepare($sql);
        $stmt->bindparam(':val_' . $propertyColumn, $propertyValue);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /** Getting all data from database **/
    public function getAll($table, $columns)
    {
        $result = null;

        $sql = 'SELECT ' . implode(',', $columns) . ' FROM ' . $table;

        $stmt = self::$conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}
