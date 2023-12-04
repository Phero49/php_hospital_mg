function deleteUser(evt, first_name, last_name) {
   
    const id = evt.target.id
    const btn = document.querySelector('#confirm-delete')
    const el = document.querySelector('#modelBody1')
    console.log(el)
    el.textContent = `are you sure you want to achieve  ${first_name} ${last_name}`
   
    btn.addEventListener('click', async () => {
        const res = await fetch(`../php/deleteUser.php?user_id=${id}`, { method: "get" })

        console.log(evt, res)
        if (res.status == 200) {
            evt.target.parentElement.parentElement.remove()
        }  
    })

}
