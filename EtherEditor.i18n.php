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
	'ethereditor-recover-session' => 'Recover this session',
	'ethereditor-leave' => ' Collaboration mode is disabled',
);

/** Message documentation (Message documentation)
 * @author Kghbln
 * @author Mark Holmquist
 * @author Raymond
 * @author Shirayuki
 * @author Siebrand
 */
$messages['qqq'] = array(
	'ethereditor-desc' => '{{desc|name=Ether Editor|url=http://www.mediawiki.org/wiki/Extension:EtherEditor}}',
	'ethereditor-prefs-enable-ether' => 'A preference that enables the experimental collaborative editor.',
	'ethereditor-collaborate-button' => 'A button at the top of the page (near read/edit) that invites the user to collaborate with others.',
	'ethereditor-fork-button' => 'A button above the textarea that allows the user to create a separate pad.',
	'ethereditor-contrib-button' => 'A button that will populate the edit summary with the list of contributors saved in the database.',
	'ethereditor-kick-button' => 'A button that will kick a user from the current Etherpad instance.',
	'ethereditor-delete-button' => 'A button that will delete the current Etherpad pad.',
	'ethereditor-cannot-nologin' => 'Lets the user know that they can only collaborate if they are logged in, shown on a login error page.',
	'ethereditor-js-off' => 'Used as error message in HTML <code><nowiki><noscript></nowiki></code> tag in [[Special:EtherEditor]].',
	'ethereditor-manager-title' => 'The title of Special:EtherEditor. Should indicated that you can manage the effects of the extension on the experience of the current user.',
	'ethereditor-pad-title' => 'Header for a table column of pad names',
	'ethereditor-base-revision' => 'Header for a table column of base revisions (what revision the pad is based on)',
	'ethereditor-users-connected' => 'Header for a table column of user counts per pad',
	'ethereditor-admin-controls' => 'Header for a table column that contains buttons for admin actions',
	'ethereditor-user-list' => 'This is the button a user clicks to access a list of users connected to the current pad.',
	'ethereditor-pad-list' => 'This is the button a user clicks to access a list of pads for the current page.',
	'ethereditor-current' => 'Indicates that this pad is up-to-date.
{{Identical|Current}}',
	'ethereditor-outdated' => 'Indicates that this pad is no longer up-to-date',
	'ethereditor-summary-message' => 'This message goes into the edit summary automatically. The parameter is for a comma-separated list of users, but we are not referring to the users in any substantial way, only to list them.',
	'ethereditor-session-created' => 'This message is how users browse the session list. Parameters:
* $1 is the name of the admin user,
* $2 is something like "2 minutes ago", see the "ago" message,
* $3 is the number of connected users in this session.',
	'ethereditor-connected' => 'This message shows how many users are connected. $1 is the number of connected users in this session.',
	'ethereditor-switch-to-session' => 'This button will bring the user to a session. The button will be next to the session in question.',
	'ethereditor-recover-session' => 'This button has the same effect as ethereditor-switch-to-session, but the change in verb is so they can easily tell that this session has no users attached.',
	'ethereditor-leave' => 'This message appears, when user leaves collab mode',
);

/** Asturian (asturianu)
 * @author Xuacu
 */
$messages['ast'] = array(
	'ethereditor-desc' => "Permite que los usuarios editen per aciu d'Etherpad",
	'ethereditor-prefs-enable-ether' => "Activar l'editor collaborativu (esperimental)",
	'ethereditor-collaborate-button' => 'Collaborar',
	'ethereditor-fork-button' => 'Dividir sesión',
	'ethereditor-contrib-button' => "Amestar la llista de collaboradores al resume d'edición",
	'ethereditor-kick-button' => 'Espulsar usuariu',
	'ethereditor-delete-button' => 'Finar sesión',
	'ethereditor-cannot-nologin' => "Pa poder usar el EtherEditor, tien d'aniciar sesión.",
	'ethereditor-js-off' => "Pa poder usar el EtherEditor, tien d'activar JavaScript.",
	'ethereditor-manager-title' => "Alministración d'EtherEditor",
	'ethereditor-pad-title' => 'Títulu del bloc',
	'ethereditor-base-revision' => 'Revisión de base',
	'ethereditor-users-connected' => 'Usuarios coneutaos',
	'ethereditor-admin-controls' => "Controles d'alministración",
	'ethereditor-user-list' => "Llista d'usuarios",
	'ethereditor-pad-list' => 'Llista de sesiones',
	'ethereditor-current' => 'Actual',
	'ethereditor-outdated' => 'Anticuáu',
	'ethereditor-summary-message' => ' usando EtherEditor, collaboradores: $1',
	'ethereditor-session-created' => 'Sesión aniciada por $1 $2',
	'ethereditor-connected' => '$1 {{PLURAL:$1|usuariu coneutáu|usuarios coneutaos}}',
	'ethereditor-switch-to-session' => 'Cambiar a esta sesión',
	'ethereditor-recover-session' => 'Recuperar esta sesión',
	'ethereditor-leave' => 'El mou de collaboración ta desactiváu',
);

/** Belarusian (беларуская)
 * @author Чаховіч Уладзіслаў
 */
$messages['be'] = array(
	'ethereditor-desc' => 'Дазваляе ўдзельнікам правіць праз Etherpad',
);

/** Belarusian (Taraškievica orthography) (беларуская (тарашкевіца)‎)
 * @author Wizardist
 */
