<?php

class My_Mod_IndexController extends Mage_Core_Controller_Front_Action {

    public function indexAction() {
        
          $variable = Mage::getModel('mymod/exercise')->getCollection();
         // ->load(48);
          $model = Mage::getModel('mymod/exercise');
          $model->setName('string')
                  ->setVidId('bhbb');
           $model->save();
          // var_dump($collection);
          /*     $bla =  new Varien_Object();
          new My_Mod_Helper_Data();
          $arr = array('f','s','t');
          $last = $arr[1];
          $bla = Mage::helper("mymod");

          $model = Mage::getModel('mymod/bla')
          ->setBlue(4)
          ->setBlas(3)
          ->save();

          $model = Mage::getModel('mymod/bla')
          ->getCollection()
          ->getLastItem()->setBlas(3)
          ->save();



          //   ->load();
          // $model->reset(Zend_Db_Select::COLUMNS);
          //  var_dump((string)$model);
          //   die();
          //   $model->setBlue(1);
          //   $model->save();
          $this->loadLayout();
          $this->renderLayout();
          }
         * 
         */

        $this->loadLayout();
        $layout = $this->getLayout();
        $blockContent = $layout->createBlock("mymod/playlist", "playlist")
                ->setTemplate("block.phtml");
        $this->getLayout()->getBlock('content')->append($blockContent);

        $this->renderLayout();
//  $this->renderLayout();
        /*
          $yt = new Zend_Gdata_YouTube();
          $playlistListFeed = $yt->getPlaylistListFeed("JREAMdesign","http://gdata.youtube.com/feeds/api/playlists/PLwQf6Mb9WjZBllFw3zPCfjdcNT7uakdr4");
          foreach ($playlistListFeed as $playlistEntry) {
          $feedUrl = $playlistEntry->getPlaylistVideoFeedUrl();
          if ($feedUrl === "http://gdata.youtube.com/feeds/api/playlists/PLwQf6Mb9WjZCEpt2kyPZBKwCuZU-V3XCq" ){
          echo $playlistEntry->title->text . "<br>";
          echo $playlistEntry->description->text . "<br>";
          echo $feedUrl = $playlistEntry->getPlaylistVideoFeedUrl();
          echo "<br>";
          $playlistVideoFeed = $yt->getPlaylistVideoFeed($feedUrl);
          //     var_dump($playlistVideoFeed);
          foreach ($playlistVideoFeed as $value) {
          $title = $value->getTitleValue();
          echo $title." -> ";
          $link = $value->getLink();
          $href = $link[0]->getHref();
          if($href){
          echo "<a href='{$href}'>{$title}</a><br>";
          }
          //  $entry =  new Zend_Gdata_YouTube_PlaylistVideoEntry();
          //  $entry->getLink()
          }
          //   $playlistVideoFeed = $playlistVideoFeed;

          }
          }
          echo '<span id="playerSpan"></span>';
          echo '
          <script>
          var iframe = new Element(\'iframe\', {
          "name": "preview_frame",
          "width":"560",
          "height":"315",
          "id": "preview_frame",
          "src": "http://www.youtube.com/embed/cQW_v1RpwcI",
          "allowtransparency": true,
          "frameborder": 0
          });
          $("playerHolder").update(iframe);
          //  <iframe width="560" height="315" src="http://www.youtube.com/embed/cQW_v1RpwcI" frameborder="0" allowfullscreen></iframe>

          </script>
          ';


          // var_dump($ytquery);
          }
         * 
         */
    }

    public function saveAction() {
        $request = $this->getRequest();
        $post = $request->getPost();
        $user = Mage::getSingleton('customer/session')->getCustomer();
        $userId = $user->getId();

        $model = Mage::getModel('mymod/routine');
        $model->setUserId($userId);
        try {
            $model->setVids($post['data']);
        } catch (Exception $e) {
            die();
        }

        foreach ($post['form'] as $value) {
            $model->setData($value['name'], $value['value']);
        }
        
        $model->save();
    }

    public function viewAction() {
        $request = $this->getRequest();
        Mage::helper('mymod/routine')->register($request);

        $this->loadLayout();
        $layout = $this->getLayout();
        $blockContent = $layout->createBlock("mymod/routinelist", "routinelist")
                ->setTemplate("blocktwo.phtml");
        $this->getLayout()->getBlock('content')->append($blockContent);

        $this->renderLayout();
    }

    public function circuitAction() {
        $request = $this->getRequest();
        Mage::helper('mymod/routine')->register($request);

        $this->loadLayout();
        $layout = $this->getLayout();
        $blockContent = $layout->createBlock("mymod/circuit", "circuit")
                ->setTemplate("circuit.phtml");
        $this->getLayout()->getBlock('content')->append($blockContent);

        $this->renderLayout();
    }

    public function caltestAction(){
        $this->loadLayout();
        $layout = $this->getLayout();
        $blockContent = $layout->createBlock("mymod/circuit", "circuit")
                ->setTemplate("test.phtml");
        $this->getLayout()->getBlock('content')->append($blockContent);

        $this->renderLayout();
    }
    public function testAction() {
         $collection = Mage::getModel('blog/blog')->getCollection();
         foreach ($collection as $model){
             var_dump($model);
         }
                 }
}