export function concatUrl(url, query) {
    if (query) {
        return url.indexOf('?') === -1 ? url + '?' + query : url + '&' + query;
    }
    return url;
}