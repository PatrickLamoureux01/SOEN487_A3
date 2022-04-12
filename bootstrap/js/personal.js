document.addEventListener('DOMContentLoaded', () => {

    const depDrop = document.querySelector('#dep_country');
    const arvDrop = document.querySelector('#arv_country');

    fetch('http://api.countrylayer.com/v2/all?access_key=39294f89baf502443b4e21c8ed3b8218').then(res => {
        return res.json();
    }).then(countries => {
        let output = "";
        countries.forEach(country => {
            output += `<option value="${country.capital}-${country.name}">${country.name}</option>`;
        })
        depDrop.innerHTML = output;
        arvDrop.innerHTML = output;
    }).catch(error => {
        console.log(error);
    })

});