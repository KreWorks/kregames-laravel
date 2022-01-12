console.log("be lesz hívva");
//Used in game and jam title's slug generation
function createSlug(name)
{
    var slug = name.toLowerCase();
    return slug.replace(' ', '-');
}

//Open modal with data
function getJamData()
{

}
function openEdit(type, entityUrl, id) {
    axios.get(entityUrl)
        .then(data=>showModal(type, data.data))
        .catch(err=>console.log(err));

    /*
    with parameter
    const params = {
        id: 1
    }
    axios.get(getEntityUrl, params)
        .then(data=>console.log(data))
        .catch(err=>console.log(err));
    */
}

function showModal(type, data)
{
    const modal = new bootstrap.Modal(document.getElementById(type + 'Form'), {});
    const formElement = document.getElementById(type + '-form');
    console.log(formElement.action);
    /*
    '<input type="hidden" name="_method" value="PUT">'
    eElement.insertBefore(newFirstElement, eElement.firstChild);
    */
     */
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

    modal.show();
}
