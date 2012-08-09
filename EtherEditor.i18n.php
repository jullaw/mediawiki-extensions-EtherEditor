<?php
/**
 * Internationalisation for EtherEditor extension
 *
 * @file
 * @ingroup Extensions
 */

$messages = array();

/** English
 * @author Mark Holmquist
 */
$messages['en'] = array(
	'ethereditor-desc' => 'Allows users to edit via Etherpad',
	'ethereditor-prefs-enable-ether' => 'Enable collaborative editor (experimental)',
	'ethereditor-collaborate-button' => 'Collaborate',
	'ethereditor-fork-button' => 'Split session',
	'ethereditor-contrib-button' => 'Add list of contributors to edit summary',
	'ethereditor-kick-button' => 'Kick user',
	'ethereditor-delete-button' => 'End session',
	'ethereditor-cannot-nologin' => 'In order to use the EtherEditor, you must log in.',
	'ethereditor-js-off' => 'In order to use the EtherEditor, you must enable JavaScript.',
	'ethereditor-manager-title' => 'EtherEditor Management',
	'ethereditor-pad-title' => 'Pad title',
	'ethereditor-base-revision' => 'Base revision',
	'ethereditor-users-connected' => 'Users connected',
	'ethereditor-admin-controls' => 'Admin controls',
	'ethereditor-user-list' => 'User list',
	'ethereditor-pad-list' => 'Session list',
	'ethereditor-current' => 'Current',
	'ethereditor-outdated' => 'Outdated',
	'ethereditor-summary-message' => ' using EtherEditor, contributors: $1',
	'ethereditor-session-created' => 'Session started by $1 $2',
	'ethereditor-connected' => '$1 connected {{PLURAL:$1|user|users}}',
	'ethereditor-switch-to-session' => 'Switch to this session',
	'ethereditor-recover-session' => 'Recover this session'
);

/** Message documentation (Message documentation)
 * @author Kghbln
 * @author Mark Holmquist
 * @author Raymond
 * @author Siebrand
 */
$messages['qqq'] = array(
	'ethereditor-desc' => '{{desc}}',
	'ethereditor-prefs-enable-ether' => 'A preference that enables the experimental collaborative editor.',
	'ethereditor-collaborate-button' => 'A button at the top of the page (near read/edit) that invites the user to collaborate with others.',
	'ethereditor-fork-button' => 'A button above the textarea that allows the user to create a separate pad.',
	'ethereditor-contrib-button' => 'A button that will populate the edit summary with the list of contributors saved in the database.',
	'ethereditor-kick-button' => 'A button that will kick a user from the current Etherpad instance.',
	'ethereditor-delete-button' => 'A button that will delete the current Etherpad pad.',
	'ethereditor-cannot-nologin' => 'Lets the user know that they can only collaborate if they are logged in, shown on a login error page.',
	'ethereditor-manager-title' => 'The title of Special:EtherEditor. Should indicated that you can manage the effects of the extension on the experience of the current user.',
	'ethereditor-pad-title' => 'Header for a table column of pad names',
	'ethereditor-base-revision' => 'Header for a table column of base revisions (what revision the pad is based on)',
	'ethereditor-users-connected' => 'Header for a table column of user counts per pad',
	'ethereditor-admin-controls' => 'Header for a table column that contains buttons for admin actions',
	'ethereditor-user-list' => 'This is the button a user clicks to access a list of users connected to the current pad.',
	'ethereditor-pad-list' => 'This is the button a user clicks to access a list of pads for the current page.',
	'ethereditor-current' => 'Indicates that this pad is up-to-date',
	'ethereditor-outdated' => 'Indicates that this pad is no longer up-to-date',
	'ethereditor-summary-message' => 'This message goes into the edit summary automatically. The parameter is for a comma-separated list of users, but we are not referring to the users in any substantial way, only to list them.',
	'ethereditor-session-created' => 'This message is how users browse the session list. Parameters:
* $1 is the name of the admin user,
* $2 is something like "2 minutes ago", see the "ago" message,
* $3 is the number of connected users in this session.',
	'ethereditor-connected' => 'This message shows how many users are connected. $1 is the number of connected users in this session.',
	'ethereditor-switch-to-session' => 'This button will bring the user to a session. The button will be next to the session in question.',
	'ethereditor-recover-session' => 'This button has the same effect as ethereditor-switch-to-session, but the change in verb is so they can easily tell that this session has no users attached.',
);

