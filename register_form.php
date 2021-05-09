<script>
  function buttonOnClick(e)
  {
    document.location.href = "#add_user";
    location.reload(true);
          
  }
</script>

<div class="dm-overlay" id="add_user">
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