# Samenvatting PHP Conversie

## Wat is er gedaan?

We hebben de statische HTML-website omgezet naar een dynamische PHP-website met de volgende verbeteringen:

1. **Modulaire structuur**
   - Header en footer zijn nu herbruikbare componenten
   - Elke pagina heeft zijn eigen PHP-bestand
   - CSS is verplaatst naar een apart bestand

2. **Dynamische navigatie**
   - Actieve pagina wordt automatisch gemarkeerd in de navigatie
   - Links zijn dynamisch en gebruiken de PHP-routing

3. **Routing systeem**
   - Eenvoudig routing systeem via GET-parameters
   - Alle pagina's worden geladen via index.php
   - Veilige verwerking van pagina-parameters

4. **Dynamische tentoonstellingen**
   - Tentoonstellingen worden dynamisch geladen
   - Detailpagina's worden gegenereerd op basis van ID

5. **Moderne ontwikkelomgeving**
   - .htaccess bestand voor server-configuratie
   - Installatie-instructies voor verschillende besturingssystemen
   - Documentatie in README.md

## Voordelen van de PHP-versie

- **Onderhoudsvriendelijker**: Wijzigingen in header of footer hoeven maar op één plek te worden doorgevoerd
- **Schaalbaarder**: Eenvoudig nieuwe pagina's toevoegen zonder code te dupliceren
- **Dynamischer**: Content kan dynamisch worden geladen, in de toekomst mogelijk vanuit een database
- **Veiliger**: Betere controle over gebruikersinvoer en bestandsinclusie
- **Toekomstbestendiger**: Eenvoudiger om nieuwe functionaliteiten toe te voegen

## Volgende stappen

- Database-integratie voor dynamische content
- Admin-panel voor contentbeheer
- Meertalige ondersteuning
- Nieuwsbrief-integratie
- Online ticketverkoop met betalingsverwerking 