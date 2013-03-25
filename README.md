## AddCode Addon für Redaxo

Dieses Addon ermöglicht es eigene Klassen und Funktionen laden zu lassen. Dabei berücksichtigt das Addon anhand des Dateinamens ob der jeweilige Code für das Front- oder Backend geladen wird. Es können Dateien auch global geladen werden.

### Dateinamen

Die Dateinamen müssen nach folgendem Schema aufgebaut sein `typ.name.ladeziel.php` (typ = `classe` oder `function`, name = Name der Datei -> beliebig, ladeziel = `frontend`, `backend` oder `global`).

##### Folgende Dateinamen wären demnach zulässig:

* `class.customnavigation.frontend.php`
* `class.customstruktur.backend.php`
* `class.taggin.global.php`
* `function.getimagestoarray.frontend.php`
* `function.getpreviewimage.backend.php`
* `function.getfiletype.global.php`


##### Folgende Dateinamen würden ignoriert:

* `classes.navigation.php`
* `function.splitit.inc.php`
* `functions.inc.php`

### Laden von Funktionen

Funktionen werden im Verzeichnis `/redaxo/include/addons/addcode/include/functions/` abgelegt und müssen wie bereits beschriebenen benannt sein.

### Laden von Klassen

Klassen die geladen werden sollen müssen im Verzeichnis `/redaxo/include/addons/addcode/include/classes/` abgelegt werden und wie bereits beschriebenen benannt sein.

### Bereitgestellte Klassen und Funktionen

### Custom Verzeichnis

Es kann zusätzlich ein Verzeichnis gewählt werden aus welchem Klassen und Funktionen geladen werden, dieses Verzeichnis kann ein Redaxouser mit entsprechenden Berechtigungen unter "Addcode" Settings definieren, das Verzeichnis wird vom Dokument-Root aus gesetzt, dabei muss immer nach dem Ordnernamen ein `/` gesetzt werden. Der Ordner `site/include/` ist vordefiniert. Es werden nur dann Dateien geladen wenn sich in dem Custom Verzeichnis die Unterverzeichnisse `functions/` und `classes/` befinden. Die darin befindlichen Dateien werden dann daraus geladen wenn sie wie bereits beschriebenen benannt sind.

### Todo

* Demo Klassen und Funktionen anlegen und Demo in die Hilfe und Info Datei einbauen.
* Diverse sinnvolle Classes und Functions hinzufügen.
