<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Слайдер с изображениями и текстом</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .slider-container {
            width: 40%; /* Set the slider container to 50% of the page width */
            margin: 0 auto; /* Center the container horizontally */
            overflow: hidden;
        }

        .slider {
            display: flex;
            width: 100%; /* Ensure the slider occupies the full width of its container */
            transition: transform 0.3s ease;
        }

        .slide {
            flex: 0 0 100%;
            width: 100%;
            position: relative;
        }

        .slide img {
            width: 100%;
            height: auto;
        }

        .slide .image-text {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 5px 10px;
            font-size: 15px;
        }

        .comments-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        ul {
            list-style: none;
            padding: 0;
            text-align: center;
        }

        li {
            margin: 10px 0;
        }


        .comment-list {
            text-align: left; /* Выравнивать текст комментариев по левому краю */
        }

        .comment {
            margin: 10px 0; /* Размещать комментарии на новых строках */
        }

        /* Анимация переключения слайдов */
        @keyframes slideAnimation {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-100%);
            }
        }

        /* Стили для формы и инпутов */
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .error-message {
            color: red;
        }

        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Стили для кнопки */
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

    </style>
</head>
<body>

    <?php if(!empty($images)): ?>
    <div class="slider-container">
        <div class="slider">
            <?php foreach ($images as $key=>$image): ?>
                <div class="slide">
                    <img src="<?= $image['url'] ?>" alt="Изображение <?=++$key;?>">
                    <div class="image-text"><?= $image['description'] ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>


    <script>
        const slider = document.querySelector('.slider');
        let currentIndex = 0;

        function nextSlide() {
            currentIndex = (currentIndex + 1) % slider.children.length;
            slider.style.transform = `translateX(-${currentIndex * 100}%)`;
        }

        setInterval(nextSlide, 5000); // Автоматическое переключение каждую секунду
    </script>