$messages['be-tarask'] = array(
	'ethereditor-desc' => 'Дазваляе ўдзельнікам рэдагаваць праз Etherpad',
	'ethereditor-prefs-enable-ether' => 'Уключыць супольны рэдактар (экспэрымэнтальна)',
	'ethereditor-collaborate-button' => 'Супрацоўніцтва',
	'ethereditor-fork-button' => 'Падзяліць сэсію',
	'ethereditor-contrib-button' => 'Дадаць сьпіс рэдактара ў апісаньне праўкі',
	'ethereditor-kick-button' => 'Выкінуць удзельніка',
	'ethereditor-delete-button' => 'Скончыць сэсію',
	'ethereditor-cannot-nologin' => 'Каб скарыстаць EtherEditor, вы мусіце ўвайсьці.',
	'ethereditor-js-off' => 'Каб скарыстаць EtherEditor, вы мусіце ўключыць JavaScript.',
	'ethereditor-manager-title' => 'Кіраваньне EtherEditor',
	'ethereditor-pad-title' => 'Загаловак дакумэнту',
	'ethereditor-base-revision' => 'Выточная вэрсія',
	'ethereditor-users-connected' => 'Падлучаныя ўдзельнікі',
	'ethereditor-admin-controls' => 'Прылады адміністратара',
	'ethereditor-user-list' => 'Сьпіс удзельнікаў',
	'ethereditor-pad-list' => 'Сьпіс сэсіяў',
	'ethereditor-current' => 'Бягучы',
	'ethereditor-outdated' => 'Састарэлы',
	'ethereditor-summary-message' => 'праз EtherEditor, рэдактары: $1',
	'ethereditor-session-created' => 'Сэсію $2 распачаў $1',
	'ethereditor-connected' => '{{PLURAL:$1|Падлучаны $1 удзельнік|Падлучаныя $1 удзельнікі|Падлучаныя $1 удзельнікаў}}',
	'ethereditor-switch-to-session' => 'Пераключыцься на гэтую сэсію',
	'ethereditor-recover-session' => 'Аднавіць гэтую сэсію',
	'ethereditor-leave' => 'Рэжым супрацы выключаны',
);

/** Bulgarian (български)
 * @author පසිඳු කාවින්ද
 */
$messages['bg'] = array(
	'ethereditor-current' => 'Текущо',
);

/** Breton (brezhoneg)
 * @author Fohanno
 * @author Y-M D
 */
$messages['br'] = array(
	'ethereditor-collaborate-button' => 'Kenlabourit',
	'ethereditor-fork-button' => "Rannañ an dalc'h",
	'ethereditor-kick-button' => 'Skarzhañ an implijer',
	'ethereditor-delete-button' => "Echuiñ an dalc'h",
	'ethereditor-user-list' => 'Roll an implijerien',
	'ethereditor-current' => 'Red',
	'ethereditor-outdated' => 'Dispredet',
);

/** Czech (česky)
 * @author Vks
 */
$messages['cs'] = array(
	'ethereditor-collaborate-button' => 'Spolupracuj',
	'ethereditor-kick-button' => 'Vykopnout uživatele',
	'ethereditor-user-list' => 'Seznam uživatelů',
	'ethereditor-current' => 'Současný',
	'ethereditor-outdated' => 'Zastaralý',
);

/** Danish (dansk)
 * @author Tjernobyl
 */
$messages['da'] = array(
	'ethereditor-user-list' => 'Brugerliste',
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
	'ethereditor-leave' => 'Der Mitwirkungsmodus ist deaktiviert',
);

/** German (formal address) (Deutsch (Sie-Form)‎)
 * @author Kghbln
 */
$messages['de-formal'] = array(
	'ethereditor-cannot-nologin' => 'Um den EtherPad-Editor nutzen zu können, müssen Sie sich anmelden.',
	'ethereditor-js-off' => 'Um den EtherPad-Editor nutzen zu können, müssen Sie JavaScript aktivieren.',
);

/** Zazaki (Zazaki)
 * @author Erdemaslancan
 */
