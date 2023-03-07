<?php
namespace FME\CustomizeProduct\Model\ResourceModel\Blog;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    
    public function _construct()
    {
        $this->_init(
            \FME\CustomizeProduct\Model\Blog::class,
            \FME\CustomizeProduct\Model\ResourceModel\Blog::class
        );
        $this->_map['fields']['id'] = 'main_table.id';
    }
}