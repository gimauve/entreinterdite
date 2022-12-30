<?

class Router
{
    private $controllerManager;
    
    public function __construct($db)
    {
        $this->controllerManager = new Controller($db);
        
    }
    
    public function main()
    {
        if((isset($_GET['map'])))
        {
            
            $this->controllerManager->view->showMap();
        }
        else
        {
            $this->controllerManager->view->makeHomePage();
            
        }
    }
      
}



?>