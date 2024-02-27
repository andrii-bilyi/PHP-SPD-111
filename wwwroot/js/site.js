document.addEventListener( 'DOMContentLoaded', () => {
	// шукаємо кнопку реєстрації, якщо знаходимо - додаємо обробник
	const signupButton = document.getElementById("signup-button");
	if(signupButton) { signupButton.onclick = signupButtonClick; }

    // шукаємо кнопку оновлення, якщо знаходимо - додаємо обробник
	const updateButton = document.getElementById("update-button");
	if(updateButton) { updateButton.onclick = updateButtonClick; }

    // шукаємо кнопку аутентифікації
	const authButton = document.getElementById("auth-button");
	if(authButton) { authButton.onclick = authButtonClick; }

	// налаштування модальних вікон
	var elems = document.querySelectorAll('.modal');
    M.Modal.init(elems, {
		"opacity": 	    	0.5, 	// Opacity of the modal overlay.
		"inDuration": 		250, 	// Transition in duration in milliseconds.
		"outDuration": 		250, 	// Transition out duration in milliseconds.
		"onOpenStart": 		null,	// Callback function called before modal is opened.
		"onOpenEnd": 		null,	// Callback function called after modal is opened.
		"onCloseStart":		null,	// Callback function called before modal is closed.
		"onCloseEnd": 		null,	// Callback function called after modal is closed.
		"preventScrolling": true,	// Prevent page from scrolling while modal is open.
		"dismissible": 		true,	// Allow modal to be dismissed by keyboard or overlay click.
		"startingTop": 		'4%',	// Starting top offset
		"endingTop": 		'10%'	// Ending top offset
	});
});

function authButtonClick(){
    const emailInput = document.querySelector('input[name="auth-email"]');
    if( ! emailInput) {  throw "'auth-email' not found";    }
    const passwordInput = document.querySelector('input[name="auth-password"]');
    if( ! passwordInput) {  throw "'auth-password' not found";    }

    //console.log(emailInput.value, passwordInput.value);
    fetch(`/auth?email=${emailInput.value}&password=${passwordInput.value}`,{
        method: 'PATCH'
    })
    .then(r=>r.json())
    
    .then(response => {
        if (response.status == 1) {
            // Закриття модального вікна
            const instance = M.Modal.getInstance(document.getElementById('auth-modal'));
            instance.close();
            // Перезавантаження поточної сторінки
            location.reload();
        } else {
            console.log(response.data.message); // Виведення повідомлення про помилку
        }
    });

}
function signupButtonClick(e) {
    //шукаємо форму - батьківський елемент кнопки (e.target)
    const signupForm = e.target.closest('form');
    if( ! signupForm) {
        throw "Signup form not found";
    }
    //в середені форми знаходимо елементи
    const nameInput = signupForm.querySelector('input[name="user-name"]');
    if( ! nameInput) {  throw "nameInput not found";    }
    const emailInput = signupForm.querySelector('input[name="user-email"]');
    if( ! emailInput) {  throw "emailInput not found";    }
    const passwordInput = signupForm.querySelector('input[name="user-password"]');
    if( ! passwordInput) {  throw "passwordInput not found";    }
    const repeatInput = signupForm.querySelector('input[name="user-repeat"]');
    if( ! repeatInput ) { throw "repeatInput not found" ; }
    const avatarInput = signupForm.querySelector('input[name="user-avatar"]');
    if( ! avatarInput ) { throw "avatarInput not found" ; }

    //валідація даних
    let isFormValid = true;
    if(nameInput.value == ""){
        nameInput.classList.remove("valid");
        nameInput.classList.add("invalid");
        isFormValid = false;
    }
    else{
        nameInput.classList.remove("invalid");
        nameInput.classList.add("valid");
    }
    if(! isFormValid) return;
    //кінець валідації

    //формуємо дані для передачі
    const formData = new FormData();
    formData.append("user-name", nameInput.value);
    formData.append("user-email", emailInput.value);
    formData.append("user-password", passwordInput.value);
    if(avatarInput.files.length > 0){
        formData.append("user-avatar", avatarInput.files[0]);
    }     
    //передаємо
    fetch("/auth",{method: 'POST', body: formData})
    .then(r=>r.json())
    .then(j => {
        if(j.status == 1){ //реєстрація успішна
            alert('реєстрація успішна');
            window.location = '/';
        }
        else {
            alert(j.data.message);
        }
    });
}

function updateButtonClick(e){
    //шукаємо форму - батьківський елемент кнопки (e.target)
    const updateForm = e.target.closest('form');
    if( ! updateForm) {
        throw "Update form not found";
    }
    //в середені форми знаходимо елементи
    const nameInput = updateForm.querySelector('input[name="user-name"]');
    if( ! nameInput ) {  nameInput=$user['name'];    }
    const emailInput = updateForm.querySelector('input[name="user-email"]');
    if( ! emailInput ) {  emailInput=$user['email'];    }
    const passwordInput = updateForm.querySelector('input[name="user-password"]');
    if( ! passwordInput ) {  passwordInput=$user['password'];    }
    // const repeatInput = signupForm.querySelector('input[name="user-repeat"]');
    // if( ! repeatInput ) { throw "repeatInput not found" ; }
    const avatarInput = updateForm.querySelector('input[name="user-avatar"]');
    if( ! avatarInput ) { avatarInput=$user['avatar']; }
    
    //валідація даних
    let isFormValid = true;
    if(nameInput.value == ""){
        nameInput.classList.remove("valid");
        nameInput.classList.add("invalid");
        isFormValid = false;
    }
    else{
        nameInput.classList.remove("invalid");
        nameInput.classList.add("valid");
    }
    if(! isFormValid) return;
    //кінець валідації
    console.log(nameInput.value, emailInput.value, passwordInput.value, avatarInput.value);
    //формуємо дані для передачі
    const formData = new FormData();
    formData.append("user-name", nameInput.value);
    formData.append("user-email", emailInput.value);
    formData.append("user-password", passwordInput.value);
    if(avatarInput.files.length > 0){
        formData.append("user-avatar", avatarInput.files[0]);
    } 
    // console.log(formData);
    // //передаємо
    // fetch("/test",{method: 'POST', body: formData})
    // .then(r=>r.json())
    // .then(j=>{
    //     if(j.status == 1){ //реєстрація успішна
    //         alert('оновлення успішне');
    //         window.location = '/';
    //     }
    //     else {
    //         alert(j.data.message);
    //     }
    // });

    //передаємо
    fetch("/auth",{method: 'PUT', body: formData})
    .then(r=>r.json())
    .then(j => {
        if(j.status == 1){ //реєстрація успішна
            alert('оновлення успішнє');
            window.location = '/';
        }
        else {
            alert(j.data.message);
        }
    });
    
}