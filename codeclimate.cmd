@ECHO OFF
SETLOCAL

FOR /f "tokens=*" %%i IN ('docker-machine env default') DO %%i

SET CODECLIMATE_CODE=%CD:\=/%
SET CODECLIMATE_CODE=%CODECLIMATE_CODE:C:=/c%
SET CODECLIMATE_TMP=%TEMP:\=/%/codeclimate
SET CODECLIMATE_TMP=%CODECLIMATE_TMP:C:=/c%

docker run ^
--interactive --rm ^
--env CODECLIMATE_CODE ^
--env CODECLIMATE_TMP ^
--env CODECLIMATE_DEBUG ^
--volume "%CODECLIMATE_CODE%":/code ^
--volume "%CODECLIMATE_TMP%":/tmp/cc ^
--volume /var/run/docker.sock:/var/run/docker.sock ^
codeclimate/codeclimate %*
PAUSE