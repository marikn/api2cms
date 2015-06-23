<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\Frontend\Models;

class Articles extends \API2CMS\Models\Articles
{
    public static function getBlogArticles()
    {
        $articles = self::findByKey('blog', 'Y');

        return $articles;
    }
}