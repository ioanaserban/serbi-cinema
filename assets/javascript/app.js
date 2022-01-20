window.addEventListener('load', () => {
    function selectChooseHour(dateAndHours, el, movieId) {
        dateAndHours = JSON.parse(dateAndHours);
        let hoursSelector = document.getElementById(`hoursFor${movieId}`);

        if (el.value !== 'None') {
            hoursSelector.classList.remove('d-none');

            let options = '<option>None</option>';

            dateAndHours[el.value].forEach((hour) => {
                options += `<option>${hour}</option>`;
            })

            hoursSelector.innerHTML = options;
        } else {
            hoursSelector.innerHTML = '';
            hoursSelector.classList.add('d-none');
        }

        console.log(dateAndHours, el.value);
    }

    window.selectChooseHour = selectChooseHour;

    function getFreeSpotsMovie (movieId)
    {
        let date = document.getElementById(`dateFor${movieId}`).value;
        let time = document.getElementById(`hoursFor${movieId}`).value;

        const spotSelect = document.getElementById(`spotFor${movieId}`);

        if (time != 'None') {
            $.ajax({
                url: "/client/freeSpotsMovie.php",
                data: {
                    movieId,
                    date,
                    time
                },
                success: function (data) {
                    let freeSpots = JSON.parse(data);

                    let options = '<option>None</option>';

                    for (let i = 0; i < freeSpots.length; i++) {
                        options += `<option value="${freeSpots[i]['id_loc']}">Sala ${freeSpots[i]['numarSala']}, rand ${freeSpots[i]['rand']}, numar ${freeSpots[i]['numar']}</option>`;
                    }

                    spotSelect.innerHTML = options;

                    spotSelect.classList.remove('d-none');
                }
            })
        } else {
            spotSelect.innerHTML = '';
            spotSelect.classList.add('d-none');
        }
    }

    window.getFreeSpotsMovie = getFreeSpotsMovie;
})