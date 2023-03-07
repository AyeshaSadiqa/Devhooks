<?php

namespace FME\CustomizeProduct\Model;

use FME\CustomizeProduct\Model\ResourceModel\CustomizeProduct as CustomizeProductResourceModel;
use Magento\Framework\Model\AbstractModel;

class CustomizeProduct extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(CustomizeProductResourceModel::class);
    }
}
