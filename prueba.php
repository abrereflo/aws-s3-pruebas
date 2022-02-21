<?php  

require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Aws\Exception\AwsException;


// Create a S3Client 
$s3Client = new S3Client([
    'profile' => 'default',
    'region' => 'us-east-2',
    'version' => 'latest',
    'credentials' => [
        'secret' => 'AKWCYFhqSAAKtKp6m4mVaNV0KFhIVKQSM9tMbXUO',
        'key' => 'AKIATTJPFITJVBFUZSW4'
    ]
    
]);
// Gets the access control policy for a bucket
$bucket ='measurement-kas-prueba';

try {
    $resp = $s3Client->getBucketAcl([
        'Bucket' => $bucket
    ]);
    echo "Succeed in retrieving bucket ACL as follows: \n";
    print_r($resp);
} catch (AwsException $e) {
    // output error message if fails
    echo $e->getMessage();
    echo "\n";
}

exit();