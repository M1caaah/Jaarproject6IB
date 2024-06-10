<?php

use app\models\HomeProducts;

/** @var $model HomeProducts */

?>

<section class="bg-dark p-5">
    <div class="container-fluid w-75">
        <div class="row">
            <h3 class="test">Special Deals</h3>
        </div>
        <div class="row">
            <div id="carouselExampleAutoplaying" class="carousel slide pointer-event" data-bs-ride="carousel">
                <div class="carousel-inner rounded-3" style="height: 500px">
                    <?php $first = true; ?>
                    <?php foreach ($model->getAllProducts() as $product):
                        if (!empty($product['bannerPath'])): ?>
                            <div class="carousel-item <?= $first ? 'active' : '' ?>">
                                <a href="/product?product_id=<?= htmlspecialchars($product['product_id']) ?>">
                                    <img src="<?= htmlspecialchars($product['bannerPath']) ?>" alt="<?= htmlspecialchars($product['productName']) ?>" class="img-fluid">
                                </a>
                            </div>
                    <?php
                    $first = false;
                    endif;
                    endforeach;
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>
    </div>
</section>
<section class="p-5">
    <div class="container-fluid w-75">
        <div class="row">
            <h3>Recommended games</h3>
        </div>
        <div class="row d-flex flex-wrap">
            <?php foreach ($model->getAllProducts() as $product) : ?>
                <div class="col-md-6 col-lg-4 col-xl-2 d-flex">
                    <a href="/product?product_id=<?= $product['product_id'] ?>" class="text-decoration-none w-100 d-flex flex-column">
                        <div class="card bg-dark mt-5 d-flex flex-column flex-grow-1">
                            <div class="ratio ratio-1x1">
                                <img src="<?= $product['imagePath'] ?>" alt="<?= $product['productName'] ?>" class="img-fluid rounded-top-3 object-fit-cover">
                            </div>
                            <div class="card-body d-flex flex-column justify-content-between flex-grow-1">
                                <p class="card-text text-center fs-5 text-white"><?= $product['productName'] ?></p>
                                <hr>
                                <p class="card-text fs-5 text-center text-white">&euro;<?= $product['price'] ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section><!-- Start: Contact Details -->