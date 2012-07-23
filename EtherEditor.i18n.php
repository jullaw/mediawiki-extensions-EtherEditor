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
	'ethereditor-fork-button' => 'Copy pad',
	'ethereditor-contrib-button' => 'Add list of contributors to edit summary',
	'ethereditor-kick-button' => 'Kick user',
	'ethereditor-delete-button' => 'Delete pad',
	'ethereditor-cannot-nologin' => 'In order to use the EtherEditor, you must log in.',
	'ethereditor-js-off' => 'In order to use the EtherEditor, you must enable JavaScript.',
	'ethereditor-manager-title' => 'EtherEditor Management',
	'ethereditor-pad-title' => 'Pad title',
	'ethereditor-base-revision' => 'Base revision',
	'ethereditor-users-connected' => 'Users connected',
	'ethereditor-admin-controls' => 'Admin controls',
	'ethereditor-user-list' => 'User list',
	'ethereditor-pad-list' => 'Pad list',
	'ethereditor-current' => 'Current',
	'ethereditor-outdated' => 'Outdated',
	'ethereditor-summary-message' => ' using EtherEditor, contributors: $1.',
);

/** Message documentation (Message documentation)
 * @author Kghbln
 * @author Mark Holmquist
 * @author Raymond
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
);

/** German (Deutsch)
 * @author Kghbln
 */
$messages['de'] = array(
	'ethereditor-desc' => 'Ermöglicht es Benutzern, Seiten mit dem EtherPad-Editor zu bearbeiten',
	'ethereditor-prefs-enable-ether' => 'EtherPad-Editor aktivieren (experimentell)',
	'ethereditor-collaborate-button' => 'Mitmachen',
	'ethereditor-fork-button' => 'EtherPad kopieren',
	'ethereditor-contrib-button' => 'Liste der Bearbeiter der Bearbeitungszusammenfassung hinzufügen',
	'ethereditor-kick-button' => 'Benutzer ausschließen',
	'ethereditor-delete-button' => 'EtherPad löschen',
	'ethereditor-cannot-nologin' => 'Um den EtherPad-Editor nutzen zu können, musst du dich anmelden.',
	'ethereditor-js-off' => 'Um den EtherPad-Editor nutzen zu können, musst du JavaScript aktivieren.',
	'ethereditor-manager-title' => 'Verwaltung des EtherPad-Editors',
	'ethereditor-pad-title' => 'Name des EtherPads',
	'ethereditor-base-revision' => 'Ursprungsversion',
	'ethereditor-users-connected' => 'Verbundene Benutzer',
	'ethereditor-admin-controls' => 'Administrationssteuerung',
	'ethereditor-current' => 'Aktuell',
	'ethereditor-outdated' => 'Veraltet',
	'ethereditor-summary-message' => 'Benutzer, die den EtherPad-Editor verwendet haben: $1',
	'ethereditor-warn-others' => 'Warnung: Andere Benutzer bearbeiten diese Seite gerade gemeinsam mit dem EtherPad-Editor. Du kannst diese Seite gerne weiter bearbeiten, allerdings könnten deine Bearbeitungen im Konflikt zu deren Bearbeitungen stehen. Überlege, ob du dich ihnen nicht beim gemeinsamen Bearbeiten anschließen möchtest, indem du die Schaltfläche „{{int:ethereditor-collaborate-button}}“ anklickst. Du findest sie in der oberen rechten Ecke des Bildschirms. Auf diese Weise kannst Du Zusammenführungskonflikte beim Speichern der Seite vermeiden.',
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
	'ethereditor-fork-button' => 'Dalšne tekstowe pólo napóraś',
	'ethereditor-contrib-button' => 'Lisćinu sobustatkujucych wobźěłowanja zespominanja pśidaś',
	'ethereditor-kick-button' => 'Wužywarja wen chyśiś',
	'ethereditor-delete-button' => 'Toś to pólo lašowaś',
	'ethereditor-cannot-nologin' => 'Aby EtherEditor wužywał, musyš pśizjawjony byś.',
);

/** Spanish (español)
 * @author Armando-Martin
 */
$messages['es'] = array(
	'ethereditor-desc' => 'Permite a los usuarios editar mediante Etherpad',
	'ethereditor-prefs-enable-ether' => 'Activar el editor colaborativo (muy experimental)',
	'ethereditor-collaborate-button' => 'Colaborar',
	'ethereditor-fork-button' => 'Abrir una ventana separada',
	'ethereditor-contrib-button' => 'Añadir una lista de los colaboradores al resumen de edición',
	'ethereditor-kick-button' => 'Echar a un usuario',
	'ethereditor-delete-button' => 'Eliminar esta ventana',
	'ethereditor-cannot-nologin' => 'Para poder utilizar el sistema EtherEditor, debes iniciar sesión.',
);

/** French (français)
 * @author Gomoko
 * @author MarkTraceur
 */
$messages['fr'] = array(
	'ethereditor-desc' => 'Permet aux utilisateurs de modifier avec Etherpad',
	'ethereditor-prefs-enable-ether' => "Activer l'éditeur collaboratif (expérimental)",
	'ethereditor-collaborate-button' => 'Collaborez',
	'ethereditor-fork-button' => 'Copiez ce bloc-note',
	'ethereditor-contrib-button' => "Ajouter la liste des contributeurs au résumé d'édition",
	'ethereditor-kick-button' => 'Bloquez utilisateur',
	'ethereditor-delete-button' => 'Supprimer ce bloc',
	'ethereditor-cannot-nologin' => 'Pour pouvoir utiliser EtherEditor, vous devez être connecté.',
);

