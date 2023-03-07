<?php
namespace FME\CustomizeProduct\Model\ResourceModel\View;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Remittance File Collection Constructor
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\FME\CustomizeProduct\Model\View::class, \FME\CustomizeProduct\Model\ResourceModel\View::class);
    }
}