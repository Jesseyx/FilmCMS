let perm_ids = G_ROLE_PERMISSIONS.map(m => m.id);
console.log(perm_ids);

$('#permissionTree').jstree({
    core: {
        data: {
            url: 'http://localhost:8000/api/permission/all-group',
            dataType: 'json',
            data: node => {

            },
            success: res => {
                for (let key in res) {
                    for (let subKey in res[key].children) {
                        let perm = res[key].children[subKey];
                        if (perm_ids.indexOf(perm.id) !== -1) {
                            perm.state || (perm.state = {});
                            perm.state.selected = true;
                        }
                    }
                }
            }
        }
    },
    plugins : ['checkbox'],
});

$('#editForm').submit(() => {
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
