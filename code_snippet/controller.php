<?php 
namespace Concrete\Package\CodeSnippet;

use BlockType;
use BlockTypeSet;

class Controller extends \Concrete\Core\Package\Package
{
    protected $pkgHandle = 'code_snippet';
    protected $appVersionRequired = '5.7.5';
    protected $pkgVersion = '0.9.1';
    
    public function getPackageName()
    {
        return t('Code Snippet');
    }
    
    public function getPackageDescription()
    {
        return t('Share your code in your page with pretty syntax highlighting.');
    }
    
    public function install()
    {
        $pkg = parent::install();
        $bt = BlockType::installBlockType('code_snippet', $pkg);
        $btSet = BlockTypeSet::getByHandle('basic');
        if (is_object($bt) && is_object($btSet)) {
            $btSet->addBlockType($bt);
        }
    }
    
    public function upgrade()
    {
        parent::upgrade();
        $bt = BlockType::getByHandle('code_snippet');
        $btSet = BlockTypeSet::getByHandle('basic');
        if (is_object($bt) && is_object($btSet)) {
            $btSet->addBlockType($bt);
        }
    }
}
