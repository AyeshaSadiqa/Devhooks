<?php
namespace FME\CustomizeProduct\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface CustomizeProductInterface extends ExtensibleDataInterface
{
    const ID = 'id';
    const P_TEXT = 'p_text';
    const P_D_GUIDE = 'p_d_guide';
    const HAS_IMAGE = 'has_image';
    const IMAGE_FIELD = 'image_field';
    

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
    public function getPText();

    /**
     * @param $title
     * @return string
     */
    public function setPText($p_text);

    /**
     * @return string
     */
    public function getPDGuide();

    /**
     * @param $description
     * @return string
     */
    public function setPDGuide($p_d_guide);
    
    /**
     * @return int
     */
    public function getHasImage();

    /**
     * @param $status
     * @return int
     */
    public function setHasImage($has_image);
}