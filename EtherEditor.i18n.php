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
	'ethereditor-fork-button' => 'Copy this pad',
	'ethereditor-contrib-button' => 'Add list of contributors to edit summary',
	'ethereditor-kick-button' => 'Kick user',
	'ethereditor-warn-others' => 'Warning: Some other users are currently editing this page in a collaborative session using the EtherEditor extension.
While you are welcome to keep editing here, their changes may conflict with yours.
Please consider clicking the "{{int:ethereditor-collaborate-button}}" button in the top right of the page screen to join them, and avoid merge conflicts.',
);

/** Message documentation (Message documentation)
 * @author Kghbln
 * @author Mark Holmquist
 */
$messages['qqq'] = array(
	'ethereditor-desc' => '{{desc}}',
	'ethereditor-prefs-enable-ether' => 'A preference that enables the experimental collaborative editor.',
	'ethereditor-collaborate-button' => 'A button at the top of the page (near read/edit) that invites the user to collaborate with others.',
	'ethereditor-fork-button' => 'A button above the textarea that allows the user to create a separate pad.',
	'ethereditor-contrib-button' => 'A button that will populate the edit summary with the list of contributors saved in the database.',
	'ethereditor-kick-button' => 'A button that will kick a user from the current Etherpad instance.',
	'ethereditor-warn-others' => 'A message to let the user know that other people are editing the page with EtherEditor. "Collaborate" should be identical to {{msg-mw|Ethereditor-collaborate-button}}.',
);

/** German (Deutsch)
 * @author Kghbln
 */
$messages['de'] = array(
	'ethereditor-desc' => 'Ermöglicht es Benutzern, Seiten mit dem EtherPad-Editor zu bearbeiten',
	'ethereditor-prefs-enable-ether' => 'EtherPad-Editor aktivieren (experimentell)',
	'ethereditor-collaborate-button' => 'Mitmachen',
	'ethereditor-fork-button' => 'Weiteres Textfeld erstellen',
	'ethereditor-contrib-button' => 'Liste der Bearbeiter der Bearbeitungszusammenfassung hinzufügen',
	'ethereditor-kick-button' => 'Benutzer ausschließen',
	'ethereditor-warn-others' => 'Warnung: Andere Benutzer bearbeiten diese Seite gerade gemeinsam mit dem EtherPad-Editor. Du kannst diese Seite gerne weiter bearbeiten, allerdings könnten deine Bearbeitungen im Konflikt zu deren Bearbeitungen stehen. Überlege, ob du dich ihnen nicht beim gemeinsamen Bearbeiten anschließen möchtest, indem du die Schaltfläche „{{int:ethereditor-collaborate-button}}“ anklickst. Du findest sie in der oberen rechten Ecke des Bildschirms. Auf diese Weise kannst Du Zusammenführungskonflikte beim Speichern der Seite vermeiden.',
);

/** German (formal address) (‪Deutsch (Sie-Form)‬) */
$messages['de-formal'] = array(
	'ethereditor-warn-others' => 'Warnung: Andere Benutzer bearbeiten diese Seite gerade gemeinsam mit dem EtherPad-Editor. Sie können diese Seite gerne weiter bearbeiten, allerdings könnten Ihre Bearbeitungen im Konflikt zu deren Bearbeitungen stehen. Überlegen Sie sich, ob Sie sich ihnen nicht beim gemeinsamen Bearbeiten anschließen möchten, indem Sie die Schaltfläche „Mitmachen“ anklicken. Sie finden sie in der oberen rechten Ecke des Bildschirms. Auf diese Weise können Sie Zusammenführungskonflikte beim Speichern der Seite vermeiden.',
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
	'ethereditor-warn-others' => 'Advertencia: Algunos otros usuarios están actualmente editando esta página en una sesión colaborativa mediante la extensión EtherEditor.
Si bien te invitamos a seguir editando aquí, sus cambios pueden entrar en conflicto con los tuyos.
Por favor considera hacer clic en el botón "{{int:ethereditor-collaborate-button}}" de la parte superior derecha de la pantalla para unirte a ellos, y evitar conflictos de combinación.',
);

/** Galician (galego)
 * @author Toliño
 */
$messages['gl'] = array(
	'ethereditor-desc' => 'Permite aos usuarios editar a través do Etherpad, unha aplicación web para a edición colaborativa',
	'ethereditor-prefs-enable-ether' => 'Activar o editor colaborativo (moi experimental)',
	'ethereditor-collaborate-button' => 'Colaborar',
	'ethereditor-fork-button' => 'Abrir unha ventá separada',
	'ethereditor-contrib-button' => 'Engadir unha lista dos colaboradores ao resumo de edición',
);

/** Upper Sorbian (hornjoserbsce)
 * @author Michawiki
 */
