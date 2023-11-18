
const form = document.querySelector('form')
function handleForm(evt) {

    const inputs = document.querySelectorAll('input')
    if (inputs.length > 0) {
        var pass = inputs[0].value
        var confirmpass = inputs[1].value
        if (confirmpass != pass) {
            const el = document.querySelector('#error')

            el.textContent = 'password does match';
            evt.preventDefault();

        }

    }
    else {
        evt.preventDefault();

    }



}
form.addEventListener('submit', handleForm)

window.onload = (evt) => {
    const el = document.querySelector("#uid")
    const elRole = document.querySelector('#role')
    const query = window.location.search.replace("&role", '').replace("?",'').split("=")
    const uid = query[1]
    const role = query[2]
    elRole.value = role
    el.value = uid
}