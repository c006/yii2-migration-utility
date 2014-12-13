<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


/** @var $model c006\utility\migration\models\MigrationUtility */
/** @var $output String */
/** @var $tables Array */
?>

<?php $form = ActiveForm::begin([
                                    'id' => 'form-submit',
                                ]
);
?>

<?php /* This is optional if SubmitSpinner is installed */ ?>
<?php if (class_exists('c006\\spinner\\SubmitSpinner')) : ?>
    <?= c006\spinner\SubmitSpinner::widget(
        [
            'form_id'                => $form->id,
            'bg_color'               => '#444444',
            'bg_opacity'             => 0.8,
            'spin_speed'             => 3.5,
            'radius'                 => 200,
            'bg_spinner_opacity'     => 0.0,
            'bg_spinner_color'       => '#000000',
            'sections'               => 10,
            'section_size'           => 30,
            'section_color'          => '#FFFFFF',
            'section_offset'         => 80,
            'section_opacity_base'   => 0.05,
            'proportionate_increase' => 0.9,
        ]);
    ?>
<?php endif ?>


<div style="margin-top: 20px;">
    <?= $form->field($model, 'databaseType')->checkboxList(['mysql' => 'mysql', 'mssql' => 'mssql', 'pgsql' => 'pgsql', 'sqlite' => 'sqlite']) ?>
</div>
<div style="margin-top: 20px;">
    <?= $form->field($model, 'databaseTables')->dropDownList(['00' => ' '] + $tables) ?>
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
        <?= Html::submitButton('Run', ['class' => 'btn btn-primary', 'name' => 'button-submit']) ?>
    </div>
</div>

<?php ActiveForm::end() ?>


<?php if ($output) : ?>
    <div style="display: block; position: relative;">
        <pre style="float: left; margin-top: 20px;"><?= $output ?></pre>
    </div>
<?php endif ?>
