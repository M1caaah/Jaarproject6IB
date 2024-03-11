<?php

use app\models\DashUsers;
/** @var $model DashUsers */

?>

<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="my-3">
            <h4>Manage users</h4>
        </div>
        <div class="row">
            <?php foreach($model->select(['*'], "active = 1 AND r.role_id = c.role_id") as $user): ?>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="card border-0">
                        <div class="card-body">
                            <h5 class="card-title"><?= $user['firstname'].' '.$user['lastname'] ?></h5>
                            <div class="row">
                                <div class="col-12">
                                    <p class="card-text text-muted">Email: <?= $user['email'] ?></p>
                                </div>
                                <div class="col-12">
                                    <p class="card-text text-muted">Role: <?= $user['roleName'] ?> </p>
                                </div>
                                <div class="col-12">
                                    <p class="card-text text-muted">Registration date: <?= $user['regDate'] ?> </p>
                                </div>
                            </div>
                            <div class="dropdown mt-3">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">Menu</button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="users/edit?client_id=<?= $user['client_id'] ?>">Edit User</a></li>
                                    <li><a class="dropdown-item" href="users/delete?client_id=<?= $user['client_id'] ?>">Delete User</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>