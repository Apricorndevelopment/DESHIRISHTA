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

            <div style="padding: 20px 40px 20px 40px; text-align: left; background-color: #ffffff;">
                 <div style='color:#000; width:90%; margin:0 auto;'>
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
  <!-- Facebook -->
  <a href="#" style="margin:0 6px;display:inline-block;">
    <svg width="36" height="36" viewBox="0 0 36 36" aria-label="Facebook">
      <circle cx="18" cy="18" r="18" fill="#6b3f2b"/>
      <path fill="#ffffff" transform="translate(9 8)"
        d="M13 4h-2c-1.1 0-1.5.7-1.5 1.4V7h3l-.4 3H9.5v8H6V10H4V7h2V5.2C6 2.7 7.5 1 10.3 1c1.2 0 2.7.2 2.7.2z"/>
    </svg>
  </a>

  <!-- Instagram -->
  <a href="#" style="margin:0 6px;display:inline-block;">
    <svg width="36" height="36" viewBox="0 0 36 36" aria-label="Instagram">
      <circle cx="18" cy="18" r="18" fill="#6b3f2b"/>
      <g fill="#ffffff" transform="translate(10 10)">
        <path d="M2 0h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm6 4a4 4 0 1 0 0 8a4 4 0 0 0 0-8zm0 2a2 2 0 1 1 0 4a2 2 0 0 1 0-4zm5-2a1 1 0 1 1-2 0a1 1 0 0 1 2 0z"/>
      </g>
    </svg>
  </a>

  <!-- X -->
  <a href="#" style="margin:0 6px;display:inline-block;">
    <svg width="36" height="36" viewBox="0 0 36 36" aria-label="X">
      <circle cx="18" cy="18" r="18" fill="#6b3f2b"/>
      <path fill="#ffffff" transform="translate(9 9)"
        d="M11.5 0H15l-6.6 7.6L15 16h-3.9L7.8 11.6L3.8 16H0l7-8L0 0h4l3 3.8z"/>
    </svg>
  </a>

  <!-- LinkedIn -->
  <a href="#" style="margin:0 6px;display:inline-block;">
    <svg width="36" height="36" viewBox="0 0 36 36" aria-label="LinkedIn">
      <circle cx="18" cy="18" r="18" fill="#6b3f2b"/>
      <g fill="#ffffff" transform="translate(9 9)">
        <path d="M1 6h4v10H1zM3 0a2 2 0 1 1 0 4a2 2 0 0 1 0-4z"/>
        <path d="M7 6h4v1.4h.1c.6-1 1.9-1.7 3.4-1.7c3.6 0 4.5 2.3 4.5 5.3V16h-4v-4.5c0-1.1 0-2.5-1.6-2.5s-1.9 1.2-1.9 2.4V16H7z"/>
      </g>
    </svg>
  </a>

  <!-- YouTube -->
  <a href="#" style="margin:0 6px;display:inline-block;">
    <svg width="36" height="36" viewBox="0 0 36 36" aria-label="YouTube">
      <circle cx="18" cy="18" r="18" fill="#6b3f2b"/>
      <path fill="#ffffff" transform="translate(11 12)"
        d="M14 6c0-1.5-.2-2.6-.6-3.2c-.4-.5-1.1-.6-1.6-.7C10.3 2 7 2 7 2s-3.3 0-4.8.1c-.5.1-1.2.2-1.6.7C.2 3.4 0 4.5 0 6s.2 2.6.6 3.2c.4.5 1.1.6 1.6.7C3.7 10 7 10 7 10s3.3 0 4.8-.1c.5-.1 1.2-.2 1.6-.7c.4-.6.6-1.7.6-3.2zM5.5 8V4l4 2z"/>
    </svg>
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
