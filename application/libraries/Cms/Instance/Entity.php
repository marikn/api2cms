<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\Cms\Instance;

interface Entity
{
    public function count();

    /**
     * @param $page int
     * @param $limit int
     * @param $params array
     * @param $filter array
     *
     * @return mixed
     */
    public function get($page, $limit, $params, $filter);

    /**
     * @param $params array
     *
     * @return mixed
     */
    public function add($params);

    /**
     * @param $id int
     * @param $params array
     *
     * @return mixed
     */
    public function update($id, $params);

    /**
     * @param $id int
     *
     * @return mixed
     */
    public function delete($id);
}
