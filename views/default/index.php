<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/** @var $model c006\utility\migration\models\MigrationUtility */
/** @var $output String */
/** @var $output_drop String */
/** @var $tables Array */

$array = ['CASCADE' => 'CASCADE', 'NO ACTION' => 'NO ACTION', 'RESTRICT' => 'RESTRICT', 'SET NULL' => 'SET NULL'];
?>

<style>
    .title {
        display    : block;
        font-size  : 2em;
        margin-top : 20px;
        color      : #e7ad24;
    }

    label[for=migrationutility-databasetables] {
        display : block;
    }

    .inline-elements {
        display : table;
        width   : 100%;
    }

    .inline-elements > div {
        display        : table-cell;
        vertical-align : top;
    }

    .inline-elements > div:first-of-type {
        width : 30%;
    }

    .inline-elements > div:last-of-type {
        width : 70%;
    }

    .inline-elements select {
        min-width : 100%;
    }

    .inline-elements input {
        min-width : 100%;
    }

    .button-style {
        display               : inline-block;
        padding               : 2px 10px;
        margin                : 0;
        margin-left           : 20px;

        font-size             : 0.9em;
        font-weight           : normal;

        background-color      : rgba(155, 202, 242, 0.56);
        -webkit-border-radius : 5px;
        -moz-border-radius    : 5px;
        border-radius         : 5px;

        cursor                : pointer;
    }

</style>

<div class="form">
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
            <?= Html::button('Add All Tables', ['class' => 'btn btn-success', 'id' => 'button-add-all']) ?>
        </div>
    </div>

    <div class="inline-elements">
        <div style="width: 80%">
            <?= $form->field($model, 'tables')
                ->label('Tables to Process')
                ->hint('Change to textarea and back to easily view tables') ?>
        </div>
        <div style="width: 20%; vertical-align: middle; text-align: right">
            <?= Html::button('Change View', ['class' => 'btn btn-success', 'id' => 'button-tables-convert']) ?>
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


<?php /* This is optional if SubmitSpinner is installed */ ?>
<?php if (class_exists('c006\\spinner\\SubmitSpinner')) : ?>
    <?= c006\spinner\SubmitSpinner::widget(['form_id' => $form->id,]);
    ?>
<?php endif ?>



<?php if ($output) : ?>
    <div class="title" style="margin-top:10px; padding-top: 10px; border-top: 1px dotted #CCCCCC"">Up()
    <?= Html::button('Select All Text', ['class' => 'btn btn-success', 'id' => 'button-select-all']) ?>
    </div>
    <div style="display: block; position: relative;">
        <pre id="code-output" style="margin-top: 20px;"><?= $output ?></pre>
    </div>

    <div class="title" style="margin-top:10px; padding-top: 10px; border-top: 1px dotted #CCCCCC">Down()
    <?= Html::button('Select All Text', ['class' => 'btn btn-success', 'id' => 'button-select-all-drop']) ?>
    </div>
    <div style="display: block; position: relative;">
        <pre id="code-output-drop" style="margin-top: 20px;"><?= $output_drop ?></pre>
    </div>

<?php endif ?>


<script type="text/javascript">
    jQuery(function () {

        jQuery.fn.selectText = function () {
            this.find('input').each(function () {
                if ($(this).prev().length == 0 || !$(this).prev().hasClass('p_copy')) {
                    $('<p class="p_copy" style="position: absolute; z-index: -1;"></p>').insertBefore($(this));
                }
                $(this).prev().html($(this).val());
            });
            var doc = document;
            var element = this[0];
            console.log(this, element);
            if (doc.body.createTextRange) {
                var range = document.body.createTextRange();
                range.moveToElementText(element);
                range.select();
            } else if (window.getSelection) {
                var selection = window.getSelection();
                var range = document.createRange();
                range.selectNodeContents(element);
                selection.removeAllRanges();
                selection.addRange(range);
            }
        };

        jQuery('#button-add-all')
            .click(function () {
                var $tables = jQuery('#migrationutility-tables');
                $tables.val("");
                jQuery("#migrationutility-databasetables > option")
                    .each(function () {
                        if (this.text != 'migration') {
                            $tables.val($tables.val() + ',' + this.text);
                        }
                    });
                $tables.val($tables.val().replace(/^,+/, ''));
            });
        jQuery('#button-select-all')
            .click(function () {
                jQuery('#code-output').selectText();
            });
        jQuery('#button-select-all-drop')
            .click(function () {
                jQuery('#code-output-drop').selectText();
            });
        jQuery('#button-tables-convert')
            .click(function () {
                var $this = jQuery('#migrationutility-tables');
                var $parent = $this.parent();
                if ($this.attr('type') == "text") {
                    var $textarea = jQuery(document.createElement('textarea'));
                    $textarea.attr('id', $this.attr('id'));
                    $textarea.attr('type', 'textarea');
                    $textarea.attr('class', $this.attr('class'));
                    $textarea.attr('name', $this.attr('name'));
                    $textarea.html($this.val().replace(/\s+/g, '').replace(/,/g, "\n"));
                    $this.remove();
                    jQuery($textarea).insertAfter($parent.find('> label'));
                } else {
                    var $input = jQuery(document.createElement('input'));
                    $input.attr('id', $this.attr('id'));
                    $input.attr('type', 'text');
                    $input.attr('class', $this.attr('class'));
                    $input.attr('name', $this.attr('name'));
                    $input.val($this.html().replace(/[\r\n]/g, ", "));
                    $this.remove();
                    jQuery($input).insertAfter($parent.find('> label'));
                }
                jQuery('#migrationutility-tables').blur();
            });
    });
</script>