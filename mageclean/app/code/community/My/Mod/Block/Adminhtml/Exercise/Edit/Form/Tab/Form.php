<?php
class My_Mod_Block_Adminhtml_Exercise_Edit_Form_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('form_form', array('legend'=>Mage::helper('blog')->__('Item information')));
          
        $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('blog')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
        ));
        
         if (Mage::getSingleton('adminhtml/session')->getBlogData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getBlogData());
            Mage::getSingleton('adminhtml/session')->setBlogData(null);
        } elseif (Mage::registry('exercise_data')) {
            Mage::registry('exercise_data');// ->setTags(Mage::helper('blog')->convertSlashes(Mage::registry('blog_data')->getTags()));
            $form->setValues(Mage::registry('exercise_data')->getData());
        }
        return parent::_prepareForm();
    }
}