<?php
namespace FME\CustomizeProduct\Model\ResourceModel;

class Blog extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {
        $this->_init("fme_blog", "id");
    }
}