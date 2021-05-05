<?php

use yii\helpers\Html;
?>
<aside class="main-sidebar main-sidebar-custom sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= \yii\helpers\Url::home() ?>" class="brand-link">
        <img src="<?= $assetDir ?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= Yii::$app->request->baseUrl . "/web/upload/" . Yii::$app->user->identity->foto ?>" class="img-circle elevation-2">
            </div>
            <div class="info">
                <a href="login/profile?id=<?= Yii::$app->user->identity->id ?>" class="d-block"><?= Yii::$app->user->identity->nama ?></a>
            </div>
        </div>

        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <?php

            use backend\models\MenuNavigasi;
            use backend\models\MenuNavigasiRole;

            $hakakses = MenuNavigasiRole::find()->where(["in", "id_system_role", Yii::$app->session->get('user_role_id')])->asArray()->all();

            $menu = MenuNavigasi::find()->where(["id_parent" => 0, "status" => 1])
                ->andWhere(["in", "id_menu", $hakakses])
                ->orderBy("no_urut")->all();
            $strMenu = array();

            foreach ($menu as $data) {
                $menu2 = MenuNavigasi::find()->where(["id_parent" => $data->id_menu, "status" => 1])
                    ->andWhere(["in", "id_menu", $hakakses])
                    ->orderBy("no_urut")->all();
                if ($menu2) {
                    //echo "1";
                    $c = 0;
                    $items = array();
                    foreach ($menu2 as $data2) {
                        array_push($items, array(
                            'label' => $data2->nama_menu,
                            'iconStyle' => 'far',
                            'url' => Yii::$app->request->baseUrl . '/' . $data2->url,
                            'active' => $a = (Yii::$app->controller->id == $data2->url) ? true : false
                        ));
                    }
                    array_push($strMenu, array(
                        'label' => $data->nama_menu,
                        'icon' => $data->icon,
                        'items'    => $items,
                    ));
                } else {
                    array_push($strMenu, array(
                        'label' => $data->nama_menu,
                        'icon' => $data->icon,
                        'url' => Yii::$app->request->baseUrl . '/' . $data->url,
                        'active' => (Yii::$app->controller->id == $data->url) ? true : false
                    ));
                }
            }
            echo \hail812\adminlte3\widgets\Menu::widget([
                'items' => $strMenu,
                'options' => [
                    'class' => 'nav nav-pills nav-sidebar flex-column nav-child-indent',
                    'data-widget' => 'treeview',
                    'role' => 'menu',
                    'data-accordion' => 'false'
                ]
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->

    </div>
    <div class="sidebar-custom">
        <a href="#" class="btn btn-link"><i class="fas fa-cogs"></i></a>
        <?= Html::a(
            '<i class="fas fa-sign-out-alt"></i>',
            ['/site/logout'],
            ['data-method' => 'post', 'class' => 'btn text-danger hide-on-collapse pos-right']
        ) ?>
        <!-- <a href="#" class="btn text-danger pos-right">
            <i class="fas fa-sign-out-alt"></i>
        </a> -->
    </div>
</aside>