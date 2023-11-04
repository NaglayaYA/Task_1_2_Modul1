<?php

namespace Perspective\Task2CountDown\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class Task2CountDown implements ArgumentInterface
{

    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    private $_productFactory;

    /**
     * @var \Magento\Framework\Registry
     */
    private $_registry;

    /**
     * @var Magento\CatalogRule\Model\RuleFactory
     */
    private $ruleFactory;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    private $timezone;

    /**
     * @var \Magento\CatalogRule\Model\ResourceModel\Rule\CollectionFactory
     */
    private $collectionFactory;

    public function __construct(
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Framework\Registry $registry,
        \Magento\CatalogRule\Model\RuleFactory $ruleFactory,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone,
        \Magento\CatalogRule\Model\ResourceModel\Rule\CollectionFactory $collectionFactory,

    ) {
        $this->_productFactory = $productFactory;
        $this->_registry = $registry;
        $this->ruleFactory = $ruleFactory;
        $this->timezone = $timezone;
        $this->collectionFactory = $collectionFactory;
    }

    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }


    public function getMinEndTime()
    {
        $_product = $this->_productFactory->create()->load($this->getCurrentProduct()->getId());
        $spec = $_product->getSpecialtoDate();
        return $spec;
    }

    public function getCatalogRuleTime()
    {
        $currentDateTime = $this->timezone->date()->format('Y-m-d H:i:s');
        $ruleCollection = $this->collectionFactory->create()
        ->addFieldToFilter('is_active', 1)
        ->addFieldToFilter('to_date', ['gteq' => $currentDateTime])
        ->getItems();
        return $ruleCollection;

        /* foreach ($rules as $rule) {
            $ruleId = $rule->getId();
            $endDate = $this->ruleFactory->create()->load($ruleId)->getToDate();
            $fromDate = $this->ruleFactory->create()->load($ruleId)->getFromDate();
            print_r("<b>Действующее ценовое правило ID $ruleId: </b> c $fromDate  <br>");
            print_r("<b>Действующее ценовое правило ID $ruleId: </b> до $endDate  <br>");} */  
                   
    }  

   
}


