    <div class="comments-container">

        <h2>Оставить комментарий</h2>


        <form method="POST" action="/feedback" enctype="multipart/form-data">
            <div class="form-group">
                <label for="firstname">Имя:</label>
                <input type="text" name="firstname" id="firstname" placeholder="Ivan" pattern="^[A-Za-z]+$" required >

            </div>
            <div class="form-group">
                <label for="lastname">Фамилия:</label>
                <input type="text" name="lastname" id="lastname" placeholder="Opiev" pattern="^[A-Za-z]+$">
            </div>
            <div class="form-group">
                <label for="phone">Телефон:</label>
                <input type="tel" name="phone" id="phone" placeholder="+375-XX-XXX-XX-XX" pattern="^\+375\-\d{2}\-\d{3}\-\d{2}\-\d{2}$">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="ivan_grechichko@mail.ru" pattern="^[a-z_\.\-]{5,31}@[a-z]{2,8}\.[a-z]{2,4}$" required>
            </div>
            <div class="form-group">
                <label for="comment">Комментарий:</label>
                <textarea name="comment" id="comment" placeholder="Comments" pattern=".+" required></textarea>
            </div>

            <?php if(!empty($_SESSION)): ?>
                <?php foreach (\App\Components\Session::get('errors') as $error): ?>
                    <p class="error-message"><?=$error?></p>
                <?php endforeach; ?>
                <?php \App\Components\Session::remove(name: 'errors'); ?>
            <?php endif; ?>

            <input type="submit" value="Отправить комментарий">
        </form>




    </div>