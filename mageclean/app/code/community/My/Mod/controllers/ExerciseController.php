<?php

class My_Mod_ExerciseController extends Mage_Core_Controller_Front_Action {

    public function saveAction() {
        $session = Mage::getSingleton('customer/session');
        $user = $session->getCustomer();
        $userId = $user->getId();
        $data = $this->getRequest()->getPost();
        if (!$session->isLoggedIn()) {
            Mage::getSingleton('customer/session')->setBeforeAuthUrl(Mage::getUrl('*/*/index', array('_current' => true)));
            $this->_redirect('customer/account/login');
            return;
        }
        
        if ($data) {
            $model = Mage::getModel('mymod/exercise');
            $model->setData($data);                    
            $model->setUserId($userId);
            $time = time();
            try {
                if (!$model->getCreatedTime()) {
                    $model->setCreatedTime($time)
                            ->setUpdateTime($time);
                } else {
                    $model->setUpdateTime($time);
                }

                $model->save();
                $session->addSuccess(Mage::helper('mymod')->__('Exercise was successfully saved'));
                
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                $this->addError($e->getMessage());
        //        Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('core/session')->addError('no exercise to save');
        $this->_redirect('*/*/');
        return;
    }

    public function indexAction() {
        $session = Mage::getSingleton('customer/session');
        if (!$session->isLoggedIn()) {
            Mage::getSingleton('customer/session')->setBeforeAuthUrl(Mage::getUrl('*/*/*', array('_current' => true)));
            $this->_redirect('customer/account/login');
            return;
        }
        $this->loadLayout();
        $this->renderLayout();
    }

    public function editAction() {
        $session = Mage::getSingleton('customer/session');
        $user = $session->getCustomer();
        $userId = $user->getId();
        $request = $this->getRequest();
        $exerciseId = $request->getParam('id');
        // redirect if not logged in return here after
        if (!$session->isLoggedIn()) {
            Mage::getSingleton('customer/session')->setBeforeAuthUrl(Mage::getUrl('*/*/*', array('_current' => true, 'id'=>$exerciseId)));
            $this->_redirect('customer/account/login');
            return;
        }
        
        $exerciseModel = Mage::getModel('mymod/exercise')->load($exerciseId);
        // check we have a model
        if (!$exerciseModel->getId()){
           $this->_redirectReferer($defaultUrl=null);
           return;
        } 
        // check the model was created by current user or unassign id and add new user id for later saving
        if ($userId !== $exerciseModel->getUserId()){
            $exerciseModel->setId('');
            $exerciseModel->setUserId($userId);
        }
        // we'll be using this in the blocks
        Mage::register('exercise_model', $exerciseModel);
        $this->loadLayout();
        $this->renderLayout();
    }

}

/*
 * blocks for these handles
 * 
 *      INDEX ACTION
 *    exercise form
 *    video form
 *    requirements form
 * 
 *      EDIT ACTION
 *    exercise form
 *    video form
 *    requirements form
 */