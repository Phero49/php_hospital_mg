


function deleteUser(evt, first_name, last_name) {
    const id = evt.target.id
    const btn = document.querySelector('#confirm-delete')
    const el = document.querySelector('#modelBody1')
    el.textContent = `are you sure you want to delete  ${first_name} ${last_name}`
   console.log(el)
    btn.addEventListener('click', async () => {
        const res = await fetch(`../php/restoreUser.php?user_id=${id}`, { method: "get" })

        console.log(evt, res)
        if (res.status == 200) {
            evt.target.parentElement.parentElement.remove()
        }
    })

}
