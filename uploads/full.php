<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
  integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
  crossorigin=""/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css"> 
  <link rel="stylesheet" href="style.css">
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
  integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
  crossorigin=""></script>
  <title></title>
</head>
<body>



  <div id="mapid">

  <script>
    const mymap = L.map('mapid').setView([54.1858259, 45.1758500], 12);

    let accessToken = 'pk.eyJ1IjoiYWxla3NlaWt1ZGFzaGtpbiIsImEiOiJja2h3MHBnczAwNHl0MndueDNqNXkzdm83In0.tkvGzNMUnq9SJ_AX-b3l4g';

    const attribution = '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors';
    const tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
    const tiles = L.tileLayer(tileUrl, {attribution});
    tiles.addTo(mymap);
     <?php

        $db_host       = 'localhost';
        $db_name       = 'problem';
        $db_username   = 'root';
        $db_password   = 'root';
        $connect_to_db = mysqli_connect( $db_host, $db_username, $db_password, $db_name );

        if(!$connect_to_db){
            echo "Не удалось подключиться к БД!";
            echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
        }

        mysqli_query($connect_to_db,'SET NAMES UTF8');

        $myquery = "SELECT coords, name, description FROM `problems`";
        $res = mysqli_query($connect_to_db, $myquery);

        while ($row = mysqli_fetch_array( $res ))
        {
      ?>
        var coords = '<?= $row["coords"]; ?>' ;
        var name = '<?= $row["name"]; ?>' ;
        coords = coords.split(",");
        
        L.marker([coords[0], coords[1]]).on('click', markerOnClick).addTo(mymap).bindPopup('<b>'+name+'</b>');

        <?php
      }
        ?>

        let amountClicks = 0;
        let whereClick;

        function markerOnClick(e)
        {
          amountClicks++
          if(amountClicks == 2 && whereClick == e.latlng){
            amountClicks = 0;
            document.cookie = "coords="+e.latlng;
            document.location.href = "#win1";
            location.reload(true);
          }
          else if(whereClick != e.latlng && amountClicks == 2){
            amountClicks = 1;
            whereClick = e.latlng;
          }
          else
          {
            whereClick = e.latlng;
          }
          
        }
  </script>
  </div>
  
<div class="dm-overlay" id="win1">
        <div class="dm-table">
            <div class="dm-cell">
                <div class="dm-modal">
                    <a href="#close" class="close"></a>
                    <?php
                      $coords = $_COOKIE["coords"];
                      $coords = mb_substr($coords, 7, 16);
                      $myquery = "SELECT name, description, (select photo from photos phot where phot.problemid = prob.id) FROM `problems` prob where coords='".$coords."'";
                      $res = mysqli_query($connect_to_db, $myquery);
                      $row = mysqli_fetch_array( $res )
                    ?>
                    <h3 align="center"> <?php echo $row[0]; ?></h3>
                    <div class="pl-left">
                        <img src="https://sun1-19.userapi.com/impg/c858136/v858136421/11a056/veVGfZHn2sI.jpg?size=1092x1280&quality=96&proxy=1&sign=a2086f79827866b1ad5869d7087e1195">  <!-- сюда добавь картинки, когда разберешься с ними -->
                    </div>
                    <?php echo $row[1]; ?>
                </div>
            </div>
        </div>
    </div>

</body>
</html>