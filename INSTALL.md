# Installatie Handleiding

## PHP Installeren

### macOS

1. **Installeer Homebrew (indien nog niet geïnstalleerd)**
   ```
   /bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
   ```

2. **Installeer PHP**
   ```
   brew install php
   ```

3. **Controleer de installatie**
   ```
   php -v
   ```

### Windows

1. **Download PHP**
   - Ga naar [windows.php.net/download](https://windows.php.net/download/)
   - Download de nieuwste Thread Safe ZIP-versie (x64 of x86, afhankelijk van je systeem)

2. **Installeer PHP**
   - Pak het ZIP-bestand uit naar een map (bijv. `C:\php`)
   - Voeg deze map toe aan je PATH-omgevingsvariabele
   - Maak een kopie van `php.ini-development` en hernoem het naar `php.ini`

3. **Controleer de installatie**
   ```
   php -v
   ```

### Linux (Ubuntu/Debian)

1. **Installeer PHP**
   ```
   sudo apt update
   sudo apt install php php-cli php-fpm php-json php-common php-mysql php-zip php-gd php-mbstring php-curl php-xml php-pear php-bcmath
   ```

2. **Controleer de installatie**
   ```
   php -v
   ```

## Lokale Webserver Starten

Nadat PHP is geïnstalleerd, kun je een lokale webserver starten met:

```
php -S localhost:8000
```

Open vervolgens je browser en ga naar `http://localhost:8000` om de website te bekijken.

## Alternatief: XAMPP/MAMP/WAMP

Als alternatief kun je een all-in-one pakket installeren:

### XAMPP
- Download van [apachefriends.org](https://www.apachefriends.org/index.html)
- Installeer en start Apache en MySQL
- Plaats de website in de `htdocs` map

### MAMP (macOS)
- Download van [mamp.info](https://www.mamp.info/)
- Installeer en start de servers
- Plaats de website in de `htdocs` map

### WAMP (Windows)
- Download van [wampserver.com](https://www.wampserver.com/en/)
- Installeer en start de servers
- Plaats de website in de `www` map 