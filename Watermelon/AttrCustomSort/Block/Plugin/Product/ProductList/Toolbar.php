<?php
namespace Watermelon\AttrCustomSort\Block\Plugin\Product\ProductList;

class Toolbar extends \Magento\Catalog\Block\Product\ProductList\Toolbar {

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Model\Session $session,
        \Magento\Catalog\Model\Config $config,
        \Magento\Catalog\Model\Product\ProductList\Toolbar $toolbar,
        \Magento\Framework\Url\EncoderInterface $encoderinterface,
        \Magento\Catalog\Helper\Product\ProductList $productlist,
        \Magento\Framework\Data\Helper\PostHelper $posthelper
    ){
         parent::__construct($context,$session,$config,$toolbar,$encoderinterface,$productlist,$posthelper);
    }

    public function setCollection($collection) {
        $this->_collection = $collection;
        $this->_collection->setCurPage($this->getCurrentPage());
        $limit = (int) $this->getLimit();
        if ($limit) {
            $this->_collection->setPageSize($limit);
        }
        if ($this->getCurrentOrder()) {
            switch ($this->getCurrentOrder()) {
                case 'cfm_l_m_displacement':
                    if ($this->getCurrentDirection() == 'desc') {
                        $this->_collection
                                ->getSelect()
                                ->order('CAST(e.cfm_l_m_displacement AS SIGNED) DESC');
                    } elseif ($this->getCurrentDirection() == 'asc') {
                        $this->_collection
                                ->getSelect()
                                ->order('CAST(e.cfm_l_m_displacement AS SIGNED) ASC');   
                    }
                    break;
                default:
                    $this->_collection->setOrder($this->getCurrentOrder(), $this->getCurrentDirection());
                    break;
            }
        }
        return $this;
      }
}