<?php
namespace FME\CustomizeProduct\Model\ResourceModel\Comment;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    
    public function _construct()
    {
        $this->_init(
            \FME\CustomizeProduct\Model\Comment::class,
            \FME\CustomizeProduct\Model\ResourceModel\Comment::class
        );
        $this->_map['fields']['id'] = 'main_table.id';
    }
}