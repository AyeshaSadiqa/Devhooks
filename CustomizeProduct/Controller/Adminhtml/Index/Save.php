<?php

namespace FME\CustomizeProduct\Controller\Adminhtml\Index;

use FME\CustomizeProduct\Model\CustomizeProductFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\View\Result\PageFactory;
//for imageUpload Field in Form
use FME\CustomizeProduct\Model\ImageUploader;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\App\Cache\Manager;


class Save extends Action
{

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        CustomizeProductFactory $CustomizeProductFactory,
        Validator $formKeyValidator,
        ImageUploader $imageUploaderModel,
        ManagerInterface $messageManager,
        Manager $cacheManager
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->CustomizeProductFactory = $CustomizeProductFactory;
        $this->formKeyValidator = $formKeyValidator;
        $this->imageUploaderModel = $imageUploaderModel;
        $this->messageManager = $messageManager;
        $this->cacheManager = $cacheManager;
        parent::__construct($context);
    }
    public function execute()
    {
        $resultPageFactory = $this->resultRedirectFactory->create();
        if (!$this->formKeyValidator->validate($this->getRequest())) {
            $this->messageManager->addErrorMessage(__("Form key is Invalidate"));
            return $resultPageFactory->setPath('*/*/index');
        }
        $data = $this->getRequest()->getPostValue();
        try {
            if ($data) {
                $model = $this->CustomizeProductFactory->create();
                $model->setData($data);
                $model = $this->imageData($model, $data);
                $model->save();

                $this->messageManager->addSuccessMessage(__("Data Saved Successfully."));
                $buttondata = $this->getRequest()->getParam('back');
                if ($buttondata == 'add') {
                    return $resultPageFactory->setPath('*/*/form');
                }
                if ($buttondata == 'close') {
                    return $resultPageFactory->setPath('*/*/index');
                }
                $id = $model->getId();
                return $resultPageFactory->setPath('*/*/form', ['id' => $id]);
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can't submit your request, Please try again."));
        }
        return $resultPageFactory->setPath('*/*/index');
    }
      /**
     * @param $model
     * @param $data
     * @return mixed
     */
    public function imageData($model, $data)
    {
        if ($model->getId()) {
            $pageData = $this->CustomizeProductFactory->create();
            $pageData->load($model->getId());
            if (isset($data['image_field'][0]['name'])) {
                $imageName1 = $pageData->getThumbnail();
                $imageName2 = $data['image_field'][0]['name'];
                if ($imageName1 != $imageName2) {
                    $imageUrl = $data['image_field'][0]['url'];
                    $imageName = $data['image_field'][0]['name'];
                    $data['image_field'] = $this->imageUploaderModel->saveMediaImage($imageName, $imageUrl);
                } else {
                    $data['image_field'] = $data['image_field'][0]['name'];
                }
            } else {
                $data['image_field'] = '';
            }
        } else {
            if (isset($data['image_field'][0]['name'])) {
                $imageUrl = $data['image_field'][0]['url'];
                $imageName = $data['image_field'][0]['name'];
                $data['image_field'] = $this->imageUploaderModel->saveMediaImage($imageName, $imageUrl);
            }
        }
        $model->setData($data);
        return $model;
    }
    public function _isAllowed() {
        return $this->_authorization->isAllowed('FME_CustomizeProduct::save');
    }

}
