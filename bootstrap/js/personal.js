document.addEventListener('DOMContentLoaded', () => {

    const depDrop = document.querySelector('#dep_country');
    const arvDrop = document.querySelector('#arv_country');

    fetch('http://api.countrylayer.com/v2/all?access_key=ae0403b594e42dad9462fed13214d1c8').then(res => {
        return res.json();
    }).then(countries => {
        let output = "";
        countries.forEach(country => {
            output += `<option value="${country.name}">${country.name}</option>`;
        })
        depDrop.innerHTML = output;
        arvDrop.innerHTML = output;
    }).catch(error => {
        console.log(error);
    })

});