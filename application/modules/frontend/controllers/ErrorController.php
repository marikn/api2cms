<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\Frontend\Controllers;

use Phalcon\Mvc\Controller;

class ErrorController extends Controller
{
    public function show404Action()
    {
        $this->response->setStatusCode(404, 'Page not found');
        $this->view->pick('error/404');
    }

    public function show403Action()
    {
        $this->response->setStatusCode(403, 'You don\'t have permissions to view this page' );
        $this->view->pick('error/403');
    }
}