/** German (Deutsch)
 * @author Kghbln
 * @author Metalhead64
 */
$messages['de'] = array(
	'ethereditor-desc' => 'Ermöglicht es Benutzern, Seiten mit dem EtherPad-Editor zu bearbeiten',
	'ethereditor-prefs-enable-ether' => 'EtherPad-Editor aktivieren (experimentell)',
	'ethereditor-collaborate-button' => 'Mitmachen',
	'ethereditor-fork-button' => 'Sitzung aufteilen',
	'ethereditor-contrib-button' => 'Liste der Bearbeiter der Bearbeitungszusammenfassung hinzufügen',
	'ethereditor-kick-button' => 'Benutzer ausschließen',
	'ethereditor-delete-button' => 'Sitzung beenden',
	'ethereditor-cannot-nologin' => 'Um den EtherPad-Editor nutzen zu können, musst du dich anmelden.',
	'ethereditor-js-off' => 'Um den EtherPad-Editor nutzen zu können, musst du JavaScript aktivieren.',
	'ethereditor-manager-title' => 'Verwaltung des EtherPad-Editors',
	'ethereditor-pad-title' => 'Name des EtherPads',
	'ethereditor-base-revision' => 'Ursprungsversion',
	'ethereditor-users-connected' => 'Verbundene Benutzer',
	'ethereditor-admin-controls' => 'Administrationssteuerung',
	'ethereditor-user-list' => 'Benutzerliste',
	'ethereditor-pad-list' => 'Sitzungsliste',
	'ethereditor-current' => 'Aktuell',
	'ethereditor-outdated' => 'Veraltet',
	'ethereditor-summary-message' => 'Benutzer, die den EtherPad-Editor verwendet haben: $1',
	'ethereditor-session-created' => 'Sitzung gestartet von $1 $2',
	'ethereditor-connected' => '{{PLURAL:$1|Ein verbundener Benutzer|$1 verbundene Benutzer}}',
	'ethereditor-switch-to-session' => 'Zu dieser Sitzung wechseln',
	'ethereditor-recover-session' => 'Diese Sitzung wiederherstellen',
);

/** German (formal address) (‪Deutsch (Sie-Form)‬)
 * @author Kghbln
 */
$messages['de-formal'] = array(
	'ethereditor-cannot-nologin' => 'Um den EtherPad-Editor nutzen zu können, müssen Sie sich anmelden.',
	'ethereditor-js-off' => 'Um den EtherPad-Editor nutzen zu können, müssen Sie JavaScript aktivieren.',
	'ethereditor-warn-others' => 'Warnung: Andere Benutzer bearbeiten diese Seite gerade gemeinsam mit dem EtherPad-Editor. Sie können diese Seite gerne weiter bearbeiten, allerdings könnten Ihre Bearbeitungen im Konflikt zu deren Bearbeitungen stehen. Überlegen Sie sich, ob Sie sich ihnen nicht beim gemeinsamen Bearbeiten anschließen möchten, indem Sie die Schaltfläche {{int:ethereditor-collaborate-button}} anklicken. Sie finden sie in der oberen rechten Ecke des Bildschirms. Auf diese Weise können Sie Zusammenführungskonflikte beim Speichern der Seite vermeiden.',
);

/** Lower Sorbian (dolnoserbski)
 * @author Michawiki
 */
