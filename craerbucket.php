<?php

require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Aws\Exception\AwsException;


function createBucket($s3Client, $bucketName)
{
    try {
      
        $result = $s3Client->createBucket([
            'Bucket' => $bucketName,
        ]);

        $result = $s3Client->createMultipartUpload([
            'ACL' => 'public-read',
            'Bucket' => $bucketName, // REQUIRED
            'BucketKeyEnabled' => true,
            'Key' => 'AKIATTJPFITJVBFUZSW4', // REQUIRED            
            'ObjectLockLegalHoldStatus' => 'ON',
            'ObjectLockMode' => 'GOVERNANCE',
             'ServerSideEncryption' => 'aws:kms',
            'StorageClass' => 'STANDARD',
         
        ]);
        return 'The bucket\'s location is: ' .
            $result['Location'] . '. ' .
            'The bucket\'s effective URI is: ' . 
            $result['@metadata']['effectiveUri'];
    } catch (AwsException $e) {
        return 'Error: ' . $e->getAwsErrorMessage();
    }
}

function createTheBucket()
{
    $s3Client = new S3Client([
        
        'region' => 'us-east-2',
        'version' => 'latest',

        'credentials' => [
            'secret' => 'AKWCYFhqSAAKtKp6m4mVaNV0KFhIVKQSM9tMbXUO',
            'key' => 'AKIATTJPFITJVBFUZSW4'
        ]
        
    ]);

    echo createBucket($s3Client, 'measurement-prueba-4');
}
createTheBucket();



$s3Client = new S3Client([
    'profile' => 'default',
    'region' => 'us-east-2',
    'version' => 'latest',
    'credentials' => [
        'secret' => 'AKWCYFhqSAAKtKp6m4mVaNV0KFhIVKQSM9tMbXUO',
        'key' => 'AKIATTJPFITJVBFUZSW4'
    ]
    
]);

$buckets = $s3Client->listBuckets();
foreach ($buckets['Buckets'] as $bucket) {
    echo $bucket['Name'] . "\n";
}




