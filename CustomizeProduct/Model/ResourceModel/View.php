<?php

namespace FME\CustomizeProduct\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class View extends AbstractDb
{
    /**
     * Post Abstract Resource Constructor
     * @return void
     */
    protected function _construct()
    {
        $this->_init('fme_customizeproduct', 'id');
    }
}