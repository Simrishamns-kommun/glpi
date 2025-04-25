# Innehåll i denna mapp

## Aviseringsmallar

Denna mapp innehåller anpassade aviseringsmallar. Dessa består av statisk HTML och är gjorda med hjälp av verktyget [MJML](https://documentation.mjml.io/). Filer med ändelsen ``.mjml`` används av MJML för att generera HTML. Verktyget vi använder är enbart till för att förenkla skapandet av enhetliga och responsiva HTML-filer och inte obligatoriskt.

### Mallöversikt

| Mall            | HTML-fil           | Beskrivning                              |
|------------------|--------------------|------------------------------------------|
| `footer.mjml`   | `footer.html`      | Standardiserad sidfot för aviseringsmeddelanden.         |
| `plugin-update.mjml`    | `plugin-update.html`       | Mall som används vid aviseringar för tillägg som har uppdateringar.               |
| `ticket-update.mjml`    | `ticket-update.html`       | Mall för meddelande som skickas när ett ärende uppdateras av handläggare.     |
| `ticket-receipt.mjml` | `ticket-receipt.html` | Mall för bekräftelse av inskickat ärende. |
|-- | `template.html`| Detta är en fil som innehåller de olika etiketterna som kan användas som platshållare i aviseringsmallar. Den används inte av GLPI utan finns här enbart som en referensfil.
