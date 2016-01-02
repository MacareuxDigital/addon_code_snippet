<?php
namespace Concrete\Package\CodeSnippet\Block\CodeSnippet;

use Concrete\Core\Asset\Asset;
use Concrete\Core\Asset\AssetList;
use Concrete\Core\Block\BlockController;
use Core;
use Package;

class Controller extends BlockController
{
    protected $btTable = 'btCodeSnippet';
    protected $btInterfaceWidth = "600";
    protected $btInterfaceHeight = "600";
    protected $btWrapperClass = 'ccm-ui';
    protected $btCacheBlockRecord = true;
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = true;
    protected $btIgnorePageThemeGridFrameworkContainer = true;

    public function getBlockTypeDescription()
    {
        return t('Share your code in your page with pretty syntax highlighting.');
    }

    public function getBlockTypeName()
    {
        return t('Code Snippet');
    }

    public function on_start()
    {
        $al = AssetList::getInstance();
        $al->register(
            'javascript', 'highlightjs', 'js/highlight.js', array(
                'version' => '9.0.0',
            ), 'code_snippet'
        );
        $al->register(
            'css', 'highlightjs', 'css/' . h($this->theme), array(
                'version' => '9.0.0',
            ), 'code_snippet'
        );
        $al->register(
            'javascript-inline',
            'highlightjsinit',
            'hljs.initHighlightingOnLoad();',
            array(
                'position' => Asset::ASSET_POSITION_FOOTER
            ),
            'code_snippet'
        );
        $al->registerGroup('highlightjs', array(
            array('css', 'highlightjs'),
            array('javascript', 'highlightjs'),
            array('javascript-inline', 'highlightjsinit'),
        ));
        $al->register(
            'javascript', 'typeaheadjs', 'js/typeahead.js', array(
                'version' => '0.11.1',
            ), 'code_snippet'
        );
        $al->registerGroup('typeaheadjs', array(
            array('javascript', 'typeaheadjs'),
        ));
    }

    public function add()
    {
        $this->set('theme', 'default.css');
        $this->edit();
    }

    public function edit()
    {
        $pkg = Package::getByHandle('code_snippet');
        $styles = Core::make('helper/file')->getDirectoryContents($pkg->getPackagePath() . '/css');
        $themes = array();
        foreach ($styles as $style) {
            $ext = Core::make('helper/file')->getExtension($style);
            if ($ext == 'css') {
                $theme = explode('.', $style);
                $themes[$style] = Core::make('helper/text')->unhandle($theme[0]);
            }
        }
        $this->set('themes', $themes);
        $this->requireAsset('ace');
        $this->requireAsset('typeaheadjs');
    }

    public function on_page_view()
    {
        $this->requireAsset('highlightjs');
    }

    public function getSearchableContent()
    {
        return $this->content;
    }

    public function save($data)
    {
        $args['content'] = isset($data['content']) ? $data['content'] : '';
        $args['language'] = isset($data['language']) ? $data['language'] : '';
        $args['theme'] = isset($data['theme']) ? $data['theme'] : '';
        parent::save($args);
    }
}
