<?php

namespace FME\CustomizeProduct\Model\Grid;

use FME\CustomizeProduct\Model\ResourceModel\CustomizeProduct\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Store\Model\StoreManagerInterface;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var $loadedData
     */
    protected $loadedData;

    /**
     * @var $collection
     */
    protected $collection;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->storeManager = $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        $items = $this->collection->getItems();
        foreach ($items as $model) {
            $this->loadedData[$model->getId()] = $model->getData();
            if ($model->getImageField()) {
                $m['image_field'][0]['name'] = $model->getImageField();
                $m['image_field'][0]['url'] = $this->getMediaUrl($model->getImageField());
                $fullData = $this->loadedData;
                $this->loadedData[$model->getId()] = array_merge($fullData[$model->getId()], $m);
            }
        }
        return $this->loadedData;
    }
    public function getMediaUrl($path = '')
    {
        $mediaUrl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'wysiwyg/customizeproduct/' . $path;
        return $mediaUrl;
    }
}
