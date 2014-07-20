<?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;

    /** @var $model c006\utility\migration\models\MigrationUtility */
    /** @var $output String */
    /** @var $tables Array */
?>

<?php $form = ActiveForm::begin([
        'id' => 'table-form',
    ]
);
?>

    <div>Select a table</div>

    <select name="table_select" id="table_select">
        <option value="">Select</option>
        <?php foreach ($tables as $table) : ?>
            <option value="<?= $table ?>"><?= $table ?></option>
        <?php endforeach ?>
    </select>
    <div style="margin-top: 20px;">
        <?= $form->field($model, 'tables') ?>
    </div>
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