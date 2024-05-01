<?php

use app\models\HomeProducts;

/** @var $model HomeProducts */
?>

<main>
    <div class="container py-5">
        <div class="row">
            <!-- First Column -->
            <div class="col-md-8">
                <div class="container-fluid bg-dark p-5 rounded">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <div class="ratio ratio-4x3">
                                                <img src="<?= $model->imagePath ?>" alt="" class="img-fluid rounded-top-3 object-fit-cover">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <h5>Description</h5>
                                            <p><?= $model->description ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Column -->
            <div class="col-md-4">
                <div class="container-fluid bg-dark p-5 rounded">
                    <div class="row">
                        <div class="col-12 row-6">
                            <div class="card p-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="card-text text-center fs-2 font-weight-bold"><?= $model->productName ?></p>
                                    <hr>
                                    <p class="card-text text-center fs-1">&euro;<?= $model->price ?></p>
                                    <div class="d-flex justify-content-center">
                                        <a href="/addtocart?product_id=<?= $model->product_id ?>" class="btn btn-primary rounded-1">Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>