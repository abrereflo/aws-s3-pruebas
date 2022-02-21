   <!DOCTYPE html>
   <html lang="en">

   <head>
       <meta charset="UTF-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Document</title>
   </head>

   <body>

       <h1>HOLA MUNDO AWS S3 </h1>
       <?php
        require 'vendor/autoload.php';
        use Aws\Sts\StsClient;
        use Aws\S3\S3Client;
        use Aws\S3\Exception\S3Exception;


        if (isset($_FILES['file'])) {
            s3_upload_put_object($_FILES['file']);
        }

        function s3_upload_put_object($file)
        {

            $credentials = new Aws\Credentials\Credentials('AKIATTJPFITJVBFUZSW4', 'AKWCYFhqSAAKtKp6m4mVaNV0KFhIVKQSM9tMbXUO');
            
            $bucket = 'measurement-prueba-4';
            $file_name = $file['name'];
            $file_path = $file['tmp_name'];

            try {
                $s3Client = new S3Client([

                    'region' => 'us-east-2',
                    'version' => 'latest',
                    'credentials' => $credentials

                ]);
                /* 
                $manager = new \Aws\S3\Transfer($s3Client, $file_path, $dest);
                $manager->transfer(); */
                $contentType =$file['type'];

                $result = $s3Client->putObject([
                    
                    'ACL' => 'public-read',
                    'Bucket' => $bucket,
                    'Key' => 'you/' . $file_name,
                    'SourceFile' => $file_path,
                    'Content-Type' => $contentType,
                ]);

                echo "<pre>" . print_r($result, true) . "</pre>";
            } catch (S3Exception $e) {
                echo $e->getMessage() . "\n";
            }
        }
        ?>

       <form action="" method="post" enctype="multipart/form-data">
           <label for="file">bucket par imagenes</label>
           <input type="file" name="file" id="file">

           <button type="submit">Enviar a file</button>
       </form>
       <img src="https://measurement-prueba-3.s3.us-east-2.amazonaws.com/ssR.jpg" alt=""><br>
       <br>
       <br>
       <a href="prueba.php"> Prueba parametros</a><br><br>
       <a href="craerbucket.php"> Prueba crear</a><br><br>
       <a href="permisos.php"> Prueba permisos</a>
       <br><br><br><br><br>
       <!--  <div class="container">
           <h2>Amazon S3 File Upload using PHP</h2>
           <br>
           <form action="" method='post' enctype="multipart/form-data">
               <h3>Upload Image</h3><br />
               <input type='file' name='upload_file' />
               <input type='submit' name="upload_files" value='Upload' />
           </form>
          
       </div> -->
   </body>


   </html>