<?php
/**
 * API module to export data from Etherpad instances
 *
 * @file ApiEtherEditor.php
 * @ingroup API
 *
 * @license GNU GPL v2+
 * @author Mark Holmquist <mtraceur@member.fsf.org>
 */

class ApiEtherEditor extends ApiBase {
    public function __construct ( $main, $action ) {
        parent::__construct( $main, $action );
    }

	public function execute() {
        global $wgUser, $wgEtherpadConfig;
		$params = $this->extractRequestParams();
		$data = array();
        $result = $this->getResult();
        if ( ! isset( $params['padId'] ) ) {
            $result->addValue(
                array( 'ApiEtherEditor' ),
                'error',
                'No pad ID.'
            );
            return;
        }
        $padId = $params['padId'];
        $apiHost = $wgEtherpadConfig['apiHost'];
        $apiPort = $wgEtherpadConfig['apiPort'];
        $apiBaseUrl = $wgEtherpadConfig['apiUrl'];
        $apiUrl = 'http://' . $apiHost . ':' . $apiPort . $apiBaseUrl;
        $apiKey = $wgEtherpadConfig['apiKey'];
        $epClient = new EtherpadLiteClient( $apiKey, $apiUrl );
        $userId = $wgUser->getId();
        $authorResult = $epClient->createAuthorIfNotExistsFor( $wgUser->getName(), $userId );
        $authorId = $authorResult->authorID;
        $groupResult = $epClient->createGroupIfNotExistsFor( "editing" );
        $groupId = $groupResult->groupID;
        $sessionResult = $epClient->createSession( $groupId, $authorId, time() + 3600 );
        $sessionId = $sessionResult->sessionID;
        $groupPadId = $groupId . '$' . $padId;
        $result->addValue(
            array( 'ApiEtherEditor' ),
            'html',
            $epClient->getHTML( $padId )->html
        );
    }

	public function getAllowedParams() {
		return array(
			'padId' => array(
				ApiBase::PARAM_TYPE => 'string',
				ApiBase::PARAM_REQUIRED => true,
				ApiBase::PARAM_ISMULTI => false
			),
		);
	}

	public function getParamDescription() {
		return array(
			'padId' => 'The name of the pad to export.',
		);
	}

	public function getDescription() {
		return array(
			'API module for exporting pads created with EtherEditor.',
		);
	}

	protected function getExamples() {
		return array(
			'api.php?action=ApiEtherEditor&padId=g.sdkjfksljajskdf$Testing',
		);
	}
    
    public function getVersion() {
        return __CLASS__ . ': 0.1';
    }
}

?>
