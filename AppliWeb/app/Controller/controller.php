<?

class Controller
{
    public $view;
    public $dbStorage;
    
    public function __construct($db)
    {
        $this->view = new View($this);
        $this->dbStorage = $db;
    }
    
}

?>