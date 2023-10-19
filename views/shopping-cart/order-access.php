<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Успешное оформление заказа</title>
    <link href="../public/css/order-access.css" rel="stylesheet"/>
</head>
<body>
<div>
    <div class="confirmation-title">Заказ успешно оформлен!</div>
    <div class="confirmation-message">
        Спасибо за ваш заказ. Ожидайте доставку.
        <br>
        Вы можете <a href="/" class="confirmation-link">перейти на главную страницу</a>.
    </div>
</div>

<script>
    localStorage.removeItem('cartItems');
    localStorage.removeItem('promocodes');
</script>

</body>
</html>


