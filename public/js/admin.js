//Used in game and jam title's slug generation
function createSlug(name)
{
    let slug = name.toLowerCase();
    return slug.replace(' ', '-');
}

//Open the modal with datas
function openEdit(type, entityUrl, updateUrl, id) {
    axios.get(entityUrl)
        .then(data=>showModal(type, updateUrl, data.data))
        .catch(err=>console.log(err));
}

function showModal(type, updateUrl, data)
{
    const modal = new bootstrap.Modal(document.getElementById(type + 'Form'), {});
    const formElement = document.getElementById(type + '-form');
    const methodInput = document.createElement('input');
    methodInput.type = 'hidden';
    methodInput.name = '_method';
    methodInput.value = 'PUT';
    methodInput.id = 'methodInput';
    //It will paste the item in the first position
    formElement.prepend(methodInput);
    formElement.action = updateUrl;

    setFormElementValues(data);

    modal.show();
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

function saveBtnOnClick()
{
    console.log('We will save the form');
}
