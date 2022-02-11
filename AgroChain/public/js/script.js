const api = 'b61f9a58770b5c88796638a90495b211';
window.addEventListener('load', () => {
    let long;
    let lat;
    console.log("here", navigator.geolocation)

    // Accesing Geolocation of User
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {
            // Storing Longitude and Latitude in variables
            long = position.coords.longitude;
            lat = position.coords.latitude;
            const base = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${long}&appid=${api}`;
            console.log(base);
            fetch(base).then((response) => {
                return response.json();
            }).then((data) => {
                console.log("data", data)
            })
        });
    }
});

const handleGetCurrentLocation = () => {
        if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {
            // Storing Longitude and Latitude in variables
            const {latitude, longitude} = position.coords;
            $("#lat").val(latitude);
            $("#lon").val(longitude);
        });
    }
}

const handleInsuranceSubmit = () => {

}
