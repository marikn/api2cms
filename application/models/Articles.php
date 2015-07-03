<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\Models;

use Phalcon\Mvc\Model;

class Articles extends Model
{
    protected $id;
    protected $title;
    protected $content;
    protected $metaTitle;
    protected $metaDescription;
    protected $metaKeywords;
    protected $author;
    protected $dateCreated;
    protected $cover;
    protected $blog;
    protected $disable;

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
            $this->$name = $value ;
        }

        throw new \InvalidArgumentException('Column ' . $name . ' not exist!');
    }

    public function initialize()
    {
        $this->setSource("articles");
        $this->belongsTo('author', 'API2CMS\Models\Accounts', 'id',  array('alias' => 'Account'));
    }

    public function columnMap()
    {
        return [
            'id'                => 'id',
            'title'             => 'title',
            'content'           => 'content',
            'meta_title'        => 'metaTitle',
            'meta_description'  => 'metaDescription',
            'meta_keywords'     => 'metaKeywords',
            'author'            => 'author',
            'date_created'      => 'dateCreated',
            'cover'             => 'cover',
            'blog'              => 'blog',
            'disable'           => 'disable'
        ];
    }

    public static function findByKey($key, $value)
    {
        return self::find( $key . '=\'' . $value . '\'');
    }
}