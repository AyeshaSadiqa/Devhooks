<?php
namespace FME\CustomizeProduct\Controller\Manage;

use Magento\Customer\Controller\AbstractAccount;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Customer\Model\Session;

class Edit extends AbstractAccount
{
    public $resultPageFactory;
    public $blogFactory;
    public $customerSession;
    public $messageManager;

    public function __construct(
        Context $context,
    PageFactory $resultPageFactory,
        \FME\CustomizeProduct\Model\BlogFactory $blogFactory,
        Session $customerSession,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
    $this->resultPageFactory = $resultPageFactory;
    $this->blogFactory = $blogFactory;
    $this->customerSession = $customerSession;
    $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    public function execute()
    {
        $blogId = $this->getRequest()->getParam('id');
        $customerId = $this->customerSession->getCustomerId();
        $isAuthorised = $this->blogFactory->create()
                                    ->getCollection()
                                    ->addFieldToFilter('user_id', $customerId)
                                    ->addFieldToFilter('id', $blogId)
                                    ->getSize();
        if (!$isAuthorised) {
            $this->messageManager->addError(__('You are not authorised to edit this blog.'));
            return $this->resultRedirectFactory->create()->setPath('customizeproduct/manage');
        }

        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Edit Blog'));
        $layout = $resultPage->getLayout();
        return $resultPage;
    }
}