$messages['hsb'] = array(
	'ethereditor-desc' => 'Źmóžnja wužiwarjam z pomocu Etherpada wobdźěłać, webaplikacija za zhromadne wobdźěłowanje',
	'ethereditor-prefs-enable-ether' => 'Editor za zhromadne wodźěłowanje zmóžnić (jara eksperimentelny)',
	'ethereditor-collaborate-button' => 'Sobudźěłać',
	'ethereditor-fork-button' => 'Dalše tekstowe polo wutworić',
	'ethereditor-contrib-button' => 'Lisćinu sobuskutkowacych na wobdźěłanskim zjeću přidać',
	'ethereditor-kick-button' => 'Wužiwarja won ćisnyć',
	'ethereditor-warn-others' => "Warnowanje: Někotři druzy wužiwarjo wobdźěłuja tuchwilu tutu stronu w zhromadnym posedźenju z pomocu rozšěrjenja EtherEditor. Móžeš bjeze wšeho tu dale dźěłać, ale jich změny móža z twojimi w konflikće być.  Rozwaž, hač nochceš z nimi zhromadnje dźěłać a klikń potom na tłóčatko ''Sobudźěłać\", zo by konflikty wobešoł.",
);

/** Interlingua (interlingua)
 * @author McDutchie
 */
$messages['ia'] = array(
	'ethereditor-desc' => 'Permitte al usatores de modificar per medio de Etherpad, un application web pro le modification collaborative',
	'ethereditor-prefs-enable-ether' => 'Activar le editor collaborative (multo experimental)',
	'ethereditor-collaborate-button' => 'Collaborar',
);

/** Italian (italiano)
 * @author Beta16
 */
$messages['it'] = array(
	'ethereditor-desc' => "Consente agli utenti di modificare tramite Etherpad, un'applicazione web per l'editing collaborativo",
	'ethereditor-prefs-enable-ether' => 'Abilita la modifica collaborativa (molto sperimentale)',
	'ethereditor-collaborate-button' => 'Collabora',
	'ethereditor-fork-button' => 'Dividi questo pad',
	'ethereditor-contrib-button' => "Aggiungi lista dei contributori all'oggetto della modifica",
);

/** Luxembourgish (Lëtzebuergesch)
 * @author Robby
 */
$messages['lb'] = array(
	'ethereditor-prefs-enable-ether' => 'De kollaborativen Editeur aktivéieren (experimentell)',
);

/** Macedonian (македонски)
 * @author Bjankuloski06
 */
$messages['mk'] = array(
	'ethereditor-desc' => 'Им овозможува на корисниците да уредуваат преку Etherpad - прилог за соработно уредување',
	'ethereditor-prefs-enable-ether' => 'Овозможи соработен уредник (многу експериментален)',
	'ethereditor-collaborate-button' => 'Соработувајте',
	'ethereditor-fork-button' => 'Направи друга текстуална кутија',
	'ethereditor-contrib-button' => 'Додај список на учесници во описот на уредувањето',
	'ethereditor-kick-button' => 'Клоцни го корисникот',
	'ethereditor-warn-others' => 'Предупредување: Моментално страницата ја уредуваат некои други корисници
во соработна сесија користејќи го додатокот EtherEditor. Иако сте добредојдени да продолжите
да уредувате тука, промените што тие ќе ги направат може да се косат со вашите. Ви препорачуваме да стиснете на копчето „Соработувај“
во десниот горен агол на екранот за да им се придружите, и така да избегнете спротиставености во уредувањата.',
);

/** Dutch (Nederlands)
 * @author Siebrand
 */
$messages['nl'] = array(
	'ethereditor-desc' => 'Maakt het mogelijk om te bewerken via Etherpas, een webapplicatie voor samen bewerken',
	'ethereditor-prefs-enable-ether' => 'Gezamenlijke tekstverwerker inschakelen (experimenteel)',
	'ethereditor-collaborate-button' => 'Samenwerken',
	'ethereditor-fork-button' => 'Kopie van deze pad maken',
	'ethereditor-contrib-button' => 'Lijst met auteurs toevoegen aan bewerkingssamenvatting',
	'ethereditor-kick-button' => 'Gebruiker verwijderen',
	'ethereditor-warn-others' => 'Waarschuwing: andere gebruikers zijn op dit moment samen bezig met het bewerken van deze pagina met behulp van de uitbreiding EtherEditor.
Als u hier blijft bewerken, kunnen uw wijzigingen conflicteren met die van hun.
U kunt op de knop "Samenwerken" klikken rechts bovenaan uw scherm om bewerkingsconflicten te voorkomen.',
);

/** Tagalog (Tagalog)
 * @author AnakngAraw
 */
$messages['tl'] = array(
	'ethereditor-desc' => 'Nagpapahintulot sa mga tagagamit na makapamatnugot sa pamamagitan ng Etherpad, isang aplikasyong pangweb para sa pamamatnugot na may pagtutulungan',
	'ethereditor-prefs-enable-ether' => 'Paganahin ang pampagtutulungang patungot (napaka pang-eksperimento)',
	'ethereditor-collaborate-button' => 'Makipagtulungan',
);

