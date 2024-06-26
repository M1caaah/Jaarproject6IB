<?php

use app\models\DashAddUsers;
/** @var $model DashAddUsers */

?>

<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="my-3">
            <h4>Manage products</h4>
        </div>
        <?php $active = $model->active ? 'inactive' : 'active'; ?>
        <div class="my-3">
            <a href="/dashboard/products?active=<?= $model->active ? 0 : 1 ?>" class="btn btn-primary">View <?= $active ?> products</a>
        </div>
        <div class="row">
            <?php if ($model->active): ?>
            <?php foreach ($model->select(['*'], where: 'active = 1') as $product): ?>
                <div class="col-md-6 col-lg-4 col-xl-2">
                    <div class="card border-0">
                        <div class="ratio ratio-1x1">
                            <img src="<?= $product['imagePath'] ?>" alt="" class="img-fluid rounded-top-3 object-fit-cover">
                        </div>
                        <div class="card-body">
                            <div class="row fs-5">
                                <div class="col-12">
                                    <p class="card-text text-muted"><?= $product['productName'] ?></p>
                                </div>
                                <div class="col-12">
                                    <p class="card-text text-muted">&euro;<?= $product['price'] ?></p>
                                </div>
                            </div>
                            <div class="dropdown mt-3">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">Menu</button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="products/edit?product_id=<?= $product['product_id'] ?>">Edit Product</a></li>
                                    <li><a class="dropdown-item" href="products/delete?product_id=<?= $product['product_id'] ?>">Delete Product</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php else: ?>
            <?php foreach ($model->select(['*'], where: 'active = 0', checkActive: false) as $product): ?>
                <div class="col-md-6 col-lg-4 col-xl-2">
                    <div class="card border-0">
                        <div class="ratio ratio-1x1">
                            <img src="<?= $product['imagePath'] ?>" alt="" class="img-fluid rounded-top-3 object-fit-cover">
                        </div>
                        <div class="card-body">
                            <div class="row fs-5">
                                <div class="col-12">
                                    <p class="card-text text-muted"><?= $product['productName'] ?></p>
                                </div>
                                <div class="col-12">
                                    <p class="card-text text-muted">&euro;<?= $product['price'] ?></p>
                                </div>
                            </div>
                            <a href="/dashboard/products/activate?product_id=<?= $product['product_id'] ?>" class="btn btn-primary">Activate product</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</main>