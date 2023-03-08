<?php
namespace FME\CustomizeProduct\Controller\Manage;

use Magento\Customer\Controller\AbstractAccount;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Customer\Model\Session;

class Edit extends AbstractAccount
{
    public $resultPageFactory;
    public $testFactory;
    public $customerSession;
    public $messageManager;

    public function __construct(
        Context $context,
    PageFactory $resultPageFactory,
        \FME\CustomizeProduct\Model\testFactory $testFactory,
        Session $customerSession,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
    $this->resultPageFactory = $resultPageFactory;
    $this->testFactory = $testFactory;
    $this->customerSession = $customerSession;
    $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    public function execute()
    {
        $testId = $this->getRequest()->getParam('id');
        $customerId = $this->customerSession->getCustomerId();
        $isAuthorised = $this->testFactory->create()
                                    ->getCollection()
                                    ->addFieldToFilter('user_id', $customerId)
                                    ->addFieldToFilter('id', $testId)
                                    ->getSize();
        if (!$isAuthorised) {
            $this->messageManager->addError(__('You are not authorised to edit this test.'));
            return $this->resultRedirectFactory->create()->setPath('customizeproduct/manage');
        }

        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Edit Test'));
        $layout = $resultPage->getLayout();
        return $resultPage;
    }
}