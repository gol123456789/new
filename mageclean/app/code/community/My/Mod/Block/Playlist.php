<?php

class My_Mod_Block_Playlist extends Mage_Core_Block_Template {

    public function getFeedUrl() {
        return "http://gdata.youtube.com/feeds/api/playlists/PLW0i--H9A4F2vZDxkOns4B6iLWI4beNiX";
    }

    public function getYoutube() {
        if (!$yt = $this->getYt()) {
            $yt = new Zend_Gdata_YouTube();
            $this->setYt($yt);
        }
        return $this->getYt();
    }

    public function getFeed() {
        $usrfeedUrl = $this->getFeedUrl();
        // playlist usr
        $usr = "gerardoloan";
        //main youtube object
        $yt = $this->getYoutube();
        // all playlists
        $playlistListFeed = $yt->getPlaylistListFeed($usr, $usrfeedUrl);
        return $playlistListFeed;
    }

    public function getFeedArr() {
        $usrfeedUrl = $this->getFeedUrl();
        $playlistListFeed = $this->getFeed();
        $yt = $this->getYoutube();
        foreach ($playlistListFeed as $playlistEntry) {
            $feedUrl = $playlistEntry->getPlaylistVideoFeedUrl();
            // find playlist matching desired one
            if ($feedUrl === $usrfeedUrl) {
                $feedUrl = $playlistEntry->getPlaylistVideoFeedUrl();
                $playlistVideoFeed = $yt->getPlaylistVideoFeed($feedUrl);
                // set position for class names
                $pos = 0;
                // loop through get info on each member of playlist
                foreach ($playlistVideoFeed as $value) {
                    $title = $value->getTitleValue();
                    $thumb = $value->getMediaGroup()->getThumbnail();
                    $thumburl = $thumb[0]->getUrl();
                    $link = $value->getLink();
                    $href[$pos]['title'] = $title;
                    $href[$pos]['thumbUrl'] = $thumburl;
                    $href[$pos]['id'] = $link[0]->getHref();
                    // increment position
                    $pos++;
                }
            }
        }
        $pos = 0;
        foreach ($href as $value) {
            $value = $value['id'];
            $tmp = str_replace("http://gdata.youtube.com/feeds/api/videos/", "", $value);
            $tmp = str_replace("http://www.youtube.com/watch?v=", "", $tmp);
            $href[$pos]['id'] = str_replace("&feature=youtube_gdata", "", $tmp);
            $pos++;
        }
        return $hrefs = new Varien_Object($href);
    }

    public function getFeedJson() {
        $dataOb = $this->getFeedArr();
        $this->addToDb($dataOb);
        return $dataOb->toJson();
    }
    public function addToDb($dataOb){
        $dataArr = $dataOb->getData();
        foreach ($dataArr as $exercise) {
            $name= $exercise['title'];
            $vidId = $exercise['id'];
            $thumb= $exercise['thumbUrl'];
             $model = Mage::getModel('mymod/exercise');
          $model->setName($name)
                  ->setVidId($vidId)
                  ->setThumb($thumb)
                  ->save(); 
        }
    }

}

