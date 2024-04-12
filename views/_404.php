<?php
use app\core\Application;
?>

<div class="container d-flex justify-content-center align-items-center flex-column " style="height: calc(100vh - 247px">
    <h1>404 - Page not found</h1>
    <p>Sorry, the page you are looking for does not exist.</p>
    <?= Application::$app->request->getPath() ?>
</div>
