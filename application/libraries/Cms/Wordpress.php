<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\Cms;

use API2CMS\Cms;

class Wordpress extends Cms
{
    public static $_versionMapping = array(
        '1x0x0' => '1.0.0',
        '1x5x0' => '1.5.0',
    );
}