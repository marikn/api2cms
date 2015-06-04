<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\API\Controllers;

use Phalcon\Mvc\Controller;

class AbstractController extends Controller
{
    public function initialize()
    {
        $this->view->disable();

        $this->response->setContentType('application/json');
    }

//    protected function prepareJsonResponse()
//    {
//        $this->view->disable();
//
//    }
}