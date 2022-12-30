<?



class View
{
    public $controllerManager;
    
    public function __construct($con)
    {
        $this->controllerManager = $con;
    }
    
    public function makeHomePage()
    {
        //require_once("app/Model/homePage.php");
        
        $header = "<h1>Entrée interdite</h1>";
        
        echo($header);
        
        $content =
        "<form action=\"index.php\">"
        ."<input type=\"radio\" id=\"sa\" name=\"continent\" value=\"saData\">"
        ."<label for=\"html\">South America</label><br>"
        ."<input type=\"radio\" id=\"sa\" name=\"continent\" value=\"naData\">"
        ."<label for=\"html\">North America</label><br>"
        ."<input type=\"radio\" id=\"sa\" name=\"continent\" value=\"euData\">"
        ."<label for=\"html\">Europe</label><br>"
        ."<input type=\"radio\" id=\"sa\" name=\"continent\" value=\"asData\">"
        ."<label for=\"html\">Asia</label><br>"
        ."<input type=\"radio\" id=\"sa\" name=\"continent\" value=\"afData\">"
        ."<label for=\"html\">Africa</label><br>"
        ."<input type=\"radio\" id=\"sa\" name=\"continent\" value=\"worldData\">"
        ."<label for=\"html\">World</label><br>"
		."<button type=\"submit\" name=\"map\" value=\"1\">View map</button>"
		."</form>";
				
				
        
        echo($content);
    }
    
    public function showMap()
    {
        $header = "<h1>Entrée interdite</h1>";
        
        echo($header);
        
        $content = "<form action=\"index.php\">"
				."<button type=\"submit\">Back</button>"
				."</form>";
				
				
        
        echo($content);
        
        
        require_once("app/Model/map.php");
    }
}

?>