<?php
namespace FME\CustomizeProduct\Model\ResourceModel;

class Comment extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {
        $this->_init("fme_comment", "id");
    }
}