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
            <td align="center" colspan="2" style="background-color:#eaeaea; border-radius:0px 0px 8px 8px; padding: 7px 0;">
               <img style="margin:0 auto; display:block" src="https://motoblockchain.us/public/frontend/images/email-logo-1.png">
            </td>
         </tr>
         <tr>
            <td colspan="2">
               <h2 style="text-align:center;">We are glad you are here</h2>
            </td>
         </tr>
          <tr>
            <td colspan="2">
               <p style="text-align:center;">Hi  <b>@if(!empty($data['name']))
               {{ $data['name'] }}
               @else
                 {{ $data['email'] }}
               @endif </b>,</p>
              
               <p> <?php if($data['message'])
                   {
                    	echo $data['message'] ;
                   }
                   ?>
                </p>
                
              
            </td>
         </tr>
         @if($data['type']=='bike_reg')
         <tr>
            <td colspan="2" align="center">
            
               <a href="#" title="Click Here" > 
                <img  src="https://motoblockchain.us/public/frontend/images/bike_reg_status.png" width="100%" title="Registration Status"  alt="MotorCycle Registration Status">
            </a>
             
            </td>
         </tr>
          <tr>
            <td colspan="2" align="center">
            
               <h3 style="text-align:center;"> Download App</h3>
            </td>
         </tr>
         
          <tr>
            <td  align="center">
            
               <a href="#" title="Click Here" > 
                <img  src="https://motoblockchain.us/public/frontend/images/googleplay.png" width="60%" title="Download Now"  alt="Get it on Google Play">
            </a>
            <td  align="center">
            
               <a href="#" title="Click Here" > 
                <img  src="https://motoblockchain.us/public/frontend/images/app_store.png" width="60%" title="Download Now"  alt="Get it on App Store ">
            </a>
             
            </td>
         </tr>
         @endif
         @if(!empty($data['url']))
         <tr>
            <td colspan="2" align="center">
            <br/>
               <a href="{{ $data['url'] }}" title="Click Here" > 
                <img style="max-width:40%;" src="https://motoblockchain.us/public/frontend/images/click-button.png" alt="Click Here To Verify Your Email Address">
            </a>
            <br/>  
            </td>
         </tr>
         @endif
         
         <tr>
            <td colspan="2">
               <!--<p style="margin-bottom:5px;">We just want to confirm you"re you.</p>-->
               <p>“You are receiving this email because you are registered in Motoblockchain database.
                You are free to edit or cancel your data anytime by clicking <a href="https://motoblockchain.us/my-profile?setting=active">here </a>”</p>
            </td>
          </tr>  
          <tr>
                    <td align="center" colspan="2" style="background-color:#eaeaea; border-radius: 8px 8px 0 0; padding: 7px 0;">
               <img style="margin:0 auto; display:block" src="https://motoblockchain.us/public/frontend/images/email-logo-2.png">
            </td>   
         </tr>
      </table>
   </div>
   </body>
</html>