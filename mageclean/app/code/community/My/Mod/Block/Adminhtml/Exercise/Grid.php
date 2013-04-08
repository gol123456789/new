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
class My_Mod_Block_Adminhtml_Exercise_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {

        parent::__construct();
        $this->setId('commentGrid');
        $this->setDefaultSort('main_table.status');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection() {

        $collection = Mage::getModel('mymod/exercise')->getCollection();
       // $collection->getSelect()->joinLeft(array('aw_blog_main' => $collection->getTable('blog/blog')), 'main_table.post_id=aw_blog_main.post_id', array('aw_blog_main.title'));

        $this->setCollection($collection);


        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {


        $this->addColumn('main_table.id', array(
            'header' => Mage::helper('blog')->__('ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'id',
        ));

        $this->addColumn('main_table.vid_id', array(
            'header' => Mage::helper('blog')->__('vid id'),
            'align' => 'left',
            'index' => 'vid_id',
            'filter_index' => 'main_table.vid_id'
        ));


        $this->addColumn('main_table.name', array(
            'header' => Mage::helper('blog')->__('name'),
            'width' => '150px',
            'index' => 'name',
            'filter_index' => 'main_table.name',
        ));


        
$defaultTime = time();
$defaultDate =  new DateTime(null, new DateTimeZone('Pacific/Nauru'));
$defaultDate->setTimestamp($defaultTime);
// $defaultDate->format('Y-m-d H:i:sP');

//$defaultDate = implode(' ', $defaultDate);
        $this->addColumn('created_time', array(
            'header' => Mage::helper('blog')->__('Created'),
            'align' => 'center',
            'width' => '150px',
            'type' => 'datetime',
            'gmtoffset' => true,
            'default' => $defaultDate->format('Y-m-d H:i:sP'),
            'filter_index' => 'main_table.created_time',
            'index' => 'created_time',
        ));

        $this->addColumn('status', array(
            'header' => Mage::helper('blog')->__('Status'),
            'align' => 'canter',
            'width' => '80px',
            'index' => 'status',
            'type' => 'options',
            'filter_index' => 'main_table.status',
            'options' => array(
                1 => 'Unapproved',
                2 => 'Approved',
            ),
        ));
 
        $this->addColumn('title', array(
            'header' => Mage::helper('blog')->__('Post Title'),
            'align' => 'left',
            'width' => '80px',
            'index' => 'title',           
            'type' => 'text'
        ));

        $this->addColumn('aw_blog_main.post_id', array(
            'header' => Mage::helper('blog')->__('Link to Post'),
            'width' => '50px',
            'type' => 'action',
            'getter' => 'getPostId',
            'actions' => array(
                array(
                    'caption' => Mage::helper('blog')->__('View'),
                    'url' => array(
                        'base' => '*/manage_blog/edit'
                    ),
                    'field' => 'id'
                )
            ),
            'filter' => false,
            'sortable' => false
        ));

        $this->addColumn('action', array(
            'header' => Mage::helper('blog')->__('Action'),
            'width' => '100',
            'type' => 'action',
            'getter' => 'getId',
            'actions' => array(
                array(
                    'caption' => Mage::helper('blog')->__('Approve'),
                    'url' => array('base' => '*/*/approve'),
                    'field' => 'id'
                ),
                array(
                    'caption' => Mage::helper('blog')->__('Unapprove'),
                    'url' => array('base' => '*/*/unapprove'),
                    'field' => 'id'
                ),
                array(
                    'caption' => Mage::helper('blog')->__('Delete'),
                    'url' => array('base' => '*/*/delete'),
                    'field' => 'id',
                    'confirm' => $this->__('Are you sure?')
                )
            ),
            'filter' => false,
            'sortable' => false,
            'index' => 'stores',
            'is_system' => true,
        ));


        //$this->addExportType('*/*/exportCsv', Mage::helper('blog')->__('CSV'));
        //$this->addExportType('*/*/exportXml', Mage::helper('blog')->__('XML'));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction() {

        $this->setMassactionIdField('main_table.comment_id');
        $this->getMassactionBlock()->setFormFieldName('comment');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('blog')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('blog')->__('Are you sure?')
        ));

        $this->getMassactionBlock()->addItem('approve', array(
            'label' => Mage::helper('blog')->__('Approve'),
            'url' => $this->getUrl('*/*/massApprove'),
            'confirm' => Mage::helper('blog')->__('Are you sure?')
        ));

        $this->getMassactionBlock()->addItem('unapprove', array(
            'label' => Mage::helper('blog')->__('Unapprove'),
            'url' => $this->getUrl('*/*/massUnapprove'),
            'confirm' => Mage::helper('blog')->__('Are you sure?')
        ));
        return $this;
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}
