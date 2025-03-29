<?php
/** @var yii\web\View $this */


$this->registerJs(<<<JS
function redirect() {
  document.location.href = '$url';
}
setTimeout(redirect, 5000);
JS
);
?>

<div class="site-login">
    <?php if(Yii::$app->response->statusCode < 300): ?>
        <h1>Переход по ссылке</h1>
        <p>
            Через 5 секунд Вы будете переадресованы на
            вашу ссылку.
        </p>
    <?php else: ?>
        <h1>404 Ссылка не найдена</h1>
        <p>
            Через 5 секунд Вы будете переадресованы на
            главную страницу.
        </p>
    <?php endif; ?>
    <p>
        Если переадресация не произошла Вы можете перейти на неё вручную.
        <code><a href="<?= $url; ?>"><?= $url; ?></a></code>.
    </p>
</div>

