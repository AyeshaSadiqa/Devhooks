<?php

namespace FME\CustomizeProduct\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultFactory;

class Upload extends \Magento\Backend\App\Action
{

    /**Devhooks\HelloWorld\Model\ImageUploader
     */
    public $imageUploader;

    /**
     * Upload constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param Devhooks\HelloWorld\Model\ImageUploader $imageUploader
     */
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\FME\CustomizeProduct\Model\ImageUploader $imageUploader
	) {
		parent::__construct($context);
		$this->imageUploader = $imageUploader;
	}

    /**
     * @return mixed
     */
	public function _isAllowed() {
		return $this->_authorization->isAllowed('FME_CustomizeProduct::upload');
	}

    /**
     * @return mixed
     */
    public function execute() {
		try {
			$result = $this->imageUploader->saveFileToTmpDir('image_field');
			$result['cookie'] = [
				'name' => $this->_getSession()->getName(),
				'value' => $this->_getSession()->getSessionId(),
				'lifetime' => $this->_getSession()->getCookieLifetime(),
				'path' => $this->_getSession()->getCookiePath(),
				'domain' => $this->_getSession()->getCookieDomain(),
			];
		} catch (\Exception $e) {
			$result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
		}
		return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
	}
}
