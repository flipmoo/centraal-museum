<?php
// Redirect all URLs except the homepage to the homepage with a 302 status code
$request_uri = $_SERVER['REQUEST_URI'];
if ($request_uri !== '/' && $request_uri !== '/index.php') {
    header('Location: /', true, 302);
    exit;
}

// Define the current page for navigation highlighting
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Sanitize the page parameter to prevent directory traversal
$page = preg_replace('/[^a-zA-Z0-9_-]/', '', $page);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centraal Museum Utrecht</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        :root {
            --primary-color: #ffed00; /* Bright yellow from the logo */
            --text-color: #000000;
            --background-color: #ffffff;
            --secondary-background: #f5f5f5;
            --max-width: 1200px; /* Maximum width for the container */
            --radius: 0.5rem;
            --font-sans: 'Inter', -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Oxygen, Ubuntu, Cantarell, Fira Sans, Droid Sans, Helvetica Neue, sans-serif;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: var(--font-sans);
        }
        
        body {
            color: var(--text-color);
            background-color: var(--background-color);
        }
        
        .container {
            max-width: var(--max-width);
            margin: 0 auto;
            padding: 0 20px;
        }
        
        header {
            position: relative;
            background-color: white;
            height: 70vh; /* Reduced height */
            overflow: hidden;
            width: 100%;
        }
        
        .header-content {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 10;
        }
        
        .logo-container {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 40px;
        }
        
        .logo {
            position: relative;
            z-index: 2;
            width: 300px;
            height: auto;
            margin-left: -20px; /* Verschuif het logo iets naar links */
        }
        
        .hero-image {
            position: absolute;
            top: 0;
            right: 0;
            width: 70%;
            height: 100%;
            object-fit: cover;
        }
        
        nav {
            padding: 0 40px;
            margin-top: 120px; /* Aangepast om beter bij het nieuwe logo te passen */
            max-width: 300px;
        }
        
        nav ul {
            list-style-type: none;
        }
        
        nav ul li {
            margin: 15px 0;
            padding-bottom: 10px;
            position: relative;
        }
        
        nav ul li::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 1px;
            background-color: #eee;
        }
        
        nav ul li a {
            text-decoration: none;
            color: var(--text-color);
            display: flex;
            align-items: center;
            font-size: 18px;
            position: relative;
            width: fit-content;
        }
        
        nav ul li a::before {
            content: "›";
            margin-right: 10px;
        }
        
        nav ul li a::after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 100%;
            height: 1px;
            background-color: var(--text-color);
        }
        
        .exhibition-banner {
            background-color: var(--primary-color);
            padding: 40px 0;
            width: 100%;
        }
        
        .banner-content {
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .banner-label {
            display: inline-block;
            background-color: black;
            color: white;
            padding: 5px 15px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        
        .banner-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 15px;
        }
        
        .banner-dates {
            font-size: 1.2rem;
            margin-bottom: 25px;
        }
        
        .banner-button {
            display: inline-block;
            background-color: black;
            color: white;
            padding: 12px 30px;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        
        .banner-button:hover {
            background-color: #333;
        }
        
        .content-section {
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .content-section h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }
        
        .exhibitions {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        /* shadcn/ui inspired card styles */
        .exhibition-card {
            flex: 1 1 300px;
            border-radius: var(--radius);
            background-color: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            overflow: hidden;
            transition: all 0.3s cubic-bezier(.25,.8,.25,1);
        }
        
        .exhibition-card:hover {
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
        }
        
        .exhibition-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .exhibition-card .card-content {
            padding: 20px;
        }
        
        .exhibition-card h3 {
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .exhibition-card p {
            color: #666;
            margin-bottom: 15px;
            line-height: 1.5;
        }
        
        .exhibition-card a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius);
            font-weight: 500;
            text-decoration: none;
            color: var(--text-color);
            background-color: var(--primary-color);
            padding: 8px 16px;
            transition: background-color 0.2s;
        }
        
        .exhibition-card a:hover {
            background-color: #e6d600;
        }
        
        .contact-info {
            background-color: var(--secondary-background);
            padding: 30px;
            margin-bottom: 30px;
            border-radius: var(--radius);
        }
        
        .sponsors {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 30px 0;
            flex-wrap: wrap;
        }
        
        .sponsor {
            flex: 1 1 200px;
            text-align: center;
            padding: 15px;
        }
        
        .sponsor img {
            max-width: 150px;
            height: auto;
            filter: grayscale(100%);
            opacity: 0.7;
            transition: all 0.3s ease;
        }
        
        .sponsor img:hover {
            filter: grayscale(0%);
            opacity: 1;
        }
        
        /* shadcn/ui inspired button */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius);
            font-weight: 500;
            text-decoration: none;
            color: var(--text-color);
            background-color: var(--primary-color);
            padding: 10px 20px;
            transition: background-color 0.2s;
            border: none;
            cursor: pointer;
        }
        
        .btn:hover {
            background-color: #e6d600;
        }
        
        /* Full-width sections */
        .full-width {
            width: 100%;
            max-width: 100%;
            padding-left: 0;
            padding-right: 0;
        }
        
        .full-width-inner {
            max-width: var(--max-width);
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Galerij styling */
        .gallery {
            margin-top: 40px;
        }
        
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .gallery-item {
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        
        .gallery-item:hover {
            transform: translateY(-5px);
        }
        
        .gallery-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .gallery-caption {
            padding: 15px;
            background-color: white;
        }
        
        .gallery-title {
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .gallery-artist {
            font-size: 0.9rem;
            color: #666;
        }
        
        /* Kaart styling */
        .map-container {
            margin-top: 40px;
        }
        
        .map {
            position: relative;
        }
        
        .map-link {
            display: inline-block;
            margin-top: 10px;
            color: #333;
            text-decoration: none;
            font-weight: 500;
        }
        
        .map-link:hover {
            text-decoration: underline;
        }
        
        /* Terug naar boven knop */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background-color: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: black;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 100;
            transition: transform 0.3s, background-color 0.3s;
        }
        
        .back-to-top:hover {
            transform: translateY(-5px);
            background-color: #ffed00cc;
        }
        
        /* Responsive design */
        @media (max-width: 1024px) {
            header {
                height: 60vh;
            }
            
            .hero-image {
                width: 60%;
            }
        }
        
        @media (max-width: 768px) {
            header {
                height: auto;
                min-height: 500px;
            }
            
            .hero-image {
                width: 100%;
                height: 100%;
                opacity: 0.3; /* Maak de afbeelding transparanter op kleinere schermen */
            }
            
            .logo {
                width: 250px;
            }
            
            nav {
                margin-top: 80px;
                max-width: 100%;
            }
            
            .footer-section {
                flex: 0 0 100%;
                margin-bottom: 30px;
            }
            
            .banner-title {
                font-size: 2rem;
            }
            
            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 480px) {
            .logo-container {
                padding: 20px;
            }
            
            .logo {
                width: 200px;
            }
            
            nav {
                padding: 0 20px;
                margin-top: 60px;
            }
            
            nav ul li a {
                font-size: 1rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
            
            .banner-title {
                font-size: 1.5rem;
            }
            
            .banner-dates {
                font-size: 1rem;
            }
            
            .banner-button {
                padding: 10px 20px;
            }
            
            .gallery-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo-container">
                <img src="logo.svg" alt="Centraal Museum Utrecht Logo" class="logo">
            </div>
            
            <nav>
                <ul>
                    <li><a href="#tickets">Tickets</a></li>
                    <li><a href="#nu-te-zien">Nu te zien</a></li>
                    <li><a href="#openingstijden">Openingstijden & info</a></li>
                </ul>
            </nav>
        </div>
        
        <img class="hero-image" src="images/hero.jpeg" alt="Centraal Museum tentoonstelling">
    </header>
    
    <div class="exhibition-banner">
        <div class="container">
            <div class="banner-content">
                <span class="banner-label">Nu te zien</span>
                <h2 class="banner-title">Utrechtse Meesters: Kunst door de Eeuwen Heen</h2>
                <p class="banner-dates">15 juni - 30 september 2023</p>
            </div>
        </div>
    </div>
    
    <div class="container">
        <section id="nu-te-zien" class="content-section">
            <h2>Nu te zien en te doen</h2>
            <div class="exhibitions">
                <div class="exhibition-card">
                    <img src="images/double-act.jpg" alt="Double Act">
                    <div class="card-content">
                        <h3>Double Act</h3>
                        <p>Een unieke tentoonstelling met werken van internationale kunstenaars.</p>
                    </div>
                </div>
                <div class="exhibition-card">
                    <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iNDAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI2YyZjJmMiIvPjxjaXJjbGUgY3g9IjIwMCIgY3k9IjEwMCIgcj0iNTAiIGZpbGw9IiNmZmVkMDAiLz48dGV4dCB4PSIyMDAiIHk9IjEwMCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjI0IiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBkb21pbmFudC1iYXNlbGluZT0ibWlkZGxlIiBmaWxsPSIjMzMzIj5VdHJlY2h0IExva2FhbDwvdGV4dD48L3N2Zz4=" alt="Utrecht Lokaal">
                    <div class="card-content">
                        <h3>Utrecht Lokaal</h3>
                        <p>Ontdek de rijke geschiedenis en kunst van Utrecht.</p>
                    </div>
                </div>
                <div class="exhibition-card">
                    <img src="images/dick-bruna.jpg" alt="Atelier Dick Bruna">
                    <div class="card-content">
                        <h3>Atelier Dick Bruna</h3>
                        <p>Bezoek het atelier van de wereldberoemde kunstenaar Dick Bruna.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="collectie-highlights" class="content-section">
            <h2>Collectie Highlights</h2>
            <div class="gallery">
                <div class="gallery-grid">
                    <div class="gallery-item">
                        <img src="images/de-stijl.jpg" alt="De Stijl" class="gallery-image">
                        <div class="gallery-caption">
                            <h3 class="gallery-title">De Stijl</h3>
                            <p class="gallery-artist">Gerrit Rietveld, Piet Mondriaan</p>
                        </div>
                    </div>
                    <div class="gallery-item">
                        <img src="images/nijntje.jpg" alt="Nijntje" class="gallery-image">
                        <div class="gallery-caption">
                            <h3 class="gallery-title">Nijntje</h3>
                            <p class="gallery-artist">Dick Bruna</p>
                        </div>
                    </div>
                    <div class="gallery-item">
                        <img src="images/utrecht-stadsgezicht.jpg" alt="Utrecht Stadsgezicht" class="gallery-image">
                        <div class="gallery-caption">
                            <h3 class="gallery-title">Utrecht Stadsgezicht</h3>
                            <p class="gallery-artist">Jan van Goyen</p>
                        </div>
                    </div>
                    <div class="gallery-item">
                        <img src="images/abstractie.jpg" alt="Abstractie" class="gallery-image">
                        <div class="gallery-caption">
                            <h3 class="gallery-title">Abstractie</h3>
                            <p class="gallery-artist">Theo van Doesburg</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="openingstijden" class="content-section">
            <h2>Openingstijden en praktische informatie</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-3">Openingstijden</h3>
                    <p class="mb-2">Dinsdag t/m zondag: 11:00 - 17:00 uur</p>
                    <p class="mb-2">Maandag: gesloten</p>
                    <p>Feestdagen: zie website</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-3">Adres</h3>
                    <p class="mb-2">Agnietenstraat 1</p>
                    <p class="mb-2">3512 XA Utrecht</p>
                    
                    <h3 class="text-lg font-semibold mb-3 mt-4">Bereikbaarheid</h3>
                    <p class="mb-2">Het museum is goed bereikbaar met het openbaar vervoer en de auto.</p>
                    <p>Meer informatie over bereikbaarheid en parkeren vindt u op onze website.</p>
                </div>
            </div>
        </section>
        
        <section id="tickets" class="content-section">
            <h2>Tickets</h2>
            <div class="bg-white p-6 rounded-lg shadow mt-4">
                <p class="mb-4">Bestel uw tickets online en vermijd wachtrijen bij de kassa.</p>
                <a href="#" class="btn">Tickets kopen</a>
            </div>
        </section>
        
        <section class="contact-info">
            <h2 class="text-xl font-semibold mb-4">Contact</h2>
            <p class="mb-2">Voor algemene vragen: <a href="mailto:info@centraalmuseum.nl" class="text-blue-600 hover:underline">info@centraalmuseum.nl</a></p>
            <p class="mb-4">Telefoonnummer: <a href="tel:+31302362362" class="text-blue-600 hover:underline">030 - 236 23 62</a></p>
            
            <h3 class="text-lg font-semibold mb-3 mt-4">Rondleidingen en schoolprogramma's</h3>
            <p class="mb-2">Voor aanvragen van rondleidingen of informatie over schoolprogramma's:</p>
            <p class="mb-2">E-mail: <a href="mailto:rondleidingen@centraalmuseum.nl" class="text-blue-600 hover:underline">rondleidingen@centraalmuseum.nl</a></p>
            <p class="mb-4">Telefoonnummer: <a href="tel:+31302362399" class="text-blue-600 hover:underline">030 - 236 23 99</a></p>
            
            <h3 class="text-lg font-semibold mb-3">Volg ons</h3>
            <div class="social-media">
                <span>Facebook</span>
                <span>Instagram</span>
                <span>Twitter</span>
                <span>YouTube</span>
            </div>
        </section>
        
        <section class="sponsors">
            <h2 style="width: 100%; text-align: center; margin-bottom: 20px;">Onze sponsoren</h2>
            <div class="sponsor">
                <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzIwIiBoZWlnaHQ9IjEwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMzIwIiBoZWlnaHQ9IjEwMCIgZmlsbD0iI2YyZjJmMiIvPjx0ZXh0IHg9IjE2MCIgeT0iNTAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIyNCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZG9taW5hbnQtYmFzZWxpbmU9Im1pZGRsZSIgZmlsbD0iIzU1NSI+U3BvbnNvciAxPC90ZXh0Pjwvc3ZnPg==" alt="Sponsor 1">
            </div>
            <div class="sponsor">
                <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzIwIiBoZWlnaHQ9IjEwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMzIwIiBoZWlnaHQ9IjEwMCIgZmlsbD0iI2YyZjJmMiIvPjx0ZXh0IHg9IjE2MCIgeT0iNTAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIyNCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZG9taW5hbnQtYmFzZWxpbmU9Im1pZGRsZSIgZmlsbD0iIzU1NSI+U3BvbnNvciAyPC90ZXh0Pjwvc3ZnPg==" alt="Sponsor 2">
            </div>
            <div class="sponsor">
                <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzIwIiBoZWlnaHQ9IjEwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMzIwIiBoZWlnaHQ9IjEwMCIgZmlsbD0iI2YyZjJmMiIvPjx0ZXh0IHg9IjE2MCIgeT0iNTAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIyNCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZG9taW5hbnQtYmFzZWxpbmU9Im1pZGRsZSIgZmlsbD0iIzU1NSI+U3BvbnNvciAzPC90ZXh0Pjwvc3ZnPg==" alt="Sponsor 3">
            </div>
        </section>
        
        <section id="bezoek" class="section">
            <h2 class="section-title">Bezoek</h2>
            <div class="section-content">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-xl font-semibold mb-3">Openingstijden</h3>
                        <p>Dinsdag t/m zondag: 11:00 - 17:00 uur<br>
                        Maandag: Gesloten</p>
                        
                        <h3 class="text-xl font-semibold mt-6 mb-3">Toegangsprijzen</h3>
                        <p>Volwassenen: €15,00<br>
                        Studenten: €7,50<br>
                        Kinderen (t/m 12 jaar): Gratis<br>
                        Museumkaart: Gratis</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-3">Adres</h3>
                        <p>Agnietenstraat 1<br>
                        3512 XA Utrecht</p>
                        
                        <h3 class="text-xl font-semibold mt-6 mb-3">Contact</h3>
                        <p>Telefoon: 030 236 2362<br>
                        Email: info@centraalmuseum.nl</p>
                    </div>
                </div>
                
                <div class="map-container mt-8">
                    <h3 class="text-xl font-semibold mb-3">Locatie</h3>
                    <div class="map">
                        <iframe 
                            width="100%" 
                            height="400" 
                            frameborder="0" 
                            scrolling="no" 
                            marginheight="0" 
                            marginwidth="0" 
                            src="https://www.openstreetmap.org/export/embed.html?bbox=5.1193%2C52.0835%2C5.1293%2C52.0885&amp;layer=mapnik&amp;marker=52.086%2C5.1243" 
                            style="border: 1px solid #ddd; border-radius: var(--radius);">
                        </iframe>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <footer class="full-width">
        <div class="full-width-inner">
            <div class="footer-links">
                <div class="footer-column">
                    <h3>Centraal Museum</h3>
                    <ul>
                        <li><a href="#over-ons">Over ons</a></li>
                        <li><a href="#">Vacatures</a></li>
                        <li><a href="#">Jaarverslag</a></li>
                        <li><a href="#">ANBI-verklaring</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Bezoek</h3>
                    <ul>
                        <li><a href="#openingstijden">Openingstijden</a></li>
                        <li><a href="#">Bereikbaarheid</a></li>
                        <li><a href="#">Toegankelijkheid</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Contact</h3>
                    <p>Agnietenstraat 1</p>
                    <p>3512 XA Utrecht</p>
                    <p>Tel: <a href="tel:+31302362362">030 - 236 23 62</a></p>
                    <p>E-mail: <a href="mailto:info@centraalmuseum.nl">info@centraalmuseum.nl</a></p>
                </div>
            </div>
            <div class="copyright">
                <p>© <?php echo date('Y'); ?> Centraal Museum Utrecht. Alle rechten voorbehouden.</p>
            </div>
        </div>
    </footer>
    
    <style>
        /* Extra footer styling om het meer op de originele versie te laten lijken */
        footer {
            background-color: #f8f8f8;
            padding: 40px 0 20px 0;
            font-size: 14px;
            line-height: 1.6;
        }
        
        .footer-links {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            gap: 40px;
            margin-bottom: 30px;
        }
        
        .footer-column {
            flex: 0 0 auto;
            min-width: 200px;
        }
        
        .footer-column h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .footer-column ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .footer-column ul li {
            margin-bottom: 8px;
            padding: 0;
        }
        
        .footer-column ul li::after {
            display: none;
        }
        
        .footer-column ul li a,
        .footer-column p,
        .footer-column p a {
            text-decoration: none;
            color: #333;
            font-size: 14px;
            transition: color 0.2s;
            display: inline;
            width: auto;
        }
        
        .footer-column ul li a::before,
        .footer-column ul li a::after {
            display: none;
        }
        
        .footer-column ul li a:hover,
        .footer-column p a:hover {
            color: #000;
            text-decoration: underline;
        }
        
        .copyright {
            border-top: 1px solid #eaeaea;
            padding-top: 20px;
            text-align: left;
            color: #666;
            font-size: 13px;
        }
    </style>
    
    <a href="#" class="back-to-top" aria-label="Terug naar boven">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 15l-6-6-6 6"/>
        </svg>
    </a>
</body>
</html>
