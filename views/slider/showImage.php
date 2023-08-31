<!-- HTML для элемента загрузки -->
<div  id="loading" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 9999;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <img src="/upload/loading.gif" alt="Loading" width="50" height="50">
        <p>Loading...</p>
    </div>
</div>


<!-- Колонки для отображения изображений -->
<?php if (!empty($imagesInfo)): ?>

    <?php foreach ($imagesInfo as $key => $imageInfo): ?>

        <div style="display: flex; justify-content: space-between;" data-parent="<?= $imageInfo['uuid']; ?>">

            <div style="width: 30%;">
                <!-- Отображение загруженного изображения -->
                <div>
                    <h2>Изображение</h2>
                    <img src="<?= $imageInfo['url'] ?>" alt="Изображение <?= ++$key ?>" width="50%">
                </div>
            </div>

            <div style="width: 30%;">
                <!-- Информация об изображении -->
                <div>
                    <h2>Информация об изображении</h2>
                    <p>Идентификационный номер: <?= $imageInfo['uuid'] ?></p>
                    <p>Описание: <?= $imageInfo['description'] ?></p>
                </div>
            </div>

            <div style="width: 30%;">
                <!-- Кнопка для удаления изображения -->
                <div>
                    <h2>Управление изображением</h2>
                    <button onclick="deleteButtonExec(event)" data-id="<?= $imageInfo['uuid']; ?>">Удалить фото</button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

<?php endif; ?>

<script>

    function deleteButtonExec(e) {

        let loading = document.getElementById('loading');
        loading.style.display='block';

        // Отправляем DELETE-запрос на сервер
        fetch(`/sliders/`+ e.target.dataset.id, {
            method: "DELETE",
        })
            .then(response => {
                if (response.ok) {
                    loading.style.display='none';
                    console.log("Фото успешно удалено.");
                    let parentElement = document.querySelector(`[data-parent="${e.target.dataset.id}"]`);
                    parentElement.remove();
                } else {
                    console.error("Произошла ошибка при удалении фото.");
                }
            })
            .catch(error => {
                console.error("Произошла ошибка при отправке запроса: " + error.message);
            });
    }


</script>
