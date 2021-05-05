<?php

use yii\helpers\Html;

$this->title = 'Login';
?>
<!-- Main Content -->
<div id="app">
    <section>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 bg-white d-flex" style="height: 100vh;">
                <div class="container col-lg-8 col-md-8 col-sm-8 col-xs-8 col-8 justify-content-center align-self-center">

                    <h1 class="d-flex justify-content-center login-title">Login Now</h1>
                    <br>

                    <?php $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'login-form']) ?>

                    <?= $form->field($model, 'username', [
                        'options' => ['class' => 'form-group has-feedback'],
                        'inputTemplate' => '{input}',
                        'template' => '{beginWrapper}{input}{error}{endWrapper}',
                        'wrapperOptions' => ['class' => 'mb-3']
                    ])
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('username') . " atau Email"]) ?>

                    <?= $form->field($model, 'password', [
                        'options' => ['class' => 'form-group has-feedback'],
                        'inputTemplate' => '{input}',
                        'template' => '{beginWrapper}{input}{error}{endWrapper}',
                        'wrapperOptions' => ['class' => 'mb-3']
                    ])->label(false)->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

                    <div class="row">
                        <div class="col-12">
                            <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary btn-block form-group']) ?>
                        </div>
                    </div>

                    <?php \yii\bootstrap4\ActiveForm::end(); ?>
                    <br>
                    <br>
                    <?= ''
                    //yii\authclient\widgets\AuthChoice::widget([
                    //  'baseAuthUrl' => ['site/auth']
                    //]) 
                    ?>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 bg-login overlay-gradient-bottom d-none d-lg-flex d-md-flex d-sm-none align-items-baseline" data-background="https://embed-ssl.wistia.com/deliveries/944f2eb42a668fac3cf14323545754ce.jpg?image_crop_resized=640x360" style="background-size: cover;">
                <div class="text-light p-5 mt-auto" style="z-index: 0;">
                    <div class="mb-5 pb-3">
                        <h1 class="mb-2 display-4 font-weight-bold text-white">Selamat Datang!</h1>
                        <h5 class="font-weight-normal text-muted-transparent text-white">Silahkan login untuk
                            masuk ke
                            halaman admin.</h5>
                    </div>
                    Made with <span class="text-danger"> ❤</span> by <a class="text-light bb" target="_blank" href="https://dicky54putra.github.io/">Dicky Saputra</a> - Image by <a class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a>
                </div>
            </div>
        </div>
    </section>
</div>