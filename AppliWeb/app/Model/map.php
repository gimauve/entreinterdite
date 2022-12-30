<html>
<head>
    <title>Entree Interdite</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.1/leaflet.css" />
    <style type="text/css">
        .leaflet-container{background-color:#c5e8ff;}
    </style>
</head>

<body>

<?
    $countryData = $this->controllerManager->dbStorage->getCountryScores();
    $countryDataJSON = json_encode($countryData);
    
    $continentDataFile = "";
    
    if(isset($_GET["continent"]))
    {
        $continentDataFile = $_GET["continent"];
    }
    else
    {
        $continentDataFile = "worldData";
    }
    
    $continentData = "data/" . $continentDataFile . ".js";
?>

    <div id="map" style="width: 1000px; height: 800px"></div>
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://cdn.leafletjs.com/leaflet-0.7.1/leaflet.js"></script>
    <script type="text/javascript" src=<? echo $continentData ?>></script>
    <script>
    
        var map = L.map('map').setView([0, -50], 3);
        
        const geojson = L.geoJson(<? echo $continentDataFile ?>, {style,onEachFeature}).addTo(map);
    
        function getColor(countryTag)
        {
            var countryData = (<? echo($countryDataJSON); ?>);
            var color = "#";
            for(line in countryData)
            {
                if (countryTag == (countryData[line]["countryTAG"]))
                {
                    switch(parseInt(countryData[line]["score"]))
                    {
                        case 1: {return ("#ff0000");}
                        case 2: {return ("#ff5050");}
                        case 3: {return ("#ff9966");}
                        case 4: {return ("#ff9933");}
                        case 5: {return ("#ffcc00");}
                        case 6: {return ("#ffff66");}
                        case 7: {return ("#ccff33");}
                        case 8: {return ("#99cc00");}
                        case 9: {return ("#66ff33");}
                        case 10: {return ("#33cc33");}
                        default:{break;}
                    }
                }
            }
            return "#ffffff";
        }
        
        function style(feature)
        {
            return {
			weight: 2,
			opacity: 1,
			color: 'white',
			dashArray: '3',
			fillOpacity: 0.7,
			fillColor: getColor(feature.properties.adm0_a3)
            };
        }
        
        function highlightFeature(e)
        {
            var layer = e.target;    
            
            layer.setStyle(
            {
                weight: 5,
                color: 'grey',
                dashArray: '',
                fillOpacity: 0.7
            });

            layer.bringToFront();
            controller.update(layer.feature.properties);
        }
        
        function resetHighlight(e)
        {
            geojson.resetStyle(e.target);
            controller.update();
        }
        
        function onEachFeature(feature, layer)
        {
            layer.on(
            {
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: onCountryClick,
            });
        }
        
        var popup = L.popup();
        var controller = L.control();

        controller.onAdd = function (map)
        {
            this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
            this.update();
            return this._div;
        };
        
        controller.update = function (props)
        {
            this._div.innerHTML = '<h4>Country name</h4>' +  (props ? '<b>' + props.admin + '</b>': 'Hover over a country');
        };

        controller.addTo(map);
        
        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent("You clicked the map at " + e.latlng.toString())
                .openOn(map);
        }
        
        function onCountryClick(e) {
            console.log(e.target.feature.properties.admin);
            popup
                .setLatLng(e.latlng)
                .setContent(e.target.feature.properties.admin)
                .openOn(map);
        }
        
        map.on('click',onMapClick);
        
        const input = document.getElementById('map');
        
        input.addEventListener('change', () => {
          const reader = new FileReader();
          reader.onload = () => {
            output.textContent = reader.result;
          };
          reader.readAsText(input.files[0]);
        });
    </script>
</body>
</html>