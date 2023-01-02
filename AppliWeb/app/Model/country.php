<head>
  <link rel="stylesheet" href="app/View/table.css">
</head>

<?
$countryTag = $_GET["countryTag"];
$countryName = $_GET["countryName"];
$countryContinent = $_GET["countryContinent"];

echo("<h1>" . $countryName ."</h1>");
echo("<h3>" . $countryTag ."</h3>");
echo("<h3>" . $countryContinent ."</h3>");


$incidentTable = "";


?>

<table>
    <thead>
        <tr>
            <th colspan="2">List of incidents</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Example of incident data.</td>
        </tr>
    </tbody>
</table>