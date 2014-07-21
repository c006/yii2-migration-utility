/**
 * Created by user on 7/19/14.
 */


jQuery(function () {
    jQuery('#migrationutility-databasetables').bind('change',
        function () {
            var val = jQuery(this).find('option:selected').text();
            if (val) {
                var $elm = jQuery('#migrationutility-tables');
                var val2 = $elm.val().replace(val + ',', '');
                val = val2 + ',' + val;
                val = val.replace(/,+/gi, ',').replace(/\s+/gi, '').replace(/^,/,'');
                $elm.val(val);
            }
        });
});