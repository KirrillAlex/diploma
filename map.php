  <div id="mapid">

  <script>
    const mymap = L.map('mapid').setView([54.1858259, 45.1758500], 12);

    let accessToken = 'pk.eyJ1IjoiYWxla3NlaWt1ZGFzaGtpbiIsImEiOiJja2h3MHBnczAwNHl0MndueDNqNXkzdm83In0.tkvGzNMUnq9SJ_AX-b3l4g';

    const attribution = '';
    const tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
    const tiles = L.tileLayer(tileUrl, {attribution});
    tiles.addTo(mymap);
     <?php
        include_once('connect.php');

        mysqli_query($connect,'SET NAMES UTF8');

        $myquery = "SELECT coords, name, description FROM `problems`";
        $res = mysqli_query($connect, $myquery);

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
          amountClicks++;
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

        function buttonOnClick(e)
        {
          document.location.href = "#add";
          location.reload(true);
          
        }
        function coordsOnClick(coords) 
        {
            coords = "LatLng(" + coords + ")";
            document.cookie = "coords="+coords;
            document.location.href = "#win1";
            location.reload(true);
        }
  </script>
  </div>
  
<div class="dm-overlay" id="win1">
        <div class="dm-table">
            <div class="dm-cell">
                <div class="dm-modal">
                    <a href="#" class="close"></a>
                    <?php
                      $coords = $_COOKIE["coords"];
                      $coords = mb_substr($coords, 7, 16);
                      $myquery = "SELECT name, description, (select photo from photos phot where phot.problemid = prob.id) FROM `problems` prob where coords='".$coords."'";
                      $row = mysqli_fetch_array(mysqli_query($connect, $myquery));
                    ?>
                    <h3 align="center"> <?php echo $row[0]; ?></h3>
                    <div class="pl-left">
                      <?php $path =  $row[2];
                      echo '<img src="'. $path .'" alt="картинка">';
                      ?>
                    </div>
                    <?php echo $row[1]; ?>
                </div>
            </div>
        </div>
    </div>

<div class="dm-overlay" id="add">
        <div class="dm-table ">
            <div class="dm-cell ">
            <div class="dm-modal-form">
                    <a href="#" class="close"></a>
                    <form class="form" action="#" method="post" autocomplete="off" enctype="multipart/form-data">
                    <h2 class="content__main-heading content__main-heading--color">Добавление проблемы</h2>
            <div class="form__row">
              <label class="form__label content__main-heading--color" for="name">Введите название проблемы <sup>*</sup></label>

              <input class="form__input" type="text" name="name" id="name" value="" placeholder="Введите название">              
            </div>
            

            
            <div class="form__row">
              <label class="form__label content__main-heading--color" for="town">Город <sup>*</sup></label>

              <input class="form__input" type="text" name="town" id="town" value="" placeholder="Введите город, в котором произошла проблема">
              
             <label class="form__label content__main-heading--color" for="street">Улица <sup>*</sup></label>

              <input class="form__input" type="text" name="street" id="street" value="" placeholder="Введите улицу, в котором произошла проблема">
              <label class="form__label content__main-heading--color" for="house">Дом </label>

              <input class="form__input" type="text" name="house" id="house" value="" placeholder="Введите дом, в котором произошла проблема"> 
            </div>

            <textarea rows="5" cols="53" placeholder="Введите описание проблемы" name="description"></textarea>
            <label class="form__label content__main-heading--color" for="file">Загрузите фотографии* </label>
            <input type="file" name="file" multiple>
            <div class="form__row form__row--controls">

              <input class="button" type="submit" name="submit_form" value="Отправить">
            </div>
          </form> 
                
                </div>
            </div>
        </div>
    </div>
    
  <?php
    $now = date('Y-m-d', time());
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit_form']){
      $name = $_POST['name'];
      $town = $_POST['town'];
      $street = $_POST['street'];
      $description = $_POST['description'];
      $file_name = $_FILES['file']['name'];
      $file_path = __DIR__ . '/uploads/';
      $file_url = '/uploads/' . $file_name;
      $new_path =  $file_path . $file_name;
      move_uploaded_file($_FILES['file']['tmp_name'], $new_path);

      $query_problems = "INSERT INTO problems (name, description, imageAvailability, date, userid, city, rating, coords) 
      VALUES('$name', '$description', '1', '$now' ,'1', '$town', '0', '54.17389, 45.22131')";
      $result_problems = mysqli_query($connect, $query_problems);
      $query_id = "SELECT id from problems WHERE userid = '1' AND name = '$name'";
      $result_id = mysqli_query($connect, $query_id);
      $id = mysqli_fetch_all($result_id, MYSQLI_ASSOC);
      $id_now = $id[0]['id'];
      $query_photos = "INSERT INTO photos (problemid, userid, date, photo) VALUES('$id_now', '1', '$now', '$file_url')";
      $result_photos = mysqli_query($connect, $query_photos);
    }
    
?>