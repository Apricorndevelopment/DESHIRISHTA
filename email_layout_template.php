<?php

function getEmailLayout($customHtml)
{

    return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desi Rishta</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4;">
    <div style="background-color: #f4f4f4; padding: 20px 0; font-family: 'Arial', sans-serif;">
        <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
            
            <div style="background-color: #5c1a1a; padding: 25px 0; text-align: center;">
                <img src="https://desi-rishta.com/images/tlogo.png" alt="Desi Rishta Logo" style="width: 320px; display: inline-block;">
            </div>

            <div style="padding: 20px; text-align: left; background-color: #ffffff;">
                 <div style='color:#000; width:100%; margin:0 auto;'>
                    $customHtml
                   <div style="margin-top:20px;">
                    <div>
                   Thanks & Regards,<br>
                  Team Desi Rishta<br>
                 <a href="mailto:support@desi-rishta.com">support@desi-rishta.com</a>
                </div>
               </div>

                 </div>
            </div>

            <div style="background-color: #fdf2d9; padding: 40px 35px; border-top: 1px solid #e8e8e8; text-align: center;">
                <p style="font-size: 13px; color: #6e5244; line-height: 1.6; margin: 0 0 30px 0;">
                    You are receiving this email because you registered at Desi Rishta or to ensure the implementation of our Terms of Service.
                </p>
                <div style="text-align: center; margin-bottom: 25px;">
                <div style="display: inline-block; vertical-align: middle; width: 60px; height: 1px; background-color: #d4c4a8;"></div>
                <div style="display: inline-block; vertical-align: middle; padding: 0 15px; font-size: 16px; font-weight: bold; color: #5c1a1a;">
                Connect with us
                </div>
               <div style="display: inline-block; vertical-align: middle; width: 60px; height: 1px; background-color: #d4c4a8;"></div>
               </div>
                
                <div style="margin-bottom:25px;text-align:center;">
<div style="margin-bottom:25px;text-align:center;">
  <a href="https://facebook.com" style="margin:0 6px;display:inline-block;">
    <img src="https://desi-rishta.com/images/email_layout_images/facebook.png"
         alt="Facebook"
         width="36"
         height="36"
         style="display:block;border-radius:50%;background:#6b3f2b;">
  </a>

  <a href="https://instagram.com" style="margin:0 6px;display:inline-block;">
    <img src="https://desi-rishta.com/images/email_layout_images/instagram.png"
         alt="Instagram"
         width="36"
         height="36"
         style="display:block;border-radius:50%;background:#6b3f2b;">
  </a>

  <a href="https://x.com" style="margin:0 6px;display:inline-block;">
    <img src="https://desi-rishta.com/images/email_layout_images/x.png"
         alt="X"
         width="36"
         height="36"
         style="display:block;border-radius:50%;background:#6b3f2b;">
  </a>

  <a href="https://linkedin.com" style="margin:0 6px;display:inline-block;">
    <img src="https://desi-rishta.com/images/email_layout_images/linkedin.png"
         alt="LinkedIn"
         width="36"
         height="36"
         style="display:block;border-radius:50%;background:#6b3f2b;">
  </a>

  <a href="https://youtube.com" style="margin:0 6px;display:inline-block;">
    <img src="https://desi-rishta.com/images/email_layout_images/youtube.png"
         alt="YouTube"
         width="36"
         height="36"
         style="display:block;border-radius:50%;background:#6b3f2b;">
  </a>
</div>

</div>


                <div style="font-size: 13px; margin-bottom: 25px; color: #5c1a1a;">
                    <a href="#" style="color: #5c1a1a; text-decoration: none;">Privacy policy</a> &nbsp; | &nbsp; 
                    <a href="#" style="color: #5c1a1a; text-decoration: none;">Help center</a> &nbsp; | &nbsp; 
                    <a href="#" style="color: #5c1a1a; text-decoration: none;">Unsubscribe</a>
                </div>

                <div style="border-top: 1px solid #d4c4a8; padding-top: 20px;">
                    <p style="font-size: 13px; color: #5c1a1a; margin-bottom: 15px; font-weight: bold;">
                        © 2026 Desi Rishta. All rights reserved
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
HTML;
}
