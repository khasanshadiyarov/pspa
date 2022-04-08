<?php

namespace core\assets;

use core\exceptions\NotFoundHttpException;
use Exception;

class AssetBundle
{
    /**
     * @var string Asset bundle name. The name must match the folder name with all its files.
     */
    public $assetName;
    /**
     * @var array CSS and JS files to be imported at the end of the head tag.
     */
    protected $head;
    /**
     * @var array CSS and JS files to be imported at the end of the body tag.
     */
    public $body;
    /**
     * @var array Bundle class names for listed CSS and JS files.
     * Clarify the full path.
     */
    public $deps;
    /**
     * @var string HTML template to import css files. Use {src} to define
     * where the path will be placed. <br>
     * Default: '<link rel="stylesheet" href="{src}">'
     */
    public $cssEl;
    /**
     * @var string HTML template to import js files. Use {src} to define
     * where the path will be placed. <br>
     * Default: '<script src="{src}"></script>'
     */
    public $jsEl;
    /**
     * @var string Actual HTML code to be inserted in head tag
     */
    public $_head;
    /**
     * @var string Actual HTML code to be inserted in body tag
     */
    public $_body;

    /**
     * Constructor. Fill elements to insert.
     */
    public function __construct()
    {
        $this->cssEl = '<link rel="stylesheet" href="{src}">';
        $this->jsEl .= '<script src="{src}"></script>';

        $this->setDeps();

        $this->_head .= $this->getPack('head');
        $this->_body .= $this->getPack('body');
    }

    /**
     * Get pack of HTML elements as a string.
     * @param $place string '_head' or '_body'
     * @return string
     */
    public function getPack($place)
    {
        $els = [];

        foreach ($this->$place as $file) {
            $ext = explode('.', $file);
            $ext = end($ext);

            try {
                // Check if the file is CDN
                if ($this->isCDN($file)) {
                    $els[] = $this->getElement($file, $ext);
                } else {
                    // Local file
                    $path = '/web/assets/' . $this->assetName . '/' . $file;
                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $path)) {
                        $els[] = $this->getElement($path, $ext);
                    } else {
                        throw new NotFoundHttpException('Asset file not found: ' . $path . '<br>');
                    }
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        return implode('', $els);
    }

    /**
     * Check if the assets file is CDN
     * @param $file string Item from an asset list. E.g. /css/style.css.
     * @return mixed
     */
    public function isCDN($file)
    {
        return filter_var($file, FILTER_VALIDATE_URL);
    }

    /**
     * Get HTML templace and insert the path into it.
     * @param $path string Valid path for HTML
     * @param $type string 'css' or 'js'
     * @return array|string|string[]
     */
    public function getElement($path, $type)
    {
        $typeEl = $type . 'El';
        return str_replace('{src}', $path, $this->$typeEl);
    }

    /**
     * Insert dependencies before current assets.
     * @return void
     */
    public function setDeps()
    {
        if ($this->deps) {
            foreach ($this->deps as $dep) {
                $depAsset = new $dep();
                $this->_head = $depAsset->_head;
                $this->_body = $depAsset->_body;
            }
        }
    }
}