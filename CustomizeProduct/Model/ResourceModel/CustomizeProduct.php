<?php

namespace FME\CustomizeProduct\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CustomizeProduct extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('fme_customizeproduct', 'id');
    }
}
