//Used in game and jam title's slug generation
function createSlug(name)
{
    let slug = name.toLowerCase();
    return slug.replace(' ', '-');
}

function openModal(entityType, entityName, actionType, formUrl, entityUrl = null)
{
    const modal = new bootstrap.Modal(document.getElementById(entityType + 'Form'), {});
    const modalLabel = document.getElementById(entityType + 'FormTitlelabel');
    const formElement = document.getElementById(entityType + '-form');
    formElement.action = formUrl;
    if (actionType == 'create') {
        modalLabel.innerText = entityName + ' létrehozása';
        const methodInput = document.getElementById('methodInput');
        if (methodInput != null) {
            methodInput.remove();
        }
        resetForm(formElement);
    }
    else if (actionType == 'update') {
        modalLabel.innerText = entityName + ' módosítása';
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PUT';
        methodInput.id = 'methodInput';
        //It will paste the item in the first position
        formElement.prepend(methodInput);
        getDatasInModal(entityUrl);
    }

    modal.show();
}


//Open the modal with datas
function getDatasInModal(entityUrl)
{
    axios.get(entityUrl)
        .then(data => setFormElementValues(data.data))
        .catch(err => console.log(err));
}

//Set all the entity attributes to the form element
function setFormElementValues(data)
{
    for (let [key, value] of Object.entries(data)) {
        //the id, created_at, modify_at wont be found
        if (key == 'id') continue;
        const element = document.getElementById(`${key}`);
        if (element !== null) {
            //If it is a date field
            if (key == 'start_date' || key == 'end_date' || key == 'publish_date') {
                value = value.substring(0, 16);
                value = value.replace(' ', 'T');
            }
            element.value = value;
        }
    }
}

function resetForm(formElement)
{
    const inputs = formElement.querySelectorAll('input');
    inputs.forEach(element =>
    {
        if (element.name != "_token") {
            element.value = null;
        }
    });
}

function deleteConfirm(route, deleteString)
{
    document.getElementById('deleteForm').action = route;
    document.getElementById('deleteString').innerText = deleteString;
}
