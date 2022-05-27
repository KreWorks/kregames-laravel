//Used in game and jam title's slug generation
function createSlug(name)
{
    let slug = name.toLowerCase();
    return slug.replace(' ', '-');
}

function openModal(modalId, entityName, actionType, formUrl, entityUrl = null)
{
    const modal = new bootstrap.Modal(document.getElementById(modalId), {});
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

function deleteConfirm(route, deleteString, redirectRoute)
{
    console.log("redirectRoute: " + redirectRoute);
    const modal = new bootstrap.Modal(document.getElementById("deleteModal"), {});
    modal.show();
    document.getElementById('deleteForm').action = route;
    document.getElementById('deleteString').innerText = deleteString;
    document.getElementById('redirect_route_on_delete').value = redirectRoute;
}

function enableEdit(id)
{
    document.querySelector(".rank-" + id).disabled = false;
    document.querySelector(".average_point-" + id).disabled = false;
    document.querySelector(".rating_count-" + id).disabled = false;
    document.querySelector(".edit-btn-" + id).style.display = 'none';
    document.querySelector(".submit-btn-" + id).style.display = '';
}

function onChange(field)
{
    var visibleTrueIcon = document.getElementById("visible_true");
    var visibleFalseIcon = document.getElementById("visible_false");

    if (field.checked) {
        visibleFalseIcon.classList.add('d-none');
        visibleTrueIcon.classList.remove('d-none');
    }
    else {
        visibleFalseIcon.classList.remove('d-none');
        visibleTrueIcon.classList.add('d-none');
    }
}