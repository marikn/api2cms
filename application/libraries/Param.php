<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS;

use API2CMS\Param\Exception;
use Phalcon\Mvc\User\Component;

class Param extends Component
{
    const PARAM_NOT_EXISTS = 0;
    const PARAM_EXISTS     = 1;

    public static function validate($params, $type, $name, $require = true)
    {
        if ($require && !isset($params[$name])) {
            throw new Exception('Parameter `'. $name.'` is required.');
        }

        if (isset($params[$name])) {
            switch ($type) {
                case 'int':
                    if (!ctype_digit($params[$name])) {
                        throw new Exception('Parameter `' . $name . '` is not valid. Integer expected.');
                    }

                    break;
                case 'decimal':
                    if (!is_numeric($params[$name])) {
                        throw new Exception('Parameter `' . $name . '` is not valid. Decimal expected.');
                    }

                    break;
                case 'string':
                    if (!is_string($params[$name])) {
                        throw new Exception('Parameter `' . $name . '` is not valid. String expected.');
                    }

                    break;
                default:
                    throw new Exception('Unexpected validation type', 500);
            }
        } else {
            return self::PARAM_NOT_EXISTS;
        }

        return self::PARAM_EXISTS;
    }
}