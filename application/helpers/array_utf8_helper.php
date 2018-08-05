<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

if (!function_exists('array_utf8_encode')) {
  /**
   * Codifica recursivamente un arreglo en utf8
   * @param type $dat
   * @return type
   */
    function array_utf8_encode($dat) {
      if (is_string($dat)) {
        return utf8_encode(trim($dat));
      }
      if (is_object($dat)) {
        $ovs = get_object_vars($dat);
        $new = $dat;
        foreach ($ovs as $k => $v) {
          $new->$k = array_utf8_encode($new->$k);
        }
        return $new;
      }

      if (!is_array($dat))
        return trim($dat);
      $ret = array();
      foreach ($dat as $i => $d)
        $ret[$i] = array_utf8_encode($d);
      return $ret;
    }
}


if (!function_exists('array_utf8_decode')) {
    /**
     * Decodifica recursivamente un arreglo en utf8
     * @param type $dat
     * @return type
     */
    function array_utf8_decode($dat) {
      if (is_string($dat)) {
        return utf8_decode($dat);
      }
      if (is_object($dat)) {
        $ovs = get_object_vars($dat);
        $new = $dat;
        foreach ($ovs as $k => $v) {
          $new->$k = array_utf8_decode($new->$k);
        }
        return $new;
      }

      if (!is_array($dat))
        return $dat;
      $ret = array();
      foreach ($dat as $i => $d)
        $ret[$i] = array_utf8_decode($d);
      return $ret;
    }
}


if (!function_exists('pretty_print')) {
    /**
     * Indents a flat JSON string to make it more human-readable.
     *
     * @param string $json The original JSON string to process.
     *
     * @return string Indented version of the original JSON string.
     */
    function pretty_print($json) {

      $result = '';
      $pos = 0;
      $strLen = strlen($json);
      $indentStr = '  ';
      $newLine = "\n";
      $prevChar = '';
      $outOfQuotes = true;

      for ($i = 0; $i <= $strLen; $i++) {

        // Grab the next character in the string.
        $char = substr($json, $i, 1);

        // Are we inside a quoted string?
        if ($char == '"' && $prevChar != '\\') {
          $outOfQuotes = !$outOfQuotes;

          // If this character is the end of an element,
          // output a new line and indent the next line.
        } else if (($char == '}' || $char == ']') && $outOfQuotes) {
          $result .= $newLine;
          $pos--;
          for ($j = 0; $j < $pos; $j++) {
            $result .= $indentStr;
          }
        }

        // Add the character to the result string.
        $result .= $char;

        // If the last character was the beginning of an element,
        // output a new line and indent the next line.
        if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
          $result .= $newLine;
          if ($char == '{' || $char == '[') {
            $pos++;
          }

          for ($j = 0; $j < $pos; $j++) {
            $result .= $indentStr;
          }
        }

        $prevChar = $char;
      }

      return $result;
    }
}

if (!function_exists('utf8_encode_deep')) {
	/**
	 * utf8_encode a todas los atributos/elementos de un objeto/array
	 *
	 * @param objeto o array por referencia
	 *
	 */

	function utf8_encode_deep(&$input) {
		if (is_string($input)) {
			$input = utf8_encode($input);
		} else if (is_array($input)) {
			foreach ($input as &$value) {
				utf8_encode_deep($value);
			}

			unset($value);
		} else if (is_object($input)) {
			$vars = array_keys(get_object_vars($input));

			foreach ($vars as $var) {
				utf8_encode_deep($input->$var);
			}
		}
	}
}