//Calculate the total price
const totalPrice = document.querySelector("#Price").textContent;
const shipping = document.querySelector("#shipping").textContent;
const vat = document.querySelector("#vat").textContent;

let sum = parseInt(totalPrice) + parseInt(shipping) + parseInt(vat);

document.querySelector("#Price").textContent = totalPrice + " $";
document.querySelector("#shipping").textContent = shipping + " $";
document.querySelector("#vat").textContent = vat + " $";
document.querySelector("#totalCount").textContent = sum + " $";
