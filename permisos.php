<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\S3\Exception\S3Exception;

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
$bucket = 'measurement-prueba-2';
try {
    $resp = $s3Client->getBucketAcl([
        'Bucket' => $bucket
    ]);
/*     var_dump($resp); */
    echo "Succeed in retrieving bucket ACL as follows: \n";
} catch (AwsException $e) {
    // output error message if fails
    echo $e->getMessage();
    echo "\n";
}
/* $grands[] = $resp->get('Grants');

$owner[] = $resp->get('Owner');
print_r($owner[0]);
exit(); */
// Sets the permissions on a bucket using access control lists (ACL).
$params = [
    'ACL' => 'public-read',
    'AccessControlPolicy' => [
        // Information can be retrieved from `getBucketAcl` response
        'Grants' => [
            [
                'Grantee' => [
                    'DisplayName' => '<string>',
                    'EmailAddress' => '<string>',
                    'ID' => '4d6257ce59662f0b0ec66aa0c9463b99892472bf053f12c3c9ac809286b12a27',
                    'Type' => 'AmazonCustomerByEmail',
                    'URI' => '<string>',
                ],
                'Permission' => 'FULL_CONTROL',
            ],
            // ...
        ],           
         
        'Owner' => [
            'DisplayName' => '<string>',
            'ID' => '4d6257ce59662f0b0ec66aa0c9463b99892472bf053f12c3c9ac809286b12a27',
        ],
     ],
    'Bucket' => 'measurement-prueba-2',
];

print_r($params);
/* exit(); */

try {
    $resp = $s3Client->putBucketAcl($params);
    echo "Succeed in setting bucket ACL.\n";
} catch (AwsException $e) {
    // Display error message
    echo $e->getMessage();
    echo "\n";
}
