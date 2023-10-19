

<!--axios-->
<script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
<!--vue-->
<script src="../public/js/main.js"></script>
<script src="../public/js/message.js"></script>

<footer class="footer_section">
    <div class="container">
        <div class="row">
            <div class="col-md-4 footer-col">
                <div class="footer_contact">
                    <h4>
                        Служба поддержки
                    </h4>
                    <div class="contact_link_box">
                        <a href="">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span>
                              <?=$contact['location']?>
                            </span>
                        </a>
                        <a href="">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <span>
                              <?=$contact['phone']?>
                            </span>
                        </a>
                        <a href="">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <span>
                               <?=$contact['email']?>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 footer-col">
                <div class="footer_detail">
                    <a href="" class="footer-logo">
                        <?=$companyInfo['name']?>
                    </a>
                    <p>
                        <?=$companyInfo['description']?>
                    </p>
                    <div class="footer_social">
                        <?php foreach($socials as $social): ?>
                        <a href="<?=$social['link']?>">
                            <i class="fa <?=$social['class_name']?>" aria-hidden="true"></i>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 footer-col">
                <h4>
                    Время работы
                </h4>
                <p>
                    <?=$companyInfo['days']?>
                </p>
                <p>
                    <?=$companyInfo['time']?>
                </p>
            </div>
        </div>

        <div class="footer-info">
            <p>
                2023  All Rights Reserved By
                <a href="https://html.design/">Free Html Templates</a><br><br>
                &copy; 2023 Distributed By
                <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
            </p>
        </div>

    </div>
</footer>