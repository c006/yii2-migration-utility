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

    <div style="margin-top: 20px;">
        <?= $form->field($model, 'databaseType')->checkboxList([ 'mysql' => 'mysql', 'mssql' => 'mssql', 'pgsql' => 'pgsql', 'sqlite' => 'sqlite' ]) ?>
    </div>
    <div style="margin-top: 20px;">
        <?= $form->field($model, 'databaseTables')->dropDownList([ '00' => ' ' ] + $tables) ?>
    </div>


    <div style="margin-top: 20px;">
        <?= $form->field($model, 'tables') ?>
    </div>

    <div style="margin-top: 20px;">
        <?= $form->field($model, 'addIfThenStatements')->checkbox() ?>
    </div>
    <div style="margin-top: 20px;">
        <?= $form->field($model, 'tableOptions')->textInput() ?>
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
