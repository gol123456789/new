<?php

class My_Mod_RoutineController extends Mage_Core_Controller_Front_Action {

    public function indexAction() {
        
    }

    public function editAction() {
        $request = $this->getRequest();
        $id = $request->getParam('id');
         // check sesssion user id against routine user id
        $session = Mage::getSingleton('customer/session');
        if (!$session->isLoggedIn()) {
            Mage::getSingleton('customer/session')->setBeforeAuthUrl(Mage::getUrl('*/*/*', array('_current' => true, 'id'=>$id)));
            $this->_redirect('customer/account/login');
            return;
        } 
        
      //  $cat = Mage::getModel('catalog/category')->load(1);
     //   var_dump($cat);
      //  die();
        $model = Mage::getModel('mymod/routine_exercise')->getCollection()->loadCatByStore($id, $request);
        
          foreach($model as $value){
              var_dump($value);
          }  
       //  $string = new Varien_Db_Select();
        
         $string = $model->getSelect();
         echo $string;
          die();
             //   ->load($id);
        Mage::register('routine', $model);
       
       
            /*
            $user = Mage::getSingleton('customer/session')->getCustomer();
            $userId = $user->getId();
            
            if ($userId !== Mage::registry('routine')->getUserId()) {
                Mage::registry('routine')->setUserId($userId);
                Mage::registry('routine')->setName('');
                
            }
             * 
             */
        

        $this->loadLayout();
        $this->renderLayout();
    }
    public function doAction(){
         $request = $this->getRequest();
        Mage::helper('mymod/routine')->register($request);

        $this->loadLayout();
        $layout = $this->getLayout();
        $blockContent = $layout->createBlock("mymod/circuit", "circuit")
                ->setTemplate("circuit.phtml");
        $this->getLayout()->getBlock('content')->append($blockContent);

        $this->renderLayout();
    }
    
    public function listAction(){
        $request = $this->getRequest();
        $allowedRequirements = $request->getParam('requirements');
        $collection = Mage::getModel('mymod/routine')->getAllowedExerciseCollection($allowedRequirements);
        Mage::register('routine_collection', $collection);
        $this->loadLayout();
        $this->renderLayout();
    }

}
/*
 * Required blocks
 * 
 *   DO ACTION 
 *     
 *      exercise_do_list
 *      exercise_player
 *      exercise_distance_tracker
 * 
 *      js tabata
 *      js distance tracker
 * 
 *    
 *    LIST ACTION
 * 
 *      routine_list   
 *      routine_filter
 * 
 */