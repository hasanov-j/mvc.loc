<div style="max-width: 400px; margin: 0 auto;">
    <h1>Галерея изображений</h1>

    <!-- Форма для загрузки изображения -->

    <form action="http://mvc.loc/sliders" method="post" enctype="multipart/form-data"
          style="display: flex; flex-direction: column; align-items: flex-start;">
        <label for="image">Выберите изображение:</label>
        <input type="file" name="image" id="image" style="margin-bottom: 10px;">

        <label for="url">Описание фото:</label>
        <input type="text" name="description" id="description" style="margin-bottom: 10px;">

        <?php if(!empty($_SESSION)): ?>
            <?php foreach (\App\Components\Session::get('errors') as $error): ?>
                <p class="error-message"><?=$error?></p>
            <?php endforeach; ?>
            <?php \App\Components\Session::remove(name: 'errors'); ?>
        <?php endif; ?>

        <input type="submit" value="Загрузить изображение">


    </form>

</div>