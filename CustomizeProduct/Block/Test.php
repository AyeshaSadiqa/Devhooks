<?php
namespace FME\CustomizeProduct\Block;

class Test extends \Magento\Framework\View\Element\Template
{
    public $testFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \FME\CustomizeProduct\Model\TestFactory $testFactory,
        array $data = []
    ) {
        $this->testFactory = $testFactory;
        parent::__construct($context, $data);
    }

    public function getTest()
    {
        $testId = $this->getRequest()->getParam('id');
        return $this->testFactory->create()->load($testId);
    }
}