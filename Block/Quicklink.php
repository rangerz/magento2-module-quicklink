<?php
declare(strict_types=1);

namespace Rangerz\Quicklink\Block;

use Magento\Framework\App\Area;
use Magento\Framework\App\State;
use Magento\Framework\View\Element\Template;
use Rangerz\Quicklink\Helper\Config;

class Quicklink extends Template
{
    private $appState;
    private $config;

    public function __construct(
        Template\Context $context,
        Config $config,
        State $appState,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->config = $config;
        $this->appState = $appState;
    }

    protected function _toHtml()
    {
        $isDeveloperMode = State::MODE_DEVELOPER === $this->appState->getMode();
        $isBackend = Area::AREA_ADMINHTML === $this->appState->getAreaCode();
        $isEnable = $this->config->isEnabled();
        $isEnableInBackend = $this->config->isEnableInBackend();
        $isEnableInDeveloperMode = $this->config->isEnableInDeveloperMode();

        if (!$isEnable ||
            ($isDeveloperMode && !$isEnableInDeveloperMode) ||
            ($isBackend && !$isEnableInBackend)) {
            return '';
        }

        return parent::_toHtml();
    }
}
