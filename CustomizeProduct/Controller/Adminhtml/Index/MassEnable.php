<?php
namespace FME\CustomizeProduct\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use FME\CustomizeProduct\Model\ResourceModel\CustomizeProduct\CollectionFactory;

class MassEnable extends Action
{ /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(Context $context, Filter $filter, CollectionFactory $collectionFactory)
    {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

     public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());

        foreach ($collection as $item) {
            $item->setHasImage(true);
            $item->save();
        }

        $this->messageManager->addSuccessMessage(
            __('A total of %1 record(s) have been enabled.', $collection->getSize())
        );

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index');
    }
    public function _isAllowed() {
        return $this->_authorization->isAllowed('FME_CustomizeProduct::enable');
    }
}