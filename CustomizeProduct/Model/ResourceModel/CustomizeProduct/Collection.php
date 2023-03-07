<?php

namespace FME\CustomizeProduct\Model\ResourceModel\CustomizeProduct;

use FME\CustomizeProduct\Model\CustomizeProduct as CustomizeProductModel;
use FME\CustomizeProduct\Model\ResourceModel\CustomizeProduct as CustomizeProductResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            CustomizeProductModel::class,
            CustomizeProductResourceModel::class
        );
    }
}
