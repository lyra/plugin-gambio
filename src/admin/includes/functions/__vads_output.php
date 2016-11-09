<?php 
/**
###COMMON_PHP_FILE_HEADER###
*/

/**
 * General functions to draw ###BANKNAME### configuration parameters.
 * */ 

global $__vads_supported_languages, $__vads_supported_cards;

// load ###BANKNAME### payment API
$__vadsApi = new __VadsApi('###CONTRIB_ENCODING###');

$__vads_supported_languages = $__vadsApi->getSupportedLanguages();
$__vads_supported_cards = $__vadsApi->getSupportedCardTypes();

function __vads_output_string($string) {
	return htmlspecialchars($string, ENT_COMPAT | ENT_HTML401, '###CONTRIB_ENCODING###');	
}

function __vads_get_bool_title($value) {
	$key = 'MODULE_PAYMENT___VADS_VALUE_' . $value;
	
	if(defined($key)) {
		return constant($key);
	} else {
		return $value;
	}	
}

function __vads_get_lang_title($value) {
	global $__vads_supported_languages;
	
	$key = 'MODULE_PAYMENT___VADS_LANGUAGE_' . strtoupper($__vads_supported_languages[$value]);
	
	if(defined($key)) {
		return constant($key);
	} else {
		return $value;
	}
}

function __vads_get_multi_lang_title($value) {
	if(!empty($value)) {
		$langs = explode(';', $value);
		
		$result = array();
		foreach ($langs as $lang) {
			$result[] = __vads_get_lang_title($lang);
		}
		
		return implode(', ', $result);
	} else {
		return '';
	}
}

function __vads_get_validation_mode_title($value) {
	$key = 'MODULE_PAYMENT___VADS_VALIDATION_' . $value;
	
	if(defined($key)) {
		return constant($key);
	} else {
		return MODULE_PAYMENT___VADS_VALIDATION_DEFAULT;
	}
}

function __vads_get_card_title($value) {
	global $__vads_supported_cards;
	
	if(!empty($value)) {
		$cards = explode(';', $value);
	
		$result = array();
		foreach ($cards as $card) {
			$result[] = $__vads_supported_cards[$card];
		}
	
		return implode(', ', $result);
	} else {
		return '';
	}
}

function __vads_get_multi_options($value) {
	if(!$value) {
		return '';
	}
	
	$options = json_decode($value, true);
	if(!is_array($options) || !count($options)) {
		return '';
	}
	
	$field = '<br /><table cellpadding="10" cellspacing="5" class="infoBoxContent">';
	$field .= '<thead><tr>';
	$field .= '<th style="padding: 0px;">' . MODULE_PAYMENT___VADS_MULTI_OPTIONS_LABEL . '</th>';
	$field .= '<th style="padding: 0px;">' . MODULE_PAYMENT___VADS_MULTI_OPTIONS_MIN_AMOUNT . '</th>';
	$field .= '<th style="padding: 0px;">' . MODULE_PAYMENT___VADS_MULTI_OPTIONS_MAX_AMOUNT . '</th>';
	$field .= '<th style="padding: 0px;">' . MODULE_PAYMENT___VADS_MULTI_OPTIONS_CONTRACT . '</th>';
	$field .= '<th style="padding: 0px;">' . MODULE_PAYMENT___VADS_MULTI_OPTIONS_COUNT . '</th>';
	$field .= '<th style="padding: 0px;">' . MODULE_PAYMENT___VADS_MULTI_OPTIONS_PERIOD . '</th>';
	$field .= '<th style="padding: 0px;">' . MODULE_PAYMENT___VADS_MULTI_OPTIONS_FIRST . '</th>';
	$field .= '</tr></thead>';
	
	$field .= '<tbody>';
	foreach ($options as $code => $option) {
		$field .= '<tr>';
		$field .= '<td style="padding: 0px;">' . $option['label'] . '</td>';
		$field .= '<td style="padding: 0px;">' . $option['min_amount'] . '</td>';
		$field .= '<td style="padding: 0px;">' . $option['max_amount'] . '</td>';
		$field .= '<td style="padding: 0px;">' . $option['contract'] . '</td>';
		$field .= '<td style="padding: 0px;">' . $option['count'] . '</td>';
		$field .= '<td style="padding: 0px;">' . $option['period'] . '</td>';
		$field .= '<td style="padding: 0px;">' . $option['first'] . '</td>';
		$field .= '</tr>';
	}	
	$field .= '</tbody></table>';
	
	return $field;
}

