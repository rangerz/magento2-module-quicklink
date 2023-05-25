<h1 align="center">Rangerz_Quicklink</h1>

<div align="center">
  <p>A Magento 2 module integrates GoogleChromeLabs/quicklink, ⚡️Faster subsequent page-loads by prefetching in-viewport links during idle time.</p>
  <img src="https://img.shields.io/badge/magento-2.4-brightgreen.svg?logo=magento&longCache=true" alt="Supported Magento Versions" />
  <a href="https://packagist.org/packages/rangerz/magento2-module-quicklink" target="_blank"><img src="https://img.shields.io/packagist/v/rangerz/magento2-module-quicklink" alt="Latest Stable Version" /></a>
  <a href="https://packagist.org/packages/rangerz/magento2-module-quicklink" target="_blank"><img src="https://img.shields.io/packagist/dt/rangerz/magento2-module-quicklink" alt="Composer Downloads" /></a>
  <a href="https://github.com/rangerz/magento2-module-quicklink/graphs/commit-activity" target="_blank"><img src="https://img.shields.io/badge/maintained%3F-yes-brightgreen" alt="Maintained - Yes" /></a>
  <a href="https://opensource.org/licenses/MIT" target="_blank"><img src="https://img.shields.io/badge/license-MIT-blue.svg" /></a>
</div>

## How it works

[Quicklink](https://github.com/GoogleChromeLabs/quicklink) attempts to make navigations to subsequent pages load faster. It:

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

After installation, it will be enabled by default. You can find the configuration into `Stores > Configuration > Rangerz Extensions > Google Quicklink`.



### Google Quicklink

- Enable Google Quicklink

- Enable in Backend

- Enable in Developer Mode



### [Quicklink Listen Options](https://github.com/GoogleChromeLabs/quicklink#quicklinklistenoptions)

- Prerender Mode
  
  - Default: `No` (Boolean)
  
  Whether to switch from the default prefetching mode to the prerendering mode for the links inside the viewport.Prerender and Prefetch
  
  > **Note:** The prerendering mode (when this option is set to true) will fallback to the prefetching mode if the browser does not support prerender.

- - Default: `No` (Boolean)
  
  Whether to activate both the prefetching and prerendering mode at the same time.

- Delay (MS)
  
  - Default: `0` (Number)
  
  The *amount of time* each link needs to stay inside the viewport before being prefetched, in milliseconds.

- Element
  
  - Default: `document.body` (HTMLElement|NodeList<A>)
  
  The DOM element to observe for in-viewport links to prefetch or the NodeList of Anchor Elements.

- Request Limit
  
  - Default: `Infinity` (Number)
  
  The *total* requests that can be prefetched or prerendered while observing the `Element` container.

- Threshold
  
  - Default: `0` (Number)
  
  The *area percentage* of each link that must have entered the viewport to be fetched, in its decimal form (e.g. 0.25 = 25%).

- Concurrency Limit
  
  - Default: `Infinity` (Number)
  
  The* concurrency limit *for simultaneous requests while observing the `Element` container.

- Timeout (MS)
  
  - Default: `2000` (Number)
  
  The `requestIdleCallback` timeout, in milliseconds.
  
  > **Note:** The browser must be idle for the configured duration before prefetching.

- Priority
  
  - Default: `No` (Boolean)
  
  Whether or not the URLs within the `Element` container should be treated as high priority.
  
  When `Yes`, quicklink will attempt to use the `fetch()` API if supported (rather than `link[rel=prefetch]`).

- Origins
  
  - Default: `[location.hostname]` (Array<String>)
  
  A static array of URL hostnames that are allowed to be prefetched.
  
  Defaults to the same domain origin, which prevents *any* cross-origin requests.
  
  **Important:** An empty array (`[]`) allows ***all origins*** to be prefetched.

- Ignore List
  
  - Default: `[]` (`RegExp` or `Function` or `Array`)
  
  Determine if a URL should be prefetched.
  
  When a `RegExp` tests positive, a `Function` returns `true`, or an `Array` contains the string, then the URL is *not* prefetched.
  
  > **Note:** An `Array` may contain `String`, `RegExp`, or `Function` values.
  
  > **Important:** This logic is executed *after* origin matching!



### Option not supported for setting

- timeoutFn

- onError

- hrefFn



## Credits

Inspired by [rafaelstz/magento2-quicklink](https://github.com/rafaelstz/magento2-quicklink)



## License

[MIT](https://opensource.org/licenses/MIT)
