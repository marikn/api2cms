<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\Cms\Wordpress;

use API2CMS\Cms\Entity;
use Phalcon\Db;

class Articles extends Entity implements \API2CMS\Cms\Instance\Entity
{
    /**
     * @param $params array
     *
     * @return mixed
     */
    public function add($params)
    {
        // TODO: Implement add() method.
    }

    public function count()
    {
        // TODO: Implement count() method.
    }

    /**
     * @param $page int
     * @param $limit int
     * @param $params array
     * @param $filter array
     *
     * @return mixed
     */
    public function get($page, $limit, $params, $filter)
    {
        $res = $this->_db->query('
            SELECT
                *
            FROM articles as a
            WHERE 1
            LIMIT ' . (int)($limit * $page) . ', ' . (int)$limit
        );


    }

    /**
     * @param $id int
     * @param $params array
     *
     * @return mixed
     */
    public function update($id, $params)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $id int
     *
     * @return mixed
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }


}