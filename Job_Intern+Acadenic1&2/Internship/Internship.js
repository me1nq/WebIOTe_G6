fetch("get_intern.php")
.then(res => res.json())
.then(data => {

    const container = document.getElementById("intern-container");
    container.innerHTML = "";

    data.forEach(item => {

        const detailList = item.details
            .split(",")
            .map(d => `<li>${d.trim()}</li>`)
            .join("");

        container.innerHTML += `
            <div class="card">
                <img src="uploads/${item.image}">
                <div class="content">
                    <h2>${item.company}</h2>
                    <div class="position">${item.position}</div>
                    <div class="date">${item.date_range}</div>

                    <button onclick="this.nextElementSibling.style.maxHeight='500px'">
                        ดูรายละเอียด
                    </button>

                    <div class="detail">
                        <ul>${detailList}</ul>
                    </div>
                </div>
            </div>
        `;
    });

})
.catch(err => console.error(err));