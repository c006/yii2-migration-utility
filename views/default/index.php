<?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;

    /** @var $model c006\utility\migration\models\MigrationUtility */
    /** @var $output String */
?>

<?php $form = ActiveForm::begin([
        'id' => 'table-form',
    ]
);
?>
    <div>Comma delimited list of tables</div>
<?= $form->field($model, 'tables') ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Run', [ 'class' => 'btn btn-primary', 'name' => 'button-submit' ]) ?>
        </div>
    </div>

<?php ActiveForm::end() ?>

<?php if ( $output ) : ?>
    <div style="display: block; position: relative;">
        <pre style="float: left; margin-top: 20px;"><?= $output ?></pre>
    </div>
<?php endif ?>