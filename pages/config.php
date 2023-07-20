<?php

require_once __DIR__ . '/../env_files/.env';
$apiKey = getenv('API_KEY');
echo $apiKey;
?>