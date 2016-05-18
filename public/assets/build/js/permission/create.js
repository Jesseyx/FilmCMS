$('#permissionTree').jstree({
    core: {
        data: {
            url: 'http://localhost:8000/api/permission/all-group',
            dataType: 'json',
        }
    },
    plugins : ['checkbox'],
});

$('#createForm').submit(() => {
    let nodes = $('#permissionTree').jstree('get_bottom_selected', true);
    let nodesIds = [];

    for (let key in nodes) {
        let node = nodes[key];
        if (node.id > 0) {
            nodesIds.push(node.id);
        }
    }

    console.log(nodesIds);
    $('#permIdsInput').val(nodesIds.join(','));
});
