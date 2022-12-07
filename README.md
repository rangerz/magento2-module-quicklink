<h1 align="center">Rangerz_Quicklink</h1>

<div align="center">
  <p>A Magento 2 module integrates GoogleChromeLabs/quicklink, ⚡️Faster subsequent page-loads by prefetching in-viewport links during idle time.</p>
  <img src="https://img.shields.io/badge/magento-2.4-brightgreen.svg?logo=magento&longCache=true&style=flat-square" alt="Supported Magento Versions" />
  <a href="https://packagist.org/packages/rangerz/magento2-module-quicklink" target="_blank"><img src="https://img.shields.io/packagist/v/rangerz/magento2-module-quicklink.svg?style=flat-square" alt="Latest Stable Version" /></a>
  <a href="https://packagist.org/packages/rangerz/magento2-module-quicklink" target="_blank"><img src="https://poser.pugx.org/rangerz/magento2-module-quicklink/downloads" alt="Composer Downloads" /></a>
  <a href="https://github.com/rangerz/magento2-module-quicklink/graphs/commit-activity" target="_blank"><img src="https://img.shields.io/badge/maintained%3F-yes-brightgreen.svg?style=flat-square" alt="Maintained - Yes" /></a>
  <a href="https://opensource.org/licenses/MIT" target="_blank"><img src="https://img.shields.io/badge/license-MIT-blue.svg" /></a>
</div>

## How it works

Quicklink attempts to make navigations to subsequent pages load faster. It:

* **Detects links within the viewport** (using [Intersection Observer](https://developer.mozilla.org/en-US/docs/Web/API/Intersection_Observer_API))
* **Waits until the browser is idle** (using [requestIdleCallback](https://developer.mozilla.org/en-US/docs/Web/API/Window/requestIdleCallback))
* **Checks if the user isn't on a slow connection** (using `navigator.connection.effectiveType`) or has data-saver enabled (using `navigator.connection.saveData`)
* **Prefetches** (using [`<link rel=prefetch>`](https://www.w3.org/TR/resource-hints/#prefetch) or XHR) or **prerenders** (using [Speculation Rules API](https://github.com/WICG/nav-speculation/blob/main/triggers.md))  URLs to the links. Provides some control over the request priority (can switch to `fetch()` if supported).

## Installation

```
composer require rangerz/magento2-module-quicklink
bin/magento module:enable Rangerz_Quicklink
bin/magento setup:upgrade
```

## Usage

Stores -> Configuration -> Rangerz Extensions -> Google Quicklink

### Google Quicklink

- Enable Google Quicklink

- Enable in Backend

- Enable in Developer Mode 

### Quicklink Listen Options

- Prerender Mode

- Delay (MS)

- Element

- Request Limit

- Threshold

- Concurrency Limit

- Timeout (MS)

- Priority

- Origins

- Ignore List

## Credits

Inspired by [rafaelstz/magento2-quicklink](https://github.com/rafaelstz/magento2-quicklink)

## License

[MIT](https://opensource.org/licenses/MIT)
