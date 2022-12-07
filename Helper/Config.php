<?php
declare(strict_types=1);

namespace Rangerz\Quicklink\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Config extends AbstractHelper
{
    private const XML_PATH_ENABLED                  = 'rangerz_quicklink/general/enabled';
    private const XML_PATH_ENABLE_IN_BACKEND        = 'rangerz_quicklink/general/enable_in_backend';
    private const XML_PATH_ENABLE_IN_DEVELOPER_MODE = 'rangerz_quicklink/general/enable_in_developer_mode';

    private const XML_PATH_PRERENDER = 'rangerz_quicklink/options/prerender';
    private const XML_PATH_DELAY     = 'rangerz_quicklink/options/delay';
    private const XML_PATH_ELEMENT   = 'rangerz_quicklink/options/element';
    private const XML_PATH_LIMIT     = 'rangerz_quicklink/options/limit';
    private const XML_PATH_THRESHOLD = 'rangerz_quicklink/options/threshold';
    private const XML_PATH_THROTTLE  = 'rangerz_quicklink/options/throttle';
    private const XML_PATH_TIMEOUT   = 'rangerz_quicklink/options/timeout';
    private const XML_PATH_PRIORITY  = 'rangerz_quicklink/options/priority';
    private const XML_PATH_ORIGINS   = 'rangerz_quicklink/options/origins';
    private const XML_PATH_IGNORES   = 'rangerz_quicklink/options/ignores';

    public function getConfig($path, $scopeCode = null)
    {
        return $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE, $scopeCode);
    }

    public function isEnabled(): bool
    {
        return (bool)$this->getConfig(self::XML_PATH_ENABLED);
    }

    public function isEnableInBackend(): bool
    {
        return (bool)$this->getConfig(self::XML_PATH_ENABLE_IN_BACKEND);
    }

    public function isEnableInDeveloperMode(): bool
    {
        return (bool)$this->getConfig(self::XML_PATH_ENABLE_IN_DEVELOPER_MODE);
    }

    public function isPrerender(): bool
    {
        return (bool)$this->getConfig(self::XML_PATH_PRERENDER);
    }

    public function getDelay(): int
    {
        return (int)$this->getConfig(self::XML_PATH_DELAY);
    }

    public function getElement(): string
    {
        return (string)$this->getConfig(self::XML_PATH_ELEMENT);
    }

    public function getLimit(): string
    {
        return (string)$this->getConfig(self::XML_PATH_LIMIT);
    }

    public function getThreshold(): int
    {
        return (int)$this->getConfig(self::XML_PATH_THRESHOLD);
    }

    public function getThrottle(): string
    {
        return (string)$this->getConfig(self::XML_PATH_THROTTLE);
    }

    public function getTimeout(): int
    {
        return (int)$this->getConfig(self::XML_PATH_TIMEOUT);
    }

    public function getPriority(): bool
    {
        return (bool)$this->getConfig(self::XML_PATH_PRIORITY);
    }

    public function getOrigins(): string
    {
        return (string)$this->getConfig(self::XML_PATH_ORIGINS);
    }

    public function getIgnores(): string
    {
        return (string)$this->getConfig(self::XML_PATH_IGNORES);
    }
}
