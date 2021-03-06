<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\Cms;

use API2CMS\Db;

abstract class Entity
{
    protected $_db;

    public function __construct()
    {
        $this->_db = Db::getInstance();
    }
}