$messages['dsb'] = array(
	'ethereditor-desc' => 'Źmóžnja wužywarjam z pomocu Etherpada wobźěłaś',
	'ethereditor-prefs-enable-ether' => 'Editor za zgromadne woźěłowanje zmóžniś (wjelgin eksperimentelny)',
	'ethereditor-collaborate-button' => 'Sobuźěłaś',
	'ethereditor-fork-button' => 'Pósejźenje rozdźěliś',
	'ethereditor-contrib-button' => 'Lisćinu sobustatkujucych wobźěłowanja zespominanja pśidaś',
	'ethereditor-kick-button' => 'Wužywarja wen chyśiś',
	'ethereditor-delete-button' => 'Pósejźenje skóńcyś',
	'ethereditor-cannot-nologin' => 'Aby EtherEditor wužywał, musyš pśizjawjony byś.',
	'ethereditor-js-off' => 'Aby EtherEditor wužywał, musyš JavaScript zmóžniś.',
	'ethereditor-manager-title' => 'EtherEditor - zarědowanje',
	'ethereditor-pad-title' => 'Titel tekstowego póla',
	'ethereditor-base-revision' => 'Zakładna wersija',
	'ethereditor-users-connected' => 'Zwězane wužywarje',
	'ethereditor-admin-controls' => 'Administraciske wóźenje',
	'ethereditor-user-list' => 'Lisćina wužywarjow',
	'ethereditor-pad-list' => 'Lisćina pósejźenjow',
	'ethereditor-current' => 'Aktualny',
	'ethereditor-outdated' => 'Zestarjony',
	'ethereditor-summary-message' => 'wužywarje, kótarež su EtherEditor wužyli: $1',
	'ethereditor-session-created' => 'Pósejźenje jo se wót $1 $2 startowało',
	'ethereditor-connected' => '$1 {{PLURAL:$1|zwězany wužywaŕ|zwězanej wužywarja|zwězane wužywarje|zwězanych wužywarjow}}',
	'ethereditor-switch-to-session' => 'K toś tomu pósejźenjeju pśejś',
	'ethereditor-recover-session' => 'Toś to pósejźenje wótnowiś',
);

/** Spanish (español)
 * @author Armando-Martin
 */
$messages['es'] = array(
	'ethereditor-desc' => 'Permite a los usuarios editar mediante Etherpad',
	'ethereditor-prefs-enable-ether' => 'Activar el editor colaborativo (muy experimental)',
	'ethereditor-collaborate-button' => 'Colaborar',
	'ethereditor-fork-button' => 'Dividir sesión',
	'ethereditor-contrib-button' => 'Añadir una lista de los colaboradores al resumen de edición',
	'ethereditor-kick-button' => 'Echar a un usuario',
	'ethereditor-delete-button' => 'Finalizar sesión de edición',
	'ethereditor-cannot-nologin' => 'Para poder utilizar el sistema EtherEditor, debes iniciar sesión.',
	'ethereditor-js-off' => 'Para poder utilizar EtherEditor, debe habilitar JavaScript.',
	'ethereditor-manager-title' => 'Administración de EtherEditor',
	'ethereditor-pad-title' => 'Título de la ventana de texto a editar',
	'ethereditor-base-revision' => 'Revisión base',
	'ethereditor-users-connected' => 'Usuarios conectados',
	'ethereditor-admin-controls' => 'Controles de administración',
	'ethereditor-user-list' => 'Lista de usuarios',
	'ethereditor-pad-list' => 'Lista de sesiones',
	'ethereditor-current' => 'Actual',
	'ethereditor-outdated' => 'Desactualizado',
	'ethereditor-summary-message' => 'utilizando EtherEditor, colaboradores: $1.',
	'ethereditor-session-created' => 'Sesión iniciada por $1 $2',
	'ethereditor-connected' => '$1 {{PLURAL:$1|usuario conectado|usuarios conectados}}',
	'ethereditor-switch-to-session' => 'Cambiar a esta sesión',
	'ethereditor-recover-session' => 'Recuperar esta sesión',
);

/** Persian (فارسی)
 * @author Mjbmr
 */
$messages['fa'] = array(
	'ethereditor-user-list' => 'فهرست کاربران',
);

