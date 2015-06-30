<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\Frontend\Controllers;

use API2CMS\Frontend\Models\Articles;
use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\Model;

class BlogController extends Controller
{
    public function indexAction()
    {
        $currentPage = $this->request->getQuery('page', 'int');

        $articles = Articles::getBlogArticles();

        $paginator = new Model(
            array(
                "data" => $articles,
                "limit"=> 5,
                "page" => $currentPage
            )
        );

        $page = $paginator->getPaginate();

        $this->view->page = $page;
    }

    public function infoAction()
    {
        $articleId = $this->dispatcher->getParam("articleId");

        $article = Articles::getBlogArticleById($articleId);

        $this->view->article = $article;
    }
}