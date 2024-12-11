<?php
namespace WB\OneStepCheckout\Block\Checkout;

use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

class CustomNote extends Template
{
    const XML_PATH_CUSTOM_NOTE = 'wb_onestepcheckout/general/custom_note';
    const XML_PATH_ENABLE = 'wb_onestepcheckout/general/enable';
    const XML_PATH_ENABLE_POPUP = 'wb_onestepcheckout/general/enable_popup';
    const XML_PATH_FREE_SHIPPING_MESSAGE = 'wb_onestepcheckout/general/free_shipping_message';
    const XML_PATH_ADD_MORE_MESSAGE = 'wb_onestepcheckout/general/add_more_message';

    protected $_scopeConfig;
    protected $_storeManager;

    public function __construct(
        Template\Context $context,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->_scopeConfig = $context->getScopeConfig();
        $this->_storeManager = $storeManager;
        parent::__construct($context, $data);
    }

    public function getCustomNote(): string
    {
        return $this->_scopeConfig->getValue(self::XML_PATH_CUSTOM_NOTE, ScopeInterface::SCOPE_STORE) ?? '';
    }

    public function isModuleEnabled(): bool
    {
        return $this->_scopeConfig->isSetFlag(self::XML_PATH_ENABLE, ScopeInterface::SCOPE_STORE);
    }

    public function isPopupEnabled(): bool
    {
        return $this->_scopeConfig->isSetFlag(self::XML_PATH_ENABLE_POPUP, ScopeInterface::SCOPE_STORE);
    }

    /*public function getFreeShippingMessage(): string
    {
        $message = $this->_scopeConfig->getValue(self::XML_PATH_FREE_SHIPPING_MESSAGE, ScopeInterface::SCOPE_STORE);
        return $message ? '🥳 ' . $message : '🥳 Awesome! You got Free Shipping';
    }*/

    public function getFreeShippingMessage(): ?string
    {
        $message = $this->_scopeConfig->getValue(self::XML_PATH_FREE_SHIPPING_MESSAGE, ScopeInterface::SCOPE_STORE);
        return $message ? '🥳 ' . $message : null; // Return null if no message is set
    }

    /*public function getAddMoreMessage(): string
    {
        $defaultMessage = 'Add {remaining}$ more for Free Shipping';
        $message = $this->_scopeConfig->getValue(self::XML_PATH_ADD_MORE_MESSAGE, ScopeInterface::SCOPE_STORE);
        return $message ? $message : $defaultMessage;
    }*/

    public function getAddMoreMessage(): ?string
    {
        $message = $this->_scopeConfig->getValue(self::XML_PATH_ADD_MORE_MESSAGE, ScopeInterface::SCOPE_STORE);
        return $message ? $message : null; // Return null if no message is set
    }

    public function getStoreId(): int
    {
        return (int) $this->_storeManager->getStore()->getId();
    }

    public function getConfigValue(string $configPath): ?string
    {
        return $this->_scopeConfig->getValue($configPath, ScopeInterface::SCOPE_STORE);
    }
}