/** Galician (galego)
 * @author Toliño
 */
$messages['gl'] = array(
	'ethereditor-desc' => 'Permite aos usuarios editar a través do Etherpad',
	'ethereditor-prefs-enable-ether' => 'Activar o editor colaborativo (moi experimental)',
	'ethereditor-collaborate-button' => 'Colaborar',
	'ethereditor-fork-button' => 'Abrir unha ventá separada',
	'ethereditor-contrib-button' => 'Engadir unha lista dos colaboradores ao resumo de edición',
	'ethereditor-kick-button' => 'Botar ao usuario',
	'ethereditor-delete-button' => 'Pechar esta ventá separada',
	'ethereditor-cannot-nologin' => 'Cómpre acceder ao sistema para utilizar o EtherEditor.',
);

/** Upper Sorbian (hornjoserbsce)
 * @author Michawiki
 */
$messages['hsb'] = array(
	'ethereditor-desc' => 'Źmóžnja wužiwarjam z pomocu Etherpada wobdźěłać',
	'ethereditor-prefs-enable-ether' => 'Editor za zhromadne wodźěłowanje zmóžnić (jara eksperimentelny)',
	'ethereditor-collaborate-button' => 'Sobudźěłać',
	'ethereditor-fork-button' => 'Dalše tekstowe polo wutworić',
	'ethereditor-contrib-button' => 'Lisćinu sobuskutkowacych wobdźěłowanskeho zjeća přidać',
	'ethereditor-kick-button' => 'Wužiwarja won ćisnyć',
	'ethereditor-delete-button' => 'Tute polo zhašeć',
	'ethereditor-cannot-nologin' => 'Zo by EtherEditor wužiwał, dyrbiš přizjewjeny być.',
);

/** Interlingua (interlingua)
 * @author McDutchie
 */
$messages['ia'] = array(
	'ethereditor-desc' => 'Permitte al usatores modificar per medio de Etherpad',
	'ethereditor-prefs-enable-ether' => 'Activar le editor collaborative (experimental)',
	'ethereditor-collaborate-button' => 'Collaborar',
	'ethereditor-fork-button' => 'Copiar iste "pad"',
	'ethereditor-contrib-button' => 'Adder lista de contributores al summario de modification',
	'ethereditor-kick-button' => 'Ejectar usator',
	'ethereditor-delete-button' => 'Deler iste pad',
	'ethereditor-cannot-nologin' => 'Pro usar le EtherEditor, tu debe aperir session.',
);

/** Italian (italiano)
 * @author Beta16
 */
$messages['it'] = array(
	'ethereditor-desc' => 'Consente agli utenti di modificare tramite Etherpad',
	'ethereditor-prefs-enable-ether' => 'Abilita la modifica collaborativa (molto sperimentale)',
	'ethereditor-collaborate-button' => 'Collabora',
	'ethereditor-fork-button' => 'Dividi questo pad',
	'ethereditor-contrib-button' => "Aggiungi lista dei contributori all'oggetto della modifica",
	'ethereditor-kick-button' => 'Allontana utente',
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
	'ethereditor-fork-button' => 'Направи друга текстуална кутија',
	'ethereditor-contrib-button' => 'Додај список на учесници во описот на уредувањето',
	'ethereditor-kick-button' => 'Клоцни го корисникот',
	'ethereditor-delete-button' => 'Избриши го овој EtherPad',
	'ethereditor-cannot-nologin' => 'За да го користите EtherEditor, мора прво да се најавите.',
);

/** Dutch (Nederlands)
 * @author Saruman
 * @author Siebrand
 */
$messages['nl'] = array(
	'ethereditor-desc' => 'Maakt het mogelijk om te bewerken via Etherpad',
	'ethereditor-prefs-enable-ether' => 'Gezamenlijke tekstverwerker inschakelen (experimenteel)',
	'ethereditor-collaborate-button' => 'Samenwerken',
	'ethereditor-fork-button' => 'Kopie van deze pad maken',
	'ethereditor-contrib-button' => 'Lijst met auteurs toevoegen aan bewerkingssamenvatting',
	'ethereditor-kick-button' => 'Gebruiker verwijderen',
	'ethereditor-delete-button' => 'Deze EtherPad verwijderen',
	'ethereditor-cannot-nologin' => 'U moet aanmelden om EtherEditor te kunnen gebruiken.',
);

/** Tagalog (Tagalog)
 * @author AnakngAraw
 */
$messages['tl'] = array(
	'ethereditor-desc' => 'Nagpapahintulot sa mga tagagamit na makapamatnugot sa pamamagitan ng Etherpad',
	'ethereditor-prefs-enable-ether' => 'Paganahin ang pampagtutulungang patungot (napaka pang-eksperimento)',
	'ethereditor-collaborate-button' => 'Makipagtulungan',
	'ethereditor-fork-button' => 'Kopyahin ang saping ito',
	'ethereditor-contrib-button' => 'Idagdag ang listahan ng mga nag-aambag sa buod ng pamamatnugot',
	'ethereditor-kick-button' => 'Sipain ang tagagamit',
	'ethereditor-delete-button' => 'Burahin ang saping ito',
	'ethereditor-cannot-nologin' => 'Upang magamit ang EtherEditor, dapat na nakalagda ka.',
);
