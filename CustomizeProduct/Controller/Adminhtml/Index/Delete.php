<?php

namespace FME\CustomizeProduct\Controller\Adminhtml\Index;

use FME\CustomizeProduct\Model\CustomizeProductFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Delete extends Action
{
    protected $resultPageFactory;
    protected $CustomizeProductFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        CustomizeProductFactory $CustomizeProductFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->CustomizeProductFactory = $CustomizeProductFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirectFactory = $this->resultRedirectFactory->create();
        try {
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model = $this->CustomizeProductFactory->create()->load($id);
                if ($model->getId()) {
                    $model->delete();
                    $this->messageManager->addSuccessMessage(__("Record Delete Successfully."));
                } else {
                    $this->messageManager->addErrorMessage(__("Something went wrong, Please try again."));
                }
            } else {
                $this->messageManager->addErrorMessage(__("Something went wrong, Please try again."));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can't delete record, Please try again."));
        }
        return $resultRedirectFactory->setPath('*/*/index');
    }
    public function _isAllowed() {
        return $this->_authorization->isAllowed('FME_CustomizeProduct::delete');
    }
}
