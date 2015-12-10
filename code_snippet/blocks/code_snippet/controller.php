<?php
namespace Concrete\Package\CodeSnippet\Block\CodeSnippet;

use Concrete\Core\Asset\AssetList;
use Concrete\Core\Block\BlockController;

class Controller extends BlockController
{
    protected $btTable = 'btCodeSnippet';
    protected $btInterfaceWidth = "600";
    protected $btInterfaceHeight = "500";
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
                'version' => '9.0.0'
            ), 'code_snippet'
        );
        $al->register(
            'css', 'highlightjs', 'css/default.css', array(
                'version' => '9.0.0'
            ), 'code_snippet'
        );
        $al->register(
            'javascript-inline',
            'highlightjsinit',
            'hljs.initHighlightingOnLoad();',
            array(),
            'code_snippet'
        );
        $al->registerGroup('highlightjs', array(
            array('css', 'highlightjs'),
            array('javascript', 'highlightjs'),
            array('javascript-inline', 'highlightjsinit'),
        ));
    }

    public function add()
    {
        $this->edit();
    }

    public function edit()
    {
        $this->requireAsset('ace');
    }
    
    public function on_page_view()
    {
        $this->requireAsset('highlightjs');
    }

    public function getSearchableContent()
    {
        return $this->content;
    }

}