document.addEventListener("DOMContentLoaded", function(event) {
    let elements = document.querySelectorAll('.wrap a');


    let addClass = (event) => {
        let target = event.target;
        console.log(target);
            target.classList.add('active');
    };

    console.log(elements);
    elements.forEach((item)=> {
        console.log(item);

        item.addEventListener('click', (event) => {
            addClass(event);
        });
    });
    // filteredCities.forEach((item) => {
	// 	const li = document.createElement('li');
	// 	li.textContent = item.name;
	// 	list.append(li);
    // });
    // dropdownCitiesTo.addEventListener('click', (event) => {
    //     selectCity(event, inputCityTo, dropdownCitiesTo);
    // })
    

});