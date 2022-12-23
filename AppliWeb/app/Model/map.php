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
    <div id="map" style="width: 1000px; height: 800px"></div>

    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://cdn.leafletjs.com/leaflet-0.7.1/leaflet.js"></script>
    
    <script type="text/javascript" src="data/saData.js"></script>
    
    <script>
    
        var map = L.map('map').setView([0, -50], 3);
        
        const geojson = L.geoJson(saData, {
		style,
		onEachFeature
	}).addTo(map);
    
        

        function getColor()
        {
            var color = "#" + Math.floor(Math.random()*16777215).toString(16);
            return color;
        }
        
        function style(feature)
        {
            return {
            stroke: true,
            fill: true,
            fillColor: getColor(),
            fillOpacity: 0.5
            };
        }
        
        function highlightFeature(e)
        {
            var layer = e.target;    
            
            layer.setStyle(
            {
                weight: 5,
                color: '#666',
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
            console.log("adding");
            layer.on(
            {
                mouseover: highlightFeature,
                mouseout: resetHighlight,
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
        
        map.on('click',onMapClick);
        
        const input = document.getElementById('map');
        
        
        input.addEventListener('change', () => {
          const reader = new FileReader();
          reader.onload = () => {
            output.textContent = reader.result;
          };
          reader.readAsText(input.files[0]);
        });
        
        //var myCustomStyle = $.getJSON(myGeoJSONPath,function(data){L.geoJson(data, {clickable: false,style: style, onEachFeature: onEachFeature}).addTo(map);})
        

        
    </script>
</body>
</html>