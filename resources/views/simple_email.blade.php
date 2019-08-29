<!doctype html> 
<html>
   <head>
      <meta charset="utf-8">
      <title>Motoblockchain </title>
      <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
     <!-- font -->
     <link href="https://fonts.googleapis.com/css?family=Titillium+Web:300,400,600,700" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
   </head>
   <body>
      <div style="margin:auto;background: #f7f7f7; float:left;  margin-top: 2px;padding:2px 0; border: 2px solid #d90f17;
    border-radius: 10px;">
      <table  align="center;" border="0" style="margin:auto; width:100%; text-align:center;font-size: 15px;color: #666;">
         <tr>
            <td align="center" colspan="2" style="background-color:#eaeaea; border-radius: 8px 8px 0 0; padding: 7px 0;">
               <img style="margin:0 auto; display:block" src="https://motoblockchain.us/public/frontend/images/email-logo-1.png" />
            </td>
         </tr>
          <tr>
            <td colspan="2">
               <p style="text-align:left;">
               <?php 
               if(!empty($data['message'])){
                    	echo $data['message'];
               }
               ?>
                </p>
            </td>
         </tr>
         @if(!empty($data['url']))
         <tr>
            <td colspan="2" align="center">
            <br/>
               {{$data['url']}}
            <br/>  
            </td>
         </tr>
         @endif
         
          <tr>
                    <td align="center" colspan="2" style="background-color:#eaeaea; border-radius:0px 0px 8px 8px; padding: 7px 0;">
               <img style="margin:0 auto; display:block" src="https://motoblockchain.us/public/frontend/images/email-logo-2.png" />
            </td>     
         </tr>
      </table>
   </div>
   </body>
</html>