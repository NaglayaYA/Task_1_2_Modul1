<?php
namespace Perspective\TaskAllPrice\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Perspective\TaskAllPrice\Helper\Data;

class TaskAllPrice implements ArgumentInterface
{
    /**
     * @var Data
     */
    protected $helper;

    /**
     * @var \Magento\Framework\Registry
     */
    private $_registry;

    /**
     * @var \Magento\Directory\Model\CurrencyFactory
     */
    private $currencyFactory;

    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    private $_productFactory;

    /**
     * @var \Magento\Catalog\Model\Product
     */
    private $product;

    public function __construct(
        Data $helper,
        \Magento\Framework\Registry $registry,    
        \Magento\Directory\Model\CurrencyFactory $currencyFactory,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Catalog\Model\Product $product
    ) {
        $this->_registry = $registry;
        $this->currencyFactory = $currencyFactory;
        $this->_productFactory = $productFactory;
        $this->product = $product;
        $this->helper = $helper;
    }

    /**
     * @return bool
     */
    
    public function isEnabled()
    {
        return $this->helper->isEnabled();
    }

    /**
     * @return bool
     */
    public function isBase()
    {
        return $this->helper->isBase();
    }

    /**
     * @return bool
     */
    public function isFinal()
    {
        return $this->helper->isFinal();
    }

    /**
     * @return bool
     */
    public function isSpecial()
    {
        return $this->helper->isSpecial();
    }

    /**
     * @return bool
     */
    public function isTier()
    {
        return $this->helper->isTier();
    }

    /**
     * @return bool
     */
    public function isCatrul()
    {
        return $this->helper->isCatrul();
    }

    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }

    public function getBase()
    {
        if ($this->isBase())
        {
            $base = $this->getCurrentProduct()->getPrice();
        }

        return $base;
    }

    public function getFinal()
    {
        if ($this->isFinal())
        {
            $final = $this->getCurrentProduct()->getFinalPrice();
        }

        return $final;
    }

    public function getSpec()
    {
        $_product = $this->_productFactory->create()->load($this->getCurrentProduct()->getId()); 
        $specialPrice = $_product->getSpecialPrice();
            if ($this->isSpecial() && $specialPrice != null)
            {
                $spec = $specialPrice;
            }
            elseif($specialPrice == null)
            {
                $spec = '---';
            }

        return $spec;
    }
    
    public function getProduct()
    {  
        return $this->product->load($this->getCurrentProduct()->getId());
    }

    public function getTier()
    {
        $TierPrice = $this->getProduct()->getTierPrices($this->getCurrentProduct());

            if ($this->isTier() && $TierPrice != null)
            {
                foreach($TierPrice as $Tr)
                {
                    {
                        $tier = $Tr->getValue();
                    }
                }   
            }
            elseif($TierPrice == null)
            {
                $tier = '---';
            }

        return $tier;
    }

    public function getCategoryRule()
    {
        $CategoryRule = $this->getProduct()->getPriceInfo()->getPrice('catalog_rule_price')->getAmount()->getValue();

            if ($this->isCatrul() && $CategoryRule != false)
            {
                $rule = $CategoryRule;  
            }
            elseif($CategoryRule == false)
            {
                $rule = '---';
            }

        return $rule; 
    }
}


    

