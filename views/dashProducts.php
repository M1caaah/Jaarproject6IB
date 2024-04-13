<?php

use app\models\DashAddUsers;
/** @var $model DashAddUsers */

?>

<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="my-3">
            <h4>Manage products</h4>
        </div>
        <div class="row">
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="card border-0">
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <div class="row">
                                <div class="col-12">
                                    <p class="card-text text-muted">Email: </p>
                                </div>
                                <div class="col-12">
                                    <p class="card-text text-muted">Role:  </p>
                                </div>
                                <div class="col-12">
                                    <p class="card-text text-muted">Registration date:  </p>
                                </div>
                            </div>
                            <div class="dropdown mt-3">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">Menu</button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="users/edit?client_id=">Edit User</a></li>
                                    <li><a class="dropdown-item" href="users/delete?client_id=">Delete User</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</main>