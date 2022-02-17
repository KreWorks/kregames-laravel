


function runCommandConfirm(route, command, warningMsg)
{
    document.getElementById('commandForm').action = route;
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
    var action = document.getElementById('commandForm').action;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function ()
    {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("response").innerText = this.responseText;
            document.getElementById('commandModalCancel').click();
        }
    };
    xhttp.open("GET", action, true);
    xhttp.send();
}