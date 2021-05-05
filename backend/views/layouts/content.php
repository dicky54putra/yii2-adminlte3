<div class="content-wrapper">
    <div class="content">
        <div class="container">
            <div class="success" data-flashdata="<?= Yii::$app->session->getFlash('success') ?>"></div>
            <div class="error" data-flashdata="<?= Yii::$app->session->getFlash('error') ?>"></div>
            <?= $content ?>
        </div>
    </div>
</div>