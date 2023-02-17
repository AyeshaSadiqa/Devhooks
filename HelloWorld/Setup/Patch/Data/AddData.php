<?php

namespace Devhooks\HelloWorld\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Module\Setup\Migration;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class AddData implements DataPatchInterface
{
     private $HelloWorldFactory;

     public function __construct(
          \Devhooks\HelloWorld\Model\HelloWorldFactory $HelloWorldFactory
     ) {
          $this->HelloWorldFactory = $HelloWorldFactory;
     }

     public function apply()
     {
          $sampleData = [
               [
                    'status' => 1, 
                    'custom_field_1' => 'Sample Text 1 for Data 1', 
                    'custom_field_2' => 'Sample Text 2 for Data 1'
               ],
               [
                    'status' => 1, 
                    'custom_field_1' => 'Sample Text 1 for Data 2', 
                    'custom_field_2' => 'Sample Text 2 for Data 2'
               ],
               [
                    'status' => 1, 
                    'custom_field_1' => 'Sample Text 1 for Data 3', 
                    'custom_field_2' => 'Sample Text 2 for Data 3'
               ],
               [
                    'status' => 1, 
                    'custom_field_1' => 'Sample Text 1 for Data 4', 
                    'custom_field_2' => 'Sample Text 2 for Data 4'
               ],
               [
                    'status' => 1, 
                    'custom_field_1' => 'Sample Text 1 for Data 5', 
                    'custom_field_2' => 'Sample Text 2 for Data 5'
               ],
               [
                    'status' => 1, 
                    'custom_field_1' => 'Sample Text 1 for Data 6', 
                    'custom_field_2' => 'Sample Text 2 for Data 6'
               ],
               [
                    'status' => 1, 
                    'custom_field_1' => 'Sample Text 1 for Data 7', 
                    'custom_field_2' => 'Sample Text 2 for Data 7'
               ],
               [
                    'status' => 1, 
                    'custom_field_1' => 'Sample Text 1 for Data 8', 
                    'custom_field_2' => 'Sample Text 2 for Data 8'
               ]
          ];
          foreach ($sampleData as $data) {
               $this->HelloWorldFactory->create()->setData($data)->save();
          }
     }

     public static function getDependencies()
     {
          return [];
     }

     public function getAliases()
     {
          return [];
     }
     
}
