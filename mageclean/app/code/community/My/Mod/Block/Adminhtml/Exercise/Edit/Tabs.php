<?php

class My_Mod_Block_Adminhtml_Exercise_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

    public function __construct() {
        parent::__construct();
        $this->setId('exercise_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('blog')->__('exercise Information'));
    }

    protected function _beforeToHtml() {
        $this->addTab('form_section', array(
            'label' => Mage::helper('blog')->__('Post Information'),
            'title' => Mage::helper('blog')->__('Post Information'),
            'content' => $this->getLayout()->createBlock('mymod/adminhtml_exercise_edit_form_tab_form')->toHtml(),
        ));

        $this->addTab('options_section', array(
            'label' => Mage::helper('blog')->__('Advanced Options'),
            'title' => Mage::helper('blog')->__('Advanced Options'),
            'content' => $this->getLayout()->createBlock('mymod/adminhtml_exercise_edit_form_tab_form')->toHtml(),
        ));

        $this->addTab('categories_section', array(
            'label' => Mage::helper('blog')->__('Item Information3'),
            'url' => $this->getUrl('*/*/form', array('_current' => true)),
            'class' => 'ajax',
        ));

        return parent::_beforeToHtml();
    }

}
