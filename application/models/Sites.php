<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\Models;

use Phalcon\Mvc\Model;

class Sites extends Model
{
    protected $id;
    protected $accountId;
    protected $siteUrl;
    protected $siteKey;
    protected $cmsType;
    protected $params;

    public function __get($name)
    {
        if (isset($this->$name)) {
            return $this->$name;
        }

        throw new \InvalidArgumentException('Column ' . $name . ' not exist!');
    }

    public function __set($name, $value)
    {
        if (isset($this->$name)) {
            $this->$name = $value;
            return true;
        }

        throw new \InvalidArgumentException('Column ' . $name . ' not exist!');
    }

    public function initialize()
    {
        $this->setSource("sites");
        $this->belongsTo('accountId', 'API2CMS\Models\Accounts', 'id',  array('alias' => 'Account'));
    }

    public function columnMap()
    {
        return [
            'id'         => 'id',
            'account_id' => 'accountId',
            'site_url'   => 'siteUrl',
            'site_key'   => 'siteKey',
            'cms_type'   => 'cmsType',
            'params'     => 'params',
        ];
    }
}