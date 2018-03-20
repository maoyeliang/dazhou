<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => '菜单', 'options' => ['class' => 'header']],
                    [
                        'label' => '我的场馆',
                        'icon' => 'file-code-o',
                        'url' => '#',
                        'items' => [
                            ['label' => '场地管理', 'icon' => 'file-code-o', 'url' => ['/fields']],
                            ['label' => '场地信息', 'icon' => 'file-code-o', 'url' => ['/fields/info']],
                    ]

                    ],
                    ['label' => '订单中心', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => '财务中心', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => '场馆管理（admin）', 'icon' => 'file-code-o', 'url' => ['/stadiums']],
                    ['label' => '用户管理（admin）', 'icon' => 'file-code-o', 'url' => ['/admin']],
                    ['label' => '订单中心（admin）', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => '会员中心（admin）', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => '权限分配（admin）', 'icon' => 'file-code-o', 'url' => ['/admins']],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
