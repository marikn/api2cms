<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
namespace API2CMS;

use API2CMS\Zip\Exception;

class Zip extends \ZipArchive
{
    public function addDirectory($path, $localPath)
    {
        if (!is_dir($path)) {
            throw new Exception("$path is not a directory");
        }

        $this->addEmptyDir($localPath);

        $directoryIterator = new \DirectoryIterator($path);
        foreach ($directoryIterator as $entry) {
            if ((!$entry->isDir() && !$entry->isFile()) || $entry->getFilename() == '.' || $entry->getFilename() == '..') {
                continue;
            }

            if ($localPath == '') {
                $entryLocalPath = '';
            } else {
                $entryLocalPath = $localPath . '/';
            }

            if ($entry->isFile()) {
                $this->addFile($entry->getPathname(), $entryLocalPath . $entry->getFilename());
            } else {
                $this->addDirectory($entry->getPathname(), $entryLocalPath . $entry->getFilename());
            }
        }
    }

    public function download($archiveName)
    {
        if (ini_get('zlib.output_compression')) {
            ini_set('zlib.output_compression', 'Off');
        }

        if ($archiveName == '') {
            throw new Exception('The download file was not specified');
        } else if (!file_exists($archiveName)) {
            throw new Exception('File not found');
        }

        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Cache-Control: private', false);
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename=' . basename($archiveName) . ';');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($archiveName));
        readfile($archiveName);
    }
}