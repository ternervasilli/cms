# sitepackage

TYPO3 v14.3.5 Sitepackage-Extension, die das im Kundenscreenshot gezeigte
"Convert"-Landingpage-Design ("A very clear statement of your offer.") als
eigene Fluid-Content-Elemente umsetzt: Hero mit Signup-Box, Intro mit zwei
Benefit-Bildern, Feature-Highlight-Liste, Bilder-Gallery-Strip, FAQ,
Testimonial-Slider, Presse-/Logo-Leiste und CTA-Banner.

## Struktur

```
Classes/DataProcessing/ChildRecordsProcessor.php   IRRE-Kindsätze (Feature-/FAQ-/Testimonial-Items) für Fluid auflösen
Configuration/TCA/...                              TCA für 3 neue Kindtabellen
Configuration/TCA/Overrides/tt_content.php          5 neue CTypes + Felder + Frame-Classes
Configuration/Sets/Sitepackage/                     Site Set: config.yaml, setup/constants.typoscript, page.tsconfig (Backend Layout, Wizard)
Resources/Private/Layouts|Templates|Partials/        Fluid-Templates
Resources/Public/Css/main.css                        Design-Umsetzung (Farben, Typo, Layout)
Resources/Public/JavaScript/main.js                  Header-Scroll-State, Testimonial-Slider
Resources/Public/Icons/                              Extension- und Content-Element-Icons
```

## Neue Content-Elemente

| CType | Zweck |
|---|---|
| `sitepackage_hero` | Vollflächiges Hero-Bild, Headline, Subline, Signup-Box (Demo-Markup) |
| `sitepackage_feature_highlight` | Bild + Liste aus Icon/Titel/Text (IRRE) |
| `sitepackage_faq` | Zweispaltige FAQ-Liste (IRRE) |
| `sitepackage_testimonials` | Rotierender Testimonial-Slider (IRRE, JS-Autoplay + Dots) |
| `sitepackage_cta_banner` | Zentrierter Abschluss-Banner mit Button |

Für die beiden Bildsektionen wurden bewusst **Core-Content-Elemente**
wiederverwendet statt eigener CTypes:

- "This is your first amazing feature…" (Intro mit 2 Benefit-Bildern) →
  Core `textmedia` (2 Bilder neben Text, Bildunterschrift = Bild-Titel)
- 4er-Bildstreifen → Core `image`, Rahmenklasse **"Sitepackage: Edge-to-edge
  gallery strip"**
- Presse-/Logo-Leiste → Core `image`, Rahmenklasse **"Sitepackage:
  Grayscale press/logo bar"**

Diese Rahmenklassen stehen im Feld "Rahmen in Frontend" jedes `image`-
Elements zur Auswahl.

## Backend Layout

Das Site Set liefert ein Backend Layout **"Landingpage (Convert)"** mit
festen Spalten (colPos 0–80), die 1:1 den Sektionen aus dem Design
entsprechen (Hero, Intro, Features, Gallery, FAQ, Testimonial-Text,
Testimonial-Slider, Presse, CTA). `Resources/Private/Templates/Page/Default.html`
rendert jede Spalte über das von `fluid_styled_content` mitgelieferte
`lib.dynamicContent`.

## Installation in ein TYPO3-v14.3.5-Projekt

1. Extension als Composer-Path-Repository einbinden:

   ```json
   {
       "repositories": [
           { "type": "path", "url": "../sitepackage" }
       ],
       "require": {
           "cms/sitepackage": "@dev"
       }
   }
   ```

2. `composer update cms/sitepackage`
3. Extension im Backend aktivieren (Erweiterungen-Modul oder
   `vendor/bin/typo3 extension:setup`).
4. Datenbankschema aktualisieren (Backend: Wartung → Analyze Database
   Structure, oder `vendor/bin/typo3 database:updateschema`).
5. In der Site-Konfiguration (Site Management → Sites) das Set
   **"Sitepackage: Convert Landingpage"** als Abhängigkeit hinzufügen.
6. Auf der Wurzelseite das Backend Layout **"Landingpage (Convert)"**
   auswählen und die Content-Elemente aus der Gruppe **"Sitepackage"**
   im Content-Element-Wizard einfügen.

## Bekannte Einschränkungen / nächste Schritte

- Das Signup-Formular im Hero ist statisches Demo-Markup
  (`action="#"`). Für echte Formularverarbeitung mit EXT:form verknüpfen
  (Formular-Definition + Finisher).
- `ChildRecordsProcessor` liest IRRE-Kindsätze direkt aus der
  Standardsprache aus; ein Sprachoverlay für mehrsprachige Kindsätze ist
  noch nicht implementiert.
- Platzhalterbilder/-fotos sind nicht enthalten – Redakteur:innen laden
  eigene Bilder in Hero, Feature-Highlight, Gallery-Strip, Logo-Bar und
  Testimonials hoch.
