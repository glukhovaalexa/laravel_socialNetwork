
const form = document.querySelector('.search');
console.log(form);

let getCities = (url, callback) => {
    console.log(url);
    const request = new XMLHttpRequest();
    request.open('post', url);
    let formData = new FormData(form);
    request.send(formData);

    //request.setRequestHeader('Accept-Encoding', 'gzip, deflate'); //script.js:23 Refused to set unsafe header "Accept-Encoding"
    request.addEventListener('readystatechange', () => {
        if (request.readyState !== 4) return;
        if (request.status === 200) {
            console.log(request.readyState);
            console.log(request.status);
            console.log(request.response);
            callback(request.response);

        } else {
            console.error(`${request.status}: ${request.status.text}`);
        }
    })

}
form.addEventListener('submit', (event) => {
    event.preventDefault();


    getCities("profile", (response) => {
        cities = JSON.parse(response);
        console.log(cities);
    });
});