function __vads_cfg_draw_pull_down_bools($value='', $name) {
	$name = 'configuration[' . __vads_output_string($name) . ']';
	if (empty($value) && isset($GLOBALS[$name])) $value = stripslashes($GLOBALS[$name]);
	
	$bools = array('1', '0');
	
	$field = '';
	foreach ($bools as $bool) {
		$field .= '<input type="radio" name="' . $name . '" value="' . $bool . '"';
		if ($value == $bool) {
			$field .= ' checked="checked"';
		}
		
		$field .= '> ' . __vads_output_string(__vads_get_bool_title($bool)) . '<br />';
	}
	
	return $field;
}

function __vads_cfg_draw_pull_down_validation_modes($value='', $name) {
	$name = 'configuration[' . __vads_output_string($name) . ']';
	
	if (empty($value) && isset($GLOBALS[$name])) $value = stripslashes($GLOBALS[$name]);
	$modes = array('', '0', '1');
	
	$field = '<select name="' . $name . '">';
	foreach ($modes as $mode) {
		$field .= '<option value="' . $mode . '"';
		if ($value == $mode) {
			$field .= ' selected="selected"';
		}
		
		$field .= '>' . __vads_output_string(__vads_get_validation_mode_title($mode)) . '</option>';
	}

	$field .= '</select>';

	return $field;
}

function __vads_cfg_draw_pull_down_langs($value='', $name) {
	global $__vads_supported_languages;
	
	$name = 'configuration[' . __vads_output_string($name) . ']';
	if (empty($value) && isset($GLOBALS[$name])) $value = stripslashes($GLOBALS[$name]);
	
	$field = '<select name="' . $name . '">';
	foreach ($__vads_supported_languages as $key => $label) {
		$field .= '<option value="' . $key . '"';
		if ($value == $key) {
			$field .= ' selected="selected"';
		}
	
		$field .= '>' . __vads_output_string(__vads_get_lang_title($key)) . '</option>';
	}
	
	$field .= '</select>';
	
	return $field;
}

function __vads_cfg_draw_pull_down_multi_langs($value='', $name) {
	global $__vads_supported_languages;
	
	$fieldName = 'configuration[' . __vads_output_string($name) . ']';
	if (empty($value) && isset($GLOBALS[$fieldName])) $value = stripslashes($GLOBALS[$fieldName]);
	
	$langs = empty($value) ? array() : explode(';', $value);
	
	$field = '<select name="' . __vads_output_string($name) . '" multiple="multiple" onChange="JavaScript:__vadsProcessLangs()">';
	foreach ($__vads_supported_languages as $key => $label) {
		$field .= '<option value="' . $key . '"';
		if (in_array($key, $langs)) {
			$field .= ' selected="selected"';
		}
	
		$field .= '>' . __vads_output_string(__vads_get_lang_title($key)) . '</option>';
	}
	$field .= '</select> <br />';
	
	$field .= <<<JSCODE
	<script type="text/javascript">
		function __vadsProcessLangs() {
			var elt = document.forms['modules'].elements['$name'];
	
			var result = '';
			for (var i=0; i < elt.length; i++) {
            	if(elt[i].selected) {
            		if(result != '') result += ';';
            	
             		result += elt[i].value;
            	}
         	}
	
         	document.forms['modules'].elements['$fieldName'].value = result;
		}
	</script>
JSCODE;
	
	$field .= '<input type="hidden" name="' . __vads_output_string($fieldName) . '" value="' . $value . '">';
	
	return $field;
}

