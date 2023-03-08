<?php
namespace FME\CustomizeProduct\Model;

class Comment extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const NOROUTE_ENTITY_ID = 'no-route';
    const ID = 'id';
    const CACHE_TAG = 'fme_customizeproduct_comment';
    protected $_cacheTag = 'fme_customizeproduct_comment';
    protected $_eventPrefix = 'fme_customizeproduct_comment';
    
    public function _construct()
    {
        $this->_init(\FME\CustomizeProduct\Model\ResourceModel\Comment::class);
    }
    
    public function load($id, $field = null)
    {
        if ($id === null) {
            return $this->noRoute();
        }
        return parent::load($id, $field);
    }
    
    public function noRoute()
    {
        return $this->load(self::NOROUTE_ENTITY_ID, $this->getIdFieldName());
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG.'_'.$this->getId()];
    }

    public function getId()
    {
        return parent::getData(self::ID);
    }

    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }
}