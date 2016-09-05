<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS;

use API2CMS\Bridge\Exception;
use \Phalcon\Mvc\User\Component;

class Bridge extends Component
{
    private $_bridgeConfig;

    public function __construct()
    {
        $this->_bridgeConfig = $this->getDI()->get('bridge');
    }

    public function download($token)
    {
        $bridgeDir         = $this->_bridgeConfig->buildDir . '/' . $token . '/' . $this->_bridgeConfig->bridgeDirName;
        $bridgeArchivePath = $bridgeDir . '/cms_bridge.zip';

        $this->_prepare($token, $bridgeDir);

        $zip = new Zip();
        $zip->open($bridgeArchivePath, Zip::OVERWRITE | Zip::CREATE );
        $zip->addDirectory($bridgeDir, '');
        $zip->close();
        $zip->download($bridgeArchivePath);

        $this->_unlinkBridgeTmpDir($this->_bridgeConfig->buildDir . '/' . $token);
    }

    private function _prepare($token, $bridgeDir)
    {
        $this->_checkTmpDir();

        if (!is_writable($bridgeDir)) {
            mkdir($bridgeDir, 777, true);
        }

        $bridge = $bridgeDir . '/bridge.php';
        $config = $bridgeDir . '/config.php';

        $cmsDir = new \DirectoryIterator(APPLICATION_PATH . '/libraries/Bridge/api2cms/cms');

        $this->_copyBridgeToTmpDir(APPLICATION_PATH . '/libraries/Bridge/api2cms', $bridgeDir);
        $this->_replaceBridgeTokenValue($token, $bridgeDir);

        foreach ($cmsDir as $fileInfo) {
            if ($fileInfo->isDot() || $fileInfo->isDir()) continue;
            $this->_appendFile($bridge, $fileInfo->getRealPath());
        }
    }

    private function _checkTmpDir()
    {
        if (!is_writable($this->_bridgeConfig->buildDir)) {
            throw new Exception('Temporary directory is now writable');
        }
    }

    private function _appendFile($mainFile, $file)
    {
        file_put_contents($mainFile, preg_replace('/<\?php/ms', '', file_get_contents($file)), FILE_APPEND);
    }

    private function _copyBridgeToTmpDir($source, $target)
    {
        copy($source . '/bridge.php', $target . '/bridge.php');
        copy($source . '/config.php', $target . '/config.php');
    }

    private function _replaceBridgeTokenValue($token, $target)
    {
        $contents = file_get_contents(APPLICATION_PATH . '/libraries/Bridge/api2cms/config.php');
        $contents = str_replace('REPLACE_BY_SECURITY_TOKEN', $token, $contents);
        $f = fopen($target . '/config.php', 'w');
        fwrite($f, $contents);
        fclose($f);
    }

    private function _unlinkBridgeTmpDir($dir)
    {
        if (!$dh = @opendir($dir)) {
            return;
        }

        while (false !== ($obj = readdir($dh))) {
            if ($obj == '.' || $obj == '..') {
                continue;
            }

            if (!@unlink($dir . '/' . $obj)) {
                $this->_unlinkBridgeTmpDir($dir.'/'.$obj);
            }
        }

        closedir($dh);

        @rmdir($dir);
    }
}