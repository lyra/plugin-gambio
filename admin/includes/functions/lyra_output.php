<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra Collect plugin for Gambio. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
 */

/**
 * General functions to draw configuration parameters.
 */
global $lyra_supported_languages, $lyra_supported_cards;

// Load gateway payment API.
$lyra_supported_languages = LyraApi::getSupportedLanguages();
$lyra_supported_cards = LyraApi::getSupportedCardTypes();

function lyra_output_string($string)
{
    return htmlspecialchars($string, ENT_COMPAT | ENT_HTML401, 'UTF-8');
}

function lyra_get_bool_title($value)
{
    $key = 'MODULE_PAYMENT_LYRA_VALUE_' . $value;

    if (defined($key)) {
        return constant($key);
    }

    return $value;
}

function lyra_get_lang_title($value)
{
    global $lyra_supported_languages;

    $key = 'MODULE_PAYMENT_LYRA_LANGUAGE_' . strtoupper($lyra_supported_languages[$value]);

    if (defined($key)) {
        return constant($key);
    }

    return $value;
}

function lyra_get_multi_lang_title($value)
{
    if (! empty($value)) {
        $langs = explode(';', $value);

        $result = array();
        foreach ($langs as $lang) {
            $result[] = lyra_get_lang_title($lang);
        }

        return implode(', ', $result);
    }

    return '';
}

function lyra_get_validation_mode_title($value)
{
    $key = 'MODULE_PAYMENT_LYRA_VALIDATION_' . $value;

    if (defined($key)) {
        return constant($key);
    }

    return MODULE_PAYMENT_LYRA_VALIDATION_DEFAULT;
}

function lyra_get_card_title($value)
{
    global $lyra_supported_cards;

    if (! empty($value)) {
        $cards = explode(';', $value);

        $result = array();
        foreach ($cards as $card) {
            $result[] = $lyra_supported_cards[$card];
        }

        return implode(', ', $result);
    }

    return '';
}

function lyra_get_multi_options($value)
{
    if (! $value) {
        return '';
    }

    $options = json_decode($value, true);
    if (! is_array($options) || ! count($options)) {
        return '';
    }

    $field = '<div style="overflow-x: visible; width: 194px;"><table class="infoBoxContent">';
    $field .= '<thead><tr>';
    $field .= '<th style="padding: 0 5px;">' . MODULE_PAYMENT_LYRA_MULTI_OPTIONS_LABEL . '</th>';
    $field .= '<th style="padding: 0 5px;">' . MODULE_PAYMENT_LYRA_MULTI_OPTIONS_MIN_AMOUNT . '</th>';
    $field .= '<th style="padding: 0 5px;">' . MODULE_PAYMENT_LYRA_MULTI_OPTIONS_MAX_AMOUNT . '</th>';
    $field .= '<th style="padding: 0 5px;">' . MODULE_PAYMENT_LYRA_MULTI_OPTIONS_CONTRACT . '</th>';
    $field .= '<th style="padding: 0 5px;">' . MODULE_PAYMENT_LYRA_MULTI_OPTIONS_COUNT . '</th>';
    $field .= '<th style="padding: 0 5px;">' . MODULE_PAYMENT_LYRA_MULTI_OPTIONS_PERIOD . '</th>';
    $field .= '<th style="padding: 0 5px;">' . MODULE_PAYMENT_LYRA_MULTI_OPTIONS_FIRST . '</th>';
    $field .= '</tr></thead>';

    $field .= '<tbody>';
    foreach ($options as $option) {
        $field .= '<tr>';
        $field .= '<td style="padding: 0 5px;">' . $option['label'] . '</td>';
        $field .= '<td style="padding: 0 5px;">' . $option['min_amount'] . '</td>';
        $field .= '<td style="padding: 0 5px;">' . $option['max_amount'] . '</td>';
        $field .= '<td style="padding: 0 5px;">' . $option['contract'] . '</td>';
        $field .= '<td style="padding: 0 5px;">' . $option['count'] . '</td>';
        $field .= '<td style="padding: 0 5px;">' . $option['period'] . '</td>';
        $field .= '<td style="padding: 0 5px;">' . $option['first'] . '</td>';
        $field .= '</tr>';
    }

    $field .= '</tbody></table><div>';

    return $field;
}

function lyra_cfg_draw_pull_down_bools($value = '', $name)
{
    $name = 'configuration[' . lyra_output_string($name) . ']';
    if (empty($value) && isset($GLOBALS[$name])) {
        $value = stripslashes($GLOBALS[$name]);
    }

    $bools = array('True', 'False');

    $field = '<br>';
    foreach ($bools as $bool) {
        $field .= '<input type="radio" name="' . $name . '" value="' . $bool . '"';
        if ($value === $bool) {
            $field .= ' checked="checked"';
        }

        $field .= '> ' . lyra_output_string(lyra_get_bool_title($bool)) . '<br />';
    }

    return $field;
}