function __vads_cfg_draw_pull_down_cards($value='', $name) {
	global $__vads_supported_cards;

	$fieldName = 'configuration[' . __vads_output_string($name) . ']';
	if (empty($value) && isset($GLOBALS[$fieldName])) $value = stripslashes($GLOBALS[$fieldName]);

	$cards = empty($value) ? array() : explode(';', $value);

	$field = '<select name="' . __vads_output_string($name) . '" multiple="multiple" onChange="JavaScript:__vadsProcessCards()">';
	foreach ($__vads_supported_cards as $key => $label) {
		$field .= '<option value="' . $key . '"';
		if (in_array($key, $cards)) {
			$field .= ' selected="selected"';
		}

		$field .= '>' . __vads_output_string($label) . '</option>';
	}
	$field .= '</select> <br />';

	$field .= <<<JSCODE
	<script type="text/javascript">
		function __vadsProcessCards() {
			var elt = document.forms['modules'].elements['$name'];

			var result = '';
			for (var i=0; i < elt.length; i++) {
            	if(elt[i].selected) {
            		if(result != '') result += ';';
       
             		result += elt[i].value;
            	}
         	}

         	document.forms['modules'].elements['$fieldName'].value = result;
		}
	</script>
JSCODE;

	$field .= '<input type="hidden" name="' . __vads_output_string($fieldName) . '" value="' . $value . '">';

	return $field;
}

