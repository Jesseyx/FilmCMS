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

export function initialQuery(obj) {
    let query, key;
    for (key in obj) {
        query = '&' + key + '=' + obj[key]
    }

    return query;
}

export function concatQuery(q1, q2) {
    if (q1.indexOf('=') >= 1) {
        return q1 + q2;
    }

    return q2.substring(1);
}
