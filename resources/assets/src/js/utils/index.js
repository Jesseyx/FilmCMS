export function concatUrl(url, query) {
    if (query) {
        return url.indexOf('?') === -1 ? url + '?' + query : url + '&' + query;
    }
    return url;
}

export function getSearch(url) {
    const arr = url.split('?');
    if (arr[1]) {
        return arr[1];
    }

    return '';
}