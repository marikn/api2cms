<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS;

use Phalcon\Mvc\User\Component;

class Response extends Component
{
    private $_data = array();

    public function __construct()
    {
        $this->_data['response_code']    = '0';
        $this->_data['response_message'] = '';
        $this->_data['result']           = null;
    }

    public function setResult($data)
    {
        $this->_data['result'] = $data;
    }

    public function appendResult($data)
    {
        if (is_array($this->_data['result'])) {
            array_push($this->_data['result'], $data);
        } else {
            $this->_data['result'] = $data;
        }
    }

    public function getData()
    {
        return $this->_data;
    }

}