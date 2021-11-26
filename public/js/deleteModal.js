
function deleteConfirm(route, deleteString)
{
    document.getElementById('deleteForm').action = route;
    document.getElementById('deleteString').innerText = deleteString;
}