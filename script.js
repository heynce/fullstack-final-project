let ul = document.createElement("ul");
document.body.append(ul);

async function readData() {
	ul.innerHTML = "";
	const response = await fetch('http://localhost/user.php');
	const userData = await response.json();
	let liElements = '';
	for (const data of userData) {
		liElements += `<li>${data.username} - ${data.email} </li>`
	}
	ul.innerHTML = liElements;
}

readData();
const firstNameInput = document.getElementById('username');
const emailInput = document.getElementById('email');


let createUserButton = document.getElementById('submitData');
createUserButton.addEventListener('click', async() => {
	const newUserData = {
		"username": userName.value,
		
		"email": emailInput.value,
	}
	await fetch("http://localhost/user.php", {
		method: "POST",
		body: JSON.stringify(newUserData)
	});
	readData();
	username.value = "";
	emailInput.value = "";
})
