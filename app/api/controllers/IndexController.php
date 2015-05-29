<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function apiAction()
    {
        $this->view->disable();

        $this->response->setJsonContent(array('response_code' => 101, 'response_message' => 'Unified CMS API'));
        $this->response->send();
    }

}

