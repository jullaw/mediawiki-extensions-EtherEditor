SHELL = /bin/sh
PHP = php
# This might work. If it fails, try changing it.
MWPATH = ${MW_INSTALL_PATH}
PU = ${PHP} ${MWPATH}/tests/phpunit/phpunit.php

tests: config api

config:
	${PU} EtherEditorTest.php

api:
	${PU} api/
