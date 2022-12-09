define([], function () {
    'use strict';

    var defaultOptions = {
        prerender: false,
        delay: 0,
        el: document.body,
        limit: Infinity,
        threshold: 0,
        throttle: Infinity,
        timeout: 2000,
        priority: false,
        origins: [location.hostname],
        ignores: []
    };

    // ex: 'document.body' => window['document']['body']
    var safeEval = function (selector) {
        return selector
            .replace(/\[([^\[\]]*)\]/g, '.$1.')
            .split('.')
            .filter(t => t !== '')
            .reduce((prev, cur) => prev && prev[cur], window)
    };

    var getElement = function (selector) {
        var el = safeEval(selector);
        if (el instanceof Element) {
            return el;
        }

        el = document.querySelector(selector);
        if (el instanceof Element) {
            return el;
        }

        console.warn('Failed to convert options.el', selector, ', so using default HTMLElement document.body');
        return defaultOptions['el'];
    };

    var getOrigins = function (origins) {
        if (!Array.isArray(origins)) {
            console.warn('Failed to convert options.origins', origins, ', so using default origins [location.hostname]');
            return defaultOptions['origins'];
        }

        var result = [];
        origins.forEach(function (origin) {
            var domain = safeEval(origin);
            result.push(domain ? domain : origin);
        });
        return result;
    };

    var getIgnores = function (ignores) {
        if (!Array.isArray(ignores)) {
            console.warn('Failed to convert options.ignores', ignores, ', so using default ignores []');
            return defaultOptions['ignores'];
        }

        var ignoreFn = function (uri) {
            for (const ignore of ignores) {
                if (uri.includes(ignore)) {
                    return true;
                }
            }
            return false;
        };

        // Add an extra ignoreFn
        var extraFn = function (uri, el) {
            return el.hasAttribute('noprefetch');
        };

        return [ignoreFn, extraFn];
    };

    var getValue = function (value) {
        if ('string' !== typeof (value)) {
            return value;
        }

        var number = parseInt(value);
        if (!isNaN(number)) {
            return number;
        }

        number = parseFloat(value);
        if (!isNaN(number)) {
            return number;
        }

        return safeEval(value);
    };

    var optionsResolver = function (jsonOption) {
        var options = {};
        var resolvers = {
            el: getElement,
            origins: getOrigins,
            ignores: getIgnores,
            default: getValue
        }

        Object.entries(jsonOption).forEach(function ([key, value]) {
            var resolver = resolvers[key] || resolvers['default'];
            options[key] = resolver(value);
        });

        return options;
    };

    return optionsResolver;
});
