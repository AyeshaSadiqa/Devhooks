<?php
namespace FME\CustomizeProduct\Block;

class CustomizeProductImage extends \Magento\Config\Block\System\Config\Form\Field {


    public function __construct(
        \Magento\Framework\View\Asset\Repository $assetRepo,
        \Magento\Backend\Block\Template\Context $context,
        array $data = []
    ) {
        $this->_assetRepo = $assetRepo;
        parent::__construct($context, $data);
    }

    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element) {
        $imageUrl = $this->_assetRepo->getUrl("wysiwyg/grid_.png");
               // echo $imageUrl; exit;

        $html = "<img src='$imageUrl' alt=' Customize Product Module Image' width='1000' height='100' />";
        return $html;
    }

}