function lyra_cfg_draw_pull_down_sign_algos($value = '', $name)
{
    $name = 'configuration[' . lyra_output_string($name) . ']';

    if (empty($value) && isset($GLOBALS[$name])) {
        $value = stripslashes($GLOBALS[$name]);
    }

    if (lyra_tools::$lyra_plugin_features['shatwoonly']) {
        $algos = array(
            'SHA-256' => 'HMAC-SHA-256'
        );
    } else {
        $algos = array(
            'SHA-1' => 'SHA-1',
            'SHA-256' => 'HMAC-SHA-256'
        );
    }

    $field = '<select name="' . $name . '">';
    foreach ($algos as $code => $algo) {
        $field .= '<option value="' . $code . '"';
        if ($value === $code) {
            $field .= ' selected="selected"';
        }

        $field .= '>' . lyra_output_string($algo) . '</option>';
    }

    $field .= '</select>';

    return $field;
}

function lyra_get_sign_algo_title($value)
{
    $algos = array(
        'SHA-1' => 'SHA-1',
        'SHA-256' => 'HMAC-SHA-256'
    );

    return $algos[$value];
}

function lyra_cfg_draw_pull_down_validation_modes($value = '', $name)
{
    $name = 'configuration[' . lyra_output_string($name) . ']';

    if (empty($value) && isset($GLOBALS[$name])) $value = stripslashes($GLOBALS[$name]);
    $modes = array('', '0', '1');

    $field = '<select name="' . $name . '">';
    foreach ($modes as $mode) {
        $field .= '<option value="' . $mode . '"';
        if ($value === $mode) {
            $field .= ' selected="selected"';
        }

        $field .= '>' . lyra_output_string(lyra_get_validation_mode_title($mode)) . '</option>';
    }

    $field .= '</select>';

    return $field;
}

function lyra_cfg_draw_pull_down_langs($value = '', $name)
{
    global $lyra_supported_languages;

    $name = 'configuration[' . lyra_output_string($name) . ']';
    if (empty($value) && isset($GLOBALS[$name])) {
        $value = stripslashes($GLOBALS[$name]);
    }

    $field = '<select name="' . $name . '">';
    foreach (array_keys($lyra_supported_languages) as $key) {
        $field .= '<option value="' . $key . '"';
        if ($value === $key) {
            $field .= ' selected="selected"';
        }

        $field .= '>' . lyra_output_string(lyra_get_lang_title($key)) . '</option>';
    }

    $field .= '</select>';

    return $field;
}

function lyra_cfg_draw_pull_down_multi_langs($value = '', $name)
{
    global $lyra_supported_languages;

    $fieldName = 'configuration[' . lyra_output_string($name) . ']';
    if (empty($value) && isset($GLOBALS[$fieldName])) {
        $value = stripslashes($GLOBALS[$fieldName]);
    }

    $langs = empty($value) ? array() : explode(';', $value);

    $field = '<select style="height: initial;" size="5" name="' . lyra_output_string($name) . '" multiple="multiple" onChange="JavaScript:lyraProcessLangs()">';
    foreach (array_keys($lyra_supported_languages) as $key) {
        $field .= '<option value="' . $key . '"';
        if (in_array($key, $langs)) {
            $field .= ' selected="selected"';
        }

        $field .= '>' . lyra_output_string(lyra_get_lang_title($key)) . '</option>';
    }

    $field .= '</select> <br />';

    $field .= <<<JSCODE
    <script type="text/javascript">
        function lyraProcessLangs()
        {
            var elt = document.forms['configuration-box-form'].elements['$name'];

            var result = '';
            for (var i=0; i < elt.length; i++) {
                if (elt[i].selected) {
                    if (result !== '') result += ';';

                     result += elt[i].value;
                }
             }

             document.forms['configuration-box-form'].elements['$fieldName'].value = result;
        }
    </script>
JSCODE;

    $field .= '<input type="hidden" name="' . lyra_output_string($fieldName) . '" value="' . $value . '">';

    return $field;
}

