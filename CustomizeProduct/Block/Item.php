<?php
namespace FME\CustomizeProduct\Block;
use \Magento\Framework\View\Element\Template\Context;
use \FME\CustomizeProduct\Model\ResourceModel\View\CollectionFactory as ViewCollectionFactory;

use \Magento\Framework\View\Element\Template;

class Item extends Template
{
   /**
     * CollectionFactory
     * @var null|CollectionFactory
     */
    protected $_viewCollectionFactory = null;

    /**
     * Constructor
     *
     * @param Context $context
     * @param ViewCollectionFactory $viewCollectionFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        ViewCollectionFactory $viewCollectionFactory,
        array $data = []
    ) {
        $this->_viewCollectionFactory  = $viewCollectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return Post[]
     */
    public function getCollection()
    {
        /** @var ViewCollection $viewCollection */
        $viewCollection = $this->_viewCollectionFactory ->create();
        $viewCollection->addFieldToSelect('*')->load();
        return $viewCollection->getItems();
    }

    /**
     * For a given design item, returns its url
     * @param Item $item
     * @return string
     */
    public function getItemUrl($viewId) {
         return $this->getUrl('test/index/view/'.$viewId, ['_secure' => true]);
    }
}

?>
