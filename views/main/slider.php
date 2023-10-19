<section class="slider_section ">
    <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">

            <?php foreach ($sliders as $slider): ?>
                <div class="<?= $slider['class_name'] ?>">
                    <div class="container ">
                        <div class="row">
                            <div class="col-md-7 col-lg-6 ">

                                <div class="detail-box">
                                    <h1>
                                        <?= $slider['name'] ?>
                                    </h1>
                                    <p>
                                        <?= $slider['description'] ?>
                                    </p>
                                    <div class="btn-box">
                                        <a href="<?=$slider['link']?>" class="btn1">
                                            <?=$slider['link_name']?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>


        <div class="container">
            <ol class="carousel-indicators">
                <?php foreach ($sliders as $key=>$slider): ?>
                    <li data-target="#customCarousel1" data-slide-to="<?=$key?>"></li>
                <? endforeach; ?>
            </ol>
        </div>
    </div>

</section>