/** French (français)
 * @author Gomoko
 * @author IAlex
 * @author MarkTraceur
 */
$messages['fr'] = array(
	'ethereditor-desc' => 'Permet aux utilisateurs de modifier avec Etherpad',
	'ethereditor-prefs-enable-ether' => "Activer l'éditeur collaboratif (expérimental)",
	'ethereditor-collaborate-button' => 'Collaborez',
	'ethereditor-fork-button' => 'Copier le bloc-note',
	'ethereditor-contrib-button' => "Ajouter la liste des contributeurs au résumé d'édition",
	'ethereditor-kick-button' => 'Bloquez utilisateur',
	'ethereditor-delete-button' => 'Supprimer le bloc',
	'ethereditor-cannot-nologin' => 'Pour pouvoir utiliser EtherEditor, vous devez être connecté.',
	'ethereditor-js-off' => 'Vous devez activer JavaScript pour utiliser EtherEditor.',
	'ethereditor-manager-title' => 'Gestion de EtherEditor',
	'ethereditor-pad-title' => 'Titre du bloc',
	'ethereditor-base-revision' => 'Révision de base',
	'ethereditor-users-connected' => 'Utilisateurs connectés',
	'ethereditor-current' => 'Actuel',
	'ethereditor-outdated' => 'Obsolète',
	'ethereditor-summary-message' => " à l'aide de EtherEditor, contributeurs : $1.",
);

/** Galician (galego)
 * @author Toliño
 */
$messages['gl'] = array(
	'ethereditor-desc' => 'Permite aos usuarios editar a través do Etherpad',
	'ethereditor-prefs-enable-ether' => 'Activar o editor colaborativo (moi experimental)',
	'ethereditor-collaborate-button' => 'Colaborar',
	'ethereditor-fork-button' => 'Dividir a sesión',
	'ethereditor-contrib-button' => 'Engadir unha lista dos colaboradores ao resumo de edición',
	'ethereditor-kick-button' => 'Botar ao usuario',
	'ethereditor-delete-button' => 'Finalizar a sesión',
	'ethereditor-cannot-nologin' => 'Cómpre acceder ao sistema para utilizar o EtherEditor.',
	'ethereditor-js-off' => 'Cómpre activar o JavaScript para usar o EtherEditor.',
	'ethereditor-manager-title' => 'Administración do EtherEditor',
	'ethereditor-pad-title' => 'Título da ventá',
	'ethereditor-base-revision' => 'Revisión de base',
	'ethereditor-users-connected' => 'Usuarios conectados',
	'ethereditor-admin-controls' => 'Controis administrativos',
	'ethereditor-user-list' => 'Lista de usuarios',
	'ethereditor-pad-list' => 'Lista de sesións',
	'ethereditor-current' => 'Actual',
	'ethereditor-outdated' => 'Anticuada',
	'ethereditor-summary-message' => ' mediante o EtherEditor. Colaboradores: $1.',
	'ethereditor-session-created' => 'Sesión iniciada por $1 $2',
	'ethereditor-connected' => '$1 {{PLURAL:$1|usuario conectado|usuarios conectados}}',
	'ethereditor-switch-to-session' => 'Cambiar a esta sesión',
	'ethereditor-recover-session' => 'Recuperar esta sesión',
);

/** Upper Sorbian (hornjoserbsce)
 * @author Michawiki
 */
