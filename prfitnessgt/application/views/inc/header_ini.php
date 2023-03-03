<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?=$title?></title>
    
    <link rel="stylesheet" href="<?=ROOT_SYS?>/assets/css/bootstrap.css" />  
    <style type="text/css">
       
    
    ::selection { background-color: #E13300; color: white; }
    ::-moz-selection { background-color: #E13300; color: white; }
        
        
    @font-face {
        font-family: Quicksand;
        src: url(<?=ROOT_SYS?>/assets/fonts/Quicksand/Quicksand-Regular.ttf) format("truetype");
    }        
    @font-face {
        font-family: Anton;
        src: url(<?=ROOT_SYS?>/assets/fonts/Anton/Anton-Regular.ttf) format("truetype");
    }        
    body {
        background-color: #FFF;
        margin: 40px;
        font: 16px/20px normal Helvetica, Arial, sans-serif;
        font-family: 'Quicksand', sans-serif;
        color: #4F5155;
        word-wrap: break-word;
    }
    a {
        color: #003399;
        background-color: transparent;
        font-weight: normal;
    }
    h1 {
        color: #444;
        background-color: transparent;
        border-bottom: 1px solid #D0D0D0;
        font-size: 24px;
        font-weight: normal;
        margin: 0 0 14px 0;
        padding: 14px 15px 10px 15px;
        font-family: 'Anton', sans-serif;
    }
    code {
        font-family: Consolas, Monaco, Courier New, Courier, monospace;
        font-size: 12px;
        background-color: #f9f9f9;
        border: 1px solid #D0D0D0;
        color: #002166;
        display: block;
        margin: 14px 0 14px 0;
        padding: 12px 10px 12px 10px;
    }
    #body {
        margin: 0 15px 0 15px;
    }
    p.footer {
        text-align: right;
        font-size: 12px;
        border-top: 1px solid #D0D0D0;
        line-height: 32px;
        padding: 0 10px 0 10px;
        margin: 20px 0 0 0;
    }
    #container {
        margin: 10px;
        border: 1px solid #D0D0D0;
        box-shadow: 0 0 8px #D0D0D0;
    }
    .form_error{
        font-size: 13px;
        font-family:Arial;
        color: white;
        font-style:italic;
        box-shadow: 1px 5px 5px lightgray;
        background-color:crimson;
        border-radius: 5px;
        padding: 5px;
        margin-bottom: 25px;        
    }
    </style>
</head>