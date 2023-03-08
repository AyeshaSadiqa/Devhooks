<?php
namespace FME\CustomizeProduct\Block;

use Magento\Customer\Model\SessionFactory;

class TestList extends \Magento\Framework\View\Element\Template
{
    public $testCollection;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \FME\CustomizeProduct\Model\ResourceModel\Test\CollectionFactory $testCollection,
        SessionFactory $customerSession,
        array $data = []
    ) {
        $this->testCollection = $testCollection;
        $this->customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    public function getTests()
    {
        $customerId = $this->customerSession->create()->getCustomer()->getId();

        $collection = $this->testCollection->create();
        $collection->addFieldToFilter('user_id', $customerId)
                    ->setOrder('updated_at', 'DESC');

        return $collection;
    }
}