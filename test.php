<?php
# Includes the autoloader for libraries installed with composer
require __DIR__ . '/vendor/autoload.php';

# Imports the Google Cloud client library
use Google\Cloud\Speech\SpeechClient;

# Your Google Cloud Platform project ID
$projectId = 'data-skype';

# Instantiates a client
$speech = new SpeechClient([
    'projectId' => $projectId,
    'languageCode' => 'en-US',
]);

# The name of the audio file to transcribe
$fileName = __DIR__ . '/resources/audio.flac';

# The audio file's encoding and sample rate
$options = [
    'encoding' => 'FLAC',
    'sampleRateHertz' => 16000,
];

# Detects speech in the audio file
$results = $speech->recognize(fopen($fileName, 'r'), $options);

foreach ($results as $result) {
    echo 'Transcription: ' . $result->alternatives()[0]['transcript'] . PHP_EOL;
}
?>