/**
 * Created by user on 7/19/14.
 */


jQuery(function () {
    jQuery('#table_select').bind('change',
        function () {
            var val = jQuery(this).val();
            if (val) {
                var $elm = jQuery('#migrationutility-tables');
                val = $elm.val() + ',' + val;
                val = val.replace(/^,/gi, '').replace(/\s+/gi, '');
                $elm.val(val);
            }
        });
});