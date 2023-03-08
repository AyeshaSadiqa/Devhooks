<?php
namespace FME\CustomizeProduct\Controller\Manage;

use Magento\Customer\Controller\AbstractAccount;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;
use FME\CustomizeProduct\Model\TestFactory;
use Magento\Framework\Message\ManagerInterface;

use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends AbstractAccount
{
    protected $testFactory;
    protected $customerSession;
    protected $messageManager;
    protected $uploaderFactory;
    protected $adapterFactory;
    protected $filesystem;
    public function __construct(
        Context $context,
        TestFactory $testFactory,
        Session $customerSession,
        ManagerInterface $messageManager,
        UploaderFactory $uploaderFactory,
        AdapterFactory $adapterFactory,
        Filesystem $filesystem
    ) {
        $this->testFactory = $testFactory;
        $this->customerSession = $customerSession;
        $this->messageManager = $messageManager;
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
        parent::__construct($context);
    }
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $customerId = $this->customerSession->getCustomerId();
        $files = $this->getRequest()->getFiles('image_field');
        
       /** echo customerId;
        exit;
        */

// echo "<pre>";
       if($files) {
            /**echo _FILES;
            exit;
            */
            
            try{
                $uploaderFactory = $this->uploaderFactory->create(['fileId' => 'image_field']);
                $uploaderFactory->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                $imageAdapter = $this->adapterFactory->create();
                $uploaderFactory->addValidateCallback('custom_image_upload',$imageAdapter,'validateUploadFile');
                $uploaderFactory->setAllowRenameFiles(true);
                $uploaderFactory->setFilesDispersion(true);
                $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
                $destinationPath = $mediaDirectory->getAbsolutePath('wysiwyg/customizeproduct/');
                $result = $uploaderFactory->save($destinationPath);
                if (!$result) {
                    throw new LocalizedException(
                        __('File cannot be saved to path: $1', $destinationPath)
                    );
                }
                $imagePath = $result['file'];
                $data['image_field'] = $imagePath;
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
       }
        
        if (isset($data['id']) && $data['id']) {
            $isAuthorised = $this->testFactory->create()
                                        ->getCollection()
                                        ->addFieldToFilter('user_id', $customerId)
                                        ->addFieldToFilter('id', $data['id'])
                                        ->getSize();
            if (!$isAuthorised) {
                $this->messageManager->addError(__('You are not authorised to edit this test entity.'));
                return $this->resultRedirectFactory->create()->setPath('customizeproduct/manage');
            } else {
                $model = $this->testFactory->create()->load($data['id']);
                $model->setData($data);
                $model->save();
                $this->messageManager->addSuccess(__('You have updated the test entry successfully.'));
            }
        } else {
            $model = $this->testFactory->create();
            $model->setData($data);
            $model->setUserId($customerId);
            $model->save();
            $this->messageManager->addSuccess(__('Test form is saved successfully.'));
        }        
        return $this->resultRedirectFactory->create()->setPath('customizeproduct/manage');
    }
   
}