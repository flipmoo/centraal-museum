# Centraal Museum Utrecht Website

Dit is de website van het Centraal Museum Utrecht, gebouwd met PHP.

## Projectstructuur

```
├── index.php              # Hoofdbestand met routing
├── includes/              # Herbruikbare componenten
│   ├── header.php         # Header met navigatie
│   └── footer.php         # Footer
├── pages/                 # Pagina's
│   ├── home.php           # Homepage
│   ├── tentoonstellingen.php  # Tentoonstellingen pagina
│   ├── collectie.php      # Collectie pagina
│   ├── bezoek.php         # Bezoek pagina
│   ├── over-ons.php       # Over ons pagina
│   └── tickets.php        # Tickets pagina
├── css/                   # CSS bestanden
│   └── style.css          # Hoofdstijlbestand
├── js/                    # JavaScript bestanden
│   └── main.js            # Hoofdscript
├── images/                # Afbeeldingen
└── placeholders/          # Placeholder bestanden
```

## Installatie

1. Zorg ervoor dat je een webserver hebt met PHP ondersteuning (bijvoorbeeld Apache of Nginx)
2. Kopieer alle bestanden naar de webroot van je server
3. Navigeer naar de website in je browser

## Functionaliteiten

- Responsive design met Tailwind CSS
- Dynamische pagina's met PHP
- Eenvoudig routingsysteem
- Tentoonstellingen overzicht en detailpagina's
- Collectie overzicht
- Bezoekersinfo
- Ticketverkoop formulier
- Over ons pagina

## Ontwikkeling

### Vereisten

- PHP 7.4 of hoger
- Webserver (Apache, Nginx, etc.)

### Lokaal ontwikkelen

1. Installeer een lokale webserver zoals XAMPP, MAMP of WAMP
2. Kopieer de bestanden naar de htdocs of www map
3. Start de webserver
4. Navigeer naar `http://localhost/centraal-museum` in je browser

## Toekomstige verbeteringen

- Database integratie voor dynamische content
- Admin panel voor contentbeheer
- Meertalige ondersteuning
- Nieuwsbrief integratie
- Online ticketverkoop met betalingsverwerking

## Licentie

Alle rechten voorbehouden © Centraal Museum Utrecht 