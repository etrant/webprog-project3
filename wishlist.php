<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeMarket | Dashboard</title>
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/global.css">
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="index.php">HomeMarket</a>
            </div>
            <ul class="navlinks">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="signout.php">Sign Out</a></li>
            </ul>
        </nav>
    </header>

    <div class="centered">
        <h1>Your wishlist.</h1>
    </div>

    <main>
        <div id="properties-list">

        </div>
    </main>
    <div id="modal" class="modal-container">
        <div class="modal-content">
            <button onclick="closeModal()" class="close-button">&times;</button>
            <div id="image" class="modal-left">
            </div>
            <div id=" model-content" class="modal-right">
                <div class="property-glance">
                    <h3>Price</h3>
                    <p id="price" class="property-price">$950000</p>
                    <h3>Property Overview</h3>
                    <ul id="specs" class="property-specs">
                        <li><b>3</b> bds</li>
                        <li><b>2.5</b> ba</li>
                        <li><b>2354</b> sqft</li>
                    </ul>
                    <h3>Property Location</h3>
                    <p id="address" class="property-address">123 Sesame St, Clarkston, GA 30000</p>
                    <h3>Seller Description</h3>
                    <p id="summary" class="property_description">Blah blah blah blah blah.</p>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/modal.js"></script>
    <script>
        const user_id = <?php echo $_SESSION['user_id']; ?>;
        const container = document.getElementById("properties-list");

        fetch(`wishlist_data.php?user_id=${user_id}&translate=true`)
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
                data.forEach((property) => {
                    const card = document.createElement("article");
                    card.id = property.id;
                    card.className = "property-card";
                    card.classList.add("wishlisted");
                    card.innerHTML = `
                <button onclick='wishlist(${
					property.id
				}, ${user_id})' class="wish-btn"><span class="wish-icon"><svg viewBox="0 0 24 22">
                            <title>Save this home</title>
                            <path class="HeartIcon__fill" d="M17.3996 6.17511e-05C15.5119 0.00908657 13.7078 0.779206 12.3955 2.13608L11.9995 2.54408L11.6035 2.13608C10.2912 0.779206 8.48708 0.00908657 6.59946 6.17511e-05C5.15317 -0.00630912 3.7479 0.480456 2.61543 1.38007C1.08163 2.60976 0.137114 4.42893 0.0137749 6.39093C-0.109564 8.35294 0.5997 10.2761 1.96743 11.6882L2.51943 12.2522L11.3995 21.3482C11.5575 21.5095 11.7738 21.6004 11.9995 21.6004C12.2253 21.6004 12.4415 21.5095 12.5995 21.3482L21.4796 12.2522L22.0316 11.6882C23.3993 10.2761 24.1086 8.35294 23.9852 6.39093C23.8619 4.42893 22.9174 2.60976 21.3836 1.38007C20.2511 0.480456 18.8458 -0.00630912 17.3996 6.17511e-05Z"></path>
                            <path class="HeartIcon__outline" d="M12.3955 2.13608C13.7078 0.779206 15.5119 0.00908657 17.3996 6.17511e-05C18.8458 -0.00630912 20.2511 0.480456 21.3836 1.38007C22.9174 2.60976 23.8619 4.42893 23.9852 6.39093C24.1086 8.35294 23.3993 10.2761 22.0316 11.6882L21.4796 12.2522L12.5995 21.3482C12.4415 21.5095 12.2253 21.6004 11.9995 21.6004C11.7738 21.6004 11.5575 21.5095 11.3995 21.3482L2.51943 12.2522L1.96743 11.6882C0.5997 10.2761 -0.109564 8.35294 0.0137748 6.39093C0.137114 4.42893 1.08163 2.60976 2.61543 1.38007C3.7479 0.480456 5.15317 -0.00630912 6.59946 6.17511e-05C8.48708 0.00908657 10.2912 0.779206 11.6035 2.13608L11.9995 2.54408L12.3955 2.13608ZM19.8956 3.25208C19.1854 2.69122 18.3045 2.39053 17.3996 2.40008C16.1576 2.41525 14.9717 2.91978 14.0995 3.80409L13.7155 4.21209L12.4315 5.5321C12.1927 5.77011 11.8063 5.77011 11.5675 5.5321L10.2835 4.21209L9.8995 3.80409C9.0273 2.91978 7.84145 2.41525 6.59947 2.40008C5.69165 2.39734 4.81045 2.70661 4.10345 3.27608C3.09352 4.06928 2.47292 5.25804 2.39944 6.54011C2.31914 7.81608 2.78104 9.06669 3.67145 9.98414L4.22345 10.5601L11.9995 18.5162L19.8476 10.5601L20.3996 9.98414C21.2638 9.05458 21.6991 7.80545 21.5996 6.54011C21.5329 5.2495 20.9116 4.05071 19.8956 3.25208Z"></path>
                        </svg></span></button>                    <img src="./img/img${
							property.id
						}.webp" class="property-image">
                    <div class="property-glance">
                        <h3 class="property-price">$${Number(
							property.price
						).toLocaleString()}</h3>
                        <ul class="property-specs">
                            <li><b>${property.beds}</b> bds</li>
                            <li><b>${property.bathrooms}</b> ba</li>
                            <li><b>${property.square_footage}</b> sqft</li>
                        </ul>
                        <p class="property-address">${property.address}, ${
					property.city
				}, ${property.state} ${property.zipcode}</p>
                    </div>
                `;
                    card.addEventListener("click", (e) => {
                        if (!e.target.classList.contains("HeartIcon__fill")) {
                            console.log(card.id);
                            openModal(card.id);
                        }
                    });
                    container.appendChild(card);
                });
            })
            .catch((error) => console.error("Error fetching data:", error));
    </script>

    <script>
        async function wishlist(property_id, user_id) {
            let card = document.getElementById(property_id);
            await fetch(
                    `wishlist_data.php?property_id=${property_id}&user_id=${user_id}`
                )
                .then((response) => response.json())
                .then((data) => {
                    if (data.length > 0) {
                        card.classList.remove("wishlisted");
                        card.remove();
                        // remove from wishlist
                        fetch("wishlist_data.php", {
                            method: "POST",
                            body: JSON.stringify({
                                property_id: property_id,
                                user_id: user_id,
                                modify: "delete",
                            }),
                            headers: {
                                "Content-type": "application/json; charset=UTF-8",
                            },

                        });
                    } else {
                        card.classList.add("wishlisted");
                        // add to wishlist
                        fetch("wishlist_data.php", {
                            method: "POST",
                            body: JSON.stringify({
                                property_id: property_id,
                                user_id: user_id,
                                modify: "add",
                            }),
                            headers: {
                                "Content-type": "application/json; charset=UTF-8",
                            },
                        });
                    }
                })
                .catch((error) => console.error("Error fetching data:", error));
        }
    </script>
</body>

</html>