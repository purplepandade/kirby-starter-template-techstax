# Kirby Template Dokumentation

Dieses Repository enthält ein Kirby Template, das als Vorlage für zukünftige Projekte unserer Agentur dient.

## Inhaltsverzeichnis

- [Inhalt des Templates](#inhalt-des-templates)
  - [Controllers](#controllers)
  - [Konfiguration](#konfiguration)
  - [Snippets](#snippets)
- [Assets](#assets)
  - [Favicon](#favicon)
  - [Schriftarten](#schriftarten)
  - [CSS](#css)
  - [Branding](#branding)
  - [Bereits vorhandene Assets](#bereits-vorhandene-assets)

## Inhalt des Templates

Das Kirby Template enthält die folgenden Hauptkomponenten:

### Controllers

1. `site/controllers/job.php`: Dieser Controller ist für Bewerbungen zuständig.

2. `site/controllers/kontakt.php`: Dieser Controller ist für das Kontaktformular verantwortlich.

### Konfiguration

1. `site/config/config.php`: In dieser Datei können Sie die Konfiguration für ausgehende E-Mails einrichten.

### Snippets

Im Verzeichnis `/site/snippets` finden Sie wichtige Snippets, darunter:

- `header.php`: Das Header-Snippet.
- `footer.php`: Das Footer-Snippet.
- `htmlhead.php`: Das HTML-Head-Snippet.
- `kontaktformular.php`: Das Snippet für das Kontaktformular.
- `bewerbungsformular.php`: Das Snippet für das Bewerbungsformular.

## Assets

Das `/assets`-Verzeichnis ist für statische Ressourcen vorgesehen und enthält:

### Favicon

Legen Sie ein gültiges Favicon in diesem Verzeichnis ab. Ein Plugin generiert automatisch die benötigten Größen.

### Schriftarten

Im Verzeichnis `/fonts` können Sie Schriftarten für Ihr Template ablegen.

### CSS

- `root.css`: Dies ist die CSS-Datei für CSS-Variablen.
- `styles.css`: Hier befindet sich die CSS-Datei für Tailwind CSS.

### Branding

Im `/branding`-Verzeichnis finden Sie Assets Ihrer Marke, wie Logos, Pfeile, Vektoren und andere Grafiken.

### Bereits vorhandene Assets

In diesem Template sind bereits einige Assets enthalten:

- `Flickity.js`: Eine JavaScript-Bibliothek für Slider.
- `lazysizes.js`: Ein JavaScript-Plugin für das Lazy Loading von Bildern.
- `theme.js`: Diese Datei enthält benutzerdefinierte Komponenten und JavaScript-Code für die Navigation und andere Funktionen.

Das sind die wichtigsten Komponenten dieses Kirby Templates. Sie können dieses Template als Ausgangspunkt für zukünftige Projekte unserer Agentur verwenden, indem Sie die entsprechenden Controller, Konfigurationen und Assets anpassen und erweitern.


Sie können PHP verwenden, um Flickity mit benutzerdefinierten Einstellungen zu konfigurieren. Hier ist ein Beispiel für die Verwendung von PHP, um Flickity zu konfigurieren:

```php
$flickity = (object) [
    'wrapAround' => true,
    'prevNextButtons' => false,
    'adaptiveHeight' => true,
    'pageDots' => true,
    'imagesLoaded' => true,
    'lazyLoad' => true,
    'contain' => true
];


```html
data-flickity-config='<?= json_encode($flickity) ?>
