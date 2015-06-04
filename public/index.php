<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

define('APPLICATION_PATH', dirname(dirname(__FILE__)) . '/application');
define('PUBLIC_PATH', dirname(__FILE__));
define('APPLICATION_ENV', getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production');

try {

    require_once APPLICATION_PATH . '/Bootstrap.php';
    Bootstrap::run();

} catch (\Exception $e) {
    echo $e->getMessage();
}