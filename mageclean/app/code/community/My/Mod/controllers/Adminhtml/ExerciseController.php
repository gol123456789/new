<?php


class My_Mod_Adminhtml_ExerciseController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
     public function gridAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
     public function editAction()
    {
          $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('mymod/exercise')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('exercise_data', $model);

            $this->loadLayout();
            //$this->_setActiveMenu('blog/posts');
            $this->_setActiveMenu('mymod/exercise');

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
 
           $this->_addContent($this->getLayout()->createBlock('mymod/adminhtml_exercise_edit'))
            ->_addLeft($this->getLayout()->createBlock('mymod/adminhtml_exercise_edit_tabs'));
     //       $this->displayTitle('Edit comment');

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('blog')->__('Post does not exist'));
            $this->_redirect('*/*/');
        }
    }
    public function saveAction(){
         if ($data = $this->getRequest()->getPost()) {
            $model = Mage::getModel('mymod/exercise');
            $model->setData($data)
                    ->setId($this->getRequest()->getParam('id'));

            try {
                if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
                    $model->setCreatedTime(now())
                            ->setUpdateTime(now());
                } else {
                    $model->setUpdateTime(now());
                }

                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('mymod')->__('Comment was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('blog')->__('Unable to find comment to save'));
        $this->_redirect('*/*/');
    }

    public function formAction() {
        $this->loadLayout();
        $response = $this->getResponse();
         $response->setBody($this->getLayout()->createBlock('mymod/adminhtml_exercise_edit_form_tab_form')->toHtml());
    }
}