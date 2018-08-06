<?php

namespace Namespace\RegisterGroup\Block;

use Magento\Framework\App\Filesystem\DirectoryList;

class Option extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \Magento\Eav\Model\Config
     *
     * Eav config collection
     */
    protected $eavConfig;
    /**
     * @param \Magento\Store\Model\StoreManagerInterface
     *
     * Store manager
     */
    protected $storeManager;
    /**
     * @param \Magento\Framework\Filesystem
     *
     * File system
     */
    protected $fileSystem;
    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     *
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Eav\Model\Config $eavConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Filesystem $_filesystem
    )
    {
        parent::__construct($context);
        $this->eavConfig = $eavConfig;
        $this->storeManager = $storeManager;
        $this->fileSystem = $_filesystem;
    }

    /**
     * Get values for customer_buyer_group attribute
     *
     * @return array;
     */
    public function getCustomerAttributeValues()
    {
        $attribute = $this->eavConfig->getAttribute('customer', 'customer_buyer_group');
        $options = $attribute->getSource()->getAllOptions();
        return $options;
    }
    /**
     * Get url group param
     *
     * @return string
     */
    public function getParam()
    {
        $data = $_GET;
        if ($group = $data['group']) {
            return $group;
        }
    }
    /**
     * Get registration form header image
     *
     * @return string
     */
    public function getImageUrlPath()
    {
        $param = $this->getParam();
        if ($param) {

        }
    }
    /**
     * Get Image Name Depending On Option
     *
     * @return string
     */
    public function getImageName()
    {
        $id = $this->getParam();
        $result = '';
        switch ($id){
        case (0):
            $result = 'diy.jpg';
            break;
        case (1):
            $result = 'tradesman.jpg';
            break;
        case (2):
            $result = 'hydro_buyer.jpg';
            break;
        case (3):
            $result = 'hydro_outlet.jpg';
            break;
        }
            return $result;
    }
    /**
     * Get base URL
     *
     * @return string
     */
    public function getImgBaseUrl()
    {
        $baseUrl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $imageName = $this->getImageName();
        if ($imageName) {
            $url = $baseUrl.'prelogin_page_img'.DIRECTORY_SEPARATOR.$imageName;
            if ($this->isImageExist($imageName)) {
                return $url;
            }
        }
    }
    /**
     * Check if image exist
     *
     * @return boolean
     */
    public function isImageExist($img)
    {
        if ($img) {
            $path = $this->fileSystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath();
            $fullPath = $path.'prelogin_page_img'.DIRECTORY_SEPARATOR.$img;
            if (file_exists($fullPath)) {
                return true;
            }
        }
    }
}