$messages['hsb'] = array(
	'ethereditor-desc' => 'Źmóžnja wužiwarjam z pomocu Etherpada wobdźěłać',
	'ethereditor-prefs-enable-ether' => 'Editor za zhromadne wodźěłowanje zmóžnić (jara eksperimentelny)',
	'ethereditor-collaborate-button' => 'Sobudźěłać',
	'ethereditor-fork-button' => 'Posedźenje rozdźělić',
	'ethereditor-contrib-button' => 'Lisćinu sobuskutkowacych wobdźěłowanskeho zjeća přidać',
	'ethereditor-kick-button' => 'Wužiwarja won ćisnyć',
	'ethereditor-delete-button' => 'Posedźenje skónčić',
	'ethereditor-cannot-nologin' => 'Zo by EtherEditor wužiwał, dyrbiš přizjewjeny być.',
	'ethereditor-js-off' => 'Zo by EtherEditor wužiwał, dyrbiš JavaScript zmóžnić.',
	'ethereditor-manager-title' => 'EtherEditor - zarjadowanje',
	'ethereditor-pad-title' => 'Titul tekstoweho pola',
	'ethereditor-base-revision' => 'Zakładna wersija',
	'ethereditor-users-connected' => 'Zwjazani wužiwarjo',
	'ethereditor-admin-controls' => 'Administraciske wodźenje',
	'ethereditor-user-list' => 'Lisćina wužiwarjow',
	'ethereditor-pad-list' => 'Lisćina posedźenjow',
	'ethereditor-current' => 'Aktualny',
	'ethereditor-outdated' => 'Zestarjeny',
	'ethereditor-summary-message' => 'wužiwarjo, kotřiž su EtherEditor wužili: $1',
	'ethereditor-session-created' => 'Posedźenje je so wot $1 $2 startowało',
	'ethereditor-connected' => '$1 {{PLURAL:$1|zwjazany wužiwar|zwjazanej wužiwarjej|zwjazani wužiwarjo|zwjazanych wužiwarjow}}',
	'ethereditor-switch-to-session' => 'K tutomu posedźenju přeńć',
	'ethereditor-recover-session' => 'Tute posedźenje wobnowić',
);

/** Interlingua (interlingua)
 * @author McDutchie
 */
$messages['ia'] = array(
	'ethereditor-desc' => 'Permitte al usatores modificar per medio de Etherpad',
	'ethereditor-prefs-enable-ether' => 'Activar le editor collaborative (experimental)',
	'ethereditor-collaborate-button' => 'Collaborar',
	'ethereditor-fork-button' => 'Divider session',
	'ethereditor-contrib-button' => 'Adder lista de contributores al summario de modification',
	'ethereditor-kick-button' => 'Ejectar usator',
	'ethereditor-delete-button' => 'Finir session',
	'ethereditor-cannot-nologin' => 'Pro usar le EtherEditor, tu debe aperir session.',
	'ethereditor-js-off' => 'Pro usar EtherEditor, tu debe activar JavaScript.',
	'ethereditor-manager-title' => 'Gestion de EtherEditor',
	'ethereditor-pad-title' => 'Titulo del pad',
	'ethereditor-base-revision' => 'Version de base',
	'ethereditor-users-connected' => 'Usatores connectite',
	'ethereditor-admin-controls' => 'Controlos administrative',
	'ethereditor-user-list' => 'Lista de usatores',
	'ethereditor-pad-list' => 'Lista de sessiones',
	'ethereditor-current' => 'Actual',
	'ethereditor-outdated' => 'Obsolete',
	'ethereditor-summary-message' => ' usante EtherEditor, contributores: $1.',
	'ethereditor-session-created' => 'Session comenciate per $1 $2',
	'ethereditor-connected' => '$1 {{PLURAL:$1|usator|usatores}} connectite',
	'ethereditor-switch-to-session' => 'Cambiar a iste session',
	'ethereditor-recover-session' => 'Recuperar iste session',
);

/** Italian (italiano)
 * @author Beta16
 */
$messages['it'] = array(
	'ethereditor-desc' => 'Consente agli utenti di modificare tramite Etherpad',
	'ethereditor-prefs-enable-ether' => 'Abilita la modifica collaborativa (molto sperimentale)',
	'ethereditor-collaborate-button' => 'Collabora',
	'ethereditor-fork-button' => 'Dividi sessione',
	'ethereditor-contrib-button' => "Aggiungi lista dei contributori all'oggetto della modifica",
	'ethereditor-kick-button' => 'Allontana utente',
	'ethereditor-delete-button' => 'Terminare sessione',
);

