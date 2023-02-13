<?php 

  // error_reporting('E_NOTICE');
  session_start();  
  include "db/conn.php"; 


  if (!isset($_SESSION['userID'])){
    ?>
      <script>
          location.href='login';
      </script>
      <?php
  }
  $userID = $_SESSION['userID'];

  $userQuery = mysqli_query($DB_CONNECT,"SELECT * FROM `user_tb` WHERE `user_id`='$userID' ");
  $userFet = mysqli_fetch_array($userQuery);

  $dptQuery = mysqli_query($DB_CONNECT,"SELECT * FROM `dpt_tb` WHERE `dpt_id`='".$userFet['dpt_id']."' ");
  $dptFet = mysqli_fetch_array($dptQuery);

  // PACKAGES
  $shipAirQu = mysqli_query($DB_CONNECT,"SELECT * FROM shipping_method_tb WHERE transport_type='Air Transport' ");
  $shipAirCount = mysqli_num_rows($shipAirQu);

  $shipRailQu = mysqli_query($DB_CONNECT,"SELECT * FROM shipping_method_tb WHERE transport_type='Rail Transport' ");
  $shipRailCount = mysqli_num_rows($shipRailQu);

  $shipRoadQu = mysqli_query($DB_CONNECT,"SELECT * FROM shipping_method_tb WHERE transport_type='Road Transport' ");
  $shipRoadCount = mysqli_num_rows($shipRoadQu);

  $shipWaterQu = mysqli_query($DB_CONNECT,"SELECT * FROM shipping_method_tb WHERE transport_type='Water Transport' ");
  $shipWaterCount = mysqli_num_rows($shipWaterQu);

  $packCantQu = mysqli_query($DB_CONNECT,"SELECT * FROM container_tb WHERE type='Container' ");
  $packContCount = mysqli_num_rows($packCantQu);

  $packCargQu = mysqli_query($DB_CONNECT,"SELECT * FROM container_tb WHERE type='Cargo' ");
  $packCargCount = mysqli_num_rows($packCargQu);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.PNG">
    <title>Heavy Lifting Analytics</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/fontawesome-free-kit/js/all.min.css">

    <script src='assets/fontawesome-free-kit/js/all.min.js'></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Transport", "Travels", { role: "style" } ],
        ["Air Transport", <?php echo $shipAirCount; ?>, "#b87333"],
        ["Rail Way Transport", <?php echo $shipRailCount; ?>, "silver"],
        ["Road Transport", <?php echo $shipRoadCount; ?>, "gold"],
        ["Water Transport", <?php $shipWaterCount; ?>, "color: #e5e4e2"]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
      chart.draw(view, options);
  }
  </script>
  <!-- CONTAINER'S OR CARGO -->
  <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Containers', <?php echo $packContCount; ?>],
          ['Cargo/Loads', <?php echo $packCargCount; ?>],
        ]);

        // Set chart options
        var options = {
                       'width':400,
                       };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
</head>