function __vads_cfg_draw_table_multi_options($value='', $name) {
	$name = __vads_output_string($name);
	
	$fieldName = 'configuration[' . $name . ']';
	if (empty($value) && isset($GLOBALS[$fieldName])) $value = stripslashes($GLOBALS[$fieldName]);

	$options = empty($value) ? array() : json_decode($value, true);

	$field = '<input id="' . $name . '_btn" class="' . $name . '_btn"' . (!empty($options) ? ' style="display: none;"' : '') . ' type="button" value="' . MODULE_PAYMENT___VADS_MULTI_OPTIONS_ADD . '" />';
	$field .= '<br /><div style="overflow-x: scroll; overflow-y: visible; width: 400px;"><table id="' . $name . '_table"' . (empty($options) ? ' style="display: none;"' : '') . ' cellpadding="10" cellspacing="0" class="infoBoxContent">';
	 
	$field .= '<thead><tr>';
	$field .= '<th style="padding: 0px;" class="label">' . MODULE_PAYMENT___VADS_MULTI_OPTIONS_LABEL . '</th>';
	$field .= '<th style="padding: 0px;" class="min_amount">' . MODULE_PAYMENT___VADS_MULTI_OPTIONS_MIN_AMOUNT . '</th>';
	$field .= '<th style="padding: 0px;" class="max_amount">' . MODULE_PAYMENT___VADS_MULTI_OPTIONS_MAX_AMOUNT . '</th>';
	$field .= '<th style="padding: 0px;" class="contract">' . MODULE_PAYMENT___VADS_MULTI_OPTIONS_CONTRACT . '</th>';
	$field .= '<th style="padding: 0px;" class="count">' . MODULE_PAYMENT___VADS_MULTI_OPTIONS_COUNT . '</th>';
	$field .= '<th style="padding: 0px;" class="period">' . MODULE_PAYMENT___VADS_MULTI_OPTIONS_PERIOD . '</th>';
	$field .= '<th style="padding: 0px;" class="first">' . MODULE_PAYMENT___VADS_MULTI_OPTIONS_FIRST . '</th>';
	$field .= '<th style="padding: 0px;"></th>';
	$field .= '</tr></thead>';
	 
	$field .= '<tbody>';
	$field .= '<tr id="' . $name . '_add">
			  	<td colspan="7"></td>
			    <td style="padding: 0px;"><input class="' . $name . '_btn" type="button" value="' . MODULE_PAYMENT___VADS_MULTI_OPTIONS_ADD . '" /></td>
    		  </tr>';
	$field .= '</tbody></table></div>';
	
	$field .= "\n" . '<script type="text/javascript">';
	
	$field .= "\n" . 'jQuery(".' . $name . '_btn").click(function() {
    					__vadsAddOption("' . $name . '");
    				 });';
	
	// add already inserted lines
	if(!empty($options)) {
		foreach ($options as $code => $option) {
			$field .= "\n" . '__vadsAddOption("' . $name . '", "' . $code . '", ' . json_encode($option) . ');' . "\n";
		}
	}
	
	
	$deleteTxt = MODULE_PAYMENT___VADS_MULTI_OPTIONS_DELETE;
	
	$field .= <<<JSCODE
		var JSON = JSON || {};
		
		// implement JSON.stringify serialization
		JSON.stringify || function(obj) {
			var t = typeof (obj);
			if (t != "object" || obj === null) {
				// simple data type
				if (t == "string") obj = '"' + obj + '"';
				return String(obj);
			} else {
				// recurse array or object
				var n, v, json = [], arr = (obj && obj.constructor == Array);
		
				for (n in obj) {
					v = obj[n]; t = typeof(v);
		
					if (t == "string") v = '"'+v+'"';
					else if (t == "object" && v !== null) v = JSON.stringify(v);
		
					json.push((arr ? "" : '"' + n + '":') + String(v));
				}
		
				return (arr ? "[" : "{") + String(json) + (arr ? "]" : "}");
			}
		};
	
		jQuery(document.forms['modules']).submit(function(event) {
  			var options = {};
  			
    		jQuery('#$name' + '_table tbody tr td input[type=text]').each(function() {
      			var name = jQuery(this).attr('name');
      			name = name.replace(/\]/g, '');
      			
      			var keys = name.split('[');
      			keys.shift();

      			options = __vadsFillArray(options, keys, jQuery(this).val());
    		});
		
			document.forms['modules'].elements['$fieldName'].value = JSON.stringify(options);
  			return true;
		});
  		
		function __vadsFillArray(arr, keys, val) {
			if(keys.length > 0) {
				var key = keys[0];
				
				if(keys.length == 1) {
					// it's a leaf, let's set the value
					arr[key] = val;
				} else {
					keys.shift();
					
					if(!arr[key]) {
						arr[key] = {};
					}
					arr[key] = __vadsFillArray(arr[key], keys, val);
				}
			}
			
			return arr;
		}
	
		function __vadsAddOption(name, key, record) {
	    	if(jQuery('#' + name + '_table tbody tr').length == 1) {
	    		jQuery('#' + name + '_btn').css('display', 'none');
	    		jQuery('#' + name + '_table').css('display', '');
	    	}
			
			if(!key && !record) {
		    	// new line, generate key and use empty record
	    		key = new Date().getTime();
				record = { label: "", min_amount: "", max_amount: "", contract: "", count: "", period: "", first: "" };
	    	}

			var inputPrefix = name + '[' + key + ']';
			
			var optionLine = '<tr id="' + name + '_line_' + key + '">';
    		optionLine += '<td style="padding: 0px;"><input style="width: 150px;" name="' + inputPrefix + '[label]" type="text" value="' + record['label'] + '" /></td>';
			optionLine += '<td style="padding: 0px;"><input style="width: 75px;" name="' + inputPrefix + '[min_amount]" type="text" value="' + record['min_amount'] + '" /></td>';
			optionLine += '<td style="padding: 0px;"><input style="width: 75px;" name="' + inputPrefix + '[max_amount]" type="text" value="' + record['max_amount'] + '" /></td>';
			optionLine += '<td style="padding: 0px;"><input style="width: 65px;" name="' + inputPrefix + '[contract]" type="text" value="' + record['contract'] + '" /></td>';
			optionLine += '<td style="padding: 0px;"><input style="width: 65px;" name="' + inputPrefix + '[count]" type="text" value="' + record['count'] + '" /></td>';
			optionLine += '<td style="padding: 0px;"><input style="width: 65px;" name="' + inputPrefix + '[period]" type="text" value="' + record['period'] + '" /></td>';
			optionLine += '<td style="padding: 0px;"><input style="width: 75px;" name="' + inputPrefix + '[first]" type="text" value="' + record['first'] + '" /></td>';
			optionLine += '<td style="padding: 0px;"><input type="button" value="$deleteTxt" onclick="javascript: __vadsDeleteOption(\'' + name + '\', \'' + key + '\');" /></td>';
	    	optionLine += '</tr>';
	    							
	    	jQuery(optionLine).insertBefore('#' + name + '_add');
	    }
	
	    function __vadsDeleteOption(name, key) {
	    	jQuery('#' + name + '_line_' + key).remove();
	    	
	    	if(jQuery('#' + name + '_table tbody tr').length == 1) {
	    		jQuery('#' + name + '_btn').css('display', '');
	    		jQuery('#' + name + '_table').css('display', 'none');
	    	}
	    }
	</script>
JSCODE;

	$field .= '<input type="hidden" name="' . $fieldName . '" value="' . $value . '">';

	return $field;
}
?>