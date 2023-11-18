const filePicker = document.querySelector("#pickFile")
const uploadBtn =  document.querySelector("#picupload")
const avatar =  document.querySelector('img#avatar')
const avatarFiled =  document.querySelector("#avatarFiled")
filePicker.addEventListener('change',(evt)=>{
const file =  evt.target.files[0]
const reader = new FileReader();
reader.onload = function (e) {
    const base64Data = e.target.result;
    avatar.src = base64Data
    avatarFiled.value = base64Data
    
};

reader.readAsDataURL(file);
console.log(evt)
})

uploadBtn.addEventListener('click',(evt)=>{
    filePicker.click()
})
