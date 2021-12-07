
function deleteConfirm(route, deleteString)
{
    document.getElementById('deleteForm').action = route;
    document.getElementById('deleteString').innerText = deleteString;
}

function runCommandConfirm(route, command, warningMsg)
{
    document.getElementById('commandForm').action = route;
    // document.getElementById('warningMsg').innerText = warningMsg;
    document.getElementById('commandName').innerText = command;
    const modal = document.getElementById('modalBody');
    if (warningMsg !== '') {
        const warningElement = document.createElement('div');
        warningElement.id = "warningElement";
        warningElement.classList = "alert alert-danger alert-dismissible fade show";
        warningElement.innerText = warningMsg;

        modal.appendChild(warningElement);
    } else {
        const warningElement = document.getElementById('warningElement');
        if (warningElement)
            modal.removeChild(warningElement);
    }
}

function runCommand(event)
{
    event.preventDefault();
    console.log('Fut a command');
    console.log('action: ', event.target.getAttribute("action"));
    console.log('action: ', document.getElementById('commandForm').action);
}