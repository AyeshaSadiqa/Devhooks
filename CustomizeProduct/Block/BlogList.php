<?php
namespace FME\CustomizeProduct\Block;

use Magento\Customer\Model\SessionFactory;

class BlogList extends \Magento\Framework\View\Element\Template
{
    public $blogCollection;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \FME\CustomizeProduct\Model\ResourceModel\Blog\CollectionFactory $blogCollection,
        SessionFactory $customerSession,
        array $data = []
    ) {
        $this->blogCollection = $blogCollection;
        $this->customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    public function getBlogs()
    {
        $customerId = $this->customerSession->create()->getCustomer()->getId();

        $collection = $this->blogCollection->create();
        $collection->addFieldToFilter('user_id', $customerId)
                    ->setOrder('updated_at', 'DESC');

        return $collection;
    }
}