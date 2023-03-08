<?php
namespace FME\CustomizeProduct\Plugin;

use Magento\Framework\Data\Tree\NodeFactory;

class NonCategoryLink
{
    protected $nodeFactory;

    public function __construct(
        NodeFactory $nodeFactory
    ) {
        $this->nodeFactory = $nodeFactory;
    }

    public function beforeGetHtml(
        \Magento\Theme\Block\Html\Topmenu $subject,
        $outermostClass = '',
        $childrenWrapClass = '',
        $limit = 0
    ) {

        $node = $this->nodeFactory->create(
            [
                'data' => $this->getNodeAsArray(),
                'idField' => 'id',
                'tree' => $subject->getMenu()->getTree()
            ]
        );
        $subject->getMenu()->addChild($node);
    }

    protected function getNodeAsArray()
    {
        return [
            'name' => __('Test Module'),
            'id' => 'test_module',
            'url' => 'http://www.example.com/',
            'has_active' => false,
            'is_active' => false
        ];
    }

}