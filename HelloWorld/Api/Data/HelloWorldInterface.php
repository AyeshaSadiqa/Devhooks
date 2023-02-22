<?php
namespace Devhooks\HelloWorld\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface HelloWorldInterface extends ExtensibleDataInterface
{
    const ID = 'id';
    const TITLE = 'title';
    const DESCRIPTION = 'description';
    const STATUS = 'status';
    const IMAGE_FIELD = 'image_field'
    

    /**
     * @return int
     */
    public function getId();

    /**
     * @param $id
     * @return int
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param $title
     * @return string
     */
    public function setTitle($title);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param $description
     * @return string
     */
    public function setDescription($description);
    
    /**
     * @return int
     */
    public function getStatus();

    /**
     * @param $status
     * @return int
     */
    public function setStatus($status);
}