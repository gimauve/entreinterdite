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
        if(isset($_GET['countryTag']))
        {
            $this->controllerManager->view->makeCountryPage();
        }
            
        
        else if((isset($_GET['map'])))
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