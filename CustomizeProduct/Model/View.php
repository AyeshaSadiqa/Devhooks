<?php

namespace FME\CustomizeProduct\Model;

use FME\CustomizeProduct\Model\ResourceModel\View as ViewResourceModel;
use Magento\Framework\Model\AbstractModel;

class View extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ViewResourceModel::class);
    }
}
