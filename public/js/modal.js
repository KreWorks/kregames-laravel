
function deleteConfirm(route, deleteString)
{
    document.getElementById('deleteForm').action = route;
    document.getElementById('deleteString').innerText = deleteString;
}

function runCommandConfirm(route, command, warningMsg)
{
    console.log('itt vbagyok');
    document.getElementById('commandForm').action = route;
    document.getElementById('warningMsg').innerText = warningMsg;
    document.getElementById('commandName').innerText = command;
}