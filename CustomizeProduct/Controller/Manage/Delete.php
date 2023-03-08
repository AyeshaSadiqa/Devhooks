<?php
namespace FME\CustomizeProduct\Controller\Manage;

use Magento\Customer\Controller\AbstractAccount;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;

class Delete extends AbstractAccount
{
    public $testFactory;
    public $customerSession;
    public $messageManager;

    public function __construct(
        Context $context,
        \FME\CustomizeProduct\Model\TestFactory $testFactory,
        Session $customerSession,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
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
            $this->messageManager->addError(__('You are not authorised to delete this test.'));
            return $this->resultRedirectFactory->create()->setPath('customizeproduct/manage');
        } else {
            $model = $this->testFactory->create()->load($testId);
            $model->delete();
            $this->messageManager->addSuccess(__('You have successfully deleted the test.'));
        }     
        return $this->resultRedirectFactory->create()->setPath('customizeproduct/manage');
    }
}