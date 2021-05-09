<script>
  function register(e)
  {
    document.location.href = "#add_user";
    location.reload(true);
  }
</script>
<head>
  <link rel="stylesheet" href="css/normalize.css">    
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/map.css">
</head>

<div class="dm-overlay" id="add_user">
        <div class="dm-table ">
            <div class="dm-cell">
            <div class="dm-modal-form">
                    <a href="#" class="close"></a>
                    <form class="form" action="#" method="post" autocomplete="off" enctype="multipart/form-data">
                    <h2 class="content__main-heading content__main-heading--color">Регистрация пользователя</h2>
            <div class="form__row">
              <label class="form__label content__main-heading--color" for="name">Введите Имя <sup>*</sup></label>
              <input class="form__input" type="text" name="name" id="name" value="" placeholder="Имя" required>  

              <label class="form__label content__main-heading--color" for="surname">Введите Фамилию <sup>*</sup></label>
              <input class="form__input" type="text" name="town" id="surname" value="" placeholder="Фамилия" required>

              <label class="form__label content__main-heading--color" for="street">Введите номер телефона <sup>*</sup></label>
              <input class="form__input" type="tel" pattern="[0-9]{11}"
                     name="street" id="street" value="" placeholder="Номер телефона" required>

              <label class="form__label content__main-heading--color" for="email">Введите email <sup>*</sup></label>
              <input class="form__input" type="email" name="email" id="house" value="" placeholder="email" required>

              <label class="form__label content__main-heading--color" for="pswd">Введите пароль <sup>*</sup></label>
              <input class="form__input" type="password" name="pswd" id="house" value="" placeholder="Пароль" required> 
            </div>

              <input class="button" type="submit" name="submit_form" value="Отправить">
            </div>
          </form> 
            </div>
            </div>
        </div>
</div>