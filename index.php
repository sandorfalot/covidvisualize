<!DOCTYPE html>
<html lang="en">
<head>
  <title>Covid 19 Worldwide Stats</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/5dd3399740.js" crossorigin="anonymous"></script>

</head>
<body>

<div class="container-fluid p-5 bg-danger text-white text-center">
  <h1>Covid-19 Visualization</h1>
  <p>Current stats of the pandemic, worldwide</p> 
</div>

<div class="container-fluid">

<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://covid-19-statistics.p.rapidapi.com/reports/total",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: covid-19-statistics.p.rapidapi.com",
		"X-RapidAPI-Key:abcdefg"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);


// taken fromn stack
//print_r(json_decode($response, true));

//print "<hr>test ";
$decoded_json = json_decode($response, true);
//echo $decoded_json['data']['date'];
$conf = $decoded_json['data']['confirmed'];
$active = $decoded_json['data']['active'];
$active_diff = $decoded_json['data']['active_diff'];

$deaths = $decoded_json['data']['deaths'];
$deaths_diff = $decoded_json['data']['deaths_diff'];

echo '<div class="row">';
  echo '<div class="col-sm-4 p-4 text-center">';
  // confirmed cases yellow
echo '<H3>Total Confirmed Cases: <br>';
    echo ' <i class="fas fa-male" style="color:gray;"></i> ';
echo $conf;
echo '</h3>';

// active cases orange
echo '<H3>Current Active Cases: <br>';
    echo ' <i class="fas fa-male" style="color:orange;"></i> ';
echo $active;
echo '<br>';
echo $active_diff;
echo ' new';
echo '</h3>';

// deaths cases red
echo '<H3>Total Deaths: <br>';
    echo ' <i class="fas fa-male" style="color:red;"></i> ';
echo $deaths; 
echo '<br>';
echo $deaths_diff;
echo ' new';
echo '</h3>';
echo '<h5> <i class="fas fa-male" style="color:black;"></i> is 1,000,000 cases</h5>';
  echo '</div>'; // col sm 4
echo '<div class="col-sm-8 p-4">';


// confirmed cases loop
$conf2 = ceil($conf/1000000);
// loop to show confirmed
for ($x = 0; $x <= $conf2; $x++) {
  echo '<i class="fas fa-male" style="color:gray;"></i> ';
}

// active cases loop
$active2 = ceil($active/1000000);
// loop to show active
for ($x = 0; $x <= $active2; $x++) {
  echo '<i class="fas fa-male" style="color:orange;"></i> ';
}

// deaths cases loop
$deaths2 = ceil($deaths/1000000);
// loop to show deaths
for ($x = 0; $x <= $deaths2; $x++) {
  echo '<i class="fas fa-male" style="color:red;"></i> ';
}
echo '</div>'; // col sm 8
// end row
echo '</div>';

// shows generic data
//if ($err) {
//	echo "cURL Error #:" . $err;
//} else {
//	echo $response;
//}
?>
</div>

<div class="footer text-center">

      <p>  Data is from the <a href="https://rapidapi.com/axisbits-axisbits-default/api/covid-19-statistics/">COVID-19 Statistics</a> API by <a href="https://rapidapi.com/organization/axisbits">AxisBits</a>.
</p>
<p><a href="https://github.com/sandorfalot/covidvisualize">My code on Github.</a></p>
</div>
</body>
</html>