$messages['diq'] = array(
	'ethereditor-collaborate-button' => 'Piyakarkerdış',
	'ethereditor-fork-button' => 'Ronıştışo leteyın',
	'ethereditor-kick-button' => 'Payçekerden karber',
	'ethereditor-delete-button' => 'Ronıştış qedyayış',
	'ethereditor-pad-title' => 'Tampon sername',
	'ethereditor-admin-controls' => 'Kontrolê adminan',
	'ethereditor-user-list' => 'Listeyê karberan',
	'ethereditor-pad-list' => 'Listeya ronıştışan',
	'ethereditor-current' => 'Nıkayên',
	'ethereditor-outdated' => 'Verêna ra',
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

/** Greek (Ελληνικά)
 * @author Glavkos
 */
$messages['el'] = array(
	'ethereditor-desc' => 'Επιτρέπει στους χρήστες να επεξεργαστούν μέσω Etherpad',
	'ethereditor-prefs-enable-ether' => 'Ενεργοποίηση συνεργατικού επεξεργαστή κειμένου (πειραματικό)',
	'ethereditor-collaborate-button' => 'Συνεργαστείτε',
	'ethereditor-fork-button' => 'Διαίρεση περιόδου λειτουργίας',
	'ethereditor-contrib-button' => 'Προσθήκη λίστας των συνεισφερόντων για να επεξεργαστείτε τη σύνοψη',
	'ethereditor-kick-button' => 'Αποβολή χρήστη',
	'ethereditor-delete-button' => 'Τέλος περιόδου λειτουργίας',
	'ethereditor-cannot-nologin' => 'Για να χρησιμοποιήσετε το EtherEditor, θα πρέπει να συνδεθείτε.',
	'ethereditor-js-off' => 'Για να χρησιμοποιήσετε το EtherEditor, θα πρέπει να ενεργοποιήσετε το JavaScript.',
	'ethereditor-manager-title' => 'Διαχείριση του EtherEditor',
	'ethereditor-pad-title' => 'Τίτλος σημείωσης',
	'ethereditor-base-revision' => 'Αναθεώρηση βάσης',
	'ethereditor-users-connected' => 'Συνδεδεμένοι χρήστες',
	'ethereditor-admin-controls' => 'Διαχειριστικοί έλεγχοι',
	'ethereditor-user-list' => 'Κατάλογος χρηστών',
	'ethereditor-pad-list' => 'Κατάλογος περιόδου λειτουργίας',
	'ethereditor-current' => 'Τρέχον',
	'ethereditor-outdated' => 'Παρωχημένες',
	'ethereditor-summary-message' => 'χρησιμοποιούν τον EtherEditor, συνεισφέροντες:$1',
	'ethereditor-session-created' => 'Η περίοδος λειτουργίας ξεκίνησε από $1 $2',
	'ethereditor-connected' => '$1 συνδεδεμένος/οι  {{PLURAL:$1|χρήστης|χρήστες}}',
	'ethereditor-switch-to-session' => 'Μεταβείτε σε αυτήν την περίοδο λειτουργίας',
	'ethereditor-recover-session' => 'Επανάκτηση αυτής της περιόδου λειτουργίας',
	'ethereditor-leave' => 'Η λειτουργία συνεργασία είναι απενεργοποιημένη',
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
	'ethereditor-leave' => 'Se ha desactivado el modo de colaboración',
);

/** Estonian (eesti)
 * @author Avjoska
 */
$messages['et'] = array(
	'ethereditor-collaborate-button' => 'Tee koostööd',
	'ethereditor-delete-button' => 'Lõpeta seanss',
	'ethereditor-user-list' => 'Kasutajate loend',
	'ethereditor-current' => 'Praegune',
	'ethereditor-outdated' => 'Aegunud',
);

/** Persian (فارسی)
 * @author Mjbmr
 */
$messages['fa'] = array(
	'ethereditor-user-list' => 'فهرست کاربران',
);

/** Finnish (suomi)
 * @author Beluga
 * @author VezonThunder
 */
$messages['fi'] = array(
	'ethereditor-desc' => 'Antaa käyttäjien muokata Etherpadilla',
	'ethereditor-prefs-enable-ether' => 'Salli yhteistyömuokkain (kokeellinen)',
	'ethereditor-collaborate-button' => 'Tee yhteistyötä',
	'ethereditor-fork-button' => 'Jaa istunto',
	'ethereditor-contrib-button' => 'Lisää luettelo muokkaajista yhteenvetoon',
	'ethereditor-kick-button' => 'Potki käyttäjä',
	'ethereditor-delete-button' => 'Lopeta istunto',
	'ethereditor-cannot-nologin' => 'Sinun tulee kirjautua sisään käyttääksesi EtherEditor-muokkainta.',
	'ethereditor-js-off' => 'Sinun tulee sallia JavaScript käyttääksesi EtherEditor-muokkainta.',
	'ethereditor-manager-title' => 'EtherEditor-muokkaimen hallinta',
	'ethereditor-pad-title' => 'Lehtiön otsikko',
	'ethereditor-base-revision' => 'Pohjana oleva versio',
	'ethereditor-users-connected' => 'Käyttäjiä liittynyt',
	'ethereditor-admin-controls' => 'Ylläpitäjän toiminnot',
	'ethereditor-user-list' => 'Käyttäjäluettelo',
	'ethereditor-pad-list' => 'Istuntoluettelo',
	'ethereditor-current' => 'Nykyinen',
	'ethereditor-outdated' => 'Vanhentunut',
	'ethereditor-summary-message' => ' käyttäen EtherEditoria, muokkajat: $1',
	'ethereditor-session-created' => '$1 aloitti istunnon $2',
	'ethereditor-connected' => '$1 {{PLURAL:$1|liittynyt käyttäjä|liittynyttä käyttäjää}}',
	'ethereditor-switch-to-session' => 'Vaihda tähän istuntoon',
	'ethereditor-recover-session' => 'Palauta tämä istunto',
	'ethereditor-leave' => 'Yhteistyötila pois päältä',
);

/** French (français)
 * @author Brunoperel
 * @author Cquoi
 * @author Gomoko
 * @author IAlex
 * @author MarkTraceur
 */
$messages['fr'] = array(
	'ethereditor-desc' => 'Permet aux utilisateurs de modifier avec Etherpad',
	'ethereditor-prefs-enable-ether' => "Activer l'éditeur collaboratif (expérimental)",
	'ethereditor-collaborate-button' => 'Collaborez',
	'ethereditor-fork-button' => 'Session de Split',
	'ethereditor-contrib-button' => "Ajouter la liste des contributeurs au résumé d'édition",
	'ethereditor-kick-button' => 'Bloquez utilisateur',
	'ethereditor-delete-button' => 'Terminer la session',
	'ethereditor-cannot-nologin' => 'Pour pouvoir utiliser EtherEditor, vous devez être connecté.',
	'ethereditor-js-off' => 'Vous devez activer JavaScript pour utiliser EtherEditor.',
	'ethereditor-manager-title' => 'Gestion de EtherEditor',
	'ethereditor-pad-title' => 'Titre du bloc',
	'ethereditor-base-revision' => 'Révision de base',
	'ethereditor-users-connected' => 'Utilisateurs connectés',
	'ethereditor-admin-controls' => "Commandes d'administrateur",
	'ethereditor-user-list' => 'Liste des utilisateurs',
	'ethereditor-pad-list' => 'Liste de sessions',
	'ethereditor-current' => 'Actuel',
	'ethereditor-outdated' => 'Obsolète',
	'ethereditor-summary-message' => " à l'aide de EtherEditor, contributeurs : $1.",
	'ethereditor-session-created' => 'Session commencée par $1 $2',
	'ethereditor-connected' => '$1 {{PLURAL:$1|utilisateur connecté|utilisateurs connectés}}',
	'ethereditor-switch-to-session' => 'Basculer sur cette session',
	'ethereditor-recover-session' => 'Récupérer cette session',
	'ethereditor-leave' => 'Le mode de collaboration est désactivé.',
);

/** Franco-Provençal (arpetan)
 * @author ChrisPtDe
 */
$messages['frp'] = array(
	'ethereditor-collaborate-button' => 'Colaborâd',
	'ethereditor-fork-button' => 'Divisar la sèance',
	'ethereditor-contrib-button' => 'Apondre na lista des contributors u rèsumâ de changement',
	'ethereditor-delete-button' => 'Chavonar la sèance',
	'ethereditor-cannot-nologin' => 'Vos dête étre branchiê por povêr empleyér EtherEditor.',
	'ethereditor-js-off' => 'Vos dête activar JavaScript por povêr empleyér EtherEditor.',
	'ethereditor-manager-title' => 'Administracion de EtherEditor',
	'ethereditor-pad-title' => 'Titro du bloco',
	'ethereditor-base-revision' => 'Vèrsion de bâsa',
	'ethereditor-users-connected' => 'Utilisators branchiês',
	'ethereditor-admin-controls' => 'Comandes d’administrator',
	'ethereditor-user-list' => 'Lista des utilisators',
	'ethereditor-pad-list' => 'Lista de sèances',
	'ethereditor-current' => 'D’ora',
	'ethereditor-outdated' => 'Dèpassâ',
	'ethereditor-summary-message' => ' avouéc EtherEditor, contributors : $1',
	'ethereditor-session-created' => 'Sèance comenciêye per $1 $2',
	'ethereditor-connected' => '$1 {{PLURAL:$1|utilisator branchiê|utilisators branchiês}}',
);

/** Irish (Gaeilge)
 * @author පසිඳු කාවින්ද
 */
$messages['ga'] = array(
	'ethereditor-current' => 'reatha',
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
	'ethereditor-leave' => 'O modo colaborativo está desactivado',
);

/** Hebrew (עברית)
 * @author YaronSh
 * @author ערן
 */
$messages['he'] = array(
	'ethereditor-desc' => 'מאפשר למשתמשים לערוך דרך Etherpad',
	'ethereditor-prefs-enable-ether' => 'הפעלת עורך שיתופי (ניסיוני)',
	'ethereditor-kick-button' => 'בעיטה במשתמש',
	'ethereditor-users-connected' => 'משתמשים מחוברים',
	'ethereditor-user-list' => 'רשימת משתמשים',
	'ethereditor-summary-message' => 'באמצעות EtherEditor, תורמים: $1',
	'ethereditor-connected' => '$1 {{PLURAL:$1|משתמש מחובר|משתמשים מחוברים}}',
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
	'ethereditor-leave' => 'Sobudźěłowy modus je znjemóžnjeny',
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

/** Indonesian (Bahasa Indonesia)
 * @author Farras
 */
$messages['id'] = array(
	'ethereditor-desc' => 'Memungkinkan pengguna menyunting lewat Etherpad',
	'ethereditor-prefs-enable-ether' => 'Nyalakan editor kolaboratif (uji coba)',
	'ethereditor-collaborate-button' => 'Berkolaborasi',
	'ethereditor-fork-button' => 'Bagi sesi',
	'ethereditor-contrib-button' => 'Tambahkan daftar kontributor untuk menyunting ringkasan',
	'ethereditor-kick-button' => 'Keluarkan pengguna',
	'ethereditor-delete-button' => 'Akhiri sesi',
	'ethereditor-cannot-nologin' => 'Untuk memakai EtherEditor, Anda perlu masuk log.',
	'ethereditor-js-off' => 'Untuk memakai EtherEditor, Anda perlu menyalakan JavaScript.',
	'ethereditor-manager-title' => 'EtherEditor Management',
	'ethereditor-pad-title' => 'Judul pad',
	'ethereditor-base-revision' => 'Revisi dasar',
	'ethereditor-users-connected' => 'Pengguna yang terhubung',
	'ethereditor-admin-controls' => 'Kontrol pengurus',
	'ethereditor-user-list' => 'Daftar pengguna',
	'ethereditor-pad-list' => 'Daftar sesi',
	'ethereditor-current' => 'Saat ini',
	'ethereditor-outdated' => 'Usang',
	'ethereditor-summary-message' => 'menggunakan EtherEditor, kontributor: $1',
	'ethereditor-session-created' => 'Sesi dimulai oleh $1 $2',
	'ethereditor-connected' => '$1 {{PLURAL:$1|pengguna|pengguna}} terhubung',
	'ethereditor-switch-to-session' => 'Pindah ke sesi ini',
	'ethereditor-recover-session' => 'Pulihkan sesi ini',
	'ethereditor-leave' => 'Mode kolaborasi dimatikan',
);

/** Italian (italiano)
 * @author Beta16
 * @author Darth Kule
 */
$messages['it'] = array(
	'ethereditor-desc' => 'Consente agli utenti di modificare tramite Etherpad',
	'ethereditor-prefs-enable-ether' => 'Abilita la modifica collaborativa (molto sperimentale)',
	'ethereditor-collaborate-button' => 'Collabora',
	'ethereditor-fork-button' => 'Dividi sessione',
	'ethereditor-contrib-button' => "Aggiungi lista dei contributori all'oggetto della modifica",
	'ethereditor-kick-button' => 'Allontana utente',
	'ethereditor-delete-button' => 'Terminare sessione',
	'ethereditor-cannot-nologin' => "È necessario effettuare l'accesso per usare EtherEditor.",
	'ethereditor-js-off' => 'È necessario attivare JavaScript per usare EtherEditor.',
	'ethereditor-manager-title' => 'Gestione EtherEditor',
	'ethereditor-pad-title' => 'Titolo pad',
	'ethereditor-base-revision' => 'Versione di base',
	'ethereditor-users-connected' => 'Utenti connessi',
	'ethereditor-admin-controls' => 'Controlli amministratori',
	'ethereditor-user-list' => 'Elenco degli utenti',
	'ethereditor-pad-list' => 'Elenco sessioni',
	'ethereditor-current' => 'Attuale',
	'ethereditor-outdated' => 'Da aggiornare',
	'ethereditor-summary-message' => 'usando EtherEditor, contributori: $1',
	'ethereditor-session-created' => 'Sessione avviata da $1 $2',
	'ethereditor-connected' => '$1 {{PLURAL:$1|utente connesso|utenti connessi}}',
	'ethereditor-switch-to-session' => 'Passa a questa sessione',
	'ethereditor-recover-session' => 'Riprendi questa sessione',
);

/** Japanese (日本語)
 * @author Shirayuki
 */
$messages['ja'] = array(
	'ethereditor-desc' => '利用者が Etherpad で編集できるようにする',
	'ethereditor-fork-button' => 'セッションを分割',
	'ethereditor-delete-button' => 'セッションを終了',
	'ethereditor-cannot-nologin' => 'EtherEditor を使用するには、ログインする必要があります。',
	'ethereditor-js-off' => 'EtherEditor を使用するには、JavaScript を有効にする必要があります。',
	'ethereditor-manager-title' => 'EtherEditor の管理',
	'ethereditor-pad-title' => 'パッド名',
	'ethereditor-users-connected' => '接続している利用者',
	'ethereditor-admin-controls' => '管理用コントロール',
	'ethereditor-user-list' => '利用者一覧',
	'ethereditor-pad-list' => 'セッション一覧',
	'ethereditor-current' => '現在',
	'ethereditor-session-created' => '$1が $2に開始したセッション',
	'ethereditor-connected' => '$1 人の{{PLURAL:$1|利用者}}が接続しています',
	'ethereditor-switch-to-session' => 'このセッションに切り替え',
);

/** Georgian (ქართული)
 * @author David1010
 */
$messages['ka'] = array(
	'ethereditor-user-list' => 'მომხმარებლების სია',
	'ethereditor-pad-list' => 'სესიების სია',
	'ethereditor-current' => 'მიმდინარე',
	'ethereditor-outdated' => 'მოძველებული',
);

/** Korean (한국어)
 * @author 아라
 */
$messages['ko'] = array(
	'ethereditor-desc' => 'Etherpad를 통해 사용자가 편집하는 것을 허용',
	'ethereditor-prefs-enable-ether' => '공동 작업 편집기 활성화 (실험)',
	'ethereditor-collaborate-button' => '공동 작업',
	'ethereditor-fork-button' => '세션 나누기',
	'ethereditor-contrib-button' => '편집 요약에 기여자 목록 추가',
	'ethereditor-kick-button' => '사용자 강제 퇴장',
	'ethereditor-delete-button' => '세션 끝',
	'ethereditor-cannot-nologin' => 'EtherEditor를 사용하려면 로그인해야 합니다.',
	'ethereditor-js-off' => 'EtherEditer를 사용하려면 자바스크립트를 활성화해야 합니다.',
	'ethereditor-manager-title' => 'EtherEditor 관리',
	'ethereditor-pad-title' => '패드 제목',
	'ethereditor-base-revision' => '기본 판',
	'ethereditor-users-connected' => '연결한 사용자',
	'ethereditor-admin-controls' => '관리자 컨트롤',
	'ethereditor-user-list' => '사용자 목록',
	'ethereditor-pad-list' => '세션 목록',
	'ethereditor-current' => '현재',
	'ethereditor-outdated' => '오래됨',
	'ethereditor-summary-message' => 'EtherEditor를 사용한 기여자: $1',
	'ethereditor-session-created' => '$2에 $1 사용자가 세션을 시작함',
	'ethereditor-connected' => '연결한 {{PLURAL:$1|사용자}} $1명',
	'ethereditor-switch-to-session' => '이 세션으로 전환',
	'ethereditor-recover-session' => '이 세션 복구',
	'ethereditor-leave' => '공동 작업 모드가 비활성화되었습니다',
);

/** Colognian (Ripoarisch)
 * @author Purodha
 */
$messages['ksh'] = array(
	'ethereditor-desc' => 'Määd_et Sigge Ändere för ene Pöngel Metmaacher ob eijmohl övver en <i lang="en">etherpad</i> müjjelesch.',
	'ethereditor-prefs-enable-ether' => 'Et Ändere övver en <i lang="en">etherpad</i> enschallde. (För zem Ußprobeere)',
	'ethereditor-collaborate-button' => 'Em  <i lang="en">etherpad</i> Ändere',
	'ethereditor-fork-button' => 'Di Sezong opdeile',
	'ethereditor-contrib-button' => 'Donn de Metschriever-Leß onger {{int:summary}} endraare',
	'ethereditor-kick-button' => 'Ene Metmaacher ußschleeße',
	'ethereditor-delete-button' => 'Donn di Sezong beände',
	'ethereditor-cannot-nologin' => 'Öm övver en <i lang="en">etherpad</i> jät ze ändere, moß De enjelogg sin.',
	'ethereditor-js-off' => 'Öm dä <i lang="en">etherpad editor</i> ze bruche, moß De JavaSkrepp aanschallde.',
	'ethereditor-manager-title' => 'Verwalldong vum <i lang="en">etherpad editor</i>',
	'ethereditor-pad-title' => 'Däm <i lang="en">etherpad</i>sing Övverschreff',
	'ethereditor-base-revision' => 'De orschprönlesche Version',
	'ethereditor-users-connected' => 'verbonge Metmaacher',
	'ethereditor-admin-controls' => 'Verwalldongsknöpp',
	'ethereditor-user-list' => 'Leß met Metmaacher',
	'ethereditor-pad-list' => 'Leß met Sezonge',
	'ethereditor-current' => 'Om aktoälle Schtand',
	'ethereditor-outdated' => 'Övverhollt',
	'ethereditor-summary-message' => ' mem <i lang="en">etherpad editor</i> un $1 Metschriiver.',
	'ethereditor-session-created' => 'Di Sezong wood $2 {{GENDER:$1|vum|vum|vumm Metmaacher|vun dä|vum}} $1 bejunne.',
	'ethereditor-connected' => '{{PLURAL:$1|Eine|$1|Kein}} verbonge Metmaacher',
	'ethereditor-switch-to-session' => 'Op heh di Sezong ömschallde',
	'ethereditor-recover-session' => 'Heh di Sezong wider opnämme',
);

/** Luxembourgish (Lëtzebuergesch)
 * @author Robby
 */
$messages['lb'] = array(
	'ethereditor-prefs-enable-ether' => 'De kollaborativen Editeur aktivéieren (experimentell)',
	'ethereditor-collaborate-button' => 'Matmaachen',
	'ethereditor-fork-button' => 'Sessioun opdeelen',
	'ethereditor-kick-button' => 'Benotzer erausgeheien',
	'ethereditor-base-revision' => 'Basisversioun',
	'ethereditor-users-connected' => 'Ageloggte Benotzer',
	'ethereditor-user-list' => 'Benotzerlëscht',
	'ethereditor-current' => 'Aktuell',
	'ethereditor-outdated' => 'Vereelst',
	'ethereditor-connected' => '{{PLURAL:$1|Ee verbonnene Benotzer|$1 verbonne Benotzer}}',
);

/** Lithuanian (lietuvių)
 * @author Eitvys200
 */
$messages['lt'] = array(
	'ethereditor-user-list' => 'Naudotojų sąrašas',
);

/** Latvian (latviešu)
 * @author Papuass
 */
$messages['lv'] = array(
	'ethereditor-collaborate-button' => 'Sadarboties',
	'ethereditor-current' => 'Aktuāls',
	'ethereditor-outdated' => 'Novecojis',
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
	'ethereditor-leave' => 'Соработниот режим е исклучен',
);

/** Malay (Bahasa Melayu)
 * @author Anakmalaysia
 */
$messages['ms'] = array(
	'ethereditor-desc' => 'Membolehkan pengguna untuk menyunting melalui Etherpad',
	'ethereditor-prefs-enable-ether' => 'Hidupkan editor kerjasama (percubaan)',
	'ethereditor-collaborate-button' => 'Bekerjasama',
	'ethereditor-fork-button' => 'Bahagikan sesi',
	'ethereditor-contrib-button' => 'Tambahkan senarai penyumbang ke dalam ringkasan suntingan',
	'ethereditor-kick-button' => 'Usir pengguna',
	'ethereditor-delete-button' => 'Tamatkan sesi',
	'ethereditor-cannot-nologin' => 'Anda mesti log masuk untuk menggunakan EtherEditor.',
	'ethereditor-js-off' => 'Anda mesti menghidupkan JavaScript untuk menggunakan EtherEditor.',
	'ethereditor-manager-title' => 'Pengurusan EtherEditor',
	'ethereditor-pad-title' => 'Tajuk pad',
	'ethereditor-base-revision' => 'Semakan asas',
	'ethereditor-users-connected' => 'Pengguna yang bersambung',
	'ethereditor-admin-controls' => 'Kawalan penyelia',
	'ethereditor-user-list' => 'Senarai pengguna',
	'ethereditor-pad-list' => 'Senarai sesi',
	'ethereditor-current' => 'Terkini',
	'ethereditor-outdated' => 'Lapuk',
	'ethereditor-summary-message' => ' menggunakan EtherEditor, penyumbang: $1',
	'ethereditor-session-created' => 'Sesi dimulakan oleh $1 $2',
	'ethereditor-connected' => '$1 pengguna bersambung',
	'ethereditor-switch-to-session' => 'Beralih ke sesi ini',
	'ethereditor-recover-session' => 'Pulihkan sesi ini',
	'ethereditor-leave' => ' Mod kerjasama dimatikan',
);

/** Maltese (Malti)
 * @author Chrisportelli
 */
$messages['mt'] = array(
	'ethereditor-desc' => 'Tippermetti lill-utenti sabiex jimmodifikaw bl-Etherpad',
	'ethereditor-collaborate-button' => 'Ikkolabora',
	'ethereditor-fork-button' => 'Aqsam is-sessjoni',
	'ethereditor-contrib-button' => "Żid lista ta' kontributuri fit-taqsira tal-modifika",
	'ethereditor-kick-button' => 'Neħħi lill-utent',
	'ethereditor-delete-button' => 'Spiċċa s-sessjoni',
	'ethereditor-pad-title' => 'Titlu tal-pad',
	'ethereditor-users-connected' => 'Utenti konnessi',
	'ethereditor-user-list' => 'Lista tal-utenti',
	'ethereditor-pad-list' => "Lista ta' sessjonijiet",
	'ethereditor-current' => 'Attwali',
	'ethereditor-outdated' => "Bżonn ta' aġġornament",
	'ethereditor-session-created' => 'Sessjoni mibidja minn $1 $2',
	'ethereditor-switch-to-session' => 'Aqleb għal din is-sessjoni',
	'ethereditor-recover-session' => 'Irkupra din is-sessjoni',
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
	'ethereditor-leave' => 'Samenwerkingsmodus is uitgeschakeld',
);

/** Nederlands (informeel)‎ (Nederlands (informeel)‎)
 * @author Siebrand
 */
$messages['nl-informal'] = array(
	'ethereditor-cannot-nologin' => 'Je moet aanmelden om EtherEditor te kunnen gebruiken.',
	'ethereditor-js-off' => 'Om EtherEditor te kunnen gebruiken, moet je JavaScript inschakelen.',
);

/** Polish (polski)
 * @author BeginaFelicysym
 * @author Odie2
 */
$messages['pl'] = array(
	'ethereditor-desc' => 'Pozwala użytkownikom na edytowanie za pomocą Etherpad',
	'ethereditor-prefs-enable-ether' => 'Umożliwia wspólną edycję (eksperymentalnie)',
	'ethereditor-collaborate-button' => 'Współpracuj',
	'ethereditor-fork-button' => 'Podziel sesję',
	'ethereditor-contrib-button' => 'Dodaj listę współpracowników do podsumowania edycji',
	'ethereditor-kick-button' => 'Wyrzuć użytkownika',
	'ethereditor-delete-button' => 'Zakończ sesję',
	'ethereditor-cannot-nologin' => 'Aby korzystać z EtherEditor musisz się zalogować.',
	'ethereditor-js-off' => 'Aby korzystać z EtherEditor należy włączyć JavaScript.',
	'ethereditor-manager-title' => 'Zarządzanie EtherEditor',
	'ethereditor-pad-title' => 'Tytuł dokumentu',
	'ethereditor-base-revision' => 'Wersja bazowa',
	'ethereditor-users-connected' => 'Podłączeni użytkownicy',
	'ethereditor-admin-controls' => 'Polecenia administratora',
	'ethereditor-user-list' => 'Lista użytkowników',
	'ethereditor-pad-list' => 'Lista sesji',
	'ethereditor-current' => 'Bieżąca',
	'ethereditor-outdated' => 'Nieaktualna',
	'ethereditor-summary-message' => 'za pomocą EtherEditor, współautorzy:$1',
	'ethereditor-session-created' => 'Sesja rozpoczęta przez $1 $2',
	'ethereditor-connected' => '$1 {{PLURAL:$1| podłączony użytkownik|podłączeni użytkownicy|podłączonych użytkowników}}',
	'ethereditor-switch-to-session' => 'Przełącz się na tą sesję',
	'ethereditor-recover-session' => 'Odzyskaj tą sesję',
	'ethereditor-leave' => 'Tryb współpracy jest wyłączony',
);

/** Piedmontese (Piemontèis)
 * @author Borichèt
 * @author Dragonòt
 */
$messages['pms'] = array(
	'ethereditor-desc' => "A përmëtt a j'utent ëd modifiché via Etherpad",
	'ethereditor-prefs-enable-ether' => 'Abìlita la modìfica colaborativa (sperimental)',
	'ethereditor-collaborate-button' => 'Colàbora',
	'ethereditor-fork-button' => 'Session ëd division',
	'ethereditor-contrib-button' => 'Gionté la lista dij contributor al resumé dla modìfica',
	'ethereditor-kick-button' => "Pija a càuss l'utent",
	'ethereditor-delete-button' => 'Finì la session',
	'ethereditor-cannot-nologin' => "Për dovré l'EtherEditor, a dev esse intrà ant ël sistema.",
	'ethereditor-js-off' => "Për dovré l'EtherEditor, a dev abilité JavaScript.",
	'ethereditor-manager-title' => "Gestion d'EtherEditor",
	'ethereditor-pad-title' => 'Tìtol dël blòch',
	'ethereditor-base-revision' => 'Revision ëd base',
	'ethereditor-users-connected' => 'Utent colegà',
	'ethereditor-admin-controls' => "Comand d'aministrator",
	'ethereditor-user-list' => "Lista dj'utent",
	'ethereditor-pad-list' => 'Lista ëd session',
	'ethereditor-current' => 'Corent',
	'ethereditor-outdated' => 'Veje',
	'ethereditor-summary-message' => 'dovrand EtherEditor, contributor: $1',
	'ethereditor-session-created' => 'Session ancaminà da $1 $2',
	'ethereditor-connected' => '$1 {{PLURAL:$1|utent colegà}}',
	'ethereditor-switch-to-session' => 'Passa a sta session',
	'ethereditor-recover-session' => 'Recùpera sta session',
	'ethereditor-leave' => "La manera ëd colaborassion a l'é disabilità",
);

/** Pashto (پښتو)
 * @author Ahmed-Najib-Biabani-Ibrahimkhel
 */
$messages['ps'] = array(
	'ethereditor-user-list' => 'کارن لړليک',
	'ethereditor-current' => 'اوسنی',
);

/** Romanian (română)
 * @author Firilacroco
 * @author Minisarm
 * @author Stelistcristi
 */
$messages['ro'] = array(
	'ethereditor-collaborate-button' => 'Colaborați',
	'ethereditor-delete-button' => 'Sfârșește sesiunea',
	'ethereditor-users-connected' => 'Utilizatori conectați',
	'ethereditor-admin-controls' => 'Comenzi ale administratorilor',
	'ethereditor-user-list' => 'Lista utilizatorilor',
	'ethereditor-pad-list' => 'Listă de sesiuni',
	'ethereditor-current' => 'Actual',
	'ethereditor-outdated' => 'Învechit',
	'ethereditor-switch-to-session' => 'Comută la această sesiune',
	'ethereditor-recover-session' => 'Recuperează această sesiune',
	'ethereditor-leave' => 'Modul de colaborare este dezactivat',
);

/** tarandíne (tarandíne)
 * @author Joetaras
 */
$messages['roa-tara'] = array(
	'ethereditor-current' => 'Corrende',
);

/** Russian (русский)
 * @author DCamer
 */
$messages['ru'] = array(
	'ethereditor-desc' => 'Позволяет пользователям редактировать через Etherpad',
	'ethereditor-prefs-enable-ether' => 'Включение совместного редактора (экспериментально)',
	'ethereditor-collaborate-button' => 'Совместно',
	'ethereditor-fork-button' => 'Разделить сессии',
	'ethereditor-contrib-button' => 'Добавить список авторов в описание правки',
	'ethereditor-kick-button' => 'Кикнуть участника',
	'ethereditor-delete-button' => 'Закончить сессию',
	'ethereditor-cannot-nologin' => 'Для того, чтобы использовать EtherEditor, вы должны войти в систему.',
	'ethereditor-js-off' => 'Для того, чтобы использовать EtherEditor, вы должны активировать JavaScript.',
	'ethereditor-manager-title' => 'Управление EtherEditor',
	'ethereditor-pad-title' => 'Название',
	'ethereditor-base-revision' => 'Базовая версия',
	'ethereditor-users-connected' => 'Подключено участников',
	'ethereditor-admin-controls' => 'Управление',
	'ethereditor-user-list' => 'Список участников',
	'ethereditor-pad-list' => 'Список сессий',
	'ethereditor-current' => 'Текущий',
	'ethereditor-outdated' => 'Устаревший',
	'ethereditor-summary-message' => ' использование EtherEditor, авторов: $1',
	'ethereditor-session-created' => 'Сессию начал $1 $2',
	'ethereditor-connected' => '{{PLURAL:$1|подключен $1 участник|подключено $1 участника|подключено $1 участников}}',
	'ethereditor-switch-to-session' => 'Переключится на эту сессию',
	'ethereditor-recover-session' => 'Восстановить эту сессию',
	'ethereditor-leave' => ' Совместный режим отключен',
);

/** Sinhala (සිංහල)
 * @author පසිඳු කාවින්ද
 */
$messages['si'] = array(
	'ethereditor-desc' => 'Etherpad හරහා සංස්කරණය කිරීමට පරිශීලකයන් හට ඉඩ දෙන්න',
	'ethereditor-collaborate-button' => 'සහයෝගයෙන් ක්‍රියා කරන්න',
	'ethereditor-fork-button' => 'සැසිය විභේදනය',
	'ethereditor-kick-button' => 'සන්තෝෂ පරිශීලක',
	'ethereditor-delete-button' => 'සැසිය අවසන් කරන්න',
	'ethereditor-manager-title' => 'ඌර්ධ්වාන්තරීක්ෂසංස්කාරක කළමනාකරණය',
	'ethereditor-pad-title' => 'උපධාන ශීර්ෂය',
	'ethereditor-base-revision' => 'පාදක සංශෝධනය',
	'ethereditor-users-connected' => 'පරිශීලකයන් සම්බන්ධිතයි',
	'ethereditor-admin-controls' => 'පරිපාලක පාලක',
	'ethereditor-user-list' => 'පරිශීලක ලැයිස්තුව',
	'ethereditor-pad-list' => 'සැසි ලැයිස්තුව',
	'ethereditor-current' => 'වත්මන්',
	'ethereditor-outdated' => 'යල් පැන ගිය',
	'ethereditor-session-created' => '$1 විසින් සැසිය ආරම්භ කරන ලදී $2',
	'ethereditor-switch-to-session' => 'මෙම සැසිය වෙත මාරුවන්න',
	'ethereditor-recover-session' => 'මෙම සැසිය ආපසු ලබාගන්න',
);

/** Swedish (svenska)
 * @author Ainali
 * @author WikiPhoenix
 */
$messages['sv'] = array(
	'ethereditor-desc' => 'Låter användarna redigera via Etherpad',
	'ethereditor-prefs-enable-ether' => 'Aktivera gemensam redigerare (experimentell)',
	'ethereditor-collaborate-button' => 'Samarbeta',
	'ethereditor-fork-button' => 'Dela upp session',
	'ethereditor-contrib-button' => 'Lägg till lista över bidragsgivare till redigeringssammanfattning',
	'ethereditor-kick-button' => 'Sparka användare',
	'ethereditor-delete-button' => 'Avsluta session',
	'ethereditor-cannot-nologin' => 'För att använda EtherEditor måste du logga in.',
	'ethereditor-js-off' => 'För att använda EtherEditor måste du aktivera JavaScript.',
	'ethereditor-manager-title' => 'EtherEditor-hantering',
	'ethereditor-pad-title' => 'Blocktitel',
	'ethereditor-base-revision' => 'Basversion',
	'ethereditor-users-connected' => 'Anslutna användare',
	'ethereditor-admin-controls' => 'Administratörkontroller',
	'ethereditor-user-list' => 'Användarlista',
	'ethereditor-pad-list' => 'Sessionslista',
	'ethereditor-current' => 'Aktuell',
	'ethereditor-outdated' => 'Föråldrad',
	'ethereditor-summary-message' => ' använder EtherEditor, bidragsgivare: $1',
	'ethereditor-session-created' => 'Session startad av $1 $2',
	'ethereditor-connected' => '$1 anslutna {{PLURAL:$1|användare|användare}}',
	'ethereditor-switch-to-session' => 'Växla till denna session',
	'ethereditor-recover-session' => 'Återställ denna session',
	'ethereditor-leave' => ' Samarbetsläget ät inaktiverat',
);

/** Tamil (தமிழ்)
 * @author Karthi.dr
 * @author மதனாஹரன்
 */
$messages['ta'] = array(
	'ethereditor-delete-button' => 'அமர்வை நிறைவு செய்யவும்',
	'ethereditor-user-list' => 'பயனர் பட்டியல்',
	'ethereditor-pad-list' => 'அமர்வுப் பட்டியல்',
	'ethereditor-current' => 'நடப்பு',
	'ethereditor-outdated' => 'காலாவதியானது',
);

/** Telugu (తెలుగు)
 * @author Veeven
 */
$messages['te'] = array(
	'ethereditor-user-list' => 'వాడుకరుల జాబితా',
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

/** Ukrainian (українська)
 * @author Base
 */
$messages['uk'] = array(
	'ethereditor-desc' => 'Дозволяє користувачам редагувати через Etherpad',
	'ethereditor-prefs-enable-ether' => 'Увімкнення спільного редактора (експериментально)',
	'ethereditor-collaborate-button' => 'Співпрацювати',
	'ethereditor-fork-button' => 'Розірвати сесію',
	'ethereditor-contrib-button' => 'Додати список редакторів до опису редагування',
	'ethereditor-kick-button' => 'Виключити користувача',
	'ethereditor-delete-button' => 'Завершити сесію',
	'ethereditor-cannot-nologin' => 'Для того, щоб використовувати EtherEditor, Ви повинні увійти до системи.',
	'ethereditor-js-off' => 'Для того, щоб використовувати EtherEditor, Ви повинні увімкнути JavaScript.',
	'ethereditor-manager-title' => 'Керування EtherEditor',
	'ethereditor-pad-title' => 'Заголовок документу',
	'ethereditor-base-revision' => 'Основна версія',
	'ethereditor-users-connected' => 'Підключено користувачів',
	'ethereditor-admin-controls' => 'Адміністративний контроль',
	'ethereditor-user-list' => 'Список користувачів',
	'ethereditor-pad-list' => 'Список сесії',
	'ethereditor-current' => 'Актуальний',
	'ethereditor-outdated' => 'Застарілий',
	'ethereditor-summary-message' => ' використовуючи EtherEditor, редактори: $1',
	'ethereditor-session-created' => 'Сесію розпочато $1 $2',
	'ethereditor-connected' => 'Підключено $1 {{PLURAL:$1|користувача|користувачі|користувачів}}',
	'ethereditor-switch-to-session' => 'Перемкнутись на цю сесію',
	'ethereditor-recover-session' => 'Відновити цю сесію',
	'ethereditor-leave' => ' Режим співпраці вимкнено',
);

/** Urdu (اردو)
 * @author පසිඳු කාවින්ද
 */
$messages['ur'] = array(
	'ethereditor-collaborate-button' => 'مل کر کام',
	'ethereditor-delete-button' => 'آخر میں اجلاس',
	'ethereditor-user-list' => 'صارف فہرست',
	'ethereditor-pad-list' => 'اجلاس کی فہرست',
	'ethereditor-current' => 'موجودہ',
);

/** Vietnamese (Tiếng Việt)
 * @author පසිඳු කාවින්ද
 */
$messages['vi'] = array(
	'ethereditor-current' => 'Hiện hành',
);

/** Yiddish (ייִדיש)
 * @author පසිඳු කාවින්ද
 */
$messages['yi'] = array(
	'ethereditor-current' => 'לויפֿיקע',
);

/** Simplified Chinese (中文（简体）‎)
 * @author Yfdyh000
 */
$messages['zh-hans'] = array(
	'ethereditor-desc' => '允许用户通过 Etherpad 编辑',
	'ethereditor-prefs-enable-ether' => '启用协作编辑器（实验性）',
	'ethereditor-collaborate-button' => '合作',
	'ethereditor-fork-button' => '拆分会话',
	'ethereditor-contrib-button' => '添加贡献者名单到编辑摘要',
	'ethereditor-kick-button' => '踢出用户',
	'ethereditor-delete-button' => '结束会话',
	'ethereditor-cannot-nologin' => '若要使用 EtherEditor，您必须登录。',
	'ethereditor-js-off' => '若要使用 EtherEditor，您必须启用 JavaScript。',
	'ethereditor-manager-title' => 'EtherEditor 管理',
	'ethereditor-pad-title' => '便签标题',
	'ethereditor-base-revision' => '基础版本',
	'ethereditor-users-connected' => '已连接用户',
	'ethereditor-admin-controls' => '管理控制台',
	'ethereditor-user-list' => '用户列表',
	'ethereditor-pad-list' => '会话列表',
	'ethereditor-current' => '当前',
	'ethereditor-outdated' => '已过期',
	'ethereditor-summary-message' => ' 使用EtherEditor，贡献者：$1',
	'ethereditor-session-created' => '会话由$1开始于$2',
	'ethereditor-connected' => '$1名用户已连接',
	'ethereditor-switch-to-session' => '切换到此会话',
	'ethereditor-recover-session' => '恢复此会话',
	'ethereditor-leave' => '协作模式已禁用',
);
