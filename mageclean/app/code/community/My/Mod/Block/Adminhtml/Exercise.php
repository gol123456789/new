<?php

/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/LICENSE-L.txt
 *
 * @category   AW
 * @package    AW_Blog
 * @copyright  Copyright (c) 2009-2010 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/LICENSE-L.txt
 */
class My_Mod_Block_Adminhtml_Exercise extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
        $this->_controller = 'adminhtml_exercise';
        $this->_blockGroup = 'mymod';
        $this->_headerText = Mage::helper('blog')->__('exercise Manager');
        parent::__construct();
        $this->setTemplate('mymod/comments.phtml');
    }

    protected function _prepareLayout() {
        $this->_removeButton('add');
        return parent::_prepareLayout();
    }

}