<?  
$strTo = "serj1966@bk.ru";
$strSubject = "Загружен новый на быструю печать!";
$strMessage = nl2br($_POST["txtDescription"]);  
  
//*** Uniqid Session ***//  
$strSid = md5(uniqid(time()));  
  
$strHeader = "";  
$strHeader .= "From: ".$_POST["txtFormName"]."<".$_POST["txtFormEmail"].">\nReply-To: ".$_POST["txtFormEmail"]."";  
  
$strHeader .= "MIME-Version: 1.0\n";  
$strHeader .= "Content-Type: multipart/mixed; boundary=\"".$strSid."\"\n\n";  
$strHeader .= "This is a multi-part message in MIME format.\n";  
  
$strHeader .= "--".$strSid."\n";  
$strHeader .= "Content-type: text/html; charset=utf-8\n";  
$strHeader .= "Content-Transfer-Encoding: 7bit\n\n";  
$strHeader .= $strMessage."\n\n";  
  
//*** Attachment ***//  
if($_FILES["fileAttach"]["name"] != "")  
{  
$strFilesName = $_FILES["fileAttach"]["name"];  
$strContent = chunk_split(base64_encode(file_get_contents($_FILES["fileAttach"]["tmp_name"])));  
$strHeader .= "--".$strSid."\n";  
$strHeader .= "Content-Type: application/octet-stream; name=\"".$strFilesName."\"\n";  
$strHeader .= "Content-Transfer-Encoding: base64\n";  
$strHeader .= "Content-Disposition: attachment; filename=\"".$strFilesName."\"\n\n";  
$strHeader .= $strContent."\n\n";  
}
  
$flgSend = @mail($strTo,$strSubject,null,$strHeader);  // @ = No Show Error //  
  
if($flgSend)  
{  
echo "";  
}  
else  
{  
echo "Возникла ошибка! Макет не загружен";  
}  
ini_set('short_open_tag', 'On');
header('Refresh: 3; URL=index.php');
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Макет загружен</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.less" type="text/less">

    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Ваш макет загружен</h1>
                    <h2 class="text-center">Сейчас с Вами свяжется менеджер</h2>
                </div>
            </div>
        </div>
        <script src="assets/less/less.min.js"></script>
        <script type="text/javascript">
            setTimeout('location.replace("/1.php")', 3000);
            миллисекунд)
        </script>

    </body>

    </html>