function lyra_cfg_draw_pull_down_cards($value = '', $name)
{
    global $lyra_supported_cards;

    $fieldName = 'configuration[' . lyra_output_string($name) . ']';
    if (empty($value) && isset($GLOBALS[$fieldName])) {
        $value = stripslashes($GLOBALS[$fieldName]);
    }

    $cards = empty($value) ? array() : explode(';', $value);

    if (lyra_output_string($name) === 'MODULE_PAYMENT_LYRA_MULTI_PAYMENT_CARDS') {
        $lyra_supported_cards = lyra_tools::getSupportedMultiCardTypes();
    }

    $field = '<select style="height: initial;" size="5" name="' . lyra_output_string($name) . '" multiple="multiple" onChange="JavaScript:lyraProcessCards()">';
    foreach ($lyra_supported_cards as $key => $label) {
        $field .= '<option value="' . $key . '"';
        if (in_array($key, $cards)) {
            $field .= ' selected="selected"';
        }

        $field .= '>' . lyra_output_string($label) . '</option>';
    }

    $field .= '</select> <br />';

    $field .= <<<JSCODE
    <script type="text/javascript">
        function lyraProcessCards()
        {
            var elt = document.forms['configuration-box-form'].elements['$name'];

            var result = '';
            for (var i = 0; i < elt.length; i++) {
                if (elt[i].selected) {
                    if (result !== '') result += ';';

                     result += elt[i].value;
                }
             }

             document.forms['configuration-box-form'].elements['$fieldName'].value = result;
        }
    </script>
JSCODE;

    $field .= '<input type="hidden" name="' . lyra_output_string($fieldName) . '" value="' . $value . '">';

    return $field;
}

