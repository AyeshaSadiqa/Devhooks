<?php
namespace FME\CustomizeProduct\Controller\Manage;
use Magento\Customer\Controller\AbstractAccount;
//use Magento\Framework\App\Action\Action; //this way action is accessible to guest users also
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
class Add extends AbstractAccount
{
    public function __construct(
        Context $context,
    PageFactory $resultPageFactory
    ) {
    $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Add Test Entity'));
        $layout = $resultPage->getLayout();
        return $resultPage;
    }
}