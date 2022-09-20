<?php
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var $model c006\utility\migration\models\MigrationUtility */
/** @var $output String */
/** @var $output_drop String */
/** @var $tables Array */

$array = ['CASCADE' => 'CASCADE', 'NO ACTION' => 'NO ACTION', 'RESTRICT' => 'RESTRICT', 'SET NULL' => 'SET NULL'];
?>

<style>
    .title {
        display: inline-block;
        padding-right: 20px;
        font-size: 2em;
        margin-top: 20px;
        color: #e7ad24;
    }

    label[for=migrationutility-databasetables] {
        display: block;
    }

    .inline-elements {
        display: table;
        width: 100%;
    }

    .inline-elements > div {
        display: table-cell;
        vertical-align: top;
    }

    .inline-elements > div:first-of-type {
        width: 30%;
    }

    .inline-elements > div:last-of-type {
        width: 70%;
    }

    .inline-elements select {
        min-width: 100%;
    }

    .inline-elements input {
        min-width: 100%;
    }

    .button-style {
        display: inline-block;
        padding: 2px 10px;
        margin: 0;
        margin-left: 20px;

        font-size: 0.9em;
        font-weight: normal;

        background-color: rgba(155, 202, 242, 0.56);
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;

        cursor: pointer;
    }

    .output-text {
        padding: 10px;
        width: 100%;
        min-height: 200px;
    }

</style>

<div class="form">

    <div class="item-container margin-top-20 margin-bottom-20">

        <?php $form = ActiveForm::begin(['id' => 'form-submit',]); ?>

        <div class="inline-elements">
            <div>
                <?= $form->field($model, 'mysql')->dropDownList(['0' => 'No', '1' => 'Yes']) ?>
            </div>
            <div>
                <?= $form->field($model, 'mysql_options') ?>
            </div>
        </div>

        <div class="inline-elements">
            <div>
                <?= $form->field($model, 'mssql')->dropDownList(['0' => 'No', '1' => 'Yes']) ?>
            </div>
            <div>
                <?= $form->field($model, 'mssql_options') ?>
            </div>
        </div>

        <div class="inline-elements">
            <div>
                <?= $form->field($model, 'pgsql')->dropDownList(['0' => 'No', '1' => 'Yes']) ?>
            </div>
            <div>
                <?= $form->field($model, 'pgsql_options') ?>
            </div>
        </div>

        <div class="inline-elements">
            <div>
                <?= $form->field($model, 'sqlite')->dropDownList(['0' => 'No', '1' => 'Yes']) ?>
            </div>
            <div>
                <?= $form->field($model, 'sqlite_options') ?>
            </div>
        </div>

        <div class="inline-elements">
            <div style="width: 80%">
                <?= $form->field($model, 'databaseTables')->dropDownList(['00' => ' '] + $tables)->label('Tables') ?>
            </div>
            <div style="width: 20%; vertical-align: middle; text-align: right">
                <?= Html::button('Add All Tables', ['class' => 'btn btn-secondary', 'id' => 'button-add-all']) ?>
            </div>
        </div>

        <div class="inline-elements">
            <div style="width: 80%">
                <?= $form->field($model, 'tables')
                    ->label('Tables to Process')
                    ->hint('Change to textarea and back to easily view tables') ?>
            </div>
            <div style="width: 20%; vertical-align: middle; text-align: right">
                <?= Html::button('Change View', ['class' => 'btn btn-secondary', 'id' => 'button-tables-convert']) ?>
            </div>
        </div>


        <div class="inline-elements">
            <div style="width: 50%">
                <?= $form->field($model, 'ForeignKeyOnUpdate')->dropDownList($array)->hint('') ?>
            </div>
            <div style="width: 50%; vertical-align: middle; text-align: right">
                <?= $form->field($model, 'ForeignKeyOnDelete')->dropDownList($array)->hint('') ?>
            </div>
        </div>

        <?= $form->field($model, 'addTableInserts')->dropDownList(['0' => 'No', '1' => 'Yes'])->hint('Add table data to migration') ?>


        <div class="form-group">
            <?= Html::submitButton('Run', ['class' => 'btn btn-primary', 'name' => 'button-submit', 'id' => 'button-submit']) ?>
        </div>

        <?php ActiveForm::end() ?>
    </div>
</div>


<?php /* This is optional if SubmitSpinner is installed */ ?>
<?php if (class_exists('c006\\spinner\\SubmitSpinner')) : ?>
    <?= c006\spinner\SubmitSpinner::widget(['form_id' => $form->id,]);
    ?>
<?php endif ?>

<?php if ($output) : ?>

    <div class="item-container margin-top-20 margin-bottom-20">

        <div style="margin-top:10px; padding-top: 10px; border-top: 1px dotted #CCCCCC"><span class="title">Up()</span>
            <?= Html::button('Select All Text', ['class' => 'btn btn-secondary', 'id' => 'button-select-all']) ?>
        </div>
        <div style="display: block; position: relative;">
            <textarea id="code-output" class="output-text form-control"> <?= $output ?></textarea>
        </div>

        <div style="margin-top:10px; padding-top: 10px; border-top: 1px dotted #CCCCCC"><span class="title">Down()</span>
            <?= Html::button('Select All Text', ['class' => 'btn btn-secondary', 'id' => 'button-select-all-drop']) ?>
        </div>
        <div style="display: block; position: relative;">
            <textarea id="code-output-drop" class="output-text form-control"> <?= $output_drop ?></textarea>
        </div>

    </div>

<?php endif ?>

