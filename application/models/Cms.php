<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\Models;

use Phalcon\Mvc\Model;

class Cms extends Model
{
    protected $id;
    protected $code;
    protected $name;
    protected $description;
    protected $supportedVersions;

    public function __get($name)
    {
        if (isset($this->$name)) {
            return $this->$name;
        }

        throw new \InvalidArgumentException('Property ' . $name . ' not exist!');
    }

    public function __set($name, $value)
    {
        if (isset($this->$name)) {
            $this->$name = $value ;
        }

        throw new \InvalidArgumentException('Property ' . $name . ' not exist!');
    }

    public function initialize()
    {
        $this->setSource("cms_types");
        $this->hasMany('id', 'API2CMS\Models\Sites', 'cmsType', array('alias' => 'Sites'));
    }

    public function columnMap()
    {
        return array(
            'id'                 => 'id',
            'code'               => 'code',
            'name'               => 'name',
            'description'        => 'description',
            'supported_versions' => 'supportedVersions',
        );
    }

}