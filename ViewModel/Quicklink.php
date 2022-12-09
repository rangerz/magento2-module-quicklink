<?php
declare(strict_types=1);

namespace Rangerz\Quicklink\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Rangerz\Quicklink\Helper\Config;

class Quicklink implements ArgumentInterface
{
    private $config;

    public function __construct(
        Config $config
    ) {
        $this->config = $config;
    }

    public function getOptions(): string
    {
        $options = [
            'prerender' => $this->config->isPrerender(),
            'delay' => $this->config->getDelay(),
            'el' => $this->config->getElement(),
            'limit' => $this->config->getLimit(),
            'threshold' => $this->config->getThreshold(),
            'throttle' => $this->config->getThrottle(),
            'timeout' => $this->config->getTimeout(),
            'priority' => $this->config->getPriority(),
            'origins' => $this->split($this->config->getOrigins()),
            'ignores' => $this->split($this->config->getIgnores()),
        ];

        return json_encode($options) ?: '{}';
    }

    private function split($input): array
    {
        // Split space, commas, and newline.
        return preg_split('/[\ \n\r\,]+/', $input, -1, PREG_SPLIT_NO_EMPTY);
    }
}
