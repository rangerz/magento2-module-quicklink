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
            'element' => $this->config->getElement(),
            'limit' => $this->config->getLimit(),
            'threshold' => $this->config->getThreshold(),
            'throttle' => $this->config->getThrottle(),
            'timeout' => $this->config->getTimeout(),
            'priority' => $this->config->getPriority(),
            'origins' => $this->config->getOrigins(),
            'ignores' => $this->getIgnores()
        ];

        return $this->convertJsObject($options);
    }

    private function convertJsObject(array $object): string
    {
        // Important: JS object may parse error
        $jsObject = '';
        foreach ($object as $key => $value) {
            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }
            $jsObject .= "{$key}: {$value},";
        }
        return '{' . $jsObject . '}';
    }

    private function getIgnores(): string
    {
        $ignoreList = $this->config->getIgnores();
        $ignoreList = array_filter(preg_split('/\R/', $ignoreList));

        $ignores = '';
        foreach ($ignoreList as $ignore) {
            $ignores .= "uri => uri.includes('{$ignore}'),";
        }
        $ignores .= "(uri, el) => el.hasAttribute('noprefetch')";

        return '[' . $ignores . ']';
    }
}
