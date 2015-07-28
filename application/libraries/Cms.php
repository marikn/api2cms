<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS;

use Phalcon\Mvc\User\Component;

abstract class Cms extends Component
{
    public static function convertVersion($cmsVersion, $versionMapping)
    {
        foreach ($versionMapping as $key => $value) {
            if (version_compare($cmsVersion, $value, 'ge')) {
                $version = $key;
            } else {
                break;
            }
        }

        if (!isset($version)) {
            throw new \API2CMS\Cms\Exception(501, 'Cart version not supported');
        }

        return $version;
    }
}