/** Colognian (Ripoarisch)
 * @author Purodha
 */
$messages['ksh'] = array(
	'ethereditor-desc' => 'Määd_et Sigge Ändere för ene Pöngel Metmaacher ob eijmohl övver en <i lang="en">etherpad</i> müjjelesch.',
	'ethereditor-prefs-enable-ether' => 'Et Ändere övver en <i lang="en">etherpad</i> enschallde. (För zem Ußprobeere)',
	'ethereditor-collaborate-button' => 'Em  <i lang="en">etherpad</i> Ändere',
	'ethereditor-fork-button' => 'En extra en <i lang="en">etherpad</i> opmaache',
	'ethereditor-contrib-button' => 'Donn de Metschriever-Leß onger {{int:summary}} enfraare!!FIÙZZY!!',
	'ethereditor-kick-button' => 'Ene Metmaacher ußschleeße',
	'ethereditor-delete-button' => 'Donn heh dat <i lang="en">etherpad</i> fottschmiiße',
	'ethereditor-cannot-nologin' => 'Öm övver en <i lang="en">etherpad</i> jät ze ändere, moß De enjelogg sin.',
);

/** Luxembourgish (Lëtzebuergesch)
 * @author Robby
 */
$messages['lb'] = array(
	'ethereditor-prefs-enable-ether' => 'De kollaborativen Editeur aktivéieren (experimentell)',
	'ethereditor-collaborate-button' => 'Matmaachen',
	'ethereditor-kick-button' => 'Benotzer erausgeheien',
);

/** Macedonian (македонски)
 * @author Bjankuloski06
 */
$messages['mk'] = array(
	'ethereditor-desc' => 'Им овозможува на корисниците да уредуваат преку Etherpad',
	'ethereditor-prefs-enable-ether' => 'Овозможи соработен уредник (многу експериментален)',
	'ethereditor-collaborate-button' => 'Соработка',
	'ethereditor-fork-button' => 'Одвој ја сесијата',
	'ethereditor-contrib-button' => 'Додај список на учесници во описот на уредувањето',
	'ethereditor-kick-button' => 'Клоцни го корисникот',
	'ethereditor-delete-button' => 'Заврши ја сесијата',
	'ethereditor-cannot-nologin' => 'За да го користите EtherEditor, мора прво да се најавите.',
	'ethereditor-js-off' => 'За да го користите уредникот EtherEditor, ќе мора да овозможите JavaScript.',
	'ethereditor-manager-title' => 'Раководење со EtherEditor',
	'ethereditor-pad-title' => 'Наслов на блокот',
	'ethereditor-base-revision' => 'Основна ревизија',
	'ethereditor-users-connected' => 'Поврзани корисници',
	'ethereditor-admin-controls' => 'Админ-ски контроли',
	'ethereditor-user-list' => 'Список на корисници',
	'ethereditor-pad-list' => 'Список на сесии',
	'ethereditor-current' => 'Тековен',
	'ethereditor-outdated' => 'Застарен',
	'ethereditor-summary-message' => ' користејќи го EtherEditor, учесници: $1.',
	'ethereditor-session-created' => 'Сесијата ја започна $1 $2',
	'ethereditor-connected' => '$1 {{PLURAL:$1|поврзан корисник|поврзани корисници}}',
	'ethereditor-switch-to-session' => 'Префрли на сесијава',
	'ethereditor-recover-session' => 'Поврати ја сесијава',
);

/** Dutch (Nederlands)
 * @author SPQRobin
 * @author Saruman
 * @author Siebrand
 */
