<?

class DatabaseManager
{
    public $database;
    
    public function __construct($url,$user,$pass)
    {
        $this->database = new PDO($url,$user,$pass);
        $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    public function getCountryScores()
    {
        $request = "SELECT * FROM countryscore";
        $stmt = $this->database->prepare($request);
		$stmt->execute();
        return($stmt->fetchAll());
    }
}


?>