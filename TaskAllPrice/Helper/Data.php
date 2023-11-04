<?php

namespace Perspective\TaskAllPrice\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Data extends AbstractHelper
{
    /**
     * @param Context $context
     */
    public function __construct(
        Context $context,

    ) {
        parent::__construct($context);
    }

    /*
     * @return bool
     */
    public function isEnabled($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->isSetFlag(
            'perspective/general/enabled',
            $scope
        );
    }

    /*
     * @return bool
     */
    public function isBase($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->isSetFlag(
            'perspective/general/base',
            $scope
        );
    }
    
    /*
     * @return bool
     */
    public function isFinal($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->isSetFlag(
            'perspective/general/final',
            $scope
        );
    }
    

    /*
     * @return bool
     */
    public function isSpecial($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->isSetFlag(
            'perspective/general/special',
            $scope
        );
    }

    /*
     * @return bool
     */
    public function isTier($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->isSetFlag(
            'perspective/general/tier',
            $scope
        );
    }

    /*
     * @return bool
     */
    public function isCatrul($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->isSetFlag(
            'perspective/general/catrul',
            $scope
        );
    }
  
}
