<?php
/** @var \yii\web\View $this */
/** @var string $content */
$this->registerJsFile('/js/app.js', ['position' => $this::POS_END, 'depends' => '\yii\bootstrap\BootstrapPluginAsset']);
?><html>
<?php $this->beginPage(); ?>
<head><?php $this->head() ?></head>
<body>
<?php $this->beginBody() ?>
<?=$content?>
<?php $this->endBody() ?>
</body>
<?php $this->endPage() ?>
</html>
