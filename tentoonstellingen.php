<?php
// Redirect all URLs except the homepage and this page to the homepage with a 302 status code
$request_uri = $_SERVER['REQUEST_URI'];
if ($request_uri !== '/' && $request_uri !== '/index.php' && $request_uri !== '/tentoonstellingen.php') {
    header('Location: /', true, 302);
    exit;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentoonstellingen - Centraal Museum Utrecht</title>
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
            scroll-behavior: smooth;
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
        
        /* Add padding to the main content container to prevent content from being hidden behind the nav */
        .main-container {
            padding-bottom: 70px; /* Ensure enough space for the fixed navigation */
        }
        
        header {
            background-color: white;
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid #eee;
        }
        
        .logo-container {
            position: relative;
            margin-right: 50px;
        }
        
        .logo-circle {
            position: absolute;
            width: 120px;
            height: 120px;
            background-color: var(--primary-color);
            border-radius: 50%;
            right: -40px;
            bottom: -40px;
            z-index: -1;
        }
        
        .logo {
            width: 120px;
            height: auto;
            position: relative;
            z-index: 1;
        }
        
        .header-content {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding: 10px 0;
        }
        
        .header-left {
            display: flex;
            align-items: center;
        }
        
        .exhibition-title {
            font-size: 1.8rem;
            font-weight: 800;
            margin: 0;
            line-height: 1.2;
        }
        
        .exhibition-subtitle {
            font-size: 0.9rem;
            margin-top: 5px;
            max-width: 500px;
        }
        
        .exhibition-section {
            padding: 40px 0;
            border-bottom: 1px solid #eee;
            scroll-margin-top: 120px; /* Increased scroll margin to ensure content is visible below header */
        }
        
        .exhibition-section:last-child {
            border-bottom: none;
        }
        
        .exhibition-image {
            width: 100%;
            height: auto;
            max-height: 400px;
            object-fit: cover;
            border-radius: var(--radius);
            margin-bottom: 20px;
        }
        
        .exhibition-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }
        
        .exhibition-description h2 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        .exhibition-description p {
            margin-bottom: 15px;
            line-height: 1.6;
        }
        
        .key-info {
            background-color: var(--secondary-background);
            padding: 20px;
            border-radius: var(--radius);
        }
        
        .key-info h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 12px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 8px;
        }
        
        .key-info p {
            margin-bottom: 8px;
        }
        
        .key-info-item {
            margin-bottom: 15px;
        }
        
        .key-info-label {
            font-weight: 600;
            display: block;
            margin-bottom: 3px;
        }
        
        .back-to-home {
            position: fixed;
            bottom: 80px; /* Adjusted to be above the navigation bar */
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
            text-decoration: none;
        }
        
        .back-to-home:hover {
            transform: translateY(-5px);
            background-color: #ffed00cc;
        }
        
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
        
        .exhibition-nav {
            background-color: black;
            padding: 15px 0;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 99;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .exhibition-nav ul {
            display: flex;
            justify-content: center;
            gap: 40px;
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        
        .exhibition-nav ul li {
            position: relative;
        }
        
        .exhibition-nav ul li a {
            text-decoration: none;
            color: white;
            font-weight: 500;
            transition: all 0.2s;
            padding: 5px 0;
            display: block;
        }
        
        .exhibition-nav ul li a:hover {
            color: var(--primary-color);
        }
        
        .exhibition-nav ul li.active a {
            color: var(--primary-color);
        }
        
        .exhibition-nav ul li.active::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 0;
            width: 100%;
            height: 4px;
            background-color: var(--primary-color);
            display: block;
        }
        
        @media (max-width: 768px) {
            .exhibition-content {
                grid-template-columns: 1fr;
            }
            
            .header-content {
                flex-direction: row;
                align-items: center;
            }
            
            .header-left {
                flex-direction: row;
                align-items: center;
            }
            
            .logo {
                margin-bottom: 0;
                margin-right: 15px;
                width: 120px;
            }
            
            .exhibition-title {
                font-size: 1.5rem;
            }
            
            .exhibition-subtitle {
                font-size: 0.8rem;
            }
            
            .exhibition-description h2 {
                font-size: 1.5rem;
            }
            
            .exhibition-nav ul {
                gap: 20px;
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .back-to-home {
                bottom: 90px;
            }
        }
        
        @media (max-width: 480px) {
            .exhibition-nav ul {
                gap: 15px;
                font-size: 0.9rem;
            }
            
            .exhibition-title {
                font-size: 1.5rem;
            }
            
            .back-to-home {
                bottom: 100px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="header-left">
                    <div class="logo-container">
                        <a href="index.php">
                            <img src="logo.svg" alt="Centraal Museum Utrecht Logo" class="logo">
                        </a>
                        <div class="logo-circle"></div>
                    </div>
                    <div>
                        <h1 class="exhibition-title">Tentoonstellingen</h1>
                        <p class="exhibition-subtitle">Ontdek de huidige en aankomende tentoonstellingen in het Centraal Museum Utrecht.</p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <div class="exhibition-nav">
        <div class="container">
            <ul>
                <li class="active"><a href="#double-act">Double Act</a></li>
                <li><a href="#utrecht-lokaal">Utrecht Lokaal</a></li>
                <li><a href="#dick-bruna">Atelier Dick Bruna</a></li>
                <li><a href="#de-stijl-revisited">De Stijl Revisited</a></li>
                <li><a href="#abstracte-kunst">Abstracte Kunst in Nederland</a></li>
                <li><a href="#utrecht-eeuwen">Utrecht door de Eeuwen Heen</a></li>
            </ul>
        </div>
    </div>
    
    <div class="container main-container">
        <!-- Nu te zien -->
        <section id="double-act" class="exhibition-section">
            <img src="images/double-act.jpg" alt="Double Act" class="exhibition-image">
            <div class="exhibition-content">
                <div class="exhibition-description">
                    <h2>Double Act</h2>
                    <p>Een unieke tentoonstelling met werken van internationale kunstenaars die samenwerken in duo's. Double Act onderzoekt de dynamiek van artistieke samenwerking en hoe deze de individuele expressie beïnvloedt.</p>
                    <p>De tentoonstelling presenteert werken van bekende kunstenaarsduo's zoals Gilbert & George, Jake & Dinos Chapman en Jeroen Eisinga & Teun Hocks, evenals nieuwe samenwerkingen die speciaal voor deze tentoonstelling zijn gecreëerd.</p>
                    <p>Bezoekers worden uitgenodigd om na te denken over thema's als identiteit, samenwerking en de grenzen van individualiteit in de kunstwereld.</p>
                </div>
                <div class="key-info">
                    <h3>Praktische informatie</h3>
                    <div class="key-info-item">
                        <span class="key-info-label">Periode</span>
                        <p>15 maart - 30 juni 2023</p>
                    </div>
                    <div class="key-info-item">
                        <span class="key-info-label">Locatie</span>
                        <p>Centraal Museum, Zaal 1 & 2</p>
                    </div>
                    <div class="key-info-item">
                        <span class="key-info-label">Curator</span>
                        <p>Dr. Madeleine van der Stap</p>
                    </div>
                    <div class="key-info-item">
                        <span class="key-info-label">Toegang</span>
                        <p>Inbegrepen bij reguliere museumticket</p>
                    </div>
                    <div class="key-info-item">
                        <span class="key-info-label">Rondleidingen</span>
                        <p>Elke zondag om 14:00 uur</p>
                    </div>
                    <a href="index.php#tickets" class="btn mt-4">Tickets kopen</a>
                </div>
            </div>
        </section>
        
        <section id="utrecht-lokaal" class="exhibition-section">
            <img src="images/utrecht-stadsgezicht.jpg" alt="Utrecht Lokaal" class="exhibition-image">
            <div class="exhibition-content">
                <div class="exhibition-description">
                    <h2>Utrecht Lokaal</h2>
                    <p>Utrecht Lokaal is een permanente tentoonstelling die de rijke geschiedenis en kunst van Utrecht belicht. De tentoonstelling neemt bezoekers mee op een reis door de tijd, van de Romeinse nederzetting Trajectum tot de bruisende culturele stad van vandaag.</p>
                    <p>De tentoonstelling bevat archeologische vondsten, historische documenten, schilderijen, foto's en multimedia-installaties die samen het verhaal van Utrecht vertellen. Bijzondere aandacht gaat uit naar de rol van Utrecht als religieus centrum, met de Dom als iconisch symbool, en de ontwikkeling van de stad als cultureel en intellectueel knooppunt.</p>
                    <p>Utrecht Lokaal is een must-see voor zowel bezoekers als inwoners van Utrecht die meer willen weten over de geschiedenis en culturele identiteit van deze bijzondere stad.</p>
                </div>
                <div class="key-info">
                    <h3>Praktische informatie</h3>
                    <div class="key-info-item">
                        <span class="key-info-label">Type</span>
                        <p>Permanente tentoonstelling</p>
                    </div>
                    <div class="key-info-item">
                        <span class="key-info-label">Locatie</span>
                        <p>Centraal Museum, Zaal 3</p>
                    </div>
                    <div class="key-info-item">
                        <span class="key-info-label">Curator</span>
                        <p>Dr. Bart Rutten</p>
                    </div>
                    <div class="key-info-item">
                        <span class="key-info-label">Toegang</span>
                        <p>Inbegrepen bij reguliere museumticket</p>
                    </div>
                    <div class="key-info-item">
                        <span class="key-info-label">Rondleidingen</span>
                        <p>Elke zaterdag om 13:00 uur</p>
                    </div>
                    <a href="index.php#tickets" class="btn mt-4">Tickets kopen</a>
                </div>
            </div>
        </section>
        
        <section id="dick-bruna" class="exhibition-section">
            <img src="images/dick-bruna.jpg" alt="Atelier Dick Bruna" class="exhibition-image">
            <div class="exhibition-content">
                <div class="exhibition-description">
                    <h2>Atelier Dick Bruna</h2>
                    <p>Bezoek het atelier van de wereldberoemde kunstenaar Dick Bruna, de schepper van Nijntje (internationaal bekend als Miffy). Het atelier is zorgvuldig gereconstrueerd en biedt een unieke inkijk in het creatieve proces van deze iconische Nederlandse illustrator en schrijver.</p>
                    <p>In het atelier zijn originele tekeningen, schetsen, boeken en persoonlijke voorwerpen te zien die Bruna's werkwijze en inspiratiebronnen illustreren. Bezoekers kunnen zien hoe Bruna's kenmerkende stijl - gekenmerkt door eenvoudige lijnen, primaire kleuren en sterke composities - tot stand kwam.</p>
                    <p>De tentoonstelling belicht ook Bruna's invloed op de wereld van illustratie, grafisch ontwerp en kinderliteratuur, en toont hoe zijn werk wereldwijd generaties heeft geïnspireerd.</p>
                </div>
                <div class="key-info">
                    <h3>Praktische informatie</h3>
                    <div class="key-info-item">
                        <span class="key-info-label">Type</span>
                        <p>Permanente tentoonstelling</p>
                    </div>
                    <div class="key-info-item">
                        <span class="key-info-label">Locatie</span>
                        <p>Centraal Museum, Zaal 4</p>
                    </div>
                    <div class="key-info-item">
                        <span class="key-info-label">Curator</span>
                        <p>Femke Diercks</p>
                    </div>
                    <div class="key-info-item">
                        <span class="key-info-label">Toegang</span>
                        <p>Inbegrepen bij reguliere museumticket</p>
                    </div>
                    <div class="key-info-item">
                        <span class="key-info-label">Geschikt voor</span>
                        <p>Alle leeftijden, speciaal programma voor kinderen beschikbaar</p>
                    </div>
                    <a href="index.php#tickets" class="btn mt-4">Tickets kopen</a>
                </div>
            </div>
        </section>
        
        <!-- Verwacht -->
        <section id="de-stijl-revisited" class="exhibition-section">
            <img src="images/de-stijl.jpg" alt="De Stijl Revisited" class="exhibition-image">
            <div class="exhibition-content">
                <div class="exhibition-description">
                    <h2>De Stijl Revisited</h2>
                    <p>Een nieuwe kijk op de invloedrijke kunstbeweging De Stijl, die in 1917 in Nederland ontstond en wereldwijd grote invloed heeft gehad op kunst, architectuur en design. Deze tentoonstelling biedt een frisse interpretatie van deze revolutionaire beweging en haar blijvende relevantie in de hedendaagse kunst en design.</p>
                    <p>De tentoonstelling presenteert iconische werken van Piet Mondriaan, Theo van Doesburg en Gerrit Rietveld naast werken van hedendaagse kunstenaars die door De Stijl zijn beïnvloed. Bezoekers kunnen de evolutie van de kenmerkende abstracte stijl, met zijn primaire kleuren en rechte lijnen, verkennen en zien hoe deze principes nog steeds resoneren in de hedendaagse visuele cultuur.</p>
                    <p>De Stijl Revisited onderzoekt ook de filosofische en utopische idealen achter de beweging en hoe deze hebben bijgedragen aan de ontwikkeling van het modernisme in de 20e eeuw.</p>
                </div>
                <div class="key-info">
                    <h3>Praktische informatie</h3>
                    <div class="key-info-item">
                        <span class="key-info-label">Periode</span>
                        <p>Vanaf 15 oktober 2023</p>
                    </div>
                    <div class="key-info-item">
                        <span class="key-info-label">Locatie</span>
                        <p>Centraal Museum, Zaal 5 & 6</p>
                    </div>
                    <div class="key-info-item">
                        <span class="key-info-label">Curator</span>
                        <p>Prof. Dr. Hans Janssen</p>
                    </div>
                    <div class="key-info-item">
                        <span class="key-info-label">Toegang</span>
                        <p>Inbegrepen bij reguliere museumticket</p>
                    </div>
                    <div class="key-info-item">
                        <span class="key-info-label">Catalogus</span>
                        <p>Beschikbaar in de museumwinkel (€29,95)</p>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="abstracte-kunst" class="exhibition-section">
            <img src="images/abstractie.jpg" alt="Abstracte Kunst in Nederland" class="exhibition-image">
            <div class="exhibition-content">
                <div class="exhibition-description">
                    <h2>Abstracte Kunst in Nederland</h2>
                    <p>Een overzicht van de ontwikkeling van abstracte kunst in Nederland vanaf het begin van de 20e eeuw tot heden. Deze tentoonstelling belicht de rijke traditie van abstractie in de Nederlandse kunst en de unieke bijdrage van Nederlandse kunstenaars aan deze internationale beweging.</p>
                    <p>De tentoonstelling omvat werken van pioniers zoals Piet Mondriaan en Theo van Doesburg, naoorlogse abstracte expressionisten zoals Karel Appel en Constant Nieuwenhuys, en hedendaagse kunstenaars die de grenzen van abstractie blijven verleggen.</p>
                    <p>Bezoekers kunnen de evolutie van abstracte kunst verkennen door verschillende stromingen en technieken, van geometrische abstractie tot lyrische abstractie, en zien hoe Nederlandse kunstenaars hebben bijgedragen aan de voortdurende vernieuwing van deze kunstvorm.</p>
                </div>
                <div class="key-info">
                    <h3>Praktische informatie</h3>
                    <div class="key-info-item">
                        <span class="key-info-label">Periode</span>
                        <p>Vanaf 1 november 2023</p>
                    </div>
                    <div class="key-info-item">
                        <span class="key-info-label">Locatie</span>
                        <p>Centraal Museum, Zaal 7</p>
                    </div>
                    <div class="key-info-item">
                        <span class="key-info-label">Curator</span>
                        <p>Dr. Margriet Schavemaker</p>
                    </div>
                    <div class="key-info-item">
                        <span class="key-info-label">Toegang</span>
                        <p>Inbegrepen bij reguliere museumticket</p>
                    </div>
                    <div class="key-info-item">
                        <span class="key-info-label">Workshops</span>
                        <p>Abstracte schilderworkshops beschikbaar voor groepen</p>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="utrecht-eeuwen" class="exhibition-section">
            <img src="images/utrecht-stadsgezicht.jpg" alt="Utrecht door de Eeuwen Heen" class="exhibition-image">
            <div class="exhibition-content">
                <div class="exhibition-description">
                    <h2>Utrecht door de Eeuwen Heen</h2>
                    <p>Een historisch overzicht van de stad Utrecht in kunst, van middeleeuwse manuscripten tot hedendaagse fotografie. Deze tentoonstelling biedt een visuele reis door de geschiedenis van Utrecht en toont hoe de stad door de eeuwen heen is vastgelegd en geïnterpreteerd door kunstenaars.</p>
                    <p>De tentoonstelling bevat stadsgezichten, portretten van belangrijke Utrechtse figuren, historische kaarten en documenten, en hedendaagse interpretaties van de stad. Bezoekers kunnen zien hoe Utrecht is veranderd en toch herkenbaar is gebleven, met iconische elementen zoals de Domtoren die als constante aanwezigheid door de geschiedenis heen loopt.</p>
                    <p>Utrecht door de Eeuwen Heen belicht ook belangrijke historische gebeurtenissen en ontwikkelingen die de stad hebben gevormd, van de Vrede van Utrecht in 1713 tot de wederopbouw na de Tweede Wereldoorlog en de moderne stadsontwikkeling.</p>
                </div>
                <div class="key-info">
                    <h3>Praktische informatie</h3>
                    <div class="key-info-item">
                        <span class="key-info-label">Periode</span>
                        <p>Vanaf 15 december 2023</p>
                    </div>
                    <div class="key-info-item">
                        <span class="key-info-label">Locatie</span>
                        <p>Centraal Museum, Zaal 8</p>
                    </div>
                    <div class="key-info-item">
                        <span class="key-info-label">Curator</span>
                        <p>Dr. Liesbeth Helmus</p>
                    </div>
                    <div class="key-info-item">
                        <span class="key-info-label">Toegang</span>
                        <p>Inbegrepen bij reguliere museumticket</p>
                    </div>
                    <div class="key-info-item">
                        <span class="key-info-label">Stadswandelingen</span>
                        <p>In combinatie met de tentoonstelling worden historische stadswandelingen aangeboden</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <a href="index.php" class="back-to-home" aria-label="Terug naar homepage">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
            <polyline points="9 22 9 12 15 12 15 22"></polyline>
        </svg>
    </a>
    
    <script>
        // Scroll naar het juiste anker bij het laden van de pagina
        document.addEventListener('DOMContentLoaded', function() {
            // Haal het fragment (anker) uit de URL
            const hash = window.location.hash;
            if (hash) {
                // Wacht even zodat de pagina volledig geladen is
                setTimeout(function() {
                    // Scroll naar het element met een offset voor de sticky header
                    const targetElement = document.querySelector(hash);
                    if (targetElement) {
                        const headerHeight = document.querySelector('header').offsetHeight;
                        const navHeight = document.querySelector('.exhibition-nav').offsetHeight;
                        const offset = headerHeight + 60; // Significantly increased offset to ensure content is fully visible
                        
                        window.scrollTo({
                            top: targetElement.offsetTop - offset,
                            behavior: 'smooth'
                        });
                    }
                }, 100);
            }
            
            // Update active class based on scroll position
            const sections = document.querySelectorAll('.exhibition-section');
            const navItems = document.querySelectorAll('.exhibition-nav ul li');
            
            function updateActiveNavItem() {
                const scrollPosition = window.scrollY;
                const headerHeight = document.querySelector('header').offsetHeight;
                
                sections.forEach((section, index) => {
                    const sectionTop = section.offsetTop - headerHeight - 150; // Increased offset for better detection
                    const sectionBottom = sectionTop + section.offsetHeight;
                    
                    if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                        navItems.forEach(item => item.classList.remove('active'));
                        navItems[index].classList.add('active');
                    }
                });
            }
            
            // Add click event listeners to navigation links for smooth scrolling with proper offset
            document.querySelectorAll('.exhibition-nav ul li a').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);
                    
                    if (targetElement) {
                        const headerHeight = document.querySelector('header').offsetHeight;
                        const offset = headerHeight + 60; // Same increased offset as above
                        
                        window.scrollTo({
                            top: targetElement.offsetTop - offset,
                            behavior: 'smooth'
                        });
                        
                        // Update URL without scrolling
                        history.pushState(null, null, targetId);
                        
                        // Update active class
                        document.querySelectorAll('.exhibition-nav ul li').forEach(item => item.classList.remove('active'));
                        this.parentElement.classList.add('active');
                    }
                });
            });
            
            window.addEventListener('scroll', updateActiveNavItem);
            updateActiveNavItem(); // Run once on page load
        });
    </script>
</body>
</html> 