$messages['nl'] = array(
	'ethereditor-desc' => 'Maakt het mogelijk om te bewerken via Etherpad',
	'ethereditor-prefs-enable-ether' => 'Gezamenlijke tekstverwerker inschakelen (experimenteel)',
	'ethereditor-collaborate-button' => 'Samenwerken',
	'ethereditor-fork-button' => 'Sessie splitsen',
	'ethereditor-contrib-button' => 'Lijst met auteurs toevoegen aan bewerkingssamenvatting',
	'ethereditor-kick-button' => 'Gebruiker verwijderen',
	'ethereditor-delete-button' => 'Sessie beëindigen',
	'ethereditor-cannot-nologin' => 'U moet aanmelden om EtherEditor te kunnen gebruiken.',
	'ethereditor-js-off' => 'Om EtherEditor te kunnen gebruiken, moet u JavaScript inschakelen.',
	'ethereditor-manager-title' => 'EtherEditor-beheer',
	'ethereditor-pad-title' => 'Titel van de pad',
	'ethereditor-base-revision' => 'Basisversie',
	'ethereditor-users-connected' => 'Verbonden gebruikers',
	'ethereditor-admin-controls' => 'Beheerdershandelingen',
	'ethereditor-user-list' => 'Gebruikerslijst',
	'ethereditor-pad-list' => 'Sessielijst',
	'ethereditor-current' => 'Bijgewerkt',
	'ethereditor-outdated' => 'Verouderd',
	'ethereditor-summary-message' => ' met behulp van EtherEditor, bijdragers: $1.',
	'ethereditor-session-created' => 'Sessie $2 gestart door $1',
	'ethereditor-connected' => '{{PLURAL:$1|Eén verbonden gebruiker|$1 verbonden gebruikers}}',
	'ethereditor-switch-to-session' => 'Overschakelen naar deze sessie',
	'ethereditor-recover-session' => 'Deze sessie herstellen',
);

/** Sinhala (සිංහල)
 * @author පසිඳු කාවින්ද
 */
$messages['si'] = array(
	'ethereditor-current' => 'වත්මන්',
);

/** Tagalog (Tagalog)
 * @author AnakngAraw
 */
$messages['tl'] = array(
	'ethereditor-desc' => 'Nagpapahintulot sa mga tagagamit na makapamatnugot sa pamamagitan ng Etherpad',
	'ethereditor-prefs-enable-ether' => 'Paganahin ang pampagtutulungang patungot (napaka pang-eksperimento)',
	'ethereditor-collaborate-button' => 'Makipagtulungan',
	'ethereditor-fork-button' => 'Hatiin ang inilaang panahon',
	'ethereditor-contrib-button' => 'Idagdag ang listahan ng mga nag-aambag sa buod ng pamamatnugot',
	'ethereditor-kick-button' => 'Sipain ang tagagamit',
	'ethereditor-delete-button' => 'Wakasan na ang inilaang panahon',
	'ethereditor-cannot-nologin' => 'Upang magamit ang EtherEditor, dapat na nakalagda ka.',
	'ethereditor-js-off' => 'Upang magamit ang EtherEditor, dapat na paganahin ang JavaScript.',
	'ethereditor-manager-title' => 'Pamamahala ng EtherEditor',
	'ethereditor-pad-title' => 'Pamagat ng sapin',
	'ethereditor-base-revision' => 'Saligang rebisyon',
	'ethereditor-users-connected' => 'Nakakabit na mga tagagamit',
	'ethereditor-admin-controls' => 'Mga pantaban ng tagapangasiwa',
	'ethereditor-user-list' => 'Tala ng tagagamit',
	'ethereditor-pad-list' => 'Tala ng paglalaan ng panahon',
	'ethereditor-current' => 'Pangkasalukuyan',
	'ethereditor-outdated' => 'Hindi na napapanahon',
	'ethereditor-summary-message' => 'paggamit ng EtherEditor, mga mang-aambag: $1',
	'ethereditor-session-created' => 'Sinimulan ni $1 ang inilaang panahon $2',
	'ethereditor-connected' => 'Ikinabit ni $1 ang {{PLURAL:$1|tagagamit|mga tagagamit}}',
	'ethereditor-switch-to-session' => 'Lumipat papunta sa laang panahon na ito',
	'ethereditor-recover-session' => 'Bawiin ang laang panahong ito',
);