function lyra_cfg_draw_table_multi_options($value = '', $name)
{
    $name = lyra_output_string($name);

    $fieldName = 'configuration[' . $name . ']';
    if (empty($value) && isset($GLOBALS[$fieldName])) {
        $value = $GLOBALS[$fieldName];
    }

    $value = stripslashes($value);

    $options = empty($value) ? array() : json_decode($value, true);

    $field = '<input id="' . $name . '_btn" class="' . $name . '_btn"' . (! empty($options) ? ' style="display: none;"' : '') . ' type="button" value="' . MODULE_PAYMENT_LYRA_MULTI_OPTIONS_ADD . '" />';
    $field .= '<div style="overflow-x: visible; width: 194px;"><table id="' . $name . '_table"' . (empty($options) ? ' style="display: none;"' : '') . ' class="infoBoxContent">';

    $field .= '<thead><tr>';
    $field .= '<th style="padding: 0 5px;" class="label">' . MODULE_PAYMENT_LYRA_MULTI_OPTIONS_LABEL . '</th>';
    $field .= '<th style="padding: 0 5px;" class="min_amount">' . MODULE_PAYMENT_LYRA_MULTI_OPTIONS_MIN_AMOUNT . '</th>';
    $field .= '<th style="padding: 0 5px;" class="max_amount">' . MODULE_PAYMENT_LYRA_MULTI_OPTIONS_MAX_AMOUNT . '</th>';
    $field .= '<th style="padding: 0 5px;" class="contract">' . MODULE_PAYMENT_LYRA_MULTI_OPTIONS_CONTRACT . '</th>';
    $field .= '<th style="padding: 0 5px;" class="count">' . MODULE_PAYMENT_LYRA_MULTI_OPTIONS_COUNT . '</th>';
    $field .= '<th style="padding: 0 5px;" class="period">' . MODULE_PAYMENT_LYRA_MULTI_OPTIONS_PERIOD . '</th>';
    $field .= '<th style="padding: 0 5px;" class="first">' . MODULE_PAYMENT_LYRA_MULTI_OPTIONS_FIRST . '</th>';
    $field .= '<th style="padding: 0 5px;"></th>';
    $field .= '</tr></thead>';

    $field .= '<tbody>';
    $field .= '<tr id="' . $name . '_add">
                  <td colspan="7"></td>
                <td style="padding: 0 5px;"><input style="margin: 0 0 2px 2px; min-width: unset;" class="' . $name . '_btn" type="button" value="' . MODULE_PAYMENT_LYRA_MULTI_OPTIONS_ADD . '" /></td>
              </tr>';
    $field .= '</tbody></table></div>';

    $field .= "\n" . '<script type="text/javascript">';

    $field .= "\n" . 'jQuery(".' . $name . '_btn").click(function() {
                        lyraAddOption("' . $name . '");
                     });';

    // Add already inserted lines.
    if (! empty($options)) {
        foreach ($options as $code => $option) {
            $field .= "\n" . 'lyraAddOption("' . $name . '", "' . $code . '", ' . json_encode($option) . ');' . "\n";
        }
    }

    $deleteTxt = MODULE_PAYMENT_LYRA_MULTI_OPTIONS_DELETE;

    $field .= <<<JSCODE
        var JSON = JSON || {};

        // Implement JSON.stringify serialization.
        JSON.stringify || function(obj) {
            var t = typeof (obj);
            if (t !== "object" || obj === null) {
                // Simple data type.
                if (t === "string") obj = '"' + obj + '"';
                return String(obj);
            } else {
                // Recurse array or object.
                var n, v, json = [], arr = (obj && obj.constructor === Array);

                for (n in obj) {
                    v = obj[n]; t = typeof(v);

                    if (t === "string") v = '"' + v + '"';
                    else if (t === "object" && v !== null) v = JSON.stringify(v);

                    json.push((arr ? "" : '"' + n + '":') + String(v));
                }

                return (arr ? "[" : "{") + String(json) + (arr ? "]" : "}");
            }
        };

        jQuery(document.forms['configuration-box-form']).submit(function(event) {
              var options = {};

            jQuery('#$name' + '_table tbody tr td input[type=text]').each(function() {
                  var name = jQuery(this).attr('name');
                  name = name.replace(/\]/g, '');

                  var keys = name.split('[');
                  keys.shift();

                  options = lyraFillArray(options, keys, jQuery(this).val());
            });

            document.forms['configuration-box-form'].elements['$fieldName'].value = JSON.stringify(options);
              return true;
        });

        function lyraFillArray(arr, keys, val)
        {
            if (keys.length > 0) {
                var key = keys[0];

                if (keys.length === 1) {
                    // It's a leaf, let's set the value.
                    arr[key] = val;
                } else {
                    keys.shift();

                    if (!arr[key]) {
                        arr[key] = {};
                    }
                    arr[key] = lyraFillArray(arr[key], keys, val);
                }
            }

            return arr;
        }

        function lyraAddOption(name, key, record)
        {
            if (jQuery('#' + name + '_table tbody tr').length === 1) {
                jQuery('#' + name + '_btn').css('display', 'none');
                jQuery('#' + name + '_table').css('display', '');
            }

            if (!key && !record) {
                // New line, generate key and use empty record.
                key = new Date().getTime();
                record = { label: "", min_amount: "", max_amount: "", contract: "", count: "", period: "", first: "" };
            }

            var inputPrefix = name + '[' + key + ']';

            var optionLine = '<tr id="' + name + '_line_' + key + '">';
            optionLine += '<td style="padding: 0 5px;"><input style="margin: 0 0 2px 2px; min-width: 100px;" name="' + inputPrefix + '[label]" type="text" value="' + record['label'] + '" /></td>';
            optionLine += '<td style="padding: 0 5px;"><input style="margin: 0 0 2px 2px; min-width: unset;" name="' + inputPrefix + '[min_amount]" type="text" value="' + record['min_amount'] + '" /></td>';
            optionLine += '<td style="padding: 0 5px;"><input style="margin: 0 0 2px 2px; min-width: unset;" name="' + inputPrefix + '[max_amount]" type="text" value="' + record['max_amount'] + '" /></td>';
            optionLine += '<td style="padding: 0 5px;"><input style="margin: 0 0 2px 2px; min-width: unset;" name="' + inputPrefix + '[contract]" type="text" value="' + record['contract'] + '" /></td>';
            optionLine += '<td style="padding: 0 5px;"><input style="margin: 0 0 2px 2px; min-width: unset;" name="' + inputPrefix + '[count]" type="text" value="' + record['count'] + '" /></td>';
            optionLine += '<td style="padding: 0 5px;"><input style="margin: 0 0 2px 2px; min-width: unset;" name="' + inputPrefix + '[period]" type="text" value="' + record['period'] + '" /></td>';
            optionLine += '<td style="padding: 0 5px;"><input style="margin: 0 0 2px 2px; min-width: unset;" name="' + inputPrefix + '[first]" type="text" value="' + record['first'] + '" /></td>';
            optionLine += '<td style="padding: 0 5px;"><input style="margin: 0 0 2px 2px; min-width: unset;" type="button" value="$deleteTxt" onclick="javascript: lyraDeleteOption(\'' + name + '\', \'' + key + '\');" /></td>';
            optionLine += '</tr>';

            jQuery(optionLine).insertBefore('#' + name + '_add');
        }

        function lyraDeleteOption(name, key)
        {
            jQuery('#' + name + '_line_' + key).remove();

            if (jQuery('#' + name + '_table tbody tr').length === 1) {
                jQuery('#' + name + '_btn').css('display', '');
                jQuery('#' + name + '_table').css('display', 'none');
            }
        }
    </script>
JSCODE;

    $field .= '<input type="hidden" name="' . $fieldName . '" value="' . $value . '">';